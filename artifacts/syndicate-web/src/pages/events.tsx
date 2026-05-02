import { Layout } from "@/components/layout/Layout";
import { useLanguage } from "@/lib/language-context";
import { MapPin, Clock, Calendar as CalendarIcon } from "lucide-react";
import { Button } from "@/components/ui/button";

export default function Events() {
  const { language } = useLanguage();

  const events = [
    {
      id: 1,
      title: language === 'ar' ? 'المؤتمر السنوي للأمن السيبراني' : 'Annual Cybersecurity Conference',
      date: language === 'ar' ? '15 أبريل 2025' : 'April 15, 2025',
      time: '09:00 AM - 04:00 PM',
      location: language === 'ar' ? 'رام الله - فندق الكرمل' : 'Ramallah - Carmel Hotel',
      type: language === 'ar' ? 'مؤتمر' : 'Conference',
      desc: language === 'ar' 
        ? 'ورش عمل متخصصة وجلسات حوارية حول أحدث تحديات أمن المعلومات وسبل الحماية المؤسسية.'
        : 'Specialized workshops and panel discussions on the latest information security challenges and institutional protection methods.',
    },
    {
      id: 2,
      title: language === 'ar' ? 'ملتقى مطوري الذكاء الاصطناعي' : 'AI Developers Meetup',
      date: language === 'ar' ? '28 أبريل 2025' : 'April 28, 2025',
      time: '04:00 PM - 07:00 PM',
      location: language === 'ar' ? 'نابلس - مساحة العمل المشتركة' : 'Nablus - Co-working Space',
      type: language === 'ar' ? 'لقاء مهني' : 'Meetup',
      desc: language === 'ar'
        ? 'لقاء مفتوح للمهتمين بالذكاء الاصطناعي لمناقشة أحدث النماذج وتطبيقاتها في السوق المحلي.'
        : 'An open meetup for AI enthusiasts to discuss the latest models and their applications in the local market.',
    },
    {
      id: 3,
      title: language === 'ar' ? 'الجمعية العمومية العادية' : 'Ordinary General Assembly',
      date: language === 'ar' ? '10 مايو 2025' : 'May 10, 2025',
      time: '10:00 AM - 02:00 PM',
      location: language === 'ar' ? 'البيرة - مقر النقابة' : 'Al-Bireh - Syndicate HQ',
      type: language === 'ar' ? 'اجتماع رسمي' : 'Official Meeting',
      desc: language === 'ar'
        ? 'الاجتماع السنوي العادي لمناقشة التقريرين الإداري والمالي وإقرار خطة العمل للعام القادم.'
        : 'The annual ordinary meeting to discuss the administrative and financial reports and approve the action plan for the coming year.',
    },
  ];

  return (
    <Layout>
      <div className="bg-primary/5 py-12 border-b">
        <div className="container mx-auto px-4 md:px-6">
          <h1 className="text-3xl md:text-4xl font-bold text-foreground mb-4">
            {language === 'ar' ? 'الفعاليات والأنشطة' : 'Events & Activities'}
          </h1>
          <p className="text-muted-foreground max-w-2xl text-lg">
            {language === 'ar' 
              ? 'شارك في مؤتمراتنا، ورش العمل، واللقاءات المهنية لتوسيع شبكة علاقاتك وتطوير معرفتك.'
              : 'Participate in our conferences, workshops, and professional meetups to expand your network and develop your knowledge.'}
          </p>
        </div>
      </div>

      <div className="container mx-auto px-4 md:px-6 py-16">
        <div className="max-w-4xl mx-auto space-y-8 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-primary/20 before:via-border before:to-transparent rtl:before:mr-5 rtl:before:ml-auto md:rtl:before:mx-auto">
          
          {events.map((event) => (
            <div key={event.id} className="relative flex items-start justify-between md:justify-normal md:odd:flex-row-reverse group">
              {/* Timeline Marker */}
              <div className="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-primary text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 rtl:md:group-odd:translate-x-1/2 rtl:md:group-even:-translate-x-1/2 z-10 mt-6">
                <CalendarIcon className="w-4 h-4" />
              </div>
              
              {/* Event Card */}
              <div className="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-white p-6 rounded-2xl border shadow-sm hover:shadow-md transition-shadow relative">
                {/* Connector Arrow */}
                <div className="absolute top-10 w-4 h-4 bg-white border-t border-r md:group-even:-left-2 md:group-even:-rotate-[135deg] md:group-odd:-right-2 md:group-odd:rotate-45 rtl:md:group-odd:-left-2 rtl:md:group-odd:-rotate-[135deg] rtl:md:group-even:-right-2 rtl:md:group-even:rotate-45 -left-2 -rotate-[135deg] rtl:-right-2 rtl:rotate-45 hidden md:block"></div>

                <div className="flex justify-between items-start mb-4">
                  <div className="bg-primary/10 text-primary text-xs font-bold px-3 py-1 rounded-md">
                    {event.type}
                  </div>
                </div>
                
                <h3 className="text-xl font-bold text-foreground mb-3 leading-tight">
                  {event.title}
                </h3>
                
                <p className="text-muted-foreground text-sm mb-6 leading-relaxed">
                  {event.desc}
                </p>

                <div className="space-y-3 mb-6 bg-gray-50 p-4 rounded-xl border border-gray-100">
                  <div className="flex items-center text-sm text-foreground">
                    <CalendarIcon className="w-4 h-4 text-muted-foreground ml-2 rtl:mr-2 rtl:ml-0 shrink-0" />
                    <span className="font-medium">{event.date}</span>
                  </div>
                  <div className="flex items-center text-sm text-foreground">
                    <Clock className="w-4 h-4 text-muted-foreground ml-2 rtl:mr-2 rtl:ml-0 shrink-0" />
                    <span className="font-medium" dir="ltr">{event.time}</span>
                  </div>
                  <div className="flex items-center text-sm text-foreground">
                    <MapPin className="w-4 h-4 text-muted-foreground ml-2 rtl:mr-2 rtl:ml-0 shrink-0" />
                    <span className="font-medium">{event.location}</span>
                  </div>
                </div>

                <Button className="w-full bg-accent text-primary hover:bg-accent/90 font-bold">
                  {language === 'ar' ? 'التسجيل في الفعالية' : 'Register for Event'}
                </Button>
              </div>
            </div>
          ))}

        </div>
      </div>
    </Layout>
  );
}
