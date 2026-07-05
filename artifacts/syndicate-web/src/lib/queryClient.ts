import { QueryClient } from "@tanstack/react-query";

export const queryClient = new QueryClient({
  defaultOptions: {
    queries: {
      refetchOnWindowFocus: false,
      retry: 1,
      staleTime: 30_000,
    },
  },
});

export async function apiFetch<T = unknown>(
  path: string,
  init: RequestInit = {},
): Promise<T> {
  const res = await fetch(resolveApiPath(path), {
    credentials: "include",
    headers: {
      "Content-Type": "application/json",
      ...(init.headers ?? {}),
    },
    ...init,
  });
  if (!res.ok) {
    const text = await res.text().catch(() => "");
    throw new Error(`${res.status} ${res.statusText}: ${text}`);
  }
  if (res.status === 204) return undefined as T;
  return (await res.json()) as T;
}

function resolveApiPath(path: string): string {
  const phpBase = import.meta.env.VITE_PHP_API_BASE as string | undefined;
  if (!phpBase || !path.startsWith("/api/")) return path;

  const normalizedBase = phpBase.replace(/\/+$/, "");
  const segments = path.replace(/^\/api\/?/, "").split("/").filter(Boolean);
  const [resource, id, action] = segments;

  if (!resource) return normalizedBase;
  if (action) return `${normalizedBase}/${resource}.php?id=${encodeURIComponent(id)}&action=${encodeURIComponent(action)}`;
  if (id) return `${normalizedBase}/${resource}.php?id=${encodeURIComponent(id)}`;

  return `${normalizedBase}/${resource}.php`;
}
