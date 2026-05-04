import { Layout } from "@/components/layout/Layout";
import { useLanguage } from "@/lib/language-context";
import { Button } from "@/components/ui/button";
import { motion } from "framer-motion";
import { ArrowRight, ArrowLeft, Users, BookOpen, Briefcase, Scale, Download, FileText, FileSignature, Info, MapPin, Calendar } from "lucide-react";
import { Link } from "wouter";

export default function Home() {
  const { t, language } = useLanguage();
  const ArrowIcon = language === 'ar' ? ArrowLeft : ArrowRight;

  return (
    <Layout>
      {/* Hero Section */}
      <section className="relative bg-white overflow-hidden border-b">
        {/* Subtle background gradient pattern */}
        <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-primary/5 via-white to-white pointer-events-none" />
        
        <div className="container mx-auto px-4 md:px-6 py-20 lg:py-32 flex flex-col lg:flex-row items-center gap-12">
          
          <div className="flex-1 space-y-8 z-10">
            <motion.div 
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.5 }}
              className="inline-flex items-center rounded-full border border-primary/20 bg-primary/5 px-3 py-1 text-sm font-medium text-primary mb-4"
            >
              <span className="flex h-2 w-2 rounded-full bg-accent mr-2 rtl:ml-2 rtl:mr-0"></span>
              {language === 'ar' ? 'البوابة الرسمية للنقابة' : 'Official Syndicate Portal'}
            </motion.div>
            
            <motion.h1 
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.5, delay: 0.1 }}
              className="text-4xl md:text-5xl lg:text-6xl font-bold text-foreground leading-[1.2]"
            >
              {language === 'ar' ? (
                <>نُمكّن محترفي <span className="text-primary relative whitespace-nowrap"><span className="relative z-10">تكنولوجيا المعلومات</span><span className="absolute bottom-1 left-0 w-full h-3 bg-accent/30 -z-10"></span></span> في فلسطين</>
              ) : (
                <>Empowering <span className="text-primary relative whitespace-nowrap"><span className="relative z-10">IT Professionals</span><span className="absolute bottom-1 left-0 w-full h-3 bg-accent/30 -z-10"></span></span> Across Palestine</>
              )}
            </motion.h1>
            
            <motion.p 
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.5, delay: 0.2 }}
              className="text-lg md:text-xl text-muted-foreground max-w-2xl leading-relaxed"
            >
              {t('hero.subtitle')}
            </motion.p>
            
            <motion.div 
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.5, delay: 0.3 }}
              className="flex flex-col sm:flex-row gap-4 pt-4"
            >
              <Button size="lg" className="bg-accent text-primary hover:bg-accent/90 font-bold text-lg h-14 px-8 shadow-sm">
                {t('hero.primary_cta')}
              </Button>
              <Button size="lg" variant="outline" className="border-primary text-primary hover:bg-primary/5 font-semibold text-lg h-14 px-8">
                {t('hero.secondary_cta')}
              </Button>
            </motion.div>
          </div>
          
          <motion.div 
            initial={{ opacity: 0, scale: 0.95 }}
            animate={{ opacity: 1, scale: 1 }}
            transition={{ duration: 0.7, delay: 0.2 }}
            className="flex-1 relative z-10 w-full max-w-lg lg:max-w-none"
          >
            <div className="relative aspect-video lg:aspect-square rounded-2xl overflow-hidden shadow-2xl border border-border bg-muted">
              <img 
                src={`${import.meta.env.BASE_URL}hero-network.png`} 
                alt="Digital Network" 
                className="w-full h-full object-cover mix-blend-multiply opacity-90"
              />
              <div className="absolute inset-0 bg-gradient-to-tr from-primary/20 to-transparent pointer-events-none" />
            </div>
          </motion.div>
        </div>
      </section>

      {/* Core Services */}
      <section className="py-20 bg-gray-50/50">
        <div className="container mx-auto px-4 md:px-6">
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {[
              { id: 'membership', icon: Users, color: 'text-blue-600', bg: 'bg-blue-100' },
              { id: 'training', icon: BookOpen, color: 'text-green-600', bg: 'bg-green-100' },
              { id: 'fund', icon: Briefcase, color: 'text-orange-600', bg: 'bg-orange-100' },
              { id: 'legal', icon: Scale, color: 'text-purple-600', bg: 'bg-purple-100' },
            ].map((service, i) => (
              <motion.div 
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ delay: i * 0.1 }}
                key={service.id}
                className="bg-white rounded-xl p-8 border shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 group cursor-pointer"
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
                <div className="flex items-center text-sm font-bold text-primary opacity-0 group-hover:opacity-100 transition-opacity transform translate-x-4 group-hover:translate-x-0 rtl:-translate-x-4 rtl:group-hover:translate-x-0">
                  {language === 'ar' ? 'المزيد' : 'Learn more'} <ArrowIcon className="w-4 h-4 ml-1 rtl:mr-1 rtl:ml-0" />
                </div>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* News & Announcements */}
      <section className="py-20 bg-white">
        <div className="container mx-auto px-4 md:px-6">
          <div className="flex justify-between items-end mb-12 border-b pb-6">
            <div>
              <h2 className="text-3xl font-bold text-foreground relative inline-block">
                {t('section.news')}
                <span className="absolute -bottom-6 left-0 w-1/2 h-1 bg-primary rounded-t-md"></span>
              </h2>
            </div>
            <Button variant="ghost" className="text-primary hover:bg-primary/5 hidden sm:flex">
              {language === 'ar' ? 'عرض كل الأخبار' : 'View all news'} <ArrowIcon className="w-4 h-4 ml-2 rtl:mr-2 rtl:ml-0" />
            </Button>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            {[1, 2, 3].map((item) => (
              <div key={item} className="group rounded-xl overflow-hidden border bg-white shadow-sm hover:shadow-lg transition-all duration-300">
                <div className="aspect-[4/3] overflow-hidden relative">
                  <img 
                    src={`${import.meta.env.BASE_URL}news-${item}.png`} 
                    alt="News thumbnail" 
                    className="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                  />
                  <div className="absolute top-4 right-4 rtl:left-4 rtl:right-auto bg-white/90 backdrop-blur text-primary text-xs font-bold px-3 py-1.5 rounded-md shadow-sm">
                    {language === 'ar' ? '15 مارس 2025' : 'March 15, 2025'}
                  </div>
                </div>
                <div className="p-6">
                  <div className="text-xs font-bold text-secondary mb-3 uppercase tracking-wider">
                    {language === 'ar' ? 'إعلان نقابي' : 'Syndicate Announcement'}
                  </div>
                  <h3 className="text-xl font-bold text-foreground mb-3 leading-tight group-hover:text-primary transition-colors line-clamp-2">
                    {language === 'ar' 
                      ? 'النقابة تطلق البرنامج التدريبي الوطني لتأهيل مطوري البرمجيات' 
                      : 'Syndicate launches national training program for software developers'}
                  </h3>
                  <p className="text-muted-foreground text-sm line-clamp-3 mb-4">
                    {language === 'ar'
                      ? 'في إطار جهودها للارتقاء بالكفاءات الوطنية، أعلنت نقابة تكنولوجيا المعلومات اليوم عن إطلاق أضخم برنامج تدريبي متخصص بالتعاون مع كبرى الشركات التكنولوجية.'
                      : 'As part of its efforts to elevate national competencies, the IT Syndicate announced today the launch of the largest specialized training program in collaboration with major tech companies.'}
                  </p>
                  <Link href={`/news/${item}`} className="text-primary text-sm font-bold flex items-center hover:text-primary/80">
                    {language === 'ar' ? 'اقرأ التفاصيل' : 'Read details'} <ArrowIcon className="w-4 h-4 ml-1 rtl:mr-1 rtl:ml-0" />
                  </Link>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Two column: Events & Reports */}
      <section className="py-20 bg-gray-50 border-y">
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
                    <div className="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-4 rounded-xl border bg-white shadow-sm hover:shadow-md transition-shadow">
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
                <Button variant="outline" className="border-border">
                  {language === 'ar' ? 'عرض أجندة الفعاليات' : 'View Events Calendar'}
                </Button>
              </div>
            </div>

            {/* Reports List */}
            <div>
              <h2 className="text-2xl font-bold text-foreground mb-8 pb-4 border-b">
                {t('section.reports')}
              </h2>
              <div className="space-y-4">
                {[1, 2, 3, 4].map((report) => (
                  <div key={report} className="flex items-start gap-4 p-5 rounded-xl border bg-white hover:bg-gray-50 transition-colors group cursor-pointer">
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
                <Button variant="outline" className="border-border">
                  {language === 'ar' ? 'تصفح المكتبة الرقمية' : 'Browse Digital Library'}
                </Button>
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
              { icon: Scale, label: t('quick.regulations') },
              { icon: Info, label: t('quick.requirements') },
              { icon: FileSignature, label: t('quick.forms') },
              { icon: Users, label: t('quick.directory') },
            ].map((item, i) => (
              <a key={i} href="#" className="flex flex-col items-center text-center p-6 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 transition-colors">
                <item.icon className="w-8 h-8 mb-4 text-accent" />
                <span className="font-medium text-sm md:text-base">{item.label}</span>
              </a>
            ))}
          </div>
        </div>
      </section>
    </Layout>
  );
}
