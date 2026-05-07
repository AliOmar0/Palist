import { useQuery } from "@tanstack/react-query";
import { Link, useRoute } from "wouter";
import { Layout } from "@/components/layout/Layout";
import { useLanguage } from "@/lib/language-context";
import { apiFetch } from "@/lib/queryClient";
import { ArrowRight, Calendar, MapPin } from "lucide-react";

interface EventRow {
  id: number;
  titleAr: string;
  titleEn: string | null;
  descriptionAr: string | null;
  descriptionEn: string | null;
  coverImage: string | null;
  location: string | null;
  startsAt: string;
  endsAt: string | null;
}

export default function EventDetail() {
  const [, params] = useRoute("/events/:id");
  const id = params?.id;
  const { language } = useLanguage();
  const isAr = language === "ar";

  const { data, isLoading, isError } = useQuery<EventRow>({
    queryKey: ["events", id],
    queryFn: () => apiFetch<EventRow>(`/api/events/${id}`),
    enabled: Boolean(id),
  });

  return (
    <Layout>
      <article className="container mx-auto px-4 md:px-6 py-12 max-w-3xl">
        <Link
          href="/events"
          className="inline-flex items-center gap-2 text-sm text-primary hover:underline mb-6 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded"
        >
          <ArrowRight className="w-4 h-4 rtl:rotate-180" />
          {isAr ? "العودة إلى الفعاليات" : "Back to events"}
        </Link>

        {isLoading && (
          <p className="text-muted-foreground">{isAr ? "جاري التحميل..." : "Loading..."}</p>
        )}
        {isError && (
          <p className="text-destructive">
            {isAr ? "تعذّر تحميل هذه الفعالية." : "Could not load this event."}
          </p>
        )}

        {data && (
          <>
            <h1 className="text-3xl md:text-4xl font-bold mb-4 leading-tight">
              {isAr ? data.titleAr : data.titleEn || data.titleAr}
            </h1>
            <div className="flex flex-wrap items-center gap-4 text-sm text-muted-foreground mb-6">
              <span className="inline-flex items-center gap-2">
                <Calendar className="w-4 h-4" />
                {new Date(data.startsAt).toLocaleString(isAr ? "ar" : "en", {
                  dateStyle: "long",
                  timeStyle: "short",
                })}
              </span>
              {data.location && (
                <span className="inline-flex items-center gap-2">
                  <MapPin className="w-4 h-4" />
                  {data.location}
                </span>
              )}
            </div>
            {data.coverImage && (
              <img
                src={data.coverImage}
                alt={isAr ? data.titleAr : data.titleEn || data.titleAr}
                className="w-full h-auto rounded-xl border mb-8 object-cover max-h-[420px]"
              />
            )}
            <div className="prose prose-lg max-w-none whitespace-pre-wrap leading-relaxed text-foreground">
              {isAr
                ? data.descriptionAr
                : data.descriptionEn || data.descriptionAr}
            </div>
          </>
        )}
      </article>
    </Layout>
  );
}
