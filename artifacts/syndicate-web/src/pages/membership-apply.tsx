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
import { CheckCircle2, ChevronLeft, ChevronRight } from "lucide-react";

type FormState = {
  fullName: string;
  fullNameEn: string;
  email: string;
  confirmEmail: string;
  phone: string;
  nationalId: string;
  gender: string;
  dateOfBirth: string;
  placeOfBirth: string;
  socialStatus: string;
  city: string;
  provinceResidence: string;
  governorateAbroad: string;
  motherProvince: string;
  homeAddress: string;
  country: string;
  university: string;
  branch: string;
  major: string;
  average: string;
  graduationYear: string;
  employer: string;
  jobTitle: string;
  yearsExperience: string;
  membershipTier: string;
  notes: string;
  declarationAccepted: boolean;
};

const PROVINCES = [
  { value: "west_bank", ar: "الضفة الغربية", en: "West Bank" },
  { value: "gaza", ar: "قطاع غزة", en: "Gaza Strip" },
  { value: "abroad", ar: "خارج فلسطين", en: "Abroad" },
];

type Field = {
  k: keyof FormState;
  ar: string;
  en: string;
  required?: boolean;
  type?: "text" | "email" | "tel" | "date" | "number";
  full?: boolean;
};

const STEPS = [
  { ar: "البيانات الشخصية", en: "Personal information" },
  { ar: "التعليم والعمل", en: "Education & employment" },
  { ar: "العضوية والإقرار", en: "Membership & declaration" },
];

