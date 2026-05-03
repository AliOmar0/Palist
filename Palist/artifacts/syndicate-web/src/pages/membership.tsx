import { Layout } from "@/components/layout/Layout";
import { useLanguage } from "@/lib/language-context";
import { Button } from "@/components/ui/button";
import { Check, AlertCircle } from "lucide-react";

export default function Membership() {
  const { language } = useLanguage();

  return (
    <Layout>
      <div className="bg-primary/5 py-12 border-b">
        <div className="container mx-auto px-4 md:px-6">
          <h1 className="text-3xl md:text-4xl font-bold text-foreground mb-4">
            {language === 'ar' ? 'العضوية' : 'Membership'}
          </h1>
          <p className="text-muted-foreground max-w-2xl text-lg">
            {language === 'ar' 
              ? 'انضم إلى آلاف المحترفين في قطاع تكنولوجيا المعلومات الفلسطيني. اختر فئة العضوية المناسبة لك وابدأ بالاستفادة من المزايا والخدمات.'
              : 'Join thousands of professionals in the Palestinian IT sector. Choose the membership tier that suits you and start benefiting from the perks and services.'}
          </p>
        </div>
      </div>

      <div className="container mx-auto px-4 md:px-6 py-16">
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          
          {/* Student Membership */}
          <div className="bg-white border rounded-2xl p-8 relative hover:shadow-lg transition-shadow">
            <h3 className="text-xl font-bold text-foreground mb-2">
              {language === 'ar' ? 'عضوية طالب' : 'Student Membership'}
            </h3>
            <p className="text-muted-foreground text-sm mb-6 h-10">
              {language === 'ar' ? 'لطلاب كليات تكنولوجيا المعلومات والهندسة في الجامعات المعترف بها.' : 'For IT and engineering students in recognized universities.'}
            </p>
            <div className="text-3xl font-bold text-primary mb-6">
              20 <span className="text-lg font-normal text-muted-foreground">{language === 'ar' ? 'شيكل / سنوياً' : 'ILS / year'}</span>
            </div>
            <ul className="space-y-3 mb-8 text-sm">
              {[
                language === 'ar' ? 'المشاركة في الفعاليات وورش العمل' : 'Participation in events and workshops',
                language === 'ar' ? 'الوصول للمكتبة الرقمية' : 'Access to digital library',
                language === 'ar' ? 'التوجيه والإرشاد المهني' : 'Career guidance and counseling',
              ].map((benefit, i) => (
                <li key={i} className="flex items-start gap-2">
                  <Check className="w-5 h-5 text-secondary shrink-0" />
                  <span className="text-muted-foreground">{benefit}</span>
                </li>
              ))}
            </ul>
            <Button className="w-full bg-primary/10 text-primary hover:bg-primary/20 border-0 font-bold">
              {language === 'ar' ? 'تقديم طلب' : 'Apply Now'}
            </Button>
          </div>

          {/* Full Membership */}
          <div className="bg-primary border-primary rounded-2xl p-8 relative shadow-lg transform md:-translate-y-4">
            <div className="absolute top-0 right-1/2 translate-x-1/2 -translate-y-1/2 bg-accent text-primary text-xs font-bold px-4 py-1 rounded-full shadow-sm">
              {language === 'ar' ? 'الأكثر شيوعاً' : 'Most Popular'}
            </div>
            <h3 className="text-xl font-bold text-white mb-2">
              {language === 'ar' ? 'عضوية عاملة' : 'Full Membership'}
            </h3>
            <p className="text-white/80 text-sm mb-6 h-10">
              {language === 'ar' ? 'للحاصلين على شهادة البكالوريوس فما فوق في تخصصات تكنولوجيا المعلومات.' : 'For holders of a Bachelor\'s degree or higher in IT disciplines.'}
            </p>
            <div className="text-3xl font-bold text-accent mb-6">
              150 <span className="text-lg font-normal text-white/70">{language === 'ar' ? 'شيكل / سنوياً' : 'ILS / year'}</span>
            </div>
            <ul className="space-y-3 mb-8 text-sm">
              {[
                language === 'ar' ? 'حق الترشح والانتخاب لمجلس النقابة' : 'Right to vote and run for syndicate council',
                language === 'ar' ? 'بطاقة عضوية نقابية معتمدة' : 'Official syndicate membership card',
                language === 'ar' ? 'تأمين صحي مخفض' : 'Discounted health insurance',
                language === 'ar' ? 'استشارات قانونية مجانية' : 'Free legal consultations',
                language === 'ar' ? 'خصومات على الدورات الاحترافية' : 'Discounts on professional courses',
              ].map((benefit, i) => (
                <li key={i} className="flex items-start gap-2">
                  <Check className="w-5 h-5 text-accent shrink-0" />
                  <span className="text-white/90">{benefit}</span>
                </li>
              ))}
            </ul>
            <Button className="w-full bg-accent text-primary hover:bg-accent/90 border-0 font-bold">
              {language === 'ar' ? 'سجل كعضو عامل' : 'Register as Full Member'}
            </Button>
          </div>

          {/* Associate Membership */}
          <div className="bg-white border rounded-2xl p-8 relative hover:shadow-lg transition-shadow">
            <h3 className="text-xl font-bold text-foreground mb-2">
              {language === 'ar' ? 'عضوية مؤازرة' : 'Associate Membership'}
            </h3>
            <p className="text-muted-foreground text-sm mb-6 h-10">
              {language === 'ar' ? 'للعاملين في القطاع من تخصصات أخرى أو الحاصلين على شهادات دبلوم.' : 'For sector workers from other disciplines or diploma holders.'}
            </p>
            <div className="text-3xl font-bold text-primary mb-6">
              100 <span className="text-lg font-normal text-muted-foreground">{language === 'ar' ? 'شيكل / سنوياً' : 'ILS / year'}</span>
            </div>
            <ul className="space-y-3 mb-8 text-sm">
              {[
                language === 'ar' ? 'بطاقة عضوية مؤازرة' : 'Associate membership card',
                language === 'ar' ? 'المشاركة في لجان النقابة' : 'Participation in syndicate committees',
                language === 'ar' ? 'تأمين صحي مخفض' : 'Discounted health insurance',
                language === 'ar' ? 'خصومات على الخدمات والنشرات' : 'Discounts on services and publications',
              ].map((benefit, i) => (
                <li key={i} className="flex items-start gap-2">
                  <Check className="w-5 h-5 text-secondary shrink-0" />
                  <span className="text-muted-foreground">{benefit}</span>
                </li>
              ))}
            </ul>
            <Button className="w-full bg-primary/10 text-primary hover:bg-primary/20 border-0 font-bold">
              {language === 'ar' ? 'تقديم طلب' : 'Apply Now'}
            </Button>
          </div>
        </div>

        <div className="mt-16 bg-blue-50 border border-blue-100 rounded-2xl p-6 flex flex-col md:flex-row gap-6 items-start md:items-center">
          <div className="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 shrink-0">
            <AlertCircle className="w-6 h-6" />
          </div>
          <div className="flex-1">
            <h4 className="font-bold text-blue-900 mb-2">
              {language === 'ar' ? 'المستندات المطلوبة للتسجيل' : 'Required Documents for Registration'}
            </h4>
            <p className="text-blue-800/80 text-sm">
              {language === 'ar' 
                ? 'يرجى تجهيز: صورة عن الهوية الشخصية، صورة عن الشهادة الجامعية مصدقة، صورة شخصية حديثة، وسيرة ذاتية محدثة قبل البدء بتعبئة الطلب الإلكتروني.'
                : 'Please prepare: Copy of ID, certified copy of university degree, recent personal photo, and updated CV before starting the online application.'}
            </p>
          </div>
          <Button variant="outline" className="bg-white border-blue-200 text-blue-700 hover:bg-blue-50 shrink-0">
            {language === 'ar' ? 'دليل التسجيل التفصيلي' : 'Detailed Registration Guide'}
          </Button>
        </div>
      </div>
    </Layout>
  );
}
