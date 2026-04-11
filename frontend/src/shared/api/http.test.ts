import { afterEach, describe, expect, it, vi } from "vitest";
import { ApiHttpError, requestJson } from "./http";

describe("requestJson", () => {
  afterEach(() => {
    vi.restoreAllMocks();
    vi.unstubAllGlobals();
  });

  it("sends JSON requests with credentials and bearer auth", async () => {
    const fetchMock = vi.fn().mockResolvedValue(
      new Response(JSON.stringify({ data: { ok: true } }), {
        status: 200,
        headers: {
          "content-type": "application/json",
        },
      }),
    );

    vi.stubGlobal("fetch", fetchMock);

    const response = await requestJson<{ data: { ok: boolean } }>(
      "/tasks",
      {
        method: "POST",
        body: { title: "Quarterly review" },
      },
      "token-123",
    );

    expect(response.data.ok).toBe(true);
    expect(fetchMock).toHaveBeenCalledWith(
      expect.stringContaining("/api/v1/tasks"),
      expect.objectContaining({
        credentials: "include",
        method: "POST",
      }),
    );

    const [, options] = fetchMock.mock.calls[0] as [string, RequestInit];
    expect(options.headers).toBeInstanceOf(Headers);
    expect((options.headers as Headers).get("authorization")).toBe("Bearer token-123");
    expect((options.headers as Headers).get("content-type")).toBe("application/json");
    expect(options.body).toBe(JSON.stringify({ title: "Quarterly review" }));
  });

  it("raises ApiHttpError for RFC 7807 responses", async () => {
    vi.stubGlobal(
      "fetch",
      vi.fn().mockResolvedValue(
        new Response(
          JSON.stringify({
            title: "Validation failed",
            detail: "Email is required.",
            status: 422,
          }),
          {
            status: 422,
            headers: {
              "content-type": "application/problem+json",
            },
          },
        ),
      ),
    );

    try {
      await requestJson("/auth/login", { method: "POST", body: {} });
      throw new Error("Expected requestJson to throw an ApiHttpError");
    } catch (error) {
      expect(error).toBeInstanceOf(ApiHttpError);
      expect((error as ApiHttpError).status).toBe(422);
      expect((error as ApiHttpError).message).toBe("Email is required.");
    }
  });
});
