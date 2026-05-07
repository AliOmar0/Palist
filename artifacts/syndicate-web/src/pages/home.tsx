import { Layout } from "@/components/layout/Layout";
import { useLanguage } from "@/lib/language-context";
import { Button } from "@/components/ui/button";
import { motion } from "framer-motion";
import { ArrowRight, ArrowLeft, Users, BookOpen, Briefcase, Scale, Download, FileText, FileSignature, Info, MapPin, Calendar, ShieldCheck, Sparkles, type LucideIcon } from "lucide-react";
import { Link } from "wouter";
import { useQuery } from "@tanstack/react-query";
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

function HomeNewsGrid({ isAr, ArrowIcon }: { isAr: boolean; ArrowIcon: LucideIcon }) {
  const { data = [] } = useQuery<NewsRow[]>({
    queryKey: ["news"],
    queryFn: () => apiFetch<NewsRow[]>("/api/news"),
  });
  const items = data.slice(0, 3);
  if (items.length === 0) {
    return (
      <p className="text-center text-muted-foreground py-12">
        {isAr ? "لا توجد أخبار للعرض حالياً." : "No news to show right now."}
      </p>
    );
  }
  return (
    <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
      {items.map((item, idx) => {
        const title = isAr ? item.titleAr : (item.titleEn || item.titleAr);
        const summary = isAr ? item.summaryAr : (item.summaryEn || item.summaryAr);
        const date = new Date(item.publishedAt).toLocaleDateString(isAr ? "ar" : "en", {
          year: "numeric", month: "short", day: "numeric",
        });
        const fallback = `${import.meta.env.BASE_URL}news-${(idx % 3) + 1}.png`;
        return (
          <Link key={item.id} href={`/news/${item.id}`} className="group rounded-xl overflow-hidden border bg-card shadow-sm hover:shadow-lg transition-all duration-300 block">
            <div className="aspect-[4/3] overflow-hidden relative bg-muted">
              <img
                src={item.coverImage || fallback}
                alt={title}
                className="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                onError={(e) => { (e.currentTarget as HTMLImageElement).src = fallback; }}
              />
              <div className="absolute top-4 right-4 rtl:left-4 rtl:right-auto bg-card/90 backdrop-blur text-primary text-xs font-bold px-3 py-1.5 rounded-md shadow-sm">
                {date}
              </div>
            </div>
            <div className="p-6">
              {item.category && (
                <div className="text-xs font-bold text-secondary mb-3 uppercase tracking-wider">{item.category}</div>
              )}
              <h3 className="text-xl font-bold text-foreground mb-3 leading-tight group-hover:text-primary transition-colors line-clamp-2">{title}</h3>
              {summary && (
                <p className="text-muted-foreground text-sm line-clamp-3 mb-4">{summary}</p>
              )}
              <span className="text-primary text-sm font-bold flex items-center hover:text-primary/80">
                {isAr ? 'اقرأ التفاصيل' : 'Read details'} <ArrowIcon className="w-4 h-4 ms-1" />
              </span>
            </div>
          </Link>
        );
      })}
    </div>
  );
}

