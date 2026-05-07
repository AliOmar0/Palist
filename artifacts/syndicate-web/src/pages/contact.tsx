import { useState } from "react";
import { useMutation } from "@tanstack/react-query";
import { Layout } from "@/components/layout/Layout";
import { useLanguage } from "@/lib/language-context";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Textarea } from "@/components/ui/textarea";
import { Label } from "@/components/ui/label";
import { MapPin, Phone, Mail, Clock, Send, CheckCircle2 } from "lucide-react";
import { apiFetch } from "@/lib/queryClient";

interface ContactForm {
  name: string;
  email: string;
  phone: string;
  subject: string;
  message: string;
}

export default function Contact() {
  const { language } = useLanguage();
  const isAr = language === "ar";

  const [form, setForm] = useState<ContactForm>({
    name: "",
    email: "",
    phone: "",
    subject: "",
    message: "",
  });

  const mutation = useMutation({
    mutationFn: (payload: ContactForm) =>
      apiFetch("/api/contact", {
        method: "POST",
        body: JSON.stringify({ ...payload, phone: payload.phone || undefined }),
      }),
    onSuccess: () => setForm({ name: "", email: "", phone: "", subject: "", message: "" }),
  });

  return (
    <Layout>
      <div className="bg-primary/5 py-12 border-b">
        <div className="container mx-auto px-4 md:px-6">
          <h1 className="text-3xl md:text-4xl font-bold text-foreground mb-4">
            {isAr ? 'اتصل بنا' : 'Contact Us'}
          </h1>
          <p className="text-muted-foreground max-w-2xl text-lg">
            {isAr
              ? 'نحن هنا للإجابة على استفساراتكم. تواصلوا معنا عبر النموذج أدناه أو تفضلوا بزيارة مقرنا.'
              : 'We are here to answer your inquiries. Contact us via the form below or visit our headquarters.'}
          </p>
        </div>
      </div>

      <div className="container mx-auto px-4 md:px-6 py-16">
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-16">

          <div>
            <h2 className="text-2xl font-bold text-foreground mb-8">
              {isAr ? 'معلومات التواصل' : 'Contact Information'}
            </h2>
            <div className="space-y-8">
              <ContactItem icon={MapPin} title={isAr ? 'العنوان' : 'Address'}>
                {isAr ? 'رام الله، فلسطين - الإرسال' : 'Ramallah, Palestine - Al-Irsal'}<br />
                {isAr ? 'مبنى المجمع المهني، الطابق الرابع' : 'Professional Complex Building, 4th Floor'}
              </ContactItem>
              <ContactItem icon={Phone} title={isAr ? 'الهاتف' : 'Phone'}>
                <span dir="ltr">+970 2 298 0000</span><br />
                <span dir="ltr">+970 59 000 0000</span>
              </ContactItem>
              <ContactItem icon={Mail} title={isAr ? 'البريد الإلكتروني' : 'Email'}>
                info@palitsyndicate.ps<br />
                membership@palitsyndicate.ps
              </ContactItem>
              <ContactItem icon={Clock} title={isAr ? 'ساعات العمل' : 'Working Hours'}>
                {isAr ? 'الأحد - الخميس: 08:00 صباحاً - 03:00 مساءً' : 'Sunday - Thursday: 08:00 AM - 03:00 PM'}
              </ContactItem>
            </div>
          </div>

          <div className="bg-card rounded-2xl p-8 border shadow-sm">
            <h2 className="text-2xl font-bold text-foreground mb-6">
              {isAr ? 'أرسل رسالة' : 'Send a Message'}
            </h2>

            {mutation.isSuccess ? (
              <div className="rounded-md border border-green-200 bg-green-50 p-6 text-center">
                <CheckCircle2 className="w-10 h-10 mx-auto text-green-600 mb-2" />
                <p className="font-semibold text-green-900">
                  {isAr ? 'تم استلام رسالتك بنجاح. سنعود إليك قريباً.' : 'Your message was received. We will get back to you shortly.'}
                </p>
                <Button
                  variant="outline"
                  className="mt-4"
                  onClick={() => mutation.reset()}
                >
                  {isAr ? 'إرسال رسالة أخرى' : 'Send another message'}
                </Button>
              </div>
            ) : (
              <form
                className="space-y-6"
                onSubmit={(e) => {
                  e.preventDefault();
                  mutation.mutate(form);
                }}
              >
                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div className="space-y-2">
                    <Label htmlFor="name">{isAr ? 'الاسم الكامل' : 'Full Name'}</Label>
                    <Input id="name" required value={form.name} onChange={(e) => setForm({ ...form, name: e.target.value })} placeholder={isAr ? 'أدخل اسمك' : 'Enter your name'} className="h-12 bg-muted/40" />
                  </div>
                  <div className="space-y-2">
                    <Label htmlFor="email">{isAr ? 'البريد الإلكتروني' : 'Email Address'}</Label>
                    <Input id="email" type="email" required value={form.email} onChange={(e) => setForm({ ...form, email: e.target.value })} placeholder="example@mail.com" className="h-12 bg-muted/40 text-left" dir="ltr" />
                  </div>
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div className="space-y-2">
                    <Label htmlFor="phone">{isAr ? 'رقم الهاتف (اختياري)' : 'Phone (optional)'}</Label>
                    <Input id="phone" value={form.phone} onChange={(e) => setForm({ ...form, phone: e.target.value })} placeholder="+970 ..." className="h-12 bg-muted/40 text-left" dir="ltr" maxLength={40} />
                  </div>
                  <div className="space-y-2">
                    <Label htmlFor="subject">{isAr ? 'الموضوع' : 'Subject'}</Label>
                    <Input id="subject" value={form.subject} onChange={(e) => setForm({ ...form, subject: e.target.value })} placeholder={isAr ? 'موضوع الرسالة' : 'Message subject'} className="h-12 bg-muted/40" maxLength={200} />
                  </div>
                </div>

                <div className="space-y-2">
                  <Label htmlFor="message">{isAr ? 'نص الرسالة' : 'Message Body'}</Label>
                  <Textarea
                    id="message"
                    required
                    value={form.message}
                    onChange={(e) => setForm({ ...form, message: e.target.value })}
                    placeholder={isAr ? 'اكتب رسالتك هنا...' : 'Write your message here...'}
                    className="min-h-[150px] bg-muted/40 resize-y"
                  />
                </div>

                {mutation.isError && (
                  <p className="text-sm text-destructive">
                    {isAr ? 'حدث خطأ. يرجى المحاولة لاحقاً.' : 'Something went wrong. Please try again.'}
                  </p>
                )}

                <Button
                  type="submit"
                  disabled={mutation.isPending}
                  className="w-full bg-primary text-primary-foreground hover:bg-primary/90 h-12 font-bold text-lg"
                >
                  <Send className="w-5 h-5 ml-2 rtl:mr-2 rtl:ml-0" />
                  {mutation.isPending
                    ? isAr ? 'جاري الإرسال...' : 'Sending...'
                    : isAr ? 'إرسال الرسالة' : 'Send Message'}
                </Button>
              </form>
            )}
          </div>
        </div>
      </div>
    </Layout>
  );
}

function ContactItem({ icon: Icon, title, children }: { icon: typeof MapPin; title: string; children: React.ReactNode }) {
  return (
    <div className="flex items-start gap-4">
      <div className="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary shrink-0">
        <Icon className="w-6 h-6" />
      </div>
      <div>
        <h3 className="font-bold text-foreground mb-1">{title}</h3>
        <p className="text-muted-foreground">{children}</p>
      </div>
    </div>
  );
}
