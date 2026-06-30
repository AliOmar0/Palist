import { Layout } from "@/components/layout/Layout";
import { useLanguage } from "@/lib/language-context";
import { Button } from "@/components/ui/button";
import { Check, AlertCircle, Building2, GraduationCap, BriefcaseBusiness } from "lucide-react";
import { Link } from "wouter";

export default function Membership() {
  const { language } = useLanguage();
  const isAr = language === "ar";

  const membershipTypes = [
    {
      icon: GraduationCap,
      titleAr: "عضوية خريج غير ممارس للمهنة",
      titleEn: "Graduate Non-Practicing Membership",
      descAr: "للخريجين في تخصصات تكنولوجيا المعلومات غير العاملين حالياً في المهنة.",
      descEn: "For IT graduates who are not currently practicing in the profession.",
      benefitsAr: ["إثبات انتساب مهني", "المشاركة في فعاليات النقابة العامة", "الأولوية في فرص التدريب والتأهيل"],
      benefitsEn: ["Professional affiliation record", "Access to public syndicate events", "Priority for training and upskilling opportunities"],
    },
    {
      icon: BriefcaseBusiness,
      titleAr: "عضوية ممارس للمهنة",
      titleEn: "Practicing Professional Membership",
      descAr: "للعاملين في مجالات تكنولوجيا المعلومات لدى جهة عمل أو بشكل مستقل.",
      descEn: "For employed or independent professionals practicing in IT fields.",
      benefitsAr: ["بطاقة عضوية نقابية", "التصويت والترشح حسب النظام", "خصومات على التدريب والخدمات المهنية"],
      benefitsEn: ["Official membership card", "Voting and candidacy according to policy", "Discounts on training and professional services"],
      highlighted: true,
    },
    {
      icon: Building2,
      titleAr: "عضوية شركات",
      titleEn: "Corporate Membership",
      descAr: "للشركات والمؤسسات العاملة في قطاع تكنولوجيا المعلومات والاتصالات.",
      descEn: "For companies and institutions operating in the ICT sector.",
      benefitsAr: ["ظهور مؤسسي ضمن شبكة النقابة", "إتاحة فرص وشراكات مهنية", "المشاركة في برامج التدريب والتوظيف"],
      benefitsEn: ["Corporate visibility in the syndicate network", "Partnership and opportunity access", "Participation in training and employment programs"],
    },
  ];

  return (
    <Layout>
      <div className="bg-primary/5 py-12 border-b">
        <div className="container mx-auto px-4 md:px-6">
          <h1 className="text-3xl md:text-4xl font-bold text-foreground mb-4">
            {isAr ? 'العضوية' : 'Membership'}
          </h1>
          <p className="text-muted-foreground max-w-2xl text-lg">
            {isAr
              ? 'انضم إلى آلاف المحترفين في قطاع تكنولوجيا المعلومات الفلسطيني. اختر فئة العضوية المناسبة لك وابدأ بالاستفادة من المزايا والخدمات.'
              : 'Join thousands of professionals in the Palestinian IT sector. Choose the membership tier that suits you and start benefiting from the perks and services.'}
          </p>
        </div>
      </div>

      <div className="container mx-auto px-4 md:px-6 py-16">
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          {membershipTypes.map((tier) => {
            const Icon = tier.icon;
            const title = isAr ? tier.titleAr : tier.titleEn;
            const benefits = isAr ? tier.benefitsAr : tier.benefitsEn;
            return (
              <div
                key={tier.titleEn}
                className={`relative rounded-lg border p-7 shadow-sm transition-shadow hover:shadow-md ${
                  tier.highlighted ? "bg-primary text-white border-primary" : "bg-card"
                }`}
              >
                {tier.highlighted && (
                  <div className="absolute top-0 right-1/2 translate-x-1/2 -translate-y-1/2 rounded-md bg-accent px-4 py-1 text-xs font-bold text-primary shadow-sm">
                    {isAr ? "الأكثر طلباً" : "Most requested"}
                  </div>
                )}
                <Icon className={`mb-4 h-9 w-9 ${tier.highlighted ? "text-accent" : "text-secondary"}`} />
                <h3 className={`mb-3 text-xl font-bold ${tier.highlighted ? "text-white" : "text-foreground"}`}>
                  {title}
                </h3>
                <p className={`mb-6 min-h-16 text-sm leading-relaxed ${tier.highlighted ? "text-white/80" : "text-muted-foreground"}`}>
                  {isAr ? tier.descAr : tier.descEn}
                </p>
                <p className={`mb-5 text-sm font-semibold ${tier.highlighted ? "text-accent" : "text-primary"}`}>
                  {isAr ? "الرسوم حسب نظام النقابة" : "Fees according to syndicate policy"}
                </p>
                <ul className="mb-8 space-y-3 text-sm">
                  {benefits.map((benefit) => (
                    <li key={benefit} className="flex items-start gap-2">
                      <Check className={`h-5 w-5 shrink-0 ${tier.highlighted ? "text-accent" : "text-secondary"}`} />
                      <span className={tier.highlighted ? "text-white/90" : "text-muted-foreground"}>{benefit}</span>
                    </li>
                  ))}
                </ul>
                <Link href="/membership/apply">
                  <Button
                    className={`w-full border-0 font-bold ${
                      tier.highlighted
                        ? "bg-accent text-primary hover:bg-accent/90"
                        : "bg-primary/10 text-primary hover:bg-primary/20"
                    }`}
                  >
                    {isAr ? "تقديم طلب" : "Apply now"}
                  </Button>
                </Link>
              </div>
            );
          })}
        </div>

        <div className="mt-16 bg-blue-50 border border-blue-100 rounded-lg p-6 flex flex-col md:flex-row gap-6 items-start md:items-center">
          <div className="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 shrink-0">
            <AlertCircle className="w-6 h-6" />
          </div>
          <div className="flex-1">
            <h4 className="font-bold text-blue-900 mb-2">
              {isAr ? 'المستندات المطلوبة للتسجيل' : 'Required Documents for Registration'}
            </h4>
            <p className="text-blue-800/80 text-sm">
              {isAr
                ? 'يرجى تجهيز: صورة الهوية، الشهادة أو إثبات المؤهل، ورقة تأكيد العمل من جهة العمل الحالية إن وجدت، وأي مستندات داعمة قبل البدء بتعبئة الطلب.'
                : 'Please prepare: ID image, degree or qualification proof, current workplace confirmation if applicable, and any supporting documents before starting the application.'}
            </p>
          </div>
          <Button variant="outline" className="bg-card border-blue-200 text-blue-700 hover:bg-blue-50 shrink-0">
            {isAr ? 'دليل التسجيل التفصيلي' : 'Detailed Registration Guide'}
          </Button>
        </div>
      </div>
    </Layout>
  );
}