export default function Home() {
  const { t, language } = useLanguage();
  const isAr = language === 'ar';
  const ArrowIcon = isAr ? ArrowLeft : ArrowRight;

  const heroStats = [
    { value: "5,200+", label: isAr ? "عضو ومنتسب" : "Members" },
    { value: "120+", label: isAr ? "شركة شريكة" : "Partner companies" },
    { value: "16", label: isAr ? "محافظة" : "Governorates" },
    { value: "350+", label: isAr ? "ساعة تدريب سنوياً" : "Training hours / year" },
  ];

  return (
    <Layout>
      {/* Hero — gradient teal canvas with grid + accent shapes (refs: BCS, IEEE, ACM, Bahrain ICT) */}
      <section className="relative overflow-hidden bg-gradient-to-br from-primary via-primary to-[#003841] text-white">
        {/* Decorative grid */}
        <div
          className="absolute inset-0 opacity-[0.08] pointer-events-none"
          style={{
            backgroundImage:
              "linear-gradient(rgba(255,255,255,0.6) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.6) 1px, transparent 1px)",
            backgroundSize: "40px 40px",
          }}
        />
        {/* Accent blobs */}
        <div className="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-accent/30 blur-3xl pointer-events-none" />
        <div className="absolute -bottom-32 -left-32 w-96 h-96 rounded-full bg-secondary/30 blur-3xl pointer-events-none" />

        <div className="container mx-auto px-4 md:px-6 pt-24 pb-20 lg:pt-32 lg:pb-28 relative z-10">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div className="lg:col-span-7 space-y-8">
              <motion.div
                initial={{ opacity: 0, y: 16 }}
                animate={{ opacity: 1, y: 0 }}
                className="inline-flex items-center rounded-full border border-white/20 bg-card/10 backdrop-blur px-3 py-1 text-sm font-medium text-white"
              >
                <span className="flex h-2 w-2 rounded-full bg-accent me-2"></span>
                {isAr ? 'البوابة الرسمية لنقابة العلوم المعلوماتية التكنولوجية الفلسطينية' : 'Official Portal of the Palestinian IT Syndicate'}
              </motion.div>

              <motion.h1
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: 0.05 }}
                className="text-4xl md:text-5xl lg:text-6xl font-bold leading-[1.15]"
              >
                {isAr ? (
                  <>نقابة <span className="text-accent">المعلوماتية التكنولوجية</span> الفلسطينية — صوت المهنة وحاضنة المستقبل الرقمي.</>
                ) : (
                  <>The home of Palestine's <span className="text-accent">IT profession</span> — protecting members, building the digital future.</>
                )}
              </motion.h1>

              <motion.p
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: 0.1 }}
                className="text-lg md:text-xl text-white/85 max-w-2xl leading-relaxed"
              >
                {t('hero.subtitle')}
              </motion.p>

              <motion.div
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: 0.15 }}
                className="flex flex-col sm:flex-row gap-4"
              >
                <Link href="/membership/apply">
                  <Button size="lg" className="bg-accent text-primary hover:bg-accent/90 font-bold text-lg h-14 px-8 shadow-lg w-full sm:w-auto">
                    {isAr ? 'قدّم طلب عضويتك' : 'Apply for membership'}
                    <ArrowIcon className="w-5 h-5 ms-2" />
                  </Button>
                </Link>
                <Link href="/about">
                  <Button size="lg" variant="outline" className="bg-transparent border-white/40 text-white hover:bg-card/10 font-semibold text-lg h-14 px-8 w-full sm:w-auto">
                    {isAr ? 'تعرّف على النقابة' : 'About the syndicate'}
                  </Button>
                </Link>
              </motion.div>

              <motion.div
                initial={{ opacity: 0 }}
                animate={{ opacity: 1 }}
                transition={{ delay: 0.25 }}
                className="flex flex-wrap items-center gap-x-6 gap-y-3 text-sm text-white/80 pt-2"
              >
                <span className="flex items-center gap-2"><ShieldCheck className="w-4 h-4 text-accent" /> {isAr ? 'مرخّصة رسمياً' : 'Officially licensed'}</span>
                <span className="flex items-center gap-2"><Users className="w-4 h-4 text-accent" /> {isAr ? 'تأمين صحي للأعضاء' : 'Member health insurance'}</span>
                <span className="flex items-center gap-2"><Sparkles className="w-4 h-4 text-accent" /> {isAr ? 'برامج تدريب وتطوير' : 'Training & upskilling'}</span>
              </motion.div>
            </div>

            <motion.div
              initial={{ opacity: 0, scale: 0.95 }}
              animate={{ opacity: 1, scale: 1 }}
              transition={{ delay: 0.2, duration: 0.6 }}
              className="lg:col-span-5"
            >
              <div className="rounded-2xl bg-card/10 backdrop-blur-md border border-white/20 p-6 shadow-2xl">
                <p className="text-xs font-bold uppercase tracking-widest text-accent mb-4">
                  {isAr ? 'النقابة بالأرقام' : 'By the numbers'}
                </p>
                <div className="grid grid-cols-2 gap-4">
                  {heroStats.map((s) => (
                    <div key={s.label} className="rounded-xl bg-card/5 border border-white/10 p-4">
                      <p className="text-3xl md:text-4xl font-bold text-white">{s.value}</p>
                      <p className="text-sm text-white/75 mt-1">{s.label}</p>
                    </div>
                  ))}
                </div>
                <Link href="/membership" className="mt-5 block text-center text-sm font-semibold text-accent hover:underline">
                  {isAr ? 'لماذا الانضمام؟ اكتشف المزايا ←' : 'Why join? Explore the benefits →'}
                </Link>
              </div>
            </motion.div>
          </div>
        </div>
      </section>

      {/* Core Services */}
      <section className="py-20 bg-muted/30">
        <div className="container mx-auto px-4 md:px-6">
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {[
              { id: 'membership', icon: Users, color: 'text-blue-600', bg: 'bg-blue-100', href: '/membership' },
              { id: 'training', icon: BookOpen, color: 'text-green-600', bg: 'bg-green-100', href: '/training' },
              { id: 'fund', icon: Briefcase, color: 'text-orange-600', bg: 'bg-orange-100', href: '/membership' },
              { id: 'legal', icon: Scale, color: 'text-purple-600', bg: 'bg-purple-100', href: '/about' },
            ].map((service, i) => (
              <motion.div
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ delay: i * 0.1 }}
                key={service.id}
              >
                <Link
                  href={service.href}
                  className="block h-full bg-card rounded-xl p-8 border shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 group"
                >
                  <div className={`w-14 h-14 rounded-lg flex items-center justify-center mb-6 transition-transform group-hover:scale-110 ${service.bg} ${service.color}`}>
                    <service.icon className="w-7 h-7" />
                  </div>
                  <h3 className="text-xl font-bold mb-3 text-foreground group-hover:text-primary transition-colors">
                    {t(`services.${service.id}.title`)}
                  </h3>
                  <p className="text-muted-foreground leading-relaxed mb-6">
                    {t(`services.${service.id}.desc`)}
                  </p>
                  <div className="flex items-center text-sm font-bold text-primary">
                    {isAr ? 'المزيد' : 'Learn more'} <ArrowIcon className="w-4 h-4 ms-1" />
                  </div>
                </Link>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* News & Announcements */}
      <section className="py-20 bg-card">
        <div className="container mx-auto px-4 md:px-6">
          <div className="flex justify-between items-end mb-12 border-b pb-6">
            <div>
              <h2 className="text-3xl font-bold text-foreground relative inline-block">
                {t('section.news')}
                <span className="absolute -bottom-6 left-0 w-1/2 h-1 bg-primary rounded-t-md"></span>
              </h2>
            </div>
            <Link href="/news">
              <Button variant="ghost" className="text-primary hover:bg-primary/5 hidden sm:flex">
                {isAr ? 'عرض كل الأخبار' : 'View all news'} <ArrowIcon className="w-4 h-4 ms-2" />
              </Button>
            </Link>
          </div>

          <HomeNewsGrid isAr={isAr} ArrowIcon={ArrowIcon} />
        </div>
      </section>

      {/* Two column: Events & Reports */}
      <section className="py-20 bg-muted/40 border-y">
        <div className="container mx-auto px-4 md:px-6">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-16">
            
            {/* Events Timeline */}
            <div>
              <h2 className="text-2xl font-bold text-foreground mb-8 pb-4 border-b">
                {t('section.events')}
              </h2>
              <div className="space-y-6 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-border before:to-transparent rtl:before:mr-5 rtl:before:ml-auto md:rtl:before:mx-auto">
                {[1, 2, 3].map((event) => (
                  <div key={event} className="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                    {/* Marker */}
                    <div className="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-primary text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 rtl:md:group-odd:translate-x-1/2 rtl:md:group-even:-translate-x-1/2 z-10">
                      <span className="text-xs font-bold">{10 + event}</span>
                    </div>
                    {/* Card */}
                    <div className="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-4 rounded-xl border bg-card shadow-sm hover:shadow-md transition-shadow">
                      <div className="flex items-center justify-between mb-2">
                        <span className="text-sm font-bold text-primary">
                          {language === 'ar' ? 'أبريل 2025' : 'April 2025'}
                        </span>
                        <span className="text-xs text-muted-foreground flex items-center">
                          <MapPin className="w-3 h-3 ml-1 rtl:mr-1 rtl:ml-0" />
                          {language === 'ar' ? 'رام الله' : 'Ramallah'}
                        </span>
                      </div>
                      <h3 className="font-bold text-foreground mb-2">
                        {language === 'ar' ? 'المؤتمر السنوي للأمن السيبراني' : 'Annual Cybersecurity Conference'}
                      </h3>
                      <p className="text-sm text-muted-foreground">
                        {language === 'ar' ? 'ورش عمل متخصصة وجلسات حوارية حول أحدث تحديات أمن المعلومات.' : 'Specialized workshops and panel discussions on the latest information security challenges.'}
                      </p>
                    </div>
                  </div>
                ))}
              </div>
              <div className="mt-8 text-center">
                <Link href="/events">
                  <Button variant="outline" className="border-border">
                    {isAr ? 'عرض أجندة الفعاليات' : 'View Events Calendar'}
                  </Button>
                </Link>
              </div>
            </div>

            {/* Reports List */}
            <div>
              <h2 className="text-2xl font-bold text-foreground mb-8 pb-4 border-b">
                {t('section.reports')}
              </h2>
              <div className="space-y-4">
                {[1, 2, 3, 4].map((report) => (
                  <div key={report} className="flex items-start gap-4 p-5 rounded-xl border bg-card hover:bg-muted transition-colors group cursor-pointer">
                    <div className="w-12 h-12 rounded-lg bg-primary/5 flex items-center justify-center text-primary shrink-0 group-hover:bg-primary group-hover:text-white transition-colors">
                      <FileText className="w-6 h-6" />
                    </div>
                    <div className="flex-1 min-w-0">
                      <h3 className="font-bold text-foreground mb-1 group-hover:text-primary transition-colors truncate">
                        {language === 'ar' ? 'التقرير السنوي لواقع قطاع تكنولوجيا المعلومات في فلسطين 2024' : 'Annual Report on the Reality of the IT Sector in Palestine 2024'}
                      </h3>
                      <div className="flex items-center text-xs text-muted-foreground gap-4">
                        <span>{language === 'ar' ? 'يناير 2025' : 'January 2025'}</span>
                        <span className="w-1 h-1 rounded-full bg-border"></span>
                        <span>PDF (2.4 MB)</span>
                      </div>
                    </div>
                    <Button variant="ghost" size="icon" className="shrink-0 text-muted-foreground group-hover:text-primary group-hover:bg-primary/10">
                      <Download className="w-5 h-5" />
                    </Button>
                  </div>
                ))}
              </div>
              <div className="mt-8 text-center">
                <Link href="/reports">
                  <Button variant="outline" className="border-border">
                    {isAr ? 'تصفح المكتبة الرقمية' : 'Browse Digital Library'}
                  </Button>
                </Link>
              </div>
            </div>

          </div>
        </div>
      </section>

      {/* Quick Access Utility Grid */}
      <section className="py-16 bg-primary text-primary-foreground relative overflow-hidden">
        <div className="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCI+PHBhdGggZD0iTTAgMGg0MHY0MEgwek0yMCAyMGgtdjIwaDIwek0wIDBoMjB2MjBIMHoiIGZpbGw9IiNmZmYiIGZpbGwtcnVsZT0iZXZlbm9kZCIgZmlsbC1vcGFjaXR5PSIuMSIvPjwvc3ZnPg==')]"></div>
        <div className="container mx-auto px-4 md:px-6 relative z-10">
          <h2 className="text-2xl font-bold mb-10 text-center">
            {t('section.quick_access')}
          </h2>
          <div className="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8">
            {[
              { icon: Scale, label: t('quick.regulations'), href: "/about" },
              { icon: Info, label: t('quick.requirements'), href: "/membership" },
              { icon: FileSignature, label: t('quick.forms'), href: "/membership/apply" },
              { icon: Users, label: t('quick.directory'), href: "/membership" },
            ].map((item, i) => (
              <Link key={i} href={item.href} className="flex flex-col items-center text-center p-6 rounded-xl bg-card/5 border border-white/10 hover:bg-card/10 transition-colors">
                <item.icon className="w-8 h-8 mb-4 text-accent" />
                <span className="font-medium text-sm md:text-base">{item.label}</span>
              </Link>
            ))}
          </div>
        </div>
      </section>
    </Layout>
  );
}
