import { useEffect, useState } from "react";
import type { SystemSettings, SystemSettingsDefaultLanguage } from "@flowdesk/api-client";

const BRANDING_STORAGE_KEY = "flowdesk.branding";
const BRANDING_UPDATED_EVENT = "flowdesk:branding-updated";
const DEFAULT_PRIMARY_HSL = "221 83% 53%";

export interface BrandingSnapshot {
  companyName: string;
  logoUrl: string;
  primaryColor: string;
  defaultLanguage: SystemSettingsDefaultLanguage;
}

const DEFAULT_BRANDING: BrandingSnapshot = {
  companyName: "FlowDesk",
  logoUrl: "",
  primaryColor: "",
  defaultLanguage: "en",
};

function normalizeHexColor(value: string | null | undefined): string | null {
  if (!value) {
    return null;
  }

  const raw = value.trim();
  const match = raw.match(/^#([0-9a-f]{3}|[0-9a-f]{6})$/i);

  if (!match) {
    return null;
  }

  const hex = match[1].toLowerCase();

  if (hex.length === 3) {
    return `#${hex
      .split("")
      .map((character) => `${character}${character}`)
      .join("")}`;
  }

  return `#${hex}`;
}

function hexToHslChannels(hex: string): string {
  const normalized = normalizeHexColor(hex);

  if (!normalized) {
    return DEFAULT_PRIMARY_HSL;
  }

  const red = parseInt(normalized.slice(1, 3), 16) / 255;
  const green = parseInt(normalized.slice(3, 5), 16) / 255;
  const blue = parseInt(normalized.slice(5, 7), 16) / 255;

  const max = Math.max(red, green, blue);
  const min = Math.min(red, green, blue);
  const delta = max - min;

  let hue = 0;
  if (delta !== 0) {
    switch (max) {
      case red:
        hue = ((green - blue) / delta) % 6;
        break;
      case green:
        hue = (blue - red) / delta + 2;
        break;
      default:
        hue = (red - green) / delta + 4;
        break;
    }
  }

  hue = Math.round((hue * 60 + 360) % 360);
  const lightness = (max + min) / 2;
  const saturation = delta === 0 ? 0 : delta / (1 - Math.abs(2 * lightness - 1));

  return `${hue} ${Math.round(saturation * 100)}% ${Math.round(lightness * 100)}%`;
}

function sanitizeLanguage(
  language: SystemSettingsDefaultLanguage | string | null | undefined,
): SystemSettingsDefaultLanguage {
  return language === "ar" ? "ar" : "en";
}

function sanitizeSnapshot(snapshot: Partial<BrandingSnapshot>): BrandingSnapshot {
  return {
    companyName: snapshot.companyName?.trim() || DEFAULT_BRANDING.companyName,
    logoUrl: snapshot.logoUrl?.trim() || "",
    primaryColor: normalizeHexColor(snapshot.primaryColor) || "",
    defaultLanguage: sanitizeLanguage(snapshot.defaultLanguage),
  };
}

function readStoredBranding(): BrandingSnapshot {
  if (typeof window === "undefined") {
    return DEFAULT_BRANDING;
  }

  try {
    const stored = window.localStorage.getItem(BRANDING_STORAGE_KEY);
    if (!stored) {
      return DEFAULT_BRANDING;
    }

    return sanitizeSnapshot(JSON.parse(stored) as Partial<BrandingSnapshot>);
  } catch {
    return DEFAULT_BRANDING;
  }
}

function persistBranding(snapshot: BrandingSnapshot): void {
  if (typeof window === "undefined") {
    return;
  }

  try {
    window.localStorage.setItem(BRANDING_STORAGE_KEY, JSON.stringify(snapshot));
  } catch {
    // Ignore local storage write failures.
  }

  window.dispatchEvent(new CustomEvent<BrandingSnapshot>(BRANDING_UPDATED_EVENT, { detail: snapshot }));
}

function applyBrandingToDocument(snapshot: BrandingSnapshot): void {
  if (typeof document === "undefined") {
    return;
  }

  const root = document.documentElement;
  root.lang = snapshot.defaultLanguage;
  root.dir = snapshot.defaultLanguage === "ar" ? "rtl" : "ltr";

  const primaryHsl = snapshot.primaryColor ? hexToHslChannels(snapshot.primaryColor) : DEFAULT_PRIMARY_HSL;
  root.style.setProperty("--primary", primaryHsl);
  root.style.setProperty("--ring", primaryHsl);
  root.style.setProperty("--chart-1", primaryHsl);

  document.title = snapshot.companyName;
}

export function initializeBrandingFromCache(): void {
  applyBrandingToDocument(readStoredBranding());
}

export function applyBrandingFromSettings(settings: Partial<SystemSettings> | null | undefined): void {
  const current = readStoredBranding();
  const next = sanitizeSnapshot({
    companyName: settings?.companyName ?? current.companyName,
    logoUrl: settings?.logoUrl ?? current.logoUrl,
    primaryColor: settings?.primaryColor ?? current.primaryColor,
    defaultLanguage: settings?.defaultLanguage ?? current.defaultLanguage,
  });

  persistBranding(next);
  applyBrandingToDocument(next);
}

export function useBranding() {
  const [branding, setBranding] = useState<BrandingSnapshot>(() => readStoredBranding());

  useEffect(() => {
    if (typeof window === "undefined") {
      return;
    }

    const handleUpdate = (event: Event) => {
      if (event instanceof CustomEvent && event.detail) {
        setBranding(sanitizeSnapshot(event.detail as Partial<BrandingSnapshot>));
        return;
      }

      setBranding(readStoredBranding());
    };

    window.addEventListener(BRANDING_UPDATED_EVENT, handleUpdate);
    return () => {
      window.removeEventListener(BRANDING_UPDATED_EVENT, handleUpdate);
    };
  }, []);

  return branding;
}

