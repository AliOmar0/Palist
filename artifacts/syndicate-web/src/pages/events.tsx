import { useMemo, useState } from "react";
import { useQuery } from "@tanstack/react-query";
import { Link } from "wouter";
import { Layout } from "@/components/layout/Layout";
import { useLanguage } from "@/lib/language-context";
import { MapPin, Clock, Calendar as CalendarIcon, Users } from "lucide-react";
import { Button } from "@/components/ui/button";
import { apiFetch } from "@/lib/queryClient";

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
  audience: "all" | "members" | "visitors" | string;
}

export default function Events() {
  const { language } = useLanguage();
  const isAr = language === "ar";
  const [audience, setAudience] = useState("all");

  const { data: events = [], isLoading, isError } = useQuery<EventRow[]>({
    queryKey: ["events"],
    queryFn: () => apiFetch<EventRow[]>("/api/events"),
  });

  const filtered = useMemo(() => {
    if (audience === "all") return events;
    return events.filter((event) => event.audience === audience || event.audience === "all");
  }, [audience, events]);

  const filters = [
    { value: "all", label: isAr ? "كل الفعاليات" : "All events" },
    { value: "members", label: isAr ? "للأعضاء" : "Members" },
    { value: "visitors", label: isAr ? "لغير الأعضاء/الزوار" : "Visitors" },
  ];

  return (
    <Layout>
      <div className="bg-primary/5 py-12 border-b">
        <div className="container mx-auto px-4 md:px-6">
          <h1 className="text-3xl md:text-4xl font-bold text-foreground mb-4">
            {isAr ? "الفعاليات والأنشطة" : "Events & Activities"}
          </h1>
          <p className="text-muted-foreground max-w-2xl text-lg">
            {isAr
              ? "شارك في مؤتمراتنا، ورش العمل، واللقاءات المهنية حسب الفئة المناسبة للأعضاء أو الزوار."
              : "Participate in conferences, workshops, and meetups according to the audience category for members or visitors."}
          </p>
        </div>
      </div>

      <div className="container mx-auto px-4 md:px-6 py-12">
        <div className="mb-10 flex flex-wrap gap-2">
          {filters.map((filter) => (
            <Button
              key={filter.value}
              type="button"
              variant={audience === filter.value ? "default" : "outline"}
              onClick={() => setAudience(filter.value)}
              className={audience === filter.value ? "bg-primary text-white" : "bg-card"}
            >
              <Users className="w-4 h-4 me-2" />
              {filter.label}
            </Button>
          ))}
        </div>

        {isLoading && (
          <p className="text-center text-muted-foreground py-12">
            {isAr ? "جاري تحميل الفعاليات..." : "Loading events..."}
          </p>
        )}
        {isError && (
          <p className="text-center text-destructive py-12">
            {isAr ? "تعذّر تحميل الفعاليات." : "Could not load events."}
          </p>
        )}
        {!isLoading && !isError && filtered.length === 0 && (
          <div className="rounded-lg border bg-card p-8 text-center">
            <CalendarIcon className="mx-auto mb-3 h-10 w-10 text-muted-foreground" />
            <p className="font-semibold text-foreground">
              {isAr ? "لا توجد فعاليات ضمن هذا التصنيف حالياً." : "No events in this category right now."}
            </p>
          </div>
        )}

        <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
          {filtered.map((event) => {
            const title = isAr ? event.titleAr : event.titleEn || event.titleAr;
            const desc = isAr
              ? event.descriptionAr
              : event.descriptionEn || event.descriptionAr;
            const audienceLabel = audienceText(event.audience, isAr);
            return (
              <article key={event.id} className="rounded-lg border bg-card shadow-sm overflow-hidden">
                {event.coverImage && (
                  <img src={event.coverImage} alt={title} className="h-56 w-full object-cover" />
                )}
                <div className="p-6">
                  <div className="mb-4 flex flex-wrap items-center gap-2">
                    <span className="rounded-md bg-primary/10 px-3 py-1 text-xs font-bold text-primary">
                      {audienceLabel}
                    </span>
                  </div>
                  <h2 className="mb-3 text-xl font-bold text-foreground">{title}</h2>
                  {desc && <p className="mb-5 line-clamp-3 text-sm leading-relaxed text-muted-foreground">{desc}</p>}
                  <div className="mb-6 space-y-3 rounded-md border bg-muted/40 p-4">
                    <div className="flex items-center gap-2 text-sm text-foreground">
                      <CalendarIcon className="h-4 w-4 text-muted-foreground" />
                      <span>
                        {new Date(event.startsAt).toLocaleString(isAr ? "ar" : "en", {
                          dateStyle: "long",
                          timeStyle: "short",
                        })}
                      </span>
                    </div>
                    {event.endsAt && (
                      <div className="flex items-center gap-2 text-sm text-foreground">
                        <Clock className="h-4 w-4 text-muted-foreground" />
                        <span>
                          {new Date(event.endsAt).toLocaleString(isAr ? "ar" : "en", {
                            dateStyle: "medium",
                            timeStyle: "short",
                          })}
                        </span>
                      </div>
                    )}
                    {event.location && (
                      <div className="flex items-center gap-2 text-sm text-foreground">
                        <MapPin className="h-4 w-4 text-muted-foreground" />
                        <span>{event.location}</span>
                      </div>
                    )}
                  </div>
                  <Link href={`/events/${event.id}`}>
                    <Button className="w-full bg-accent text-primary hover:bg-accent/90 font-bold">
                      {isAr ? "عرض التفاصيل والتسجيل" : "View details and register"}
                    </Button>
                  </Link>
                </div>
              </article>
            );
          })}
        </div>
      </div>
    </Layout>
  );
}

function audienceText(audience: string, isAr: boolean): string {
  if (audience === "members") return isAr ? "للأعضاء فقط" : "Members only";
  if (audience === "visitors") return isAr ? "لغير الأعضاء / الزوار" : "Visitors / non-members";
  return isAr ? "للأعضاء والزوار" : "Members and visitors";
}
