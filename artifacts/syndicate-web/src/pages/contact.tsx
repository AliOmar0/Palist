import { Layout } from "@/components/layout/Layout";
import { useLanguage } from "@/lib/language-context";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Textarea } from "@/components/ui/textarea";
import { Label } from "@/components/ui/label";
import { MapPin, Phone, Mail, Clock, Send } from "lucide-react";

export default function Contact() {
  const { language } = useLanguage();

  return (
    <Layout>
      <div className="bg-primary/5 py-12 border-b">
        <div className="container mx-auto px-4 md:px-6">
          <h1 className="text-3xl md:text-4xl font-bold text-foreground mb-4">
            {language === 'ar' ? 'اتصل بنا' : 'Contact Us'}
          </h1>
          <p className="text-muted-foreground max-w-2xl text-lg">
            {language === 'ar' 
              ? 'نحن هنا للإجابة على استفساراتكم. تواصلوا معنا عبر النموذج أدناه أو تفضلوا بزيارة مقرنا.'
              : 'We are here to answer your inquiries. Contact us via the form below or visit our headquarters.'}
          </p>
        </div>
      </div>

      <div className="container mx-auto px-4 md:px-6 py-16">
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-16">
          
          {/* Contact Info */}
          <div>
            <h2 className="text-2xl font-bold text-foreground mb-8">
              {language === 'ar' ? 'معلومات التواصل' : 'Contact Information'}
            </h2>
            
            <div className="space-y-8">
              <div className="flex items-start gap-4">
                <div className="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary shrink-0">
                  <MapPin className="w-6 h-6" />
                </div>
                <div>
                  <h3 className="font-bold text-foreground mb-1">
                    {language === 'ar' ? 'العنوان' : 'Address'}
                  </h3>
                  <p className="text-muted-foreground">
                    {language === 'ar' ? 'رام الله، فلسطين - الإرسال' : 'Ramallah, Palestine - Al-Irsal'}
                    <br />
                    {language === 'ar' ? 'مبنى المجمع المهني، الطابق الرابع' : 'Professional Complex Building, 4th Floor'}
                  </p>
                </div>
              </div>

              <div className="flex items-start gap-4">
                <div className="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary shrink-0">
                  <Phone className="w-6 h-6" />
                </div>
                <div>
                  <h3 className="font-bold text-foreground mb-1">
                    {language === 'ar' ? 'الهاتف' : 'Phone'}
                  </h3>
                  <p className="text-muted-foreground" dir="ltr">+970 2 298 0000</p>
                  <p className="text-muted-foreground" dir="ltr">+970 59 000 0000</p>
                </div>
              </div>

              <div className="flex items-start gap-4">
                <div className="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary shrink-0">
                  <Mail className="w-6 h-6" />
                </div>
                <div>
                  <h3 className="font-bold text-foreground mb-1">
                    {language === 'ar' ? 'البريد الإلكتروني' : 'Email'}
                  </h3>
                  <p className="text-muted-foreground">info@palitsyndicate.ps</p>
                  <p className="text-muted-foreground">membership@palitsyndicate.ps</p>
                </div>
              </div>

              <div className="flex items-start gap-4">
                <div className="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary shrink-0">
                  <Clock className="w-6 h-6" />
                </div>
                <div>
                  <h3 className="font-bold text-foreground mb-1">
                    {language === 'ar' ? 'ساعات العمل' : 'Working Hours'}
                  </h3>
                  <p className="text-muted-foreground">
                    {language === 'ar' ? 'الأحد - الخميس: 08:00 صباحاً - 03:00 مساءً' : 'Sunday - Thursday: 08:00 AM - 03:00 PM'}
                  </p>
                </div>
              </div>
            </div>
          </div>

          {/* Contact Form */}
          <div className="bg-white rounded-2xl p-8 border shadow-sm">
            <h2 className="text-2xl font-bold text-foreground mb-6">
              {language === 'ar' ? 'أرسل رسالة' : 'Send a Message'}
            </h2>
            <form className="space-y-6" onSubmit={(e) => e.preventDefault()}>
              <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="name">{language === 'ar' ? 'الاسم الكامل' : 'Full Name'}</Label>
                  <Input id="name" placeholder={language === 'ar' ? 'أدخل اسمك' : 'Enter your name'} className="h-12 bg-gray-50" />
                </div>
                <div className="space-y-2">
                  <Label htmlFor="email">{language === 'ar' ? 'البريد الإلكتروني' : 'Email Address'}</Label>
                  <Input id="email" type="email" placeholder="example@mail.com" className="h-12 bg-gray-50 text-left" dir="ltr" />
                </div>
              </div>
              
              <div className="space-y-2">
                <Label htmlFor="subject">{language === 'ar' ? 'الموضوع' : 'Subject'}</Label>
                <Input id="subject" placeholder={language === 'ar' ? 'موضوع الرسالة' : 'Message subject'} className="h-12 bg-gray-50" />
              </div>
              
              <div className="space-y-2">
                <Label htmlFor="message">{language === 'ar' ? 'نص الرسالة' : 'Message Body'}</Label>
                <Textarea 
                  id="message" 
                  placeholder={language === 'ar' ? 'اكتب رسالتك هنا...' : 'Write your message here...'} 
                  className="min-h-[150px] bg-gray-50 resize-y" 
                />
              </div>
              
              <Button type="submit" className="w-full bg-primary text-primary-foreground hover:bg-primary/90 h-12 font-bold text-lg">
                <Send className="w-5 h-5 ml-2 rtl:mr-2 rtl:ml-0" />
                {language === 'ar' ? 'إرسال الرسالة' : 'Send Message'}
              </Button>
            </form>
          </div>

        </div>
      </div>
    </Layout>
  );
}
