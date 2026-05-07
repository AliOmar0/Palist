import { useState } from "react";
import { useQuery, useMutation, useQueryClient } from "@tanstack/react-query";
import { motion } from "framer-motion";
import { Button } from "@/components/ui/button";
import { useLanguage } from "@/lib/language-context";
import { apiFetch } from "@/lib/queryClient";
import { Navbar } from "@/components/layout/Navbar";
import { Footer } from "@/components/layout/Footer";
import { ImageUpload } from "@/components/ImageUpload";
import { useUser } from "@clerk/react";
import {
  FileText,
  Calendar,
  GraduationCap,
  BookOpen,
  Mail,
  Users,
  Plus,
  Trash2,
  Briefcase,
  Send,
  Activity,
} from "lucide-react";

type Tab =
  | "overview"
  | "news"
  | "events"
  | "trainings"
  | "publications"
  | "jobs"
  | "applications"
  | "contact"
  | "newsletter"
  | "audit";

interface NewsRow { id: number; titleAr: string; titleEn: string | null; publishedAt: string; }
interface EventRow { id: number; titleAr: string; startsAt: string; location: string | null; }
interface TrainingRow { id: number; titleAr: string; category: string | null; }
interface PublicationRow { id: number; titleAr: string; publishedAt: string; }
interface ApplicationRow { id: number; fullName: string; email: string; status: string; createdAt: string; membershipTier: string | null; }
interface ContactRow { id: number; name: string; email: string; subject: string | null; message: string; read: boolean; createdAt: string; }

export default function AdminPage() {
  const { language } = useLanguage();
  const { user } = useUser();
  const isAr = language === "ar";
  const [tab, setTab] = useState<Tab>("overview");

  const tabs: Array<{ k: Tab; ar: string; en: string; icon: typeof FileText }> = [
    { k: "overview", ar: "نظرة عامة", en: "Overview", icon: Users },
    { k: "news", ar: "الأخبار", en: "News", icon: FileText },
    { k: "events", ar: "الفعاليات", en: "Events", icon: Calendar },
    { k: "trainings", ar: "التدريب", en: "Trainings", icon: GraduationCap },
    { k: "publications", ar: "التقارير", en: "Publications", icon: BookOpen },
    { k: "jobs", ar: "الوظائف", en: "Jobs", icon: Briefcase },
    { k: "applications", ar: "طلبات العضوية", en: "Applications", icon: Users },
    { k: "contact", ar: "رسائل التواصل", en: "Contact", icon: Mail },
    { k: "newsletter", ar: "النشرة البريدية", en: "Newsletter", icon: Send },
    { k: "audit", ar: "سجل التدقيق", en: "Audit log", icon: Activity },
  ];

  return (
    <div className="min-h-screen bg-muted/30">
      <Navbar />
      <main className="container mx-auto px-4 md:px-6 pt-32 pb-20">
        <motion.div initial={{ opacity: 0, y: 12 }} animate={{ opacity: 1, y: 0 }} className="mb-8">
          <p className="text-xs font-bold text-secondary uppercase tracking-widest mb-2">
            {isAr ? "لوحة الإدارة" : "Admin Dashboard"}
          </p>
          <h1 className="text-3xl md:text-4xl font-bold">
            {isAr ? "إدارة محتوى الموقع" : "Manage Site Content"}
          </h1>
          <p className="text-muted-foreground mt-2">
            {isAr ? `مرحباً ${user?.firstName ?? ""}` : `Signed in as ${user?.primaryEmailAddress?.emailAddress}`}
          </p>
        </motion.div>

        <div className="grid grid-cols-1 lg:grid-cols-[240px_1fr] gap-6">
          <aside className="bg-card rounded-xl border p-3 shadow-sm h-fit lg:sticky lg:top-28">
            <nav className="flex lg:flex-col gap-1 overflow-x-auto">
              {tabs.map((t) => {
                const Icon = t.icon;
                return (
                  <button
                    key={t.k}
                    onClick={() => setTab(t.k)}
                    className={`flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium transition-colors whitespace-nowrap ${
                      tab === t.k
                        ? "bg-primary/10 text-primary"
                        : "text-muted-foreground hover:bg-muted hover:text-foreground"
                    }`}
                  >
                    <Icon className="w-4 h-4" />
                    {isAr ? t.ar : t.en}
                  </button>
                );
              })}
            </nav>
          </aside>

          <section className="bg-card rounded-xl border p-6 shadow-sm min-h-[400px]">
            {tab === "overview" && <Overview isAr={isAr} />}
            {tab === "news" && <NewsManager isAr={isAr} />}
            {tab === "events" && <EventsManager isAr={isAr} />}
            {tab === "trainings" && <TrainingsManager isAr={isAr} />}
            {tab === "publications" && <PublicationsManager isAr={isAr} />}
            {tab === "jobs" && <JobsManager isAr={isAr} />}
            {tab === "applications" && <ApplicationsManager isAr={isAr} />}
            {tab === "contact" && <ContactManager isAr={isAr} />}
            {tab === "newsletter" && <NewsletterManager isAr={isAr} />}
            {tab === "audit" && <AuditLogView isAr={isAr} />}
          </section>
        </div>
      </main>
      <Footer />
    </div>
  );
}

