import { createContext, useContext, useEffect, useRef, useState, type ReactNode } from "react";
import type { User } from "@flowdesk/api-client";
import { ApiHttpError, type ApiEnvelope, requestJson, type ApiRequestInit } from "@/shared/api/http";

interface SessionPayload {
  user: User;
  access_token: string;
  token_type: string;
  expires_in: number;
}

interface AuthContextType {
  user: User | null;
  accessToken: string | null;
  isLoading: boolean;
  login: (email: string, password: string) => Promise<void>;
  logout: () => Promise<void>;
  refreshSession: () => Promise<string | null>;
  request: <T>(path: string, init?: ApiRequestInit, options?: { retryOnUnauthorized?: boolean }) => Promise<T>;
}

const AuthContext = createContext<AuthContextType | undefined>(undefined);

function isSessionEnvelope(value: unknown): value is ApiEnvelope<SessionPayload> {
  return Boolean(value && typeof value === "object" && "data" in value);
}

export function AuthProvider({ children }: { children: ReactNode }) {
  const [user, setUser] = useState<User | null>(null);
  const [accessToken, setAccessToken] = useState<string | null>(null);
  const [isLoading, setIsLoading] = useState(true);
  const tokenRef = useRef<string | null>(null);
  const refreshPromiseRef = useRef<Promise<string | null> | null>(null);

  const clearSession = () => {
    tokenRef.current = null;
    setAccessToken(null);
    setUser(null);
  };

  const applySession = (payload: SessionPayload) => {
    tokenRef.current = payload.access_token;
    setAccessToken(payload.access_token);
    setUser(payload.user);
  };

  const refreshSession = async (): Promise<string | null> => {
    if (refreshPromiseRef.current) {
      return refreshPromiseRef.current;
    }

    refreshPromiseRef.current = (async () => {
      try {
        const response = await requestJson<ApiEnvelope<SessionPayload>>("/auth/refresh", {
          method: "POST",
        });

        if (!isSessionEnvelope(response)) {
          clearSession();
          return null;
        }

        applySession(response.data);
        return response.data.access_token;
      } catch {
        clearSession();
        return null;
      } finally {
        refreshPromiseRef.current = null;
      }
    })();

    return refreshPromiseRef.current;
  };

  const request = async <T,>(
    path: string,
    init: ApiRequestInit = {},
    options: { retryOnUnauthorized?: boolean } = {},
  ): Promise<T> => {
    const retryOnUnauthorized = options.retryOnUnauthorized ?? true;

    try {
      return await requestJson<T>(path, init, tokenRef.current);
    } catch (error) {
      if (retryOnUnauthorized && error instanceof ApiHttpError && error.status === 401) {
        const refreshedToken = await refreshSession();

        if (refreshedToken) {
          return requestJson<T>(path, init, refreshedToken);
        }
      }

      throw error;
    }
  };

  const login = async (email: string, password: string) => {
    const response = await requestJson<ApiEnvelope<SessionPayload>>("/auth/login", {
      method: "POST",
      body: { email, password },
    });

    if (!isSessionEnvelope(response)) {
      throw new Error("Invalid login response.");
    }

    applySession(response.data);
  };

  const logout = async () => {
    try {
      await request("/auth/logout", { method: "POST" }, { retryOnUnauthorized: false });
    } catch {
      // Ignore logout errors so the local session is always cleared.
    } finally {
      clearSession();
    }
  };

  useEffect(() => {
    let cancelled = false;

    void (async () => {
      try {
        await refreshSession();
      } finally {
        if (!cancelled) {
          setIsLoading(false);
        }
      }
    })();

    return () => {
      cancelled = true;
    };
  }, []);

  return (
    <AuthContext.Provider
      value={{
        user,
        accessToken,
        isLoading,
        login,
        logout,
        refreshSession,
        request,
      }}
    >
      {children}
    </AuthContext.Provider>
  );
}

export function useAuth() {
  const context = useContext(AuthContext);

  if (!context) {
    throw new Error("useAuth must be used within an AuthProvider");
  }

  return context;
}
