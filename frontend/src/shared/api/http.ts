export interface ApiEnvelope<T> {
  data: T;
}

export interface ApiPaginatedEnvelope<T> extends ApiEnvelope<T> {
  meta: {
    page: number;
    per_page: number;
    total: number;
  };
}

export interface ProblemDocument {
  type?: string;
  title?: string;
  status?: number;
  detail?: string;
  instance?: string;
  trace_id?: string;
  errors?: Record<string, string[]>;
}

export class ApiHttpError extends Error {
  constructor(
    message: string,
    public readonly status: number,
    public readonly payload: ProblemDocument | string | null,
  ) {
    super(message);
    this.name = "ApiHttpError";
  }
}

export type ApiRequestInit = Omit<RequestInit, "body"> & {
  body?: BodyInit | FormData | Record<string, unknown> | unknown[] | null;
};

const API_BASE_URL = (import.meta.env.VITE_API_BASE_URL || "/api/v1").replace(/\/+$/, "");

function resolveUrl(path: string): string {
  if (path.startsWith("http://") || path.startsWith("https://")) {
    return path;
  }

  return `${API_BASE_URL}${path.startsWith("/") ? path : `/${path}`}`;
}

function normalizeBody(body: ApiRequestInit["body"], headers: Headers): BodyInit | null | undefined {
  if (body == null) {
    return body;
  }

  if (
    typeof body === "string" ||
    body instanceof Blob ||
    body instanceof ArrayBuffer ||
    body instanceof FormData ||
    body instanceof URLSearchParams ||
    body instanceof ReadableStream
  ) {
    return body;
  }

  if (!headers.has("content-type")) {
    headers.set("content-type", "application/json");
  }

  return JSON.stringify(body);
}

async function parseResponse(response: Response): Promise<unknown> {
  if (response.status === 204 || response.status === 205) {
    return null;
  }

  const contentType = response.headers.get("content-type") || "";

  if (contentType.includes("application/json") || contentType.includes("+json")) {
    return response.json();
  }

  const text = await response.text();
  return text === "" ? null : text;
}

export async function rawRequest(
  path: string,
  init: ApiRequestInit = {},
  token?: string | null,
): Promise<Response> {
  const headers = new Headers(init.headers);

  if (!headers.has("accept")) {
    headers.set("accept", "application/json, application/problem+json");
  }

  if (token) {
    headers.set("authorization", `Bearer ${token}`);
  }

  const body = normalizeBody(init.body, headers);

  return fetch(resolveUrl(path), {
    ...init,
    body,
    headers,
    credentials: "include",
  });
}

export async function requestJson<T>(
  path: string,
  init: ApiRequestInit = {},
  token?: string | null,
): Promise<T> {
  const response = await rawRequest(path, init, token);
  const payload = await parseResponse(response);

  if (!response.ok) {
    const problem = typeof payload === "string" || payload == null ? payload : (payload as ProblemDocument);
    const message =
      (typeof problem === "object" && problem?.detail) ||
      (typeof problem === "object" && problem?.title) ||
      `Request failed with status ${response.status}`;

    throw new ApiHttpError(message, response.status, problem ?? null);
  }

  return payload as T;
}
