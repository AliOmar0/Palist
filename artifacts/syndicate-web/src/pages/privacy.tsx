import { Layout } from "@/components/layout/Layout";
import { useLanguage } from "@/lib/language-context";

export default function Privacy() {
  const { language } = useLanguage();
  const isAr = language === "ar";
  return (
    <Layout>
      <div className="bg-primary/5 py-12 border-b">
        <div className="container mx-auto px-4 md:px-6">
          <h1 className="text-3xl md:text-4xl font-bold text-foreground">
            {isAr ? "سياسة الخصوصية" : "Privacy Policy"}
          </h1>
          <p className="text-muted-foreground mt-3 text-lg">
            {isAr
              ? "آخر تحديث: مايو 2026"
              : "Last updated: May 2026"}
          </p>
        </div>
      </div>
      <div className="container mx-auto px-4 md:px-6 py-12 max-w-3xl">
        <article className="prose prose-neutral max-w-none space-y-6 text-foreground leading-relaxed">
          {isAr ? (
            <>
              <section>
                <h2 className="text-xl font-bold mb-2">1. مقدمة</h2>
                <p>
                  تحترم نقابة العلوم المعلوماتية التكنولوجية الفلسطينية خصوصية زوار الموقع وأعضاء النقابة. توضّح هذه السياسة كيفية جمع المعلومات الشخصية واستخدامها وحمايتها.
                </p>
              </section>
              <section>
                <h2 className="text-xl font-bold mb-2">2. المعلومات التي نجمعها</h2>
                <ul className="list-disc ps-6 space-y-1">
                  <li>المعلومات التي تقدّمها طوعاً عند تقديم طلب العضوية أو نموذج التواصل (الاسم، البريد، الهاتف، الشهادات).</li>
                  <li>المعلومات التقنية الأساسية (نوع المتصفح، عنوان IP، صفحات الزيارة) لأغراض إحصائية وأمنية.</li>
                  <li>الكوكيز الضرورية لتشغيل تسجيل الدخول والجلسات.</li>
                </ul>
              </section>
              <section>
                <h2 className="text-xl font-bold mb-2">3. استخدام المعلومات</h2>
                <p>تُستخدم بياناتك لمعالجة طلب العضوية، التواصل بشأن الفعاليات والتدريبات، وإصدار التقارير المجمّعة عن قطاع تكنولوجيا المعلومات.</p>
              </section>
              <section>
                <h2 className="text-xl font-bold mb-2">4. مشاركة البيانات</h2>
                <p>لا نبيع بياناتك أو نشاركها مع أطراف ثالثة لأغراض تسويقية. قد نشاركها مع جهات حكومية مختصة فقط عند وجود التزام قانوني.</p>
              </section>
              <section>
                <h2 className="text-xl font-bold mb-2">5. حقوقك</h2>
                <p>يحق لك طلب الاطلاع على بياناتك وتصحيحها أو حذف حسابك في أي وقت بمراسلتنا على info@palitsyndicate.ps.</p>
              </section>
              <section>
                <h2 className="text-xl font-bold mb-2">6. الاتصال</h2>
                <p>لأي استفسار حول الخصوصية تواصل معنا على البريد الإلكتروني أعلاه أو من خلال صفحة "اتصل بنا".</p>
              </section>
            </>
          ) : (
            <>
              <section>
                <h2 className="text-xl font-bold mb-2">1. Introduction</h2>
                <p>
                  The Palestinian IT Syndicate respects the privacy of visitors and members. This policy explains how we collect, use, and protect personal information.
                </p>
              </section>
              <section>
                <h2 className="text-xl font-bold mb-2">2. Information We Collect</h2>
                <ul className="list-disc ps-6 space-y-1">
                  <li>Information you provide voluntarily through the membership application or contact form (name, email, phone, qualifications).</li>
                  <li>Basic technical data (browser, IP address, visited pages) for analytics and security.</li>
                  <li>Cookies strictly necessary for sign-in and session management.</li>
                </ul>
              </section>
              <section>
                <h2 className="text-xl font-bold mb-2">3. Use of Information</h2>
                <p>Your data is used to process membership applications, communicate about events and trainings, and produce aggregate reports about the IT sector.</p>
              </section>
              <section>
                <h2 className="text-xl font-bold mb-2">4. Sharing</h2>
                <p>We do not sell or share your data with third parties for marketing. We may share data with competent governmental authorities only when legally required.</p>
              </section>
              <section>
                <h2 className="text-xl font-bold mb-2">5. Your Rights</h2>
                <p>You may request access to, correction of, or deletion of your data at any time by writing to info@palitsyndicate.ps.</p>
              </section>
              <section>
                <h2 className="text-xl font-bold mb-2">6. Contact</h2>
                <p>For privacy questions reach us at the email above or through the Contact page.</p>
              </section>
            </>
          )}
        </article>
      </div>
    </Layout>
  );
}
