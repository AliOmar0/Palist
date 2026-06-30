import { useState } from "react";
import { useQuery } from "@tanstack/react-query";
import { Link, useRoute } from "wouter";
import { Layout } from "@/components/layout/Layout";
import { useLanguage } from "@/lib/language-context";
import { apiFetch } from "@/lib/queryClient";
import { ArrowRight, Calendar, Share2 } from "lucide-react";
import { Button } from "@/components/ui/button";

interface NewsRow {
  id: number;
  titleAr: string;
  titleEn: string | null;
  summaryAr: string | null;
  summaryEn: string | null;
  contentAr: string | null;
  contentEn: string | null;
  coverImage: string | null;
  category: string | null;
  publishedAt: string;
}

export default function NewsDetail() {
  const [, params] = useRoute("/news/:id");
  const id = params?.id;
  const { language } = useLanguage();
  const isAr = language === "ar";
  const [shareMsg, setShareMsg] = useState<string | null>(null);

  const { data, isLoading, isError } = useQuery<NewsRow>({
    queryKey: ["news", id],
    queryFn: () => apiFetch<NewsRow>(`/api/news/${id}`),
    enabled: Boolean(id),
  });

  async function shareImage() {
    if (!data?.coverImage) return;
    const title = isAr ? data.titleAr : data.titleEn || data.titleAr;
    const imageUrl = new URL(data.coverImage, window.location.origin).href;
    setShareMsg(null);
    try {
      if (navigator.share) {
        await navigator.share({ title, text: title, url: imageUrl });
      } else {
        await navigator.clipboard.writeText(imageUrl);
      }
      setShareMsg(isAr ? "تم تجهيز رابط الصورة للمشاركة." : "Image link is ready to share.");
    } catch (err) {
      if (err instanceof DOMException && err.name === "AbortError") return;
      setShareMsg(isAr ? "تعذّرت المشاركة. تم نسخ رابط الصورة إن أمكن." : "Sharing failed. Image link was copied if possible.");
      await navigator.clipboard?.writeText(imageUrl).catch(() => undefined);
    }
  }

  return (
    <Layout>
      <article className="container mx-auto px-4 md:px-6 py-12 max-w-3xl">
        <Link
          href="/news"
          className="inline-flex items-center gap-2 text-sm text-primary hover:underline mb-6 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded"
        >
          <ArrowRight className="w-4 h-4 rtl:rotate-180" />
          {isAr ? "العودة إلى الأخبار" : "Back to news"}
        </Link>

        {isLoading && (
          <p className="text-muted-foreground">{isAr ? "جاري التحميل..." : "Loading..."}</p>
        )}
        {isError && (
          <p className="text-destructive">
            {isAr ? "تعذّر تحميل هذا الخبر." : "Could not load this article."}
          </p>
        )}

        {data && (
          <>
            {data.category && (
              <p className="text-xs font-bold text-secondary uppercase tracking-widest mb-2">
                {data.category}
              </p>
            )}
            <h1 className="text-3xl md:text-4xl font-bold mb-4 leading-tight">
              {isAr ? data.titleAr : data.titleEn || data.titleAr}
            </h1>
            <div className="flex items-center gap-2 text-sm text-muted-foreground mb-6">
              <Calendar className="w-4 h-4" />
              {new Date(data.publishedAt).toLocaleDateString(isAr ? "ar" : "en", {
                year: "numeric",
                month: "long",
                day: "numeric",
              })}
            </div>
            {data.coverImage && (
              <div className="mb-8">
                <img
                  src={data.coverImage}
                  alt={isAr ? data.titleAr : data.titleEn || data.titleAr}
                  className="w-full h-auto rounded-xl border object-cover max-h-[420px]"
                />
                <div className="mt-3 flex flex-wrap items-center gap-3">
                  <Button type="button" variant="outline" onClick={shareImage}>
                    <Share2 className="w-4 h-4 me-2" />
                    {isAr ? "مشاركة الصورة" : "Share image"}
                  </Button>
                  {shareMsg && <span className="text-sm text-muted-foreground">{shareMsg}</span>}
                </div>
              </div>
            )}
            {(isAr ? data.summaryAr : data.summaryEn) && (
              <p className="text-lg text-foreground/80 mb-8 leading-relaxed font-medium">
                {isAr ? data.summaryAr : data.summaryEn || data.summaryAr}
              </p>
            )}
            <div className="prose prose-lg max-w-none whitespace-pre-wrap leading-relaxed text-foreground">
              {isAr
                ? data.contentAr || data.summaryAr
                : data.contentEn || data.contentAr || data.summaryEn || data.summaryAr}
            </div>
          </>
        )}
      </article>
    </Layout>
  );
}
