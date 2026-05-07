import { useState } from "react";
import { useMutation, useQuery } from "@tanstack/react-query";
import { Link, useRoute } from "wouter";
import { useUser } from "@clerk/react";
import { Layout } from "@/components/layout/Layout";
import { Button } from "@/components/ui/button";
import { useLanguage } from "@/lib/language-context";
import { apiFetch } from "@/lib/queryClient";
import { ArrowRight, Briefcase, MapPin, ExternalLink, CheckCircle2 } from "lucide-react";

interface JobRow {
  id: number;
  titleAr: string;
  titleEn: string | null;
  descriptionAr: string | null;
  descriptionEn: string | null;
  company: string;
  companyLogo: string | null;
  location: string | null;
  employmentType: string | null;
  category: string | null;
  applyUrl: string | null;
  contactEmail: string | null;
  createdAt: string;
}

interface MyApp {
  id: number;
  status: string;
}

export default function JobDetail() {
  const [, params] = useRoute("/jobs/:id");
  const id = params?.id;
  const { language } = useLanguage();
  const { isSignedIn, user } = useUser();
  const isAr = language === "ar";

  const { data: job, isLoading } = useQuery<JobRow>({
    queryKey: ["jobs", id],
    queryFn: () => apiFetch<JobRow>(`/api/jobs/${id}`),
    enabled: Boolean(id),
  });

  const { data: myApps = [] } = useQuery<MyApp[]>({
    queryKey: ["applications", "me"],
    queryFn: () => apiFetch<MyApp[]>("/api/membership/me"),
    enabled: Boolean(isSignedIn),
  });
  const isMember = myApps.some((a) => a.status === "approved");

  const [submitted, setSubmitted] = useState(false);
  const [form, setForm] = useState({
    fullName: "",
    email: "",
    phone: "",
    coverLetter: "",
    resumeUrl: "",
  });

  const apply = useMutation({
    mutationFn: () =>
      apiFetch(`/api/jobs/${id}/apply`, {
        method: "POST",
        body: JSON.stringify(form),
      }),
    onSuccess: () => setSubmitted(true),
  });

  return (
    <Layout>
      <article className="container mx-auto px-4 md:px-6 py-10 max-w-3xl">
        <Link
          href="/jobs"
          className="inline-flex items-center gap-2 text-sm text-primary hover:underline mb-6 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded"
        >
          <ArrowRight className="w-4 h-4 rtl:rotate-180" />
          {isAr ? "كل الوظائف" : "All jobs"}
        </Link>

        {isLoading && (
          <p className="text-muted-foreground">{isAr ? "جاري التحميل..." : "Loading..."}</p>
        )}

        {job && (
          <>
            <div className="flex items-start gap-4 mb-6">
              {job.companyLogo ? (
                <img
                  src={job.companyLogo}
                  alt={job.company}
                  className="w-16 h-16 rounded-md object-contain border bg-white shrink-0"
                />
              ) : (
                <div className="w-16 h-16 rounded-md bg-primary/10 text-primary flex items-center justify-center shrink-0">
                  <Briefcase className="w-7 h-7" />
                </div>
              )}
              <div>
                <h1 className="text-2xl md:text-3xl font-bold leading-tight">
                  {isAr ? job.titleAr : job.titleEn || job.titleAr}
                </h1>
                <p className="text-muted-foreground mt-1">{job.company}</p>
                <div className="flex flex-wrap gap-3 text-xs text-muted-foreground mt-3">
                  {job.location && (
                    <span className="inline-flex items-center gap-1">
                      <MapPin className="w-3.5 h-3.5" />
                      {job.location}
                    </span>
                  )}
                  {job.employmentType && (
                    <span className="px-2 py-0.5 rounded bg-muted text-foreground">
                      {job.employmentType}
                    </span>
                  )}
                  {job.category && (
                    <span className="px-2 py-0.5 rounded bg-secondary/10 text-secondary">
                      {job.category}
                    </span>
                  )}
                </div>
              </div>
            </div>

            <div className="prose prose-lg max-w-none whitespace-pre-wrap text-foreground mb-10">
              {isAr ? job.descriptionAr : job.descriptionEn || job.descriptionAr}
            </div>

            <div className="border-t pt-8">
              <h2 className="text-xl font-bold mb-4">{isAr ? "تقديم الطلب" : "Apply"}</h2>

              {!isSignedIn && (
                <div className="rounded-lg bg-muted/40 border p-4">
                  <p className="text-sm mb-3">
                    {isAr
                      ? "يجب تسجيل الدخول كعضو في النقابة لتتمكن من التقديم."
                      : "You must sign in as a syndicate member to apply."}
                  </p>
                  <Link href="/sign-in">
                    <Button size="sm" className="bg-primary text-white">
                      {isAr ? "تسجيل الدخول" : "Sign in"}
                    </Button>
                  </Link>
                </div>
              )}

              {isSignedIn && !isMember && (
                <div className="rounded-lg bg-muted/40 border p-4">
                  <p className="text-sm mb-3">
                    {isAr
                      ? "التقديم على الوظائف متاح فقط للأعضاء المعتمدين في النقابة."
                      : "Applications are open only to approved syndicate members."}
                  </p>
                  <Link href="/membership/apply">
                    <Button size="sm" className="bg-primary text-white">
                      {isAr ? "تقديم طلب عضوية" : "Apply for membership"}
                    </Button>
                  </Link>
                  {job.applyUrl && (
                    <a
                      href={job.applyUrl}
                      target="_blank"
                      rel="noreferrer"
                      className="ms-3 text-sm text-primary inline-flex items-center gap-1 hover:underline"
                    >
                      {isAr ? "أو الموقع الخارجي" : "Or external site"} <ExternalLink className="w-3.5 h-3.5" />
                    </a>
                  )}
                </div>
              )}

              {isSignedIn && isMember && submitted && (
                <div className="rounded-lg border border-green-200 bg-green-50 p-5 text-center">
                  <CheckCircle2 className="w-8 h-8 mx-auto text-green-600 mb-2" />
                  <p className="font-semibold">
                    {isAr ? "تم إرسال طلبك" : "Application submitted"}
                  </p>
                  <p className="text-sm text-muted-foreground mt-1">
                    {isAr ? "سيتم التواصل معك من قِبَل صاحب العمل." : "The employer will contact you."}
                  </p>
                </div>
              )}

              {isSignedIn && isMember && !submitted && (
                <form
                  className="space-y-4"
                  onSubmit={(e) => {
                    e.preventDefault();
                    apply.mutate();
                  }}
                >
                  <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label className="block">
                      <span className="text-sm font-medium">
                        {isAr ? "الاسم الكامل" : "Full name"}
                      </span>
                      <input
                        required
                        value={form.fullName || `${user?.firstName ?? ""} ${user?.lastName ?? ""}`.trim()}
                        onChange={(e) => setForm({ ...form, fullName: e.target.value })}
                        className="mt-1 w-full rounded-md border bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/40"
                      />
                    </label>
                    <label className="block">
                      <span className="text-sm font-medium">{isAr ? "البريد" : "Email"}</span>
                      <input
                        required
                        type="email"
                        value={form.email || (user?.primaryEmailAddress?.emailAddress ?? "")}
                        onChange={(e) => setForm({ ...form, email: e.target.value })}
                        className="mt-1 w-full rounded-md border bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/40"
                      />
                    </label>
                    <label className="block">
                      <span className="text-sm font-medium">{isAr ? "الهاتف" : "Phone"}</span>
                      <input
                        value={form.phone}
                        onChange={(e) => setForm({ ...form, phone: e.target.value })}
                        className="mt-1 w-full rounded-md border bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/40"
                      />
                    </label>
                    <label className="block">
                      <span className="text-sm font-medium">{isAr ? "رابط السيرة الذاتية" : "Resume URL"}</span>
                      <input
                        value={form.resumeUrl}
                        onChange={(e) => setForm({ ...form, resumeUrl: e.target.value })}
                        className="mt-1 w-full rounded-md border bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/40"
                      />
                    </label>
                  </div>
                  <label className="block">
                    <span className="text-sm font-medium">{isAr ? "خطاب التعريف" : "Cover letter"}</span>
                    <textarea
                      rows={5}
                      value={form.coverLetter}
                      onChange={(e) => setForm({ ...form, coverLetter: e.target.value })}
                      className="mt-1 w-full rounded-md border bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/40"
                    />
                  </label>
                  {apply.isError && (
                    <p className="text-sm text-destructive">
                      {isAr ? "تعذّر إرسال الطلب." : "Could not submit your application."}
                    </p>
                  )}
                  <Button
                    type="submit"
                    disabled={apply.isPending}
                    className="bg-accent text-primary hover:bg-accent/90 font-semibold"
                  >
                    {apply.isPending
                      ? isAr
                        ? "جاري الإرسال..."
                        : "Submitting..."
                      : isAr
                        ? "إرسال الطلب"
                        : "Submit application"}
                  </Button>
                </form>
              )}
            </div>
          </>
        )}
      </article>
    </Layout>
  );
}
