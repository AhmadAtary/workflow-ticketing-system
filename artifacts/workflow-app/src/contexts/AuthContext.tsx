import React, { createContext, useContext, useState, useEffect, ReactNode } from "react";
import { User, UserRole, UserStatus } from "@workspace/api-client-react";

interface AuthContextType {
  user: User | null;
  isLoading: boolean;
  login: (email: string, role: "admin" | "user") => Promise<void>;
  logout: () => Promise<void>;
}

const AuthContext = createContext<AuthContextType | undefined>(undefined);

export function AuthProvider({ children }: { children: ReactNode }) {
  const [user, setUser] = useState<User | null>(null);
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    // Check local storage for user on mount
    const storedUser = localStorage.getItem("flowdesk_user");
    if (storedUser) {
      try {
        setUser(JSON.parse(storedUser));
      } catch (e) {
        console.error("Failed to parse stored user");
      }
    }
    setIsLoading(false);
  }, []);

  const login = async (email: string, role: "admin" | "user") => {
    // Simulate API call
    await new Promise((resolve) => setTimeout(resolve, 500));
    
    const mockUser: User = {
      id: role === "admin" ? "user-1" : "user-2",
      name: role === "admin" ? "Admin User" : "Regular User",
      email,
      role: role === "admin" ? UserRole.admin : UserRole.user,
      teamId: "team-1",
      teamName: "Engineering",
      avatar: `https://i.pravatar.cc/150?u=${email}`,
      status: UserStatus.active,
      createdAt: new Date().toISOString(),
      lastLogin: new Date().toISOString(),
    };

    setUser(mockUser);
    localStorage.setItem("flowdesk_user", JSON.stringify(mockUser));
  };

  const logout = async () => {
    await new Promise((resolve) => setTimeout(resolve, 300));
    setUser(null);
    localStorage.removeItem("flowdesk_user");
  };

  return (
    <AuthContext.Provider value={{ user, isLoading, login, logout }}>
      {children}
    </AuthContext.Provider>
  );
}

export function useAuth() {
  const context = useContext(AuthContext);
  if (context === undefined) {
    throw new Error("useAuth must be used within an AuthProvider");
  }
  return context;
}
