import { useState } from "react";
import { useMutation } from "@tanstack/react-query";
import { useLocation } from "wouter";
import { motion } from "framer-motion";
import { Button } from "@/components/ui/button";
import { useLanguage } from "@/lib/language-context";
import { apiFetch } from "@/lib/queryClient";
import { Navbar } from "@/components/layout/Navbar";
import { Footer } from "@/components/layout/Footer";
import { useUser } from "@clerk/react";
import { CheckCircle2 } from "lucide-react";

export default function MembershipApply() {
  const { language } = useLanguage();
  const { user } = useUser();
  const [, setLocation] = useLocation();
  const isAr = language === "ar";
  const [submitted, setSubmitted] = useState(false);

  const [form, setForm] = useState({
    fullName: `${user?.firstName ?? ""} ${user?.lastName ?? ""}`.trim(),
    email: user?.primaryEmailAddress?.emailAddress ?? "",
    phone: "",
    nationalId: "",
    city: "",
    university: "",
    major: "",
    graduationYear: "",
    employer: "",
    jobTitle: "",
    yearsExperience: "",
    membershipTier: "regular",
    notes: "",
  });

  const mutation = useMutation({
    mutationFn: (payload: typeof form) =>
      apiFetch("/api/membership/apply", {
        method: "POST",
        body: JSON.stringify(payload),
      }),
    onSuccess: () => setSubmitted(true),
  });

  const update = (k: keyof typeof form) => (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement>) =>
    setForm((f) => ({ ...f, [k]: e.target.value }));

  if (submitted) {
    return (
      <div className="min-h-screen bg-gray-50/50">
        <Navbar />
        <main className="container mx-auto px-4 md:px-6 pt-32 pb-20 max-w-2xl">
          <div className="bg-white rounded-xl border p-10 shadow-sm text-center">
            <CheckCircle2 className="w-16 h-16 text-green-600 mx-auto mb-4" />
            <h1 className="text-2xl font-bold mb-3">
              {isAr ? "تم استلام طلبك بنجاح" : "Your application was received"}
            </h1>
            <p className="text-muted-foreground mb-6">
              {isAr
                ? "سيراجع الفريق طلبك وسنتواصل معك قريباً."
                : "Our team will review your application and contact you shortly."}
            </p>
            <Button onClick={() => setLocation("/dashboard")} className="bg-primary text-white">
              {isAr ? "العودة إلى لوحة التحكم" : "Back to dashboard"}
            </Button>
          </div>
        </main>
        <Footer />
      </div>
    );
  }

  const fields: Array<{ k: keyof typeof form; ar: string; en: string; required?: boolean; type?: string }> = [
    { k: "fullName", ar: "الاسم الكامل", en: "Full name", required: true },
    { k: "email", ar: "البريد الإلكتروني", en: "Email", required: true, type: "email" },
    { k: "phone", ar: "رقم الهاتف", en: "Phone" },
    { k: "nationalId", ar: "رقم الهوية", en: "National ID" },
    { k: "city", ar: "المدينة", en: "City" },
    { k: "university", ar: "الجامعة", en: "University" },
    { k: "major", ar: "التخصص", en: "Major" },
    { k: "graduationYear", ar: "سنة التخرج", en: "Graduation year" },
    { k: "employer", ar: "جهة العمل", en: "Employer" },
    { k: "jobTitle", ar: "المسمى الوظيفي", en: "Job title" },
    { k: "yearsExperience", ar: "سنوات الخبرة", en: "Years of experience" },
  ];

  return (
    <div className="min-h-screen bg-gray-50/50">
      <Navbar />
      <main className="container mx-auto px-4 md:px-6 pt-32 pb-20 max-w-3xl">
        <motion.div initial={{ opacity: 0, y: 12 }} animate={{ opacity: 1, y: 0 }}>
          <h1 className="text-3xl md:text-4xl font-bold mb-2">
            {isAr ? "طلب عضوية" : "Membership application"}
          </h1>
          <p className="text-muted-foreground mb-8">
            {isAr
              ? "املأ النموذج التالي لتقديم طلب الانضمام إلى نقابة العلوم المعلوماتية التكنولوجية الفلسطينية."
              : "Fill out the form to apply for membership in the Palestinian IT Syndicate."}
          </p>
        </motion.div>

        <form
          onSubmit={(e) => {
            e.preventDefault();
            mutation.mutate(form);
          }}
          className="bg-white rounded-xl border p-6 md:p-8 shadow-sm space-y-5"
        >
          <div className="grid grid-cols-1 md:grid-cols-2 gap-5">
            {fields.map((f) => (
              <label key={f.k} className="block">
                <span className="text-sm font-medium text-foreground">
                  {isAr ? f.ar : f.en}
                  {f.required && <span className="text-destructive ms-1">*</span>}
                </span>
                <input
                  type={f.type ?? "text"}
                  required={f.required}
                  value={form[f.k]}
                  onChange={update(f.k)}
                  className="mt-1 w-full rounded-md border border-border bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30"
                />
              </label>
            ))}

            <label className="block md:col-span-2">
              <span className="text-sm font-medium text-foreground">
                {isAr ? "فئة العضوية" : "Membership tier"}
              </span>
              <select
                value={form.membershipTier}
                onChange={update("membershipTier")}
                className="mt-1 w-full rounded-md border border-border bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30"
              >
                <option value="regular">{isAr ? "عضو عامل" : "Regular member"}</option>
                <option value="associate">{isAr ? "عضو منتسب" : "Associate member"}</option>
                <option value="student">{isAr ? "عضو طالب" : "Student member"}</option>
                <option value="honorary">{isAr ? "عضو فخري" : "Honorary member"}</option>
              </select>
            </label>

            <label className="block md:col-span-2">
              <span className="text-sm font-medium text-foreground">
                {isAr ? "ملاحظات إضافية" : "Additional notes"}
              </span>
              <textarea
                rows={4}
                value={form.notes}
                onChange={update("notes")}
                className="mt-1 w-full rounded-md border border-border bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30"
              />
            </label>
          </div>

          {mutation.isError && (
            <p className="text-sm text-destructive">
              {isAr ? "حدث خطأ أثناء الإرسال. حاول مرة أخرى." : "Something went wrong. Please try again."}
            </p>
          )}

          <Button
            type="submit"
            disabled={mutation.isPending}
            className="bg-accent text-primary hover:bg-accent/90 font-semibold px-8 py-6 text-base"
          >
            {mutation.isPending
              ? isAr ? "جاري الإرسال..." : "Submitting..."
              : isAr ? "إرسال الطلب" : "Submit application"}
          </Button>
        </form>
      </main>
      <Footer />
    </div>
  );
}
