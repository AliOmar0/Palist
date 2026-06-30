import React, { createContext, useContext, useEffect, useState } from "react";

type Theme = "light" | "dark";

interface ThemeContextValue {
  theme: Theme;
  grayscale: boolean;
  toggleTheme: () => void;
  toggleGrayscale: () => void;
}

const ThemeContext = createContext<ThemeContextValue | undefined>(undefined);
const STORAGE_KEY = "palist.theme";
const GRAYSCALE_STORAGE_KEY = "palist.accessibility.grayscale";

export function ThemeProvider({ children }: { children: React.ReactNode }) {
  const [theme, setTheme] = useState<Theme>(() => {
    if (typeof window === "undefined") return "light";
    const saved = window.localStorage.getItem(STORAGE_KEY);
    if (saved === "dark" || saved === "light") return saved;
    return "light";
  });
  const [grayscale, setGrayscale] = useState(() => {
    if (typeof window === "undefined") return false;
    return window.localStorage.getItem(GRAYSCALE_STORAGE_KEY) === "true";
  });

  useEffect(() => {
    const root = document.documentElement;
    root.classList.toggle("dark", theme === "dark");
    root.style.colorScheme = theme;
    try {
      window.localStorage.setItem(STORAGE_KEY, theme);
    } catch {
      /* ignore */
    }
  }, [theme]);

  useEffect(() => {
    const root = document.documentElement;
    root.classList.toggle("grayscale-mode", grayscale);
    try {
      window.localStorage.setItem(GRAYSCALE_STORAGE_KEY, String(grayscale));
    } catch {
      /* ignore */
    }
  }, [grayscale]);

  const toggleTheme = () => setTheme((t) => (t === "dark" ? "light" : "dark"));
  const toggleGrayscale = () => setGrayscale((value) => !value);

  return (
    <ThemeContext.Provider value={{ theme, grayscale, toggleTheme, toggleGrayscale }}>
      {children}
    </ThemeContext.Provider>
  );
}

export function useTheme(): ThemeContextValue {
  const ctx = useContext(ThemeContext);
  if (!ctx) throw new Error("useTheme must be used within a ThemeProvider");
  return ctx;
}
