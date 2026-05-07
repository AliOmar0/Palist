import { useState, useRef, useEffect } from "react";
import { useUser } from "@clerk/react";
import { motion } from "framer-motion";
import { Navbar } from "@/components/layout/Navbar";
import { Footer } from "@/components/layout/Footer";
import { useLanguage } from "@/lib/language-context";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Camera, Loader2, CheckCircle2, X, UserCircle } from "lucide-react";
import { Link } from "wouter";

export default function ProfilePage() {
  const { user, isLoaded } = useUser();
  const { language } = useLanguage();
  const isAr = language === "ar";

  const [firstName, setFirstName] = useState("");
  const [lastName, setLastName] = useState("");
  const [savingProfile, setSavingProfile] = useState(false);
  const [profileMsg, setProfileMsg] = useState<{ type: "ok" | "err"; text: string } | null>(null);

  const [avatarBusy, setAvatarBusy] = useState(false);
  const [avatarMsg, setAvatarMsg] = useState<{ type: "ok" | "err"; text: string } | null>(null);
  const fileRef = useRef<HTMLInputElement>(null);

  const [pwCurrent, setPwCurrent] = useState("");
  const [pwNew, setPwNew] = useState("");
  const [pwBusy, setPwBusy] = useState(false);
  const [pwMsg, setPwMsg] = useState<{ type: "ok" | "err"; text: string } | null>(null);

  useEffect(() => {
    if (user) {
      setFirstName(user.firstName ?? "");
      setLastName(user.lastName ?? "");
    }
  }, [user]);

  if (!isLoaded || !user) {
    return (
      <div className="min-h-screen bg-gray-50/50">
        <Navbar />
        <main className="container mx-auto px-4 md:px-6 pt-32 pb-20 text-center">
          <Loader2 className="w-8 h-8 animate-spin mx-auto text-primary" />
        </main>
        <Footer />
      </div>
    );
  }

  async function handleAvatarFile(file: File) {
    setAvatarMsg(null);
    setAvatarBusy(true);
    try {
      await user!.setProfileImage({ file });
      setAvatarMsg({ type: "ok", text: isAr ? "تم تحديث الصورة." : "Avatar updated." });
    } catch (e) {
      setAvatarMsg({
        type: "err",
        text: e instanceof Error ? e.message : isAr ? "فشل رفع الصورة." : "Failed to upload avatar.",
      });
    } finally {
      setAvatarBusy(false);
      if (fileRef.current) fileRef.current.value = "";
    }
  }

  async function removeAvatar() {
    setAvatarMsg(null);
    setAvatarBusy(true);
    try {
      await user!.setProfileImage({ file: null });
      setAvatarMsg({ type: "ok", text: isAr ? "تمت إزالة الصورة." : "Avatar removed." });
    } catch (e) {
      setAvatarMsg({
        type: "err",
        text: e instanceof Error ? e.message : "Failed",
      });
    } finally {
      setAvatarBusy(false);
    }
  }

  async function saveProfile(e: React.FormEvent) {
    e.preventDefault();
    setProfileMsg(null);
    setSavingProfile(true);
    try {
      await user!.update({ firstName, lastName });
      setProfileMsg({ type: "ok", text: isAr ? "تم حفظ التغييرات." : "Changes saved." });
    } catch (err) {
      setProfileMsg({
        type: "err",
        text: err instanceof Error ? err.message : isAr ? "فشل الحفظ." : "Save failed.",
      });
    } finally {
      setSavingProfile(false);
    }
  }

  async function changePassword(e: React.FormEvent) {
    e.preventDefault();
    setPwMsg(null);
    if (pwNew.length < 8) {
      setPwMsg({ type: "err", text: isAr ? "يجب أن تحتوي كلمة المرور على 8 أحرف على الأقل." : "Password must be at least 8 characters." });
      return;
    }
    setPwBusy(true);
    try {
      await user!.updatePassword({ currentPassword: pwCurrent || undefined, newPassword: pwNew });
      setPwCurrent("");
      setPwNew("");
      setPwMsg({ type: "ok", text: isAr ? "تم تغيير كلمة المرور." : "Password updated." });
    } catch (err) {
      setPwMsg({
        type: "err",
        text: err instanceof Error ? err.message : isAr ? "فشل تغيير كلمة المرور." : "Failed to change password.",
      });
    } finally {
      setPwBusy(false);
    }
  }

  return (
    <div className="min-h-screen bg-gray-50/50">
      <Navbar />
      <main className="container mx-auto px-4 md:px-6 pt-32 pb-20 max-w-4xl">
        <motion.div initial={{ opacity: 0, y: 12 }} animate={{ opacity: 1, y: 0 }} className="mb-8">
          <p className="text-xs font-bold text-secondary uppercase tracking-widest mb-2">
            {isAr ? "ملفي الشخصي" : "My Profile"}
          </p>
          <h1 className="text-3xl md:text-4xl font-bold">
            {isAr ? "تعديل المعلومات الشخصية" : "Edit your profile"}
          </h1>
          <p className="text-muted-foreground mt-2">
            {isAr ? "حدّث صورتك واسمك وكلمة المرور." : "Update your avatar, name, and password."}
          </p>
        </motion.div>

        {/* Avatar */}
        <section className="bg-white rounded-xl border p-6 shadow-sm mb-6">
          <h2 className="text-lg font-bold mb-4">
            {isAr ? "الصورة الشخصية" : "Profile picture"}
          </h2>
          <div className="flex items-center gap-6">
            <div className="relative">
              {user.imageUrl ? (
                <img src={user.imageUrl} alt="" className="w-24 h-24 rounded-full object-cover border-2 border-border" />
              ) : (
                <div className="w-24 h-24 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                  <UserCircle className="w-12 h-12" />
                </div>
              )}
              <button
                type="button"
                onClick={() => fileRef.current?.click()}
                disabled={avatarBusy}
                className="absolute -bottom-1 -right-1 rtl:right-auto rtl:-left-1 w-9 h-9 bg-primary text-white rounded-full flex items-center justify-center shadow-md hover:bg-primary/90 disabled:opacity-50"
                aria-label={isAr ? "تغيير الصورة" : "Change picture"}
              >
                {avatarBusy ? <Loader2 className="w-4 h-4 animate-spin" /> : <Camera className="w-4 h-4" />}
              </button>
            </div>
            <div className="flex flex-col gap-2">
              <div className="flex gap-2 flex-wrap">
                <Button type="button" variant="outline" onClick={() => fileRef.current?.click()} disabled={avatarBusy}>
                  <Camera className="w-4 h-4 me-2" />
                  {isAr ? "رفع صورة من جهازك" : "Upload from device"}
                </Button>
                {user.imageUrl && (
                  <Button type="button" variant="ghost" onClick={removeAvatar} disabled={avatarBusy} className="text-destructive">
                    <X className="w-4 h-4 me-1" /> {isAr ? "إزالة" : "Remove"}
                  </Button>
                )}
              </div>
              <p className="text-xs text-muted-foreground">
                {isAr ? "PNG أو JPG حتى 5 ميغابايت." : "PNG or JPG up to 5 MB."}
              </p>
              {avatarMsg && (
                <p className={`text-sm ${avatarMsg.type === "ok" ? "text-green-700" : "text-destructive"}`}>
                  {avatarMsg.text}
                </p>
              )}
            </div>
          </div>
          <input
            ref={fileRef}
            type="file"
            accept="image/png,image/jpeg,image/webp"
            className="hidden"
            onChange={(e) => {
              const f = e.target.files?.[0];
              if (f) handleAvatarFile(f);
            }}
          />
        </section>

        {/* Name */}
        <section className="bg-white rounded-xl border p-6 shadow-sm mb-6">
          <h2 className="text-lg font-bold mb-4">
            {isAr ? "الاسم" : "Name"}
          </h2>
          <form onSubmit={saveProfile} className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div className="space-y-2">
              <Label htmlFor="firstName">{isAr ? "الاسم الأول" : "First name"}</Label>
              <Input id="firstName" value={firstName} onChange={(e) => setFirstName(e.target.value)} className="h-11" />
            </div>
            <div className="space-y-2">
              <Label htmlFor="lastName">{isAr ? "اسم العائلة" : "Last name"}</Label>
              <Input id="lastName" value={lastName} onChange={(e) => setLastName(e.target.value)} className="h-11" />
            </div>
            <div className="md:col-span-2 space-y-2">
              <Label>{isAr ? "البريد الإلكتروني" : "Email"}</Label>
              <Input value={user.primaryEmailAddress?.emailAddress ?? ""} readOnly disabled className="h-11 bg-muted text-left" dir="ltr" />
              <p className="text-xs text-muted-foreground">
                {isAr ? "لا يمكن تغيير البريد الإلكتروني هنا." : "Email cannot be changed from this page."}
              </p>
            </div>
            <div className="md:col-span-2 flex items-center gap-3">
              <Button type="submit" className="bg-primary text-white hover:bg-primary/90" disabled={savingProfile}>
                {savingProfile ? <Loader2 className="w-4 h-4 me-2 animate-spin" /> : <CheckCircle2 className="w-4 h-4 me-2" />}
                {isAr ? "حفظ" : "Save changes"}
              </Button>
              {profileMsg && (
                <span className={`text-sm ${profileMsg.type === "ok" ? "text-green-700" : "text-destructive"}`}>
                  {profileMsg.text}
                </span>
              )}
            </div>
          </form>
        </section>

        {/* Password */}
        <section className="bg-white rounded-xl border p-6 shadow-sm mb-6">
          <h2 className="text-lg font-bold mb-1">
            {isAr ? "كلمة المرور" : "Password"}
          </h2>
          <p className="text-sm text-muted-foreground mb-4">
            {isAr ? "غيّر كلمة المرور الخاصة بحسابك." : "Change the password for your account."}
          </p>
          <form onSubmit={changePassword} className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div className="space-y-2">
              <Label htmlFor="pwCurrent">{isAr ? "كلمة المرور الحالية" : "Current password"}</Label>
              <Input id="pwCurrent" type="password" value={pwCurrent} onChange={(e) => setPwCurrent(e.target.value)} className="h-11" />
            </div>
            <div className="space-y-2">
              <Label htmlFor="pwNew">{isAr ? "كلمة المرور الجديدة" : "New password"}</Label>
              <Input id="pwNew" type="password" value={pwNew} onChange={(e) => setPwNew(e.target.value)} className="h-11" minLength={8} required />
            </div>
            <div className="md:col-span-2 flex items-center gap-3">
              <Button type="submit" className="bg-primary text-white hover:bg-primary/90" disabled={pwBusy}>
                {pwBusy ? <Loader2 className="w-4 h-4 me-2 animate-spin" /> : null}
                {isAr ? "تحديث كلمة المرور" : "Update password"}
              </Button>
              {pwMsg && (
                <span className={`text-sm ${pwMsg.type === "ok" ? "text-green-700" : "text-destructive"}`}>
                  {pwMsg.text}
                </span>
              )}
            </div>
          </form>
        </section>

        <div className="text-center">
          <Link href="/dashboard" className="text-sm text-primary hover:underline">
            ← {isAr ? "العودة إلى لوحة التحكم" : "Back to dashboard"}
          </Link>
        </div>
      </main>
      <Footer />
    </div>
  );
}
