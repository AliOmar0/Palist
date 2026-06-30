import { useState } from "react";
import { useMutation, useQuery } from "@tanstack/react-query";
import { Link, useRoute } from "wouter";
import { Layout } from "@/components/layout/Layout";
import { useLanguage } from "@/lib/language-context";
import { apiFetch } from "@/lib/queryClient";
import { ArrowRight, Calendar, MapPin } from "lucide-react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";

interface EventRow {
  id: number;
  titleAr: string;
  titleEn: string | null;
  descriptionAr: string | null;
  descriptionEn: string | null;
  coverImage: string | null;
  location: string | null;
  startsAt: string;
  endsAt: string | null;
  audience: string;
}

export default function EventDetail() {
  const [, params] = useRoute("/events/:id");
  const id = params?.id;
  const { language } = useLanguage();
  const isAr = language === "ar";
  const [registration, setRegistration] = useState({
    fullName: "",
    email: "",
    phone: "",
  });

  const { data, isLoading, isError } = useQuery<EventRow>({
    queryKey: ["events", id],
    queryFn: () => apiFetch<EventRow>(`/api/events/${id}`),
    enabled: Boolean(id),
  });
  const register = useMutation({
    mutationFn: () =>
      apiFetch(`/api/events/${id}/register`, {
        method: "POST",
        body: JSON.stringify({ ...registration, attendeeType: "visitor" }),
      }),
  });

  return (
    <Layout>
      <article className="container mx-auto px-4 md:px-6 py-12 max-w-3xl">
        <Link
          href="/events"
          className="inline-flex items-center gap-2 text-sm text-primary hover:underline mb-6 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded"
        >
          <ArrowRight className="w-4 h-4 rtl:rotate-180" />
          {isAr ? "العودة إلى الفعاليات" : "Back to events"}
        </Link>

        {isLoading && (
          <p className="text-muted-foreground">{isAr ? "جاري التحميل..." : "Loading..."}</p>
        )}
        {isError && (
          <p className="text-destructive">
            {isAr ? "تعذّر تحميل هذه الفعالية." : "Could not load this event."}
          </p>
        )}

        {data && (
          <>
            <h1 className="text-3xl md:text-4xl font-bold mb-4 leading-tight">
              {isAr ? data.titleAr : data.titleEn || data.titleAr}
            </h1>
            <div className="flex flex-wrap items-center gap-4 text-sm text-muted-foreground mb-6">
              <span className="inline-flex items-center gap-2">
                <Calendar className="w-4 h-4" />
                {new Date(data.startsAt).toLocaleString(isAr ? "ar" : "en", {
                  dateStyle: "long",
                  timeStyle: "short",
                })}
              </span>
              {data.location && (
                <span className="inline-flex items-center gap-2">
                  <MapPin className="w-4 h-4" />
                  {data.location}
                </span>
              )}
            </div>
            {data.coverImage && (
              <img
                src={data.coverImage}
                alt={isAr ? data.titleAr : data.titleEn || data.titleAr}
                className="w-full h-auto rounded-xl border mb-8 object-cover max-h-[420px]"
              />
            )}
            <div className="prose prose-lg max-w-none whitespace-pre-wrap leading-relaxed text-foreground">
              {isAr
                ? data.descriptionAr
                : data.descriptionEn || data.descriptionAr}
            </div>
            <section className="mt-10 rounded-lg border bg-card p-6">
              <div className="mb-5">
                <p className="text-xs font-bold uppercase tracking-widest text-secondary">
                  {audienceText(data.audience, isAr)}
                </p>
                <h2 className="mt-1 text-xl font-bold">
                  {isAr ? "التسجيل في الفعالية" : "Register for this event"}
                </h2>
                <p className="mt-1 text-sm text-muted-foreground">
                  {isAr
                    ? "يمكن التسجيل كزائر حتى لو لم يكن لديك حساب عضو."
                    : "Visitors can register even without a member account."}
                </p>
              </div>
              {register.isSuccess ? (
                <div className="rounded-md border border-green-200 bg-green-50 p-4 text-sm text-green-800">
                  {isAr ? "تم تسجيلك في الفعالية بنجاح." : "You have been registered for the event."}
                </div>
              ) : (
                <form
                  onSubmit={(e) => {
                    e.preventDefault();
                    register.mutate();
                  }}
                  className="grid grid-cols-1 gap-4 md:grid-cols-2"
                >
                  <label className="space-y-2">
                    <span className="text-sm font-medium">{isAr ? "الاسم الكامل" : "Full name"}</span>
                    <Input
                      required
                      value={registration.fullName}
                      onChange={(e) => setRegistration((r) => ({ ...r, fullName: e.target.value }))}
                    />
                  </label>
                  <label className="space-y-2">
                    <span className="text-sm font-medium">{isAr ? "البريد الإلكتروني" : "Email"}</span>
                    <Input
                      required
                      type="email"
                      dir="ltr"
                      value={registration.email}
                      onChange={(e) => setRegistration((r) => ({ ...r, email: e.target.value }))}
                    />
                  </label>
                  <label className="space-y-2 md:col-span-2">
                    <span className="text-sm font-medium">{isAr ? "رقم الجوال" : "Mobile number"}</span>
                    <Input
                      dir="ltr"
                      value={registration.phone}
                      onChange={(e) => setRegistration((r) => ({ ...r, phone: e.target.value }))}
                    />
                  </label>
                  {register.isError && (
                    <p className="md:col-span-2 text-sm text-destructive">
                      {isAr ? "تعذّر إرسال التسجيل. حاول مرة أخرى." : "Could not submit registration. Please try again."}
                    </p>
                  )}
                  <div className="md:col-span-2">
                    <Button
                      type="submit"
                      disabled={register.isPending}
                      className="bg-accent text-primary hover:bg-accent/90 font-semibold"
                    >
                      {register.isPending
                        ? isAr ? "جاري التسجيل..." : "Registering..."
                        : isAr ? "تسجيل كزائر" : "Register as visitor"}
                    </Button>
                  </div>
                </form>
              )}
            </section>
          </>
        )}
      </article>
    </Layout>
  );
}

function audienceText(audience: string, isAr: boolean): string {
  if (audience === "members") return isAr ? "للأعضاء فقط" : "Members only";
  if (audience === "visitors") return isAr ? "لغير الأعضاء / الزوار" : "Visitors / non-members";
  return isAr ? "للأعضاء والزوار" : "Members and visitors";
}