function Overview({ isAr }: { isAr: boolean }) {
  const news = useQuery<NewsRow[]>({ queryKey: ["news"], queryFn: () => apiFetch("/api/news") });
  const events = useQuery<EventRow[]>({ queryKey: ["events"], queryFn: () => apiFetch("/api/events") });
  const apps = useQuery<ApplicationRow[]>({ queryKey: ["admin", "applications"], queryFn: () => apiFetch("/api/admin/applications") });
  const contact = useQuery<ContactRow[]>({ queryKey: ["admin", "contact"], queryFn: () => apiFetch("/api/admin/contact") });

  const stats = [
    { label: isAr ? "أخبار" : "News", value: news.data?.length ?? 0 },
    { label: isAr ? "فعاليات" : "Events", value: events.data?.length ?? 0 },
    { label: isAr ? "طلبات قيد المراجعة" : "Pending applications", value: apps.data?.filter((a) => a.status === "pending").length ?? 0 },
    { label: isAr ? "رسائل غير مقروءة" : "Unread messages", value: contact.data?.filter((c) => !c.read).length ?? 0 },
  ];

  return (
    <div>
      <h2 className="text-xl font-bold mb-6">{isAr ? "نظرة عامة" : "Overview"}</h2>
      <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
        {stats.map((s) => (
          <div key={s.label} className="rounded-lg border p-5 bg-muted/40">
            <p className="text-3xl font-bold text-primary">{s.value}</p>
            <p className="text-sm text-muted-foreground mt-1">{s.label}</p>
          </div>
        ))}
      </div>
    </div>
  );
}

