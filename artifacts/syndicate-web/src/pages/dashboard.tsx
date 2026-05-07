import { useUser } from "@clerk/react";
import { useQuery } from "@tanstack/react-query";
import { Link } from "wouter";
import { motion } from "framer-motion";
import { Button } from "@/components/ui/button";
import { useLanguage } from "@/lib/language-context";
import { apiFetch } from "@/lib/queryClient";
import { Navbar } from "@/components/layout/Navbar";
import { Footer } from "@/components/layout/Footer";
import { CheckCircle2, Clock, FileText, UserCircle, Pencil, Download } from "lucide-react";
import { generateMembershipCardPdf } from "@/lib/membership-card";

interface MemberApplication {
  id: number;
  fullName: string;
  fullNameEn: string | null;
  status: string;
  membershipTier: string | null;
  membershipNumber: string | null;
  cardId: string;
  expiresAt: string | null;
  createdAt: string;
}

interface Me {
  id: string;
  email: string;
  firstName: string | null;
  lastName: string | null;
  role: string;
}

export default function Dashboard() {
  const { user } = useUser();
  const { language } = useLanguage();
  const isAr = language === "ar";

  const { data: me } = useQuery<Me>({
    queryKey: ["me"],
    queryFn: () => apiFetch<Me>("/api/me"),
  });

  const { data: applications = [] } = useQuery<MemberApplication[]>({
    queryKey: ["applications", "me"],
    queryFn: () => apiFetch<MemberApplication[]>("/api/membership/me"),
  });

  const latest = applications[0];

  return (
    <div className="min-h-screen bg-muted/30">
      <Navbar />
      <main className="container mx-auto px-4 md:px-6 pt-32 pb-20">
        <motion.div
          initial={{ opacity: 0, y: 12 }}
          animate={{ opacity: 1, y: 0 }}
          className="mb-10"
        >
          <h1 className="text-3xl md:text-4xl font-bold text-foreground">
            {isAr ? `مرحباً ${user?.firstName ?? ""}` : `Welcome, ${user?.firstName ?? ""}`}
          </h1>
          <p className="text-muted-foreground mt-2">
            {isAr
              ? "هذه لوحة التحكم الخاصة بك في نقابة العلوم المعلوماتية التكنولوجية الفلسطينية."
              : "This is your member portal for the Palestinian IT Syndicate."}
          </p>
        </motion.div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
          <div className="bg-card rounded-xl border p-6 shadow-sm">
            <div className="flex items-center gap-3 mb-3">
              {user?.imageUrl ? (
                <img src={user.imageUrl} alt="" className="w-10 h-10 rounded-full object-cover" />
              ) : (
                <UserCircle className="w-10 h-10 text-primary" />
              )}
              <div className="min-w-0">
                <h3 className="font-semibold text-foreground truncate">
                  {user?.firstName ? `${user.firstName}${user.lastName ? " " + user.lastName : ""}` : (isAr ? "حسابي" : "Account")}
                </h3>
                <p className="text-xs text-muted-foreground">
                  {isAr ? "الدور:" : "Role:"} <span className="font-medium text-foreground">{me?.role ?? "member"}</span>
                </p>
              </div>
            </div>
            <p className="text-sm text-muted-foreground break-all mb-3">{user?.primaryEmailAddress?.emailAddress}</p>
            <Link href="/profile">
              <Button variant="outline" size="sm" className="w-full">
                <Pencil className="w-4 h-4 me-2" /> {isAr ? "تعديل الملف الشخصي" : "Edit profile"}
              </Button>
            </Link>
          </div>

          <div className="bg-card rounded-xl border p-6 shadow-sm">
            <div className="flex items-center gap-3 mb-3">
              {latest?.status === "approved" ? (
                <CheckCircle2 className="w-5 h-5 text-green-600" />
              ) : (
                <Clock className="w-5 h-5 text-secondary" />
              )}
              <h3 className="font-semibold text-foreground">
                {isAr ? "حالة العضوية" : "Membership Status"}
              </h3>
            </div>
            {latest ? (
              <>
                <p className="text-sm text-muted-foreground">
                  {isAr ? "آخر طلب:" : "Latest application:"}{" "}
                  <span className="font-medium text-foreground capitalize">{latest.status}</span>
                </p>
                {latest.membershipTier && (
                  <p className="text-xs text-muted-foreground mt-1">
                    {isAr ? "الفئة:" : "Tier:"} {latest.membershipTier}
                  </p>
                )}
              </>
            ) : (
              <p className="text-sm text-muted-foreground">
                {isAr ? "لم تقدّم طلب عضوية بعد." : "You haven't applied yet."}
              </p>
            )}
            <Link href="/membership/apply">
              <Button className="mt-4 bg-primary text-white hover:bg-primary/90" size="sm">
                {latest
                  ? isAr ? "تقديم طلب جديد" : "Submit new application"
                  : isAr ? "تقديم طلب عضوية" : "Apply for membership"}
              </Button>
            </Link>
            {latest?.status === "approved" && latest.cardId && (
              <Button
                onClick={() =>
                  generateMembershipCardPdf({
                    fullName: latest.fullName,
                    fullNameEn: latest.fullNameEn,
                    membershipNumber: latest.membershipNumber,
                    membershipTier: latest.membershipTier,
                    cardId: latest.cardId,
                    expiresAt: latest.expiresAt,
                    verifyUrl: `${window.location.origin}/verify/${latest.cardId}`,
                  })
                }
                variant="outline"
                size="sm"
                className="mt-2 w-full"
              >
                <Download className="w-4 h-4 me-2" />
                {isAr ? "تنزيل بطاقة العضوية" : "Download membership card"}
              </Button>
            )}
          </div>

          <div className="bg-card rounded-xl border p-6 shadow-sm">
            <div className="flex items-center gap-3 mb-3">
              <FileText className="w-5 h-5 text-primary" />
              <h3 className="font-semibold text-foreground">
                {isAr ? "مواردي" : "My Resources"}
              </h3>
            </div>
            <ul className="text-sm text-muted-foreground space-y-2">
              <li>
                <Link href="/news" className="hover:text-primary">
                  {isAr ? "آخر الأخبار" : "Latest news"}
                </Link>
              </li>
              <li>
                <Link href="/events" className="hover:text-primary">
                  {isAr ? "الفعاليات القادمة" : "Upcoming events"}
                </Link>
              </li>
              <li>
                <Link href="/training" className="hover:text-primary">
                  {isAr ? "البرامج التدريبية" : "Training programs"}
                </Link>
              </li>
            </ul>
          </div>
        </div>

        {applications.length > 0 && (
          <div className="bg-card rounded-xl border p-6 shadow-sm">
            <h3 className="font-bold text-lg text-foreground mb-4">
              {isAr ? "طلبات العضوية السابقة" : "My Applications"}
            </h3>
            <div className="overflow-x-auto">
              <table className="w-full text-sm">
                <thead>
                  <tr className="text-left text-muted-foreground border-b">
                    <th className="py-2">{isAr ? "الاسم" : "Name"}</th>
                    <th className="py-2">{isAr ? "الفئة" : "Tier"}</th>
                    <th className="py-2">{isAr ? "الحالة" : "Status"}</th>
                    <th className="py-2">{isAr ? "التاريخ" : "Date"}</th>
                  </tr>
                </thead>
                <tbody>
                  {applications.map((app) => (
                    <tr key={app.id} className="border-b last:border-0">
                      <td className="py-2 text-foreground">{app.fullName}</td>
                      <td className="py-2 text-muted-foreground">{app.membershipTier ?? "—"}</td>
                      <td className="py-2 capitalize">{app.status}</td>
                      <td className="py-2 text-muted-foreground">
                        {new Date(app.createdAt).toLocaleDateString(isAr ? "ar" : "en")}
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </div>
        )}

        {me?.role === "admin" && (
          <div className="mt-10 p-6 rounded-xl border-2 border-primary/30 bg-primary/5">
            <h3 className="font-bold text-foreground text-lg">
              {isAr ? "أنت مسؤول في النظام" : "You are an administrator"}
            </h3>
            <p className="text-sm text-muted-foreground mt-1 mb-4">
              {isAr
                ? "يمكنك الوصول إلى لوحة الإدارة لإدارة محتوى الموقع."
                : "You have access to the admin dashboard to manage site content."}
            </p>
            <Link href="/admin">
              <Button className="bg-primary text-white hover:bg-primary/90">
                {isAr ? "فتح لوحة الإدارة" : "Open admin dashboard"}
              </Button>
            </Link>
          </div>
        )}
      </main>
      <Footer />
    </div>
  );
}
