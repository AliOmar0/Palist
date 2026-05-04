import { Layout } from "@/components/layout/Layout";
import { useLanguage } from "@/lib/language-context";
import { Button } from "@/components/ui/button";
import { Calendar, Search } from "lucide-react";
import { Input } from "@/components/ui/input";

export default function News() {
  const { language } = useLanguage();

  const newsItems = [
    {
      id: 1,
      date: language === 'ar' ? '15 مارس 2025' : 'March 15, 2025',
      category: language === 'ar' ? 'إعلان نقابي' : 'Syndicate Announcement',
      title: language === 'ar' ? 'النقابة تطلق البرنامج التدريبي الوطني لتأهيل مطوري البرمجيات' : 'Syndicate launches national training program for software developers',
      excerpt: language === 'ar' ? 'في إطار جهودها للارتقاء بالكفاءات الوطنية، أعلنت نقابة تكنولوجيا المعلومات اليوم عن إطلاق أضخم برنامج تدريبي متخصص بالتعاون مع كبرى الشركات التكنولوجية.' : 'As part of its efforts to elevate national competencies, the IT Syndicate announced today the launch of the largest specialized training program.',
    },
    {
      id: 2,
      date: language === 'ar' ? '10 مارس 2025' : 'March 10, 2025',
      category: language === 'ar' ? 'شراكات' : 'Partnerships',
      title: language === 'ar' ? 'توقيع اتفاقية تعاون مع وزارة الاتصالات لدعم التحول الرقمي' : 'Signing cooperation agreement with Ministry of Communications to support digital transformation',
      excerpt: language === 'ar' ? 'وقعت النقابة مذكرة تفاهم تهدف إلى تعزيز دور القطاع الخاص والنقابي في تسريع عجلة التحول الرقمي للمؤسسات الحكومية.' : 'The syndicate signed a memorandum of understanding aimed at enhancing the role of the private and syndicate sectors in accelerating digital transformation.',
    },
    {
      id: 3,
      date: language === 'ar' ? '5 مارس 2025' : 'March 5, 2025',
      category: language === 'ar' ? 'أخبار الأعضاء' : 'Members News',
      title: language === 'ar' ? 'فتح باب الترشح لجوائز الإبداع التكنولوجي 2025' : 'Call for nominations for Technological Innovation Awards 2025',
      excerpt: language === 'ar' ? 'ندعو كافة الزملاء والزميلات لتقديم مشاريعهم الابتكارية للمنافسة على جوائز النقابة السنوية للإبداع.' : 'We invite all colleagues to submit their innovative projects to compete for the syndicate\'s annual innovation awards.',
    },
    {
      id: 4,
      date: language === 'ar' ? '28 فبراير 2025' : 'February 28, 2025',
      category: language === 'ar' ? 'فعاليات' : 'Events',
      title: language === 'ar' ? 'نجاح كبير لمؤتمر الأمن السيبراني الأول في رام الله' : 'Great success for the first Cybersecurity Conference in Ramallah',
      excerpt: language === 'ar' ? 'بمشاركة أكثر من 500 خبير ومختص، اختتمت النقابة أعمال مؤتمرها السنوي للأمن السيبراني بتوصيات هامة.' : 'With the participation of over 500 experts, the syndicate concluded its annual cybersecurity conference with important recommendations.',
    },
    {
      id: 5,
      date: language === 'ar' ? '20 فبراير 2025' : 'February 20, 2025',
      category: language === 'ar' ? 'إعلان نقابي' : 'Syndicate Announcement',
      title: language === 'ar' ? 'اعتماد نظام التأمين الصحي الجديد للأعضاء وعائلاتهم' : 'Approval of the new health insurance system for members and their families',
      excerpt: language === 'ar' ? 'في خطوة تهدف لتعزيز الخدمات المقدمة، تم إقرار حزمة تأمينية شاملة بأسعار تفضيلية للأعضاء المنتسبين.' : 'In a step aimed at enhancing services, a comprehensive insurance package at preferential rates was approved for affiliated members.',
    },
  ];

  return (
    <Layout>
      <div className="bg-primary/5 py-12 border-b">
        <div className="container mx-auto px-4 md:px-6">
          <h1 className="text-3xl md:text-4xl font-bold text-foreground mb-4">
            {language === 'ar' ? 'الأخبار والإعلانات' : 'News & Announcements'}
          </h1>
          <p className="text-muted-foreground max-w-2xl text-lg">
            {language === 'ar' 
              ? 'ابق على اطلاع بآخر أخبار النقابة، القرارات، الفعاليات، وأهم التطورات في قطاع تكنولوجيا المعلومات الفلسطيني.'
              : 'Stay informed with the latest syndicate news, decisions, events, and major developments in the Palestinian IT sector.'}
          </p>
        </div>
      </div>

      <div className="container mx-auto px-4 md:px-6 py-12">
        {/* Search & Filter */}
        <div className="flex flex-col sm:flex-row gap-4 mb-12 bg-gray-50 p-4 rounded-xl border">
          <div className="relative flex-1">
            <Search className="absolute right-3 rtl:right-3 ltr:left-3 top-1/2 -translate-y-1/2 text-muted-foreground w-5 h-5" />
            <Input 
              placeholder={language === 'ar' ? 'ابحث في الأخبار...' : 'Search news...'} 
              className="bg-white pl-10 pr-4 rtl:pr-10 rtl:pl-4 h-12"
            />
          </div>
          <div className="flex gap-2 overflow-x-auto pb-2 sm:pb-0">
            {['الكل', 'إعلان نقابي', 'شراكات', 'فعاليات', 'أخبار الأعضاء'].map((cat, i) => (
              <Button key={i} variant={i === 0 ? "default" : "outline"} className={i === 0 ? "bg-primary" : "bg-white whitespace-nowrap"}>
                {language === 'en' ? (['All', 'Announcements', 'Partnerships', 'Events', 'Members News'][i]) : cat}
              </Button>
            ))}
          </div>
        </div>

        {/* News Grid */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          {newsItems.map((item, index) => (
            <div key={item.id} className="group rounded-xl overflow-hidden border bg-white shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col">
              <div className="aspect-[4/3] overflow-hidden relative bg-muted">
                <img 
                  src={`${import.meta.env.BASE_URL}news-${(index % 3) + 1}.png`} 
                  alt="News thumbnail" 
                  className="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                />
                <div className="absolute top-4 right-4 rtl:left-4 rtl:right-auto bg-white/90 backdrop-blur text-primary text-xs font-bold px-3 py-1.5 rounded-md shadow-sm flex items-center gap-1.5">
                  <Calendar className="w-3.5 h-3.5" />
                  {item.date}
                </div>
              </div>
              <div className="p-6 flex-1 flex flex-col">
                <div className="text-xs font-bold text-secondary mb-3 uppercase tracking-wider">
                  {item.category}
                </div>
                <h3 className="text-xl font-bold text-foreground mb-3 leading-tight group-hover:text-primary transition-colors line-clamp-2">
                  {item.title}
                </h3>
                <p className="text-muted-foreground text-sm line-clamp-3 mb-6 flex-1">
                  {item.excerpt}
                </p>
                <Button variant="outline" className="w-full border-primary/20 text-primary hover:bg-primary/5 mt-auto">
                  {language === 'ar' ? 'اقرأ التفاصيل' : 'Read Full Article'}
                </Button>
              </div>
            </div>
          ))}
        </div>

        <div className="mt-12 text-center">
          <Button variant="outline" size="lg" className="border-border">
            {language === 'ar' ? 'تحميل المزيد' : 'Load More'}
          </Button>
        </div>
      </div>
    </Layout>
  );
}