type Row = { id: number; [k: string]: unknown };
function GenericManager({
  isAr,
  title,
  listKey,
  listUrl,
  adminUrl,
  columns,
  fields,
  defaults,
}: {
  isAr: boolean;
  title: string;
  listKey: string[];
  listUrl: string;
  adminUrl: string;
  columns: Array<{ key: string; label: string }>;
  fields: Array<{ key: string; label: string; type?: string; required?: boolean }>;
  defaults: Record<string, unknown>;
}) {
  const qc = useQueryClient();
  const [showForm, setShowForm] = useState(false);
  const [form, setForm] = useState<Record<string, unknown>>(defaults);
  const list = useQuery<Row[]>({ queryKey: listKey, queryFn: () => apiFetch<Row[]>(listUrl) });

  const create = useMutation({
    mutationFn: (payload: Record<string, unknown>) =>
      apiFetch(adminUrl, { method: "POST", body: JSON.stringify(payload) }),
    onSuccess: () => {
      qc.invalidateQueries({ queryKey: listKey });
      setShowForm(false);
      setForm(defaults);
    },
  });

  const remove = useMutation({
    mutationFn: (id: number) => apiFetch(`${adminUrl}/${id}`, { method: "DELETE" }),
    onSuccess: () => qc.invalidateQueries({ queryKey: listKey }),
  });

  return (
    <div>
      <div className="flex items-center justify-between mb-6">
        <h2 className="text-xl font-bold">{title}</h2>
        <Button
          onClick={() => setShowForm((s) => !s)}
          className="bg-primary text-white hover:bg-primary/90"
          size="sm"
        >
          <Plus className="w-4 h-4 me-1" />
          {showForm ? (isAr ? "إلغاء" : "Cancel") : isAr ? "إضافة" : "Add new"}
        </Button>
      </div>

      {showForm && (
        <form
          onSubmit={(e) => {
            e.preventDefault();
            const payload: Record<string, unknown> = { ...form };
            for (const f of fields) {
              if (f.type === "datetime-local" && payload[f.key]) {
                payload[f.key] = new Date(String(payload[f.key])).toISOString();
              }
              if (f.type === "number" && payload[f.key] !== "" && payload[f.key] != null) {
                payload[f.key] = Number(payload[f.key]);
              }
            }
            create.mutate(payload);
          }}
          className="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 mb-6 border border-dashed rounded-lg bg-muted/40"
        >
          {fields.map((f) => {
            if (f.type === "image") {
              return (
                <div key={f.key} className="md:col-span-2">
                  <ImageUpload
                    label={f.label}
                    value={String(form[f.key] ?? "") || null}
                    onChange={(url) => setForm({ ...form, [f.key]: url })}
                  />
                </div>
              );
            }
            return (
              <label key={f.key} className={f.type === "textarea" ? "md:col-span-2" : ""}>
                <span className="text-xs font-medium text-foreground">{f.label}</span>
                {f.type === "textarea" ? (
                  <textarea
                    rows={4}
                    required={f.required}
                    value={String(form[f.key] ?? "")}
                    onChange={(e) => setForm({ ...form, [f.key]: e.target.value })}
                    className="mt-1 w-full rounded-md border bg-card px-3 py-2 text-sm"
                  />
                ) : (
                  <input
                    type={f.type ?? "text"}
                    required={f.required}
                    value={String(form[f.key] ?? "")}
                    onChange={(e) => setForm({ ...form, [f.key]: e.target.value })}
                    className="mt-1 w-full rounded-md border bg-card px-3 py-2 text-sm"
                  />
                )}
              </label>
            );
          })}
          <div className="md:col-span-2">
            <Button
              type="submit"
              disabled={create.isPending}
              className="bg-accent text-primary hover:bg-accent/90 font-semibold"
            >
              {create.isPending ? (isAr ? "جاري الحفظ..." : "Saving...") : isAr ? "حفظ" : "Save"}
            </Button>
          </div>
        </form>
      )}

      <div className="overflow-x-auto">
        <table className="w-full text-sm">
          <thead>
            <tr className="text-left text-muted-foreground border-b">
              {columns.map((c) => (
                <th key={String(c.key)} className="py-2">{c.label}</th>
              ))}
              <th />
            </tr>
          </thead>
          <tbody>
            {list.data?.map((row) => (
              <tr key={row.id} className="border-b last:border-0 hover:bg-muted">
                {columns.map((c) => (
                  <td key={String(c.key)} className="py-2 pe-3">
                    {String(row[c.key] ?? "—")}
                  </td>
                ))}
                <td className="py-2 text-end">
                  <button
                    onClick={() => {
                      if (confirm(isAr ? "حذف هذا العنصر؟" : "Delete this item?")) {
                        remove.mutate(row.id);
                      }
                    }}
                    className="text-destructive hover:text-destructive/80"
                  >
                    <Trash2 className="w-4 h-4" />
                  </button>
                </td>
              </tr>
            ))}
            {list.data?.length === 0 && (
              <tr>
                <td colSpan={columns.length + 1} className="py-8 text-center text-muted-foreground">
                  {isAr ? "لا توجد عناصر بعد" : "No items yet"}
                </td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
}

function NewsManager({ isAr }: { isAr: boolean }) {
  return (
    <GenericManager
      isAr={isAr}
      title={isAr ? "إدارة الأخبار" : "Manage News"}
      listKey={["news"]}
      listUrl="/api/news"
      adminUrl="/api/admin/news"
      columns={[
        { key: "id", label: "ID" },
        { key: "titleAr", label: isAr ? "العنوان (عربي)" : "Title (AR)" },
        { key: "titleEn", label: isAr ? "العنوان (إنجليزي)" : "Title (EN)" },
      ]}
      fields={[
        { key: "titleAr", label: isAr ? "العنوان بالعربية" : "Title (Arabic)", required: true },
        { key: "titleEn", label: isAr ? "العنوان بالإنجليزية" : "Title (English)" },
        { key: "category", label: isAr ? "التصنيف" : "Category" },
        { key: "coverImage", label: isAr ? "صورة الغلاف" : "Cover image", type: "image" },
        { key: "summaryAr", label: isAr ? "ملخص (عربي)" : "Summary (AR)", type: "textarea" },
        { key: "summaryEn", label: isAr ? "ملخص (إنجليزي)" : "Summary (EN)", type: "textarea" },
        { key: "contentAr", label: isAr ? "المحتوى (عربي)" : "Content (AR)", type: "textarea" },
        { key: "contentEn", label: isAr ? "المحتوى (إنجليزي)" : "Content (EN)", type: "textarea" },
      ]}
      defaults={{ titleAr: "", titleEn: "", category: "", coverImage: "", summaryAr: "", summaryEn: "", contentAr: "", contentEn: "" }}
    />
  );
}

function EventsManager({ isAr }: { isAr: boolean }) {
  return (
    <GenericManager
      isAr={isAr}
      title={isAr ? "إدارة الفعاليات" : "Manage Events"}
      listKey={["events"]}
      listUrl="/api/events"
      adminUrl="/api/admin/events"
      columns={[
        { key: "id", label: "ID" },
        { key: "titleAr", label: isAr ? "العنوان" : "Title" },
        { key: "location", label: isAr ? "الموقع" : "Location" },
        { key: "startsAt", label: isAr ? "البداية" : "Starts" },
      ]}
      fields={[
        { key: "titleAr", label: isAr ? "العنوان بالعربية" : "Title (Arabic)", required: true },
        { key: "titleEn", label: isAr ? "العنوان بالإنجليزية" : "Title (English)" },
        { key: "location", label: isAr ? "الموقع" : "Location" },
        { key: "startsAt", label: isAr ? "تاريخ البداية" : "Starts at", type: "datetime-local", required: true },
        { key: "endsAt", label: isAr ? "تاريخ النهاية" : "Ends at", type: "datetime-local" },
        { key: "coverImage", label: isAr ? "صورة الغلاف" : "Cover image", type: "image" },
        { key: "descriptionAr", label: isAr ? "الوصف (عربي)" : "Description (AR)", type: "textarea" },
        { key: "descriptionEn", label: isAr ? "الوصف (إنجليزي)" : "Description (EN)", type: "textarea" },
      ]}
      defaults={{ titleAr: "", titleEn: "", location: "", startsAt: "", endsAt: "", coverImage: "", descriptionAr: "", descriptionEn: "" }}
    />
  );
}

function TrainingsManager({ isAr }: { isAr: boolean }) {
  return (
    <GenericManager
      isAr={isAr}
      title={isAr ? "إدارة التدريب" : "Manage Trainings"}
      listKey={["trainings"]}
      listUrl="/api/trainings"
      adminUrl="/api/admin/trainings"
      columns={[
        { key: "id", label: "ID" },
        { key: "titleAr", label: isAr ? "العنوان" : "Title" },
        { key: "category", label: isAr ? "التصنيف" : "Category" },
      ]}
      fields={[
        { key: "titleAr", label: isAr ? "العنوان بالعربية" : "Title (Arabic)", required: true },
        { key: "titleEn", label: isAr ? "العنوان بالإنجليزية" : "Title (English)" },
        { key: "category", label: isAr ? "التصنيف" : "Category" },
        { key: "durationHours", label: isAr ? "المدة (ساعات)" : "Duration (hours)", type: "number" },
        { key: "startsAt", label: isAr ? "تاريخ البداية" : "Starts at", type: "datetime-local" },
        { key: "registrationUrl", label: isAr ? "رابط التسجيل" : "Registration URL" },
        { key: "coverImage", label: isAr ? "صورة الغلاف" : "Cover image", type: "image" },
        { key: "descriptionAr", label: isAr ? "الوصف (عربي)" : "Description (AR)", type: "textarea" },
        { key: "descriptionEn", label: isAr ? "الوصف (إنجليزي)" : "Description (EN)", type: "textarea" },
      ]}
      defaults={{ titleAr: "", titleEn: "", category: "", durationHours: "", startsAt: "", registrationUrl: "", coverImage: "", descriptionAr: "", descriptionEn: "" }}
    />
  );
}

function PublicationsManager({ isAr }: { isAr: boolean }) {
  return (
    <GenericManager
      isAr={isAr}
      title={isAr ? "إدارة التقارير" : "Manage Publications"}
      listKey={["publications"]}
      listUrl="/api/publications"
      adminUrl="/api/admin/publications"
      columns={[
        { key: "id", label: "ID" },
        { key: "titleAr", label: isAr ? "العنوان" : "Title" },
        { key: "publishedAt", label: isAr ? "تاريخ النشر" : "Published" },
      ]}
      fields={[
        { key: "titleAr", label: isAr ? "العنوان بالعربية" : "Title (Arabic)", required: true },
        { key: "titleEn", label: isAr ? "العنوان بالإنجليزية" : "Title (English)" },
        { key: "category", label: isAr ? "التصنيف" : "Category" },
        { key: "fileUrl", label: isAr ? "ملف PDF (رابط أو تحميل)" : "File (URL or upload)", type: "image" },
        { key: "coverImage", label: isAr ? "صورة الغلاف" : "Cover image", type: "image" },
        { key: "summaryAr", label: isAr ? "ملخص (عربي)" : "Summary (AR)", type: "textarea" },
        { key: "summaryEn", label: isAr ? "ملخص (إنجليزي)" : "Summary (EN)", type: "textarea" },
      ]}
      defaults={{ titleAr: "", titleEn: "", category: "", fileUrl: "", coverImage: "", summaryAr: "", summaryEn: "" }}
    />
  );
}

function JobsManager({ isAr }: { isAr: boolean }) {
  return (
    <GenericManager
      isAr={isAr}
      title={isAr ? "إدارة الوظائف" : "Manage Jobs"}
      listKey={["jobs"]}
      listUrl="/api/jobs"
      adminUrl="/api/admin/jobs"
      columns={[
        { key: "id", label: "ID" },
        { key: "titleAr", label: isAr ? "العنوان" : "Title" },
        { key: "company", label: isAr ? "الشركة" : "Company" },
        { key: "location", label: isAr ? "الموقع" : "Location" },
      ]}
      fields={[
        { key: "titleAr", label: isAr ? "المسمى (عربي)" : "Title (AR)", required: true },
        { key: "titleEn", label: isAr ? "المسمى (إنجليزي)" : "Title (EN)" },
        { key: "company", label: isAr ? "الشركة" : "Company", required: true },
        { key: "companyLogo", label: isAr ? "شعار الشركة" : "Company logo", type: "image" },
        { key: "location", label: isAr ? "الموقع" : "Location" },
        { key: "employmentType", label: isAr ? "نوع التعاقد" : "Employment type" },
        { key: "category", label: isAr ? "التصنيف" : "Category" },
        { key: "applyUrl", label: isAr ? "رابط التقديم الخارجي" : "External apply URL" },
        { key: "contactEmail", label: isAr ? "بريد التواصل" : "Contact email" },
        { key: "expiresAt", label: isAr ? "تاريخ الانتهاء" : "Expires at", type: "datetime-local" },
        { key: "descriptionAr", label: isAr ? "الوصف (عربي)" : "Description (AR)", type: "textarea" },
        { key: "descriptionEn", label: isAr ? "الوصف (إنجليزي)" : "Description (EN)", type: "textarea" },
      ]}
      defaults={{
        titleAr: "", titleEn: "", company: "", companyLogo: "",
        location: "", employmentType: "full_time", category: "",
        applyUrl: "", contactEmail: "", expiresAt: "",
        descriptionAr: "", descriptionEn: "",
      }}
    />
  );
}

interface NewsletterRow { id: number; email: string; lang: string; createdAt: string; }
function NewsletterManager({ isAr }: { isAr: boolean }) {
  const list = useQuery<NewsletterRow[]>({
    queryKey: ["admin", "newsletter"],
    queryFn: () => apiFetch("/api/admin/newsletter"),
  });
  const csv = (list.data ?? []).map((r) => `${r.email},${r.lang}`).join("\n");
  const compose = () => {
    const emails = (list.data ?? []).map((r) => r.email).join(",");
    window.location.href = `mailto:?bcc=${encodeURIComponent(emails)}&subject=${encodeURIComponent(isAr ? "نشرة نقابة تكنولوجيا المعلومات" : "Palist Newsletter")}`;
  };
  return (
    <div>
      <div className="flex items-center justify-between mb-6 flex-wrap gap-3">
        <h2 className="text-xl font-bold">{isAr ? "مشتركو النشرة البريدية" : "Newsletter subscribers"}</h2>
        <div className="flex gap-2">
          <Button size="sm" variant="outline" onClick={() => navigator.clipboard.writeText(csv)}>
            {isAr ? "نسخ كـ CSV" : "Copy CSV"}
          </Button>
          <Button size="sm" className="bg-primary text-white" onClick={compose} disabled={!list.data?.length}>
            <Send className="w-4 h-4 me-2" />
            {isAr ? "إنشاء نشرة" : "Compose digest"}
          </Button>
        </div>
      </div>
      <p className="text-sm text-muted-foreground mb-4">
        {isAr ? `إجمالي ${list.data?.length ?? 0} مشترك` : `${list.data?.length ?? 0} subscribers total`}
      </p>
      <div className="overflow-x-auto">
        <table className="w-full text-sm">
          <thead>
            <tr className="text-left text-muted-foreground border-b">
              <th className="py-2">{isAr ? "البريد" : "Email"}</th>
              <th className="py-2">{isAr ? "اللغة" : "Lang"}</th>
              <th className="py-2">{isAr ? "تاريخ الاشتراك" : "Subscribed"}</th>
            </tr>
          </thead>
          <tbody>
            {list.data?.map((r) => (
              <tr key={r.id} className="border-b last:border-0">
                <td className="py-2">{r.email}</td>
                <td className="py-2 uppercase text-xs">{r.lang}</td>
                <td className="py-2 text-muted-foreground">
                  {new Date(r.createdAt).toLocaleDateString(isAr ? "ar" : "en")}
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </div>
  );
}

interface AuditRow {
  id: number;
  actorUserId: string;
  action: string;
  entityType: string;
  entityId: string | null;
  payload: unknown;
  createdAt: string;
}
function AuditLogView({ isAr }: { isAr: boolean }) {
  const list = useQuery<AuditRow[]>({
    queryKey: ["admin", "audit"],
    queryFn: () => apiFetch("/api/admin/audit"),
  });
  return (
    <div>
      <h2 className="text-xl font-bold mb-6">{isAr ? "سجل تدقيق الإدارة" : "Admin audit log"}</h2>
      <div className="space-y-2">
        {list.data?.map((r) => (
          <div key={r.id} className="border rounded-lg p-3 text-sm flex flex-wrap items-center gap-3">
            <span className="font-mono text-xs text-muted-foreground">
              {new Date(r.createdAt).toLocaleString(isAr ? "ar" : "en")}
            </span>
            <span className="px-2 py-0.5 rounded bg-primary/10 text-primary text-xs font-semibold uppercase">
              {r.action}
            </span>
            <span className="text-foreground font-medium">{r.entityType}</span>
            {r.entityId && <span className="text-muted-foreground">#{r.entityId}</span>}
            <span className="text-xs text-muted-foreground ms-auto truncate max-w-[200px]" title={r.actorUserId}>
              {r.actorUserId.slice(0, 12)}…
            </span>
          </div>
        ))}
        {list.data?.length === 0 && (
          <p className="text-muted-foreground text-center py-8">
            {isAr ? "لا توجد سجلات بعد." : "No audit entries yet."}
          </p>
        )}
      </div>
    </div>
  );
}

function ApplicationsManager({ isAr }: { isAr: boolean }) {
  const qc = useQueryClient();
  const list = useQuery<ApplicationRow[]>({
    queryKey: ["admin", "applications"],
    queryFn: () => apiFetch("/api/admin/applications"),
  });
  const update = useMutation({
    mutationFn: ({ id, status }: { id: number; status: string }) =>
      apiFetch(`/api/admin/applications/${id}`, { method: "PATCH", body: JSON.stringify({ status }) }),
    onSuccess: () => qc.invalidateQueries({ queryKey: ["admin", "applications"] }),
  });

  return (
    <div>
      <h2 className="text-xl font-bold mb-6">{isAr ? "طلبات العضوية" : "Membership Applications"}</h2>
      <div className="overflow-x-auto">
        <table className="w-full text-sm">
          <thead>
            <tr className="text-left text-muted-foreground border-b">
              <th className="py-2">{isAr ? "الاسم" : "Name"}</th>
              <th className="py-2">{isAr ? "البريد" : "Email"}</th>
              <th className="py-2">{isAr ? "الفئة" : "Tier"}</th>
              <th className="py-2">{isAr ? "الحالة" : "Status"}</th>
              <th className="py-2">{isAr ? "إجراء" : "Action"}</th>
            </tr>
          </thead>
          <tbody>
            {list.data?.map((row) => (
              <tr key={row.id} className="border-b last:border-0">
                <td className="py-2">{row.fullName}</td>
                <td className="py-2 text-muted-foreground">{row.email}</td>
                <td className="py-2">{row.membershipTier ?? "—"}</td>
                <td className="py-2 capitalize">{row.status}</td>
                <td className="py-2">
                  {row.status === "pending" && (
                    <div className="flex gap-2">
                      <Button
                        size="sm"
                        onClick={() => update.mutate({ id: row.id, status: "approved" })}
                        className="bg-green-600 hover:bg-green-700 text-white h-7 px-3 text-xs"
                      >
                        {isAr ? "قبول" : "Approve"}
                      </Button>
                      <Button
                        size="sm"
                        onClick={() => update.mutate({ id: row.id, status: "rejected" })}
                        variant="outline"
                        className="h-7 px-3 text-xs"
                      >
                        {isAr ? "رفض" : "Reject"}
                      </Button>
                    </div>
                  )}
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </div>
  );
}

function ContactManager({ isAr }: { isAr: boolean }) {
  const qc = useQueryClient();
  const list = useQuery<ContactRow[]>({
    queryKey: ["admin", "contact"],
    queryFn: () => apiFetch("/api/admin/contact"),
  });
  const markRead = useMutation({
    mutationFn: (id: number) => apiFetch(`/api/admin/contact/${id}/read`, { method: "PATCH" }),
    onSuccess: () => qc.invalidateQueries({ queryKey: ["admin", "contact"] }),
  });

  return (
    <div>
      <h2 className="text-xl font-bold mb-6">{isAr ? "رسائل التواصل" : "Contact Messages"}</h2>
      <div className="space-y-3">
        {list.data?.map((row) => (
          <div
            key={row.id}
            className={`border rounded-lg p-4 ${row.read ? "bg-card" : "bg-yellow-50/50 border-yellow-200"}`}
          >
            <div className="flex justify-between items-start mb-2">
              <div>
                <p className="font-semibold">{row.name}</p>
                <p className="text-xs text-muted-foreground">
                  {row.email} · {new Date(row.createdAt).toLocaleString(isAr ? "ar" : "en")}
                </p>
              </div>
              {!row.read && (
                <Button size="sm" variant="outline" className="h-7 px-3 text-xs" onClick={() => markRead.mutate(row.id)}>
                  {isAr ? "تحديد كمقروء" : "Mark read"}
                </Button>
              )}
            </div>
            {row.subject && <p className="text-sm font-medium mb-1">{row.subject}</p>}
            <p className="text-sm text-muted-foreground whitespace-pre-wrap">{row.message}</p>
          </div>
        ))}
        {list.data?.length === 0 && (
          <p className="text-muted-foreground text-center py-8">
            {isAr ? "لا توجد رسائل" : "No messages"}
          </p>
        )}
      </div>
    </div>
  );
}
