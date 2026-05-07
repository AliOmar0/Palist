import { useQuery } from "@tanstack/react-query";
import { Link, useRoute } from "wouter";
import { Layout } from "@/components/layout/Layout";
import { useLanguage } from "@/lib/language-context";
import { apiFetch } from "@/lib/queryClient";
import { ArrowRight, Calendar } from "lucide-react";

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

  const { data, isLoading, isError } = useQuery<NewsRow>({
    queryKey: ["news", id],
    queryFn: () => apiFetch<NewsRow>(`/api/news/${id}`),
    enabled: Boolean(id),
  });

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
              <img
                src={data.coverImage}
                alt={isAr ? data.titleAr : data.titleEn || data.titleAr}
                className="w-full h-auto rounded-xl border mb-8 object-cover max-h-[420px]"
              />
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