export default function MembershipApply() {
  const { language } = useLanguage();
  const { user } = useUser();
  const [, setLocation] = useLocation();
  const isAr = language === "ar";
  const [submitted, setSubmitted] = useState(false);
  const [step, setStep] = useState(0);

  const [form, setForm] = useState<FormState>({
    fullName: `${user?.firstName ?? ""} ${user?.lastName ?? ""}`.trim(),
    fullNameEn: "",
    email: user?.primaryEmailAddress?.emailAddress ?? "",
    confirmEmail: user?.primaryEmailAddress?.emailAddress ?? "",
    phone: "",
    nationalId: "",
    gender: "",
    dateOfBirth: "",
    placeOfBirth: "",
    socialStatus: "",
    city: "",
    provinceResidence: "",
    governorateAbroad: "",
    motherProvince: "",
    homeAddress: "",
    country: "Palestine",
    university: "",
    branch: "",
    major: "",
    average: "",
    graduationYear: "",
    employer: "",
    jobTitle: "",
    yearsExperience: "",
    membershipTier: "regular",
    notes: "",
    declarationAccepted: false,
  });

  const [emailMismatch, setEmailMismatch] = useState(false);

  const mutation = useMutation({
    mutationFn: (payload: FormState) =>
      apiFetch("/api/membership/apply", { method: "POST", body: JSON.stringify(payload) }),
    onSuccess: () => setSubmitted(true),
  });

  const update =
    <K extends keyof FormState>(k: K) =>
    (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement>) => {
      const value =
        e.target.type === "checkbox" ? (e.target as HTMLInputElement).checked : e.target.value;
      setForm((f) => ({ ...f, [k]: value as FormState[K] }));
    };

  if (submitted) {
    return (
      <div className="min-h-screen bg-muted/30 dark:bg-background">
        <Navbar />
        <main className="container mx-auto px-4 md:px-6 pt-32 pb-20 max-w-2xl">
          <div className="bg-card dark:bg-card rounded-xl border p-10 shadow-sm text-center">
            <CheckCircle2 className="w-16 h-16 text-green-600 mx-auto mb-4" />
            <h1 className="text-2xl font-bold mb-3">
              {isAr ? "تم استلام طلبك بنجاح" : "Your application was received"}
            </h1>
            <p className="text-muted-foreground mb-6">
              {isAr
                ? "سيراجع الفريق طلبك وسنتواصل معك قريباً."
                : "Our team will review your application and contact you shortly."}
            </p>
            <Button onClick={() => setLocation("/dashboard")} className="bg-primary text-white cursor-pointer">
              {isAr ? "العودة إلى لوحة التحكم" : "Back to dashboard"}
            </Button>
          </div>
        </main>
        <Footer />
      </div>
    );
  }

  const personal: Field[] = [
    { k: "fullName", ar: "الاسم الكامل (عربي)", en: "Full name (Arabic)", required: true },
    { k: "fullNameEn", ar: "الاسم الكامل (إنجليزي)", en: "Full name (English)", required: true },
    { k: "email", ar: "البريد الإلكتروني", en: "Email", required: true, type: "email" },
    { k: "confirmEmail", ar: "تأكيد البريد", en: "Confirm email", required: true, type: "email" },
    { k: "nationalId", ar: "رقم الهوية", en: "National ID", required: true },
    { k: "phone", ar: "رقم الجوال", en: "Mobile number", required: true, type: "tel" },
    { k: "dateOfBirth", ar: "تاريخ الميلاد", en: "Date of birth", type: "date" },
    { k: "placeOfBirth", ar: "مكان الولادة", en: "Place of birth" },
  ];
  const address: Field[] = [
    { k: "city", ar: "المدينة", en: "City" },
    { k: "homeAddress", ar: "العنوان", en: "Home address", full: true },
    { k: "motherProvince", ar: "محافظة الأم الأصلية", en: "Mother's home province" },
    { k: "country", ar: "الدولة", en: "Country" },
  ];
  const education: Field[] = [
    { k: "university", ar: "الجامعة", en: "University" },
    { k: "branch", ar: "الفرع", en: "Branch" },
    { k: "major", ar: "التخصص", en: "Major" },
    { k: "average", ar: "المعدل التراكمي", en: "GPA / Average" },
    { k: "graduationYear", ar: "سنة التخرج", en: "Graduation year" },
  ];
  const work: Field[] = [
    { k: "employer", ar: "جهة العمل", en: "Employer" },
    { k: "jobTitle", ar: "المسمى الوظيفي", en: "Job title" },
    { k: "yearsExperience", ar: "سنوات الخبرة", en: "Years of experience" },
  ];

  const renderField = (f: Field) => (
    <label key={f.k} className={`block ${f.full ? "md:col-span-2" : ""}`}>
      <span className="text-sm font-medium text-foreground">
        {isAr ? f.ar : f.en}
        {f.required && <span className="text-destructive ms-1">*</span>}
      </span>
      <input
        type={f.type ?? "text"}
        required={f.required}
        value={String(form[f.k] ?? "")}
        onChange={update(f.k)}
        className="mt-1 w-full rounded-md border border-border bg-card dark:bg-card px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/40"
      />
    </label>
  );

  const validateStep = (s: number): boolean => {
    if (s === 0) {
      if (form.email !== form.confirmEmail) {
        setEmailMismatch(true);
        return false;
      }
      setEmailMismatch(false);
      return Boolean(form.fullName && form.fullNameEn && form.email && form.nationalId && form.phone);
    }
    return true;
  };

  const canSubmit = form.declarationAccepted && !mutation.isPending;

  return (
    <div className="min-h-screen bg-muted/30 dark:bg-background">
      <Navbar />
      <main className="container mx-auto px-4 md:px-6 pt-32 pb-20 max-w-4xl">
        <motion.div initial={{ opacity: 0, y: 12 }} animate={{ opacity: 1, y: 0 }}>
          <h1 className="text-3xl md:text-4xl font-bold mb-2">
            {isAr ? "طلب عضوية" : "Membership application"}
          </h1>
          <p className="text-muted-foreground mb-6">
            {isAr
              ? "أكمل الخطوات الثلاث التالية لتقديم طلب العضوية."
              : "Complete the three steps below to submit your application."}
          </p>
        </motion.div>

        {/* Stepper */}
        <ol className="flex items-center mb-8" aria-label={isAr ? "خطوات النموذج" : "Form steps"}>
          {STEPS.map((s, i) => (
            <li key={i} className="flex-1 flex items-center">
              <div
                className={`flex items-center gap-2 text-sm font-semibold ${
                  i <= step ? "text-primary" : "text-muted-foreground"
                }`}
              >
                <span
                  className={`w-8 h-8 rounded-full flex items-center justify-center text-xs ${
                    i < step
                      ? "bg-primary text-white"
                      : i === step
                        ? "bg-accent text-primary"
                        : "bg-muted text-muted-foreground"
                  }`}
                >
                  {i + 1}
                </span>
                <span className="hidden sm:inline">{isAr ? s.ar : s.en}</span>
              </div>
              {i < STEPS.length - 1 && <div className={`flex-1 h-px mx-3 ${i < step ? "bg-primary" : "bg-border"}`} />}
            </li>
          ))}
        </ol>

        <form
          onSubmit={(e) => {
            e.preventDefault();
            if (step < STEPS.length - 1) {
              if (validateStep(step)) setStep((s) => s + 1);
              return;
            }
            if (form.email !== form.confirmEmail) {
              setEmailMismatch(true);
              setStep(0);
              return;
            }
            mutation.mutate(form);
          }}
          className="bg-card dark:bg-card rounded-xl border p-6 md:p-8 shadow-sm space-y-8"
        >
          {step === 0 && (
            <>
              <div>
                <h2 className="text-lg font-bold mb-4 border-b pb-2">
                  {isAr ? "البيانات الشخصية" : "Personal information"}
                </h2>
                <div className="grid grid-cols-1 md:grid-cols-2 gap-5">
                  {personal.map(renderField)}
                  <label className="block">
                    <span className="text-sm font-medium text-foreground">{isAr ? "الجنس" : "Gender"}</span>
                    <select
                      value={form.gender}
                      onChange={update("gender")}
                      className="mt-1 w-full rounded-md border border-border bg-card dark:bg-card px-3 py-2 text-sm"
                    >
                      <option value="">{isAr ? "اختر..." : "Select..."}</option>
                      <option value="male">{isAr ? "ذكر" : "Male"}</option>
                      <option value="female">{isAr ? "أنثى" : "Female"}</option>
                    </select>
                  </label>
                  <label className="block">
                    <span className="text-sm font-medium text-foreground">
                      {isAr ? "الحالة الاجتماعية" : "Social status"}
                    </span>
                    <select
                      value={form.socialStatus}
                      onChange={update("socialStatus")}
                      className="mt-1 w-full rounded-md border border-border bg-card dark:bg-card px-3 py-2 text-sm"
                    >
                      <option value="">{isAr ? "اختر..." : "Select..."}</option>
                      <option value="single">{isAr ? "أعزب" : "Single"}</option>
                      <option value="married">{isAr ? "متزوج" : "Married"}</option>
                      <option value="divorced">{isAr ? "مطلق" : "Divorced"}</option>
                      <option value="widowed">{isAr ? "أرمل" : "Widowed"}</option>
                    </select>
                  </label>
                </div>
              </div>
              <div>
                <h2 className="text-lg font-bold mb-4 border-b pb-2">
                  {isAr ? "العنوان" : "Address"}
                </h2>
                <div className="grid grid-cols-1 md:grid-cols-2 gap-5">
                  <label className="block">
                    <span className="text-sm font-medium text-foreground">
                      {isAr ? "محافظة الإقامة الحالية" : "Province of current residence"}
                    </span>
                    <select
                      value={form.provinceResidence}
                      onChange={update("provinceResidence")}
                      className="mt-1 w-full rounded-md border border-border bg-card dark:bg-card px-3 py-2 text-sm"
                    >
                      <option value="">{isAr ? "اختر..." : "Select..."}</option>
                      {PROVINCES.map((p) => (
                        <option key={p.value} value={p.value}>
                          {isAr ? p.ar : p.en}
                        </option>
                      ))}
                    </select>
                  </label>
                  {form.provinceResidence === "abroad" && (
                    <label className="block">
                      <span className="text-sm font-medium text-foreground">
                        {isAr ? "المحافظة في حال الإقامة خارج فلسطين" : "Governorate (if abroad)"}
                      </span>
                      <input
                        type="text"
                        value={form.governorateAbroad}
                        onChange={update("governorateAbroad")}
                        className="mt-1 w-full rounded-md border border-border bg-card dark:bg-card px-3 py-2 text-sm"
                      />
                    </label>
                  )}
                  {address.map(renderField)}
                </div>
              </div>
            </>
          )}

          {step === 1 && (
            <>
              <div>
                <h2 className="text-lg font-bold mb-4 border-b pb-2">
                  {isAr ? "المؤهلات العلمية" : "Education"}
                </h2>
                <div className="grid grid-cols-1 md:grid-cols-2 gap-5">{education.map(renderField)}</div>
              </div>
              <div>
                <h2 className="text-lg font-bold mb-4 border-b pb-2">
                  {isAr ? "بيانات العمل" : "Employment"}
                </h2>
                <div className="grid grid-cols-1 md:grid-cols-2 gap-5">{work.map(renderField)}</div>
              </div>
            </>
          )}

          {step === 2 && (
            <>
              <div>
                <h2 className="text-lg font-bold mb-4 border-b pb-2">
                  {isAr ? "العضوية" : "Membership"}
                </h2>
                <div className="grid grid-cols-1 gap-5">
                  <label className="block">
                    <span className="text-sm font-medium text-foreground">
                      {isAr ? "فئة العضوية" : "Membership tier"}
                    </span>
                    <select
                      value={form.membershipTier}
                      onChange={update("membershipTier")}
                      className="mt-1 w-full rounded-md border border-border bg-card dark:bg-card px-3 py-2 text-sm"
                    >
                      <option value="regular">{isAr ? "عضو عامل" : "Regular member"}</option>
                      <option value="associate">{isAr ? "عضو منتسب" : "Associate member"}</option>
                      <option value="student">{isAr ? "عضو طالب" : "Student member"}</option>
                      <option value="honorary">{isAr ? "عضو فخري" : "Honorary member"}</option>
                    </select>
                  </label>
                  <label className="block">
                    <span className="text-sm font-medium text-foreground">
                      {isAr ? "ملاحظات إضافية" : "Additional notes"}
                    </span>
                    <textarea
                      rows={4}
                      value={form.notes}
                      onChange={update("notes")}
                      className="mt-1 w-full rounded-md border border-border bg-card dark:bg-card px-3 py-2 text-sm"
                    />
                  </label>
                </div>
              </div>

              <div className="border-t pt-5">
                <p className="text-xs text-muted-foreground mb-3">
                  {isAr
                    ? "يجب إرفاق المستندات الرسمية لاحقاً (شهادات جامعية مصدّقة، إثبات الهوية، شهادة الثانوية العامة، شهادة عدم محكومية، إثبات العمل، وصل البنك). سنتواصل معك لتزويدنا بها."
                    : "Official documents will be requested after submission (attested university certificates, ID/passport, high school certificate, certificate of good conduct, work proof, and bank receipt). We will contact you to collect them."}
                </p>
                <label className="flex items-start gap-3 cursor-pointer">
                  <input
                    type="checkbox"
                    checked={form.declarationAccepted}
                    onChange={update("declarationAccepted")}
                    required
                    className="mt-1 h-4 w-4 cursor-pointer accent-primary"
                  />
                  <span className="text-sm text-foreground leading-relaxed">
                    {isAr
                      ? "أُقرّ بأن جميع المعلومات والشهادات الواردة في الطلب صحيحة، وفي حال ثبت خلاف ذلك يحق للنقابة سحب قرار قبولي عضواً، وأتحمّل المسؤولية القانونية المدنية والجزائية الناتجة عن ذلك."
                      : "I declare that all information and certificates in this application are correct. If proven otherwise, the Syndicate has the right to revoke my membership."}
                  </span>
                </label>
              </div>
            </>
          )}

          {emailMismatch && (
            <p className="text-sm text-destructive" role="alert">
              {isAr ? "البريد الإلكتروني وتأكيده غير متطابقين." : "Email and confirmation do not match."}
            </p>
          )}
          {mutation.isError && (
            <p className="text-sm text-destructive" role="alert">
              {isAr ? "حدث خطأ أثناء الإرسال. حاول مرة أخرى." : "Something went wrong. Please try again."}
            </p>
          )}

          <div className="flex flex-wrap gap-3 justify-between border-t pt-5">
            <Button
              type="button"
              variant="outline"
              disabled={step === 0}
              onClick={() => setStep((s) => Math.max(0, s - 1))}
              className="cursor-pointer disabled:cursor-not-allowed"
            >
              <ChevronRight className="w-4 h-4 me-1 rtl:hidden" />
              <ChevronLeft className="w-4 h-4 me-1 ltr:hidden" />
              {isAr ? "السابق" : "Previous"}
            </Button>
            {step < STEPS.length - 1 ? (
              <Button type="submit" className="bg-primary text-white hover:bg-primary/90 cursor-pointer">
                {isAr ? "التالي" : "Next"}
                <ChevronLeft className="w-4 h-4 ms-1 rtl:hidden" />
                <ChevronRight className="w-4 h-4 ms-1 ltr:hidden" />
              </Button>
            ) : (
              <Button
                type="submit"
                disabled={!canSubmit}
                className="bg-accent text-primary hover:bg-accent/90 font-semibold px-8 cursor-pointer disabled:cursor-not-allowed"
              >
                {mutation.isPending
                  ? isAr ? "جاري الإرسال..." : "Submitting..."
                  : isAr ? "إرسال الطلب" : "Submit application"}
              </Button>
            )}
          </div>
        </form>
      </main>
      <Footer />
    </div>
  );
}
