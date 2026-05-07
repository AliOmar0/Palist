import { Layout } from "@/components/layout/Layout";
import { useLanguage } from "@/lib/language-context";

export default function Terms() {
  const { language } = useLanguage();
  const isAr = language === "ar";
  return (
    <Layout>
      <div className="bg-primary/5 py-12 border-b">
        <div className="container mx-auto px-4 md:px-6">
          <h1 className="text-3xl md:text-4xl font-bold text-foreground">
            {isAr ? "شروط الاستخدام" : "Terms of Use"}
          </h1>
          <p className="text-muted-foreground mt-3 text-lg">
            {isAr ? "آخر تحديث: مايو 2026" : "Last updated: May 2026"}
          </p>
        </div>
      </div>
      <div className="container mx-auto px-4 md:px-6 py-12 max-w-3xl">
        <article className="prose prose-neutral max-w-none space-y-6 text-foreground leading-relaxed">
          {isAr ? (
            <>
              <section>
                <h2 className="text-xl font-bold mb-2">1. القبول بالشروط</h2>
                <p>باستخدامك لموقع نقابة العلوم المعلوماتية التكنولوجية الفلسطينية فإنك توافق على الالتزام بهذه الشروط وقوانين النقابة المعمول بها.</p>
              </section>
              <section>
                <h2 className="text-xl font-bold mb-2">2. الحساب والعضوية</h2>
                <p>أنت مسؤول عن الحفاظ على سرية بيانات حسابك وعن جميع الأنشطة التي تتم باستخدامه. تلتزم بتقديم معلومات صحيحة وحديثة في طلب العضوية.</p>
              </section>
              <section>
                <h2 className="text-xl font-bold mb-2">3. الاستخدام المقبول</h2>
                <ul className="list-disc ps-6 space-y-1">
                  <li>عدم نشر أي محتوى غير قانوني أو مسيء أو ينتهك حقوق الملكية الفكرية.</li>
                  <li>عدم محاولة اختراق الموقع أو تعطيل خدماته.</li>
                  <li>احترام جميع المستخدمين وأخلاقيات المهنة.</li>
                </ul>
              </section>
              <section>
                <h2 className="text-xl font-bold mb-2">4. حقوق الملكية الفكرية</h2>
                <p>جميع المحتويات والشعارات والتقارير المنشورة على الموقع تعود ملكيتها للنقابة، ولا يجوز إعادة استخدامها تجارياً دون إذن خطي.</p>
              </section>
              <section>
                <h2 className="text-xl font-bold mb-2">5. حدود المسؤولية</h2>
                <p>تُقدّم المعلومات والخدمات على الموقع "كما هي" دون أي ضمانات صريحة، ولا تتحمل النقابة المسؤولية عن أي ضرر مباشر أو غير مباشر ناتج عن الاستخدام.</p>
              </section>
              <section>
                <h2 className="text-xl font-bold mb-2">6. التعديلات</h2>
                <p>تحتفظ النقابة بحق تعديل هذه الشروط في أي وقت، ويُعتبر الاستمرار في استخدام الموقع موافقة على التعديلات.</p>
              </section>
              <section>
                <h2 className="text-xl font-bold mb-2">7. القانون الواجب التطبيق</h2>
                <p>تخضع هذه الشروط لقوانين دولة فلسطين، وتُسوّى أي نزاعات أمام المحاكم المختصة.</p>
              </section>
            </>
          ) : (
            <>
              <section>
                <h2 className="text-xl font-bold mb-2">1. Acceptance of Terms</h2>
                <p>By using the website of the Palestinian IT Syndicate you agree to be bound by these terms and any applicable syndicate regulations.</p>
              </section>
              <section>
                <h2 className="text-xl font-bold mb-2">2. Account & Membership</h2>
                <p>You are responsible for maintaining the confidentiality of your account credentials and for all activities under your account. You agree to provide accurate, current information.</p>
              </section>
              <section>
                <h2 className="text-xl font-bold mb-2">3. Acceptable Use</h2>
                <ul className="list-disc ps-6 space-y-1">
                  <li>Do not post any unlawful, abusive, or infringing content.</li>
                  <li>Do not attempt to compromise or disrupt the site or its services.</li>
                  <li>Respect other users and professional ethics.</li>
                </ul>
              </section>
              <section>
                <h2 className="text-xl font-bold mb-2">4. Intellectual Property</h2>
                <p>All content, logos, and reports published on this site are owned by the Syndicate and may not be reused commercially without written permission.</p>
              </section>
              <section>
                <h2 className="text-xl font-bold mb-2">5. Limitation of Liability</h2>
                <p>Information and services are provided "as is" without warranty. The Syndicate is not liable for any direct or indirect damage arising from your use of the site.</p>
              </section>
              <section>
                <h2 className="text-xl font-bold mb-2">6. Modifications</h2>
                <p>The Syndicate may modify these terms at any time. Continued use of the site constitutes acceptance of the changes.</p>
              </section>
              <section>
                <h2 className="text-xl font-bold mb-2">7. Governing Law</h2>
                <p>These terms are governed by the laws of the State of Palestine, with disputes resolved in the competent courts.</p>
              </section>
            </>
          )}
        </article>
      </div>
    </Layout>
  );
}
