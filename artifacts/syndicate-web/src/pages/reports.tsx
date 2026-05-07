import { Layout } from "@/components/layout/Layout";
import { useLanguage } from "@/lib/language-context";
import { FileText, Download, FileBarChart, ShieldAlert } from "lucide-react";
import { Button } from "@/components/ui/button";

export default function Reports() {
  const { language } = useLanguage();

  const documents = [
    {
      category: language === 'ar' ? 'التقارير السنوية' : 'Annual Reports',
      icon: FileBarChart,
      items: [
        { title: language === 'ar' ? 'التقرير السنوي لواقع قطاع تكنولوجيا المعلومات 2024' : 'Annual Report on IT Sector Reality 2024', size: '2.4 MB', date: '2025-01-10' },
        { title: language === 'ar' ? 'التقرير المالي والإداري للنقابة 2024' : 'Financial and Administrative Report 2024', size: '1.1 MB', date: '2025-01-05' },
      ]
    },
    {
      category: language === 'ar' ? 'الأنظمة والقوانين' : 'Regulations & Laws',
      icon: ShieldAlert,
      items: [
        { title: language === 'ar' ? 'النظام الأساسي المعدل لنقابة تكنولوجيا المعلومات' : 'Amended Basic Statute of the IT Syndicate', size: '5.2 MB', date: '2023-05-20' },
        { title: language === 'ar' ? 'لائحة أخلاقيات وآداب المهنة' : 'Code of Ethics and Professional Conduct', size: '0.8 MB', date: '2022-11-15' },
        { title: language === 'ar' ? 'نظام التأمين الصحي التكافلي للأعضاء' : 'Takaful Health Insurance System for Members', size: '1.5 MB', date: '2024-02-10' },
      ]
    },
    {
      category: language === 'ar' ? 'الدراسات والأبحاث' : 'Studies & Research',
      icon: FileText,
      items: [
        { title: language === 'ar' ? 'دراسة: فجوة المهارات في سوق العمل التقني الفلسطيني' : 'Study: Skills Gap in the Palestinian Tech Job Market', size: '3.7 MB', date: '2024-08-30' },
        { title: language === 'ar' ? 'ورقة موقف: تحديات الشركات الناشئة في ظل الأزمات' : 'Position Paper: Startup Challenges During Crises', size: '1.2 MB', date: '2024-04-12' },
      ]
    }
  ];

  return (
    <Layout>
      <div className="bg-primary/5 py-12 border-b">
        <div className="container mx-auto px-4 md:px-6">
          <h1 className="text-3xl md:text-4xl font-bold text-foreground mb-4">
            {language === 'ar' ? 'التقارير والمنشورات' : 'Reports & Publications'}
          </h1>
          <p className="text-muted-foreground max-w-2xl text-lg">
            {language === 'ar' 
              ? 'مكتبة رقمية شاملة تضم تقارير النقابة الدورية، القوانين والأنظمة المهنية، والدراسات المتخصصة في القطاع.'
              : 'A comprehensive digital library containing periodic syndicate reports, professional laws and regulations, and specialized sector studies.'}
          </p>
        </div>
      </div>

      <div className="container mx-auto px-4 md:px-6 py-16 max-w-5xl">
        <div className="space-y-12">
          {documents.map((group, index) => (
            <div key={index}>
              <div className="flex items-center gap-3 mb-6 border-b pb-4">
                <group.icon className="w-6 h-6 text-primary" />
                <h2 className="text-2xl font-bold text-foreground">
                  {group.category}
                </h2>
              </div>
              
              <div className="grid grid-cols-1 gap-4">
                {group.items.map((doc, idx) => (
                  <div key={idx} className="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-5 rounded-xl border bg-card hover:bg-muted transition-colors group">
                    <div className="flex items-start gap-4">
                      <div className="w-10 h-10 rounded bg-red-100 flex items-center justify-center text-red-600 shrink-0 mt-1 sm:mt-0 font-bold text-xs">
                        PDF
                      </div>
                      <div>
                        <h3 className="font-bold text-foreground mb-1 group-hover:text-primary transition-colors">
                          {doc.title}
                        </h3>
                        <div className="flex items-center text-sm text-muted-foreground gap-4">
                          <span dir="ltr">{doc.date}</span>
                          <span className="w-1 h-1 rounded-full bg-border"></span>
                          <span dir="ltr">{doc.size}</span>
                        </div>
                      </div>
                    </div>
                    <Button variant="outline" size="sm" className="shrink-0 text-primary border-primary/20 hover:bg-primary/5 w-full sm:w-auto">
                      <Download className="w-4 h-4 ml-2 rtl:mr-2 rtl:ml-0" />
                      {language === 'ar' ? 'تحميل' : 'Download'}
                    </Button>
                  </div>
                ))}
              </div>
            </div>
          ))}
        </div>
      </div>
    </Layout>
  );
}
