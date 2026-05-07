import { useMemo, useState } from "react";
import { useQuery } from "@tanstack/react-query";
import { Link } from "wouter";
import { Layout } from "@/components/layout/Layout";
import { useLanguage } from "@/lib/language-context";
import { apiFetch } from "@/lib/queryClient";
import { Briefcase, MapPin, Search } from "lucide-react";
import { Input } from "@/components/ui/input";

interface JobRow {
  id: number;
  titleAr: string;
  titleEn: string | null;
  company: string;
  companyLogo: string | null;
  location: string | null;
  employmentType: string | null;
  category: string | null;
  createdAt: string;
}

export default function JobsList() {
  const { language } = useLanguage();
  const isAr = language === "ar";
  const [q, setQ] = useState("");

  const { data: jobs = [], isLoading } = useQuery<JobRow[]>({
    queryKey: ["jobs"],
    queryFn: () => apiFetch<JobRow[]>("/api/jobs"),
  });

  const filtered = useMemo(() => {
    const s = q.trim().toLowerCase();
    if (!s) return jobs;
    return jobs.filter((j) =>
      `${j.titleAr} ${j.titleEn ?? ""} ${j.company} ${j.location ?? ""}`.toLowerCase().includes(s),
    );
  }, [q, jobs]);

  return (
    <Layout>
      <div className="bg-primary/5 py-12 border-b">
        <div className="container mx-auto px-4 md:px-6">
          <h1 className="text-3xl md:text-4xl font-bold mb-3">
            {isAr ? "لوحة الوظائف" : "Jobs board"}
          </h1>
          <p className="text-muted-foreground max-w-2xl text-lg">
            {isAr
              ? "فرص عمل في قطاع تكنولوجيا المعلومات الفلسطيني — متاحة للمتقدّمين الأعضاء."
              : "Open IT roles across Palestine — applications open to syndicate members."}
          </p>
        </div>
      </div>

      <div className="container mx-auto px-4 md:px-6 py-10">
        <div className="relative mb-8 max-w-xl">
          <Search className="absolute right-3 rtl:right-3 ltr:left-3 top-1/2 -translate-y-1/2 text-muted-foreground w-5 h-5" />
          <Input
            value={q}
            onChange={(e) => setQ(e.target.value)}
            placeholder={isAr ? "ابحث بالمسمى أو الشركة" : "Search by title or company"}
            className="bg-card pl-10 rtl:pr-10 rtl:pl-4 h-12"
            aria-label={isAr ? "بحث الوظائف" : "Search jobs"}
          />
        </div>

        {isLoading ? (
          <p className="text-muted-foreground">{isAr ? "جاري التحميل..." : "Loading..."}</p>
        ) : filtered.length === 0 ? (
          <p className="text-muted-foreground py-12 text-center">
            {isAr ? "لا توجد وظائف منشورة حالياً." : "No jobs posted right now."}
          </p>
        ) : (
          <ul className="space-y-3">
            {filtered.map((job) => (
              <li key={job.id}>
                <Link
                  href={`/jobs/${job.id}`}
                  className="block rounded-xl border bg-card p-5 hover:shadow-md transition-shadow focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary"
                >
                  <div className="flex items-start gap-4">
                    {job.companyLogo ? (
                      <img
                        src={job.companyLogo}
                        alt={job.company}
                        className="w-12 h-12 rounded-md object-contain border bg-card shrink-0"
                      />
                    ) : (
                      <div className="w-12 h-12 rounded-md bg-primary/10 text-primary flex items-center justify-center shrink-0">
                        <Briefcase className="w-5 h-5" />
                      </div>
                    )}
                    <div className="flex-1 min-w-0">
                      <h3 className="font-bold text-foreground text-lg">
                        {isAr ? job.titleAr : job.titleEn || job.titleAr}
                      </h3>
                      <p className="text-sm text-muted-foreground mt-1">{job.company}</p>
                      <div className="flex flex-wrap gap-3 text-xs text-muted-foreground mt-3">
                        {job.location && (
                          <span className="inline-flex items-center gap-1">
                            <MapPin className="w-3.5 h-3.5" />
                            {job.location}
                          </span>
                        )}
                        {job.employmentType && (
                          <span className="px-2 py-0.5 rounded bg-muted text-foreground">
                            {job.employmentType}
                          </span>
                        )}
                        {job.category && (
                          <span className="px-2 py-0.5 rounded bg-secondary/10 text-secondary">
                            {job.category}
                          </span>
                        )}
                      </div>
                    </div>
                  </div>
                </Link>
              </li>
            ))}
          </ul>
        )}
      </div>
    </Layout>
  );
}
