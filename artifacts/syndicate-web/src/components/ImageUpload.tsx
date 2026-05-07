import { useRef, useState } from "react";
import { Upload, X, Image as ImageIcon, Loader2 } from "lucide-react";
import { useLanguage } from "@/lib/language-context";
import { Button } from "@/components/ui/button";

type Props = {
  value?: string | null;
  onChange: (url: string) => void;
  label?: string;
  className?: string;
};

const BASE = import.meta.env.BASE_URL.replace(/\/$/, "");

export function ImageUpload({ value, onChange, label, className }: Props) {
  const { language } = useLanguage();
  const isAr = language === "ar";
  const ref = useRef<HTMLInputElement>(null);
  const [busy, setBusy] = useState(false);
  const [error, setError] = useState<string | null>(null);

  async function handleFile(file: File) {
    setError(null);
    setBusy(true);
    try {
      const fd = new FormData();
      fd.append("file", file);
      const res = await fetch(`${BASE}/api/uploads`, {
        method: "POST",
        credentials: "include",
        body: fd,
      });
      if (!res.ok) {
        const text = await res.text();
        throw new Error(text || `Upload failed (${res.status})`);
      }
      const json = (await res.json()) as { url: string };
      onChange(json.url);
    } catch (e) {
      setError(e instanceof Error ? e.message : "Upload failed");
    } finally {
      setBusy(false);
      if (ref.current) ref.current.value = "";
    }
  }

  return (
    <div className={className}>
      {label && <span className="text-xs font-medium text-foreground block mb-1">{label}</span>}
      <div className="flex items-center gap-3">
        <div className="w-20 h-20 rounded-md border bg-muted flex items-center justify-center overflow-hidden shrink-0">
          {value ? (
            <img src={value} alt="" className="w-full h-full object-cover" />
          ) : (
            <ImageIcon className="w-6 h-6 text-muted-foreground" />
          )}
        </div>
        <div className="flex flex-col gap-2 min-w-0 flex-1">
          <div className="flex gap-2 flex-wrap">
            <Button
              type="button"
              size="sm"
              variant="outline"
              disabled={busy}
              onClick={() => ref.current?.click()}
            >
              {busy ? <Loader2 className="w-4 h-4 me-1 animate-spin" /> : <Upload className="w-4 h-4 me-1" />}
              {isAr ? "اختر صورة من جهازك" : "Choose from device"}
            </Button>
            {value && (
              <Button
                type="button"
                size="sm"
                variant="ghost"
                onClick={() => onChange("")}
                className="text-destructive"
              >
                <X className="w-4 h-4 me-1" /> {isAr ? "إزالة" : "Remove"}
              </Button>
            )}
          </div>
          {value && (
            <p className="text-xs text-muted-foreground truncate" title={value}>{value}</p>
          )}
          {error && <p className="text-xs text-destructive">{error}</p>}
          <p className="text-[11px] text-muted-foreground">
            {isAr ? "PNG / JPG / WebP — حتى 5 ميغابايت" : "PNG / JPG / WebP — up to 5 MB"}
          </p>
        </div>
      </div>
      <input
        ref={ref}
        type="file"
        accept="image/png,image/jpeg,image/webp,image/gif,image/svg+xml"
        className="hidden"
        onChange={(e) => {
          const f = e.target.files?.[0];
          if (f) handleFile(f);
        }}
      />
    </div>
  );
}
