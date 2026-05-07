import { useMemo, useState } from "react";
import { useQuery } from "@tanstack/react-query";
import { Link } from "wouter";
import { Layout } from "@/components/layout/Layout";
import { useLanguage } from "@/lib/language-context";
import { Button } from "@/components/ui/button";
import { Calendar, Search } from "lucide-react";
import { Input } from "@/components/ui/input";
import { apiFetch } from "@/lib/queryClient";

interface NewsRow {
  id: number;
  titleAr: string;
  titleEn: string | null;
  summaryAr: string | null;
  summaryEn: string | null;
  coverImage: string | null;
  category: string | null;
  publishedAt: string;
}

const PAGE_SIZE = 9;

export default function News() {
  const { language } = useLanguage();
  const isAr = language === "ar";
  const [query, setQuery] = useState("");
  const [activeCat, setActiveCat] = useState<string>("all");
  const [visible, setVisible] = useState(PAGE_SIZE);

  const { data: items = [], isLoading } = useQuery<NewsRow[]>({
    queryKey: ["news"],
    queryFn: () => apiFetch<NewsRow[]>("/api/news"),
  });

  const categories = useMemo(() => {
    const set = new Set<string>();
    items.forEach((it) => it.category && set.add(it.category));
    return ["all", ...Array.from(set)];
  }, [items]);

  const filtered = useMemo(() => {
    const q = query.trim().toLowerCase();
    return items.filter((it) => {
      if (activeCat !== "all" && it.category !== activeCat) return false;
      if (!q) return true;
      const hay = `${it.titleAr} ${it.titleEn ?? ""} ${it.summaryAr ?? ""} ${it.summaryEn ?? ""}`.toLowerCase();
      return hay.includes(q);
    });
  }, [items, query, activeCat]);

  const shown = filtered.slice(0, visible);

  return (
    <Layout>
      <div className="bg-primary/5 py-12 border-b">
        <div className="container mx-auto px-4 md:px-6">
          <h1 className="text-3xl md:text-4xl font-bold text-foreground mb-4">
            {isAr ? 'الأخبار والإعلانات' : 'News & Announcements'}
          </h1>
          <p className="text-muted-foreground max-w-2xl text-lg">
            {isAr
              ? 'ابق على اطلاع بآخر أخبار النقابة، القرارات، الفعاليات، وأهم التطورات في قطاع تكنولوجيا المعلومات الفلسطيني.'
              : 'Stay informed with the latest syndicate news, decisions, events, and major developments in the Palestinian IT sector.'}
          </p>
        </div>
      </div>

      <div className="container mx-auto px-4 md:px-6 py-12">
        <div className="flex flex-col sm:flex-row gap-4 mb-12 bg-gray-50 p-4 rounded-xl border">
          <div className="relative flex-1">
            <Search className="absolute right-3 rtl:right-3 ltr:left-3 top-1/2 -translate-y-1/2 text-muted-foreground w-5 h-5" />
            <Input
              value={query}
              onChange={(e) => { setQuery(e.target.value); setVisible(PAGE_SIZE); }}
              placeholder={isAr ? 'ابحث في الأخبار...' : 'Search news...'}
              className="bg-white pl-10 pr-4 rtl:pr-10 rtl:pl-4 h-12"
            />
          </div>
          <div className="flex gap-2 overflow-x-auto pb-2 sm:pb-0">
            {categories.map((cat) => (
              <Button
                key={cat}
                onClick={() => { setActiveCat(cat); setVisible(PAGE_SIZE); }}
                variant={activeCat === cat ? "default" : "outline"}
                className={activeCat === cat ? "bg-primary" : "bg-white whitespace-nowrap"}
              >
                {cat === "all" ? (isAr ? "الكل" : "All") : cat}
              </Button>
            ))}
          </div>
        </div>

        {isLoading ? (
          <p className="text-muted-foreground text-center py-12">
            {isAr ? "جاري التحميل..." : "Loading..."}
          </p>
        ) : shown.length === 0 ? (
          <p className="text-muted-foreground text-center py-12">
            {isAr ? "لا توجد أخبار مطابقة." : "No matching news."}
          </p>
        ) : (
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {shown.map((item, index) => {
              const title = isAr ? item.titleAr : (item.titleEn || item.titleAr);
              const summary = isAr ? item.summaryAr : (item.summaryEn || item.summaryAr);
              const date = new Date(item.publishedAt).toLocaleDateString(isAr ? "ar" : "en", {
                year: "numeric", month: "short", day: "numeric",
              });
              const fallback = `${import.meta.env.BASE_URL}news-${(index % 3) + 1}.png`;
              return (
                <Link key={item.id} href={`/news/${item.id}`} className="group rounded-xl overflow-hidden border bg-white shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col">
                  <div className="aspect-[4/3] overflow-hidden relative bg-muted">
                    <img
                      src={item.coverImage || fallback}
                      alt={title}
                      className="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                      onError={(e) => { (e.currentTarget as HTMLImageElement).src = fallback; }}
                    />
                    <div className="absolute top-4 right-4 rtl:left-4 rtl:right-auto bg-white/90 backdrop-blur text-primary text-xs font-bold px-3 py-1.5 rounded-md shadow-sm flex items-center gap-1.5">
                      <Calendar className="w-3.5 h-3.5" />
                      {date}
                    </div>
                  </div>
                  <div className="p-6 flex-1 flex flex-col">
                    {item.category && (
                      <div className="text-xs font-bold text-secondary mb-3 uppercase tracking-wider">
                        {item.category}
                      </div>
                    )}
                    <h3 className="text-xl font-bold text-foreground mb-3 leading-tight group-hover:text-primary transition-colors line-clamp-2">
                      {title}
                    </h3>
                    {summary && (
                      <p className="text-muted-foreground text-sm line-clamp-3 mb-6 flex-1">
                        {summary}
                      </p>
                    )}
                    <span className="mt-auto text-sm font-bold text-primary group-hover:underline">
                      {isAr ? 'اقرأ التفاصيل ←' : 'Read full article →'}
                    </span>
                  </div>
                </Link>
              );
            })}
          </div>
        )}

        {visible < filtered.length && (
          <div className="mt-12 text-center">
            <Button
              variant="outline"
              size="lg"
              className="border-border"
              onClick={() => setVisible((v) => v + PAGE_SIZE)}
            >
              {isAr ? 'تحميل المزيد' : 'Load More'}
            </Button>
          </div>
        )}
      </div>
    </Layout>
  );
}
