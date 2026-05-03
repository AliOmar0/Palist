import { Layout } from "@/components/layout/Layout";
import { useLanguage } from "@/lib/language-context";
import { Button } from "@/components/ui/button";
import { FileQuestion, Home } from "lucide-react";
import { Link } from "wouter";

export default function NotFound() {
  const { language } = useLanguage();

  return (
    <Layout>
      <div className="container mx-auto px-4 md:px-6 py-32 flex flex-col items-center justify-center text-center">
        <div className="w-24 h-24 rounded-full bg-primary/5 flex items-center justify-center text-primary mb-8 border border-primary/10">
          <FileQuestion className="w-12 h-12" />
        </div>
        <h1 className="text-4xl md:text-5xl font-bold text-foreground mb-4">
          {language === 'ar' ? 'الصفحة غير موجودة' : 'Page Not Found'}
        </h1>
        <p className="text-muted-foreground text-lg mb-8 max-w-md">
          {language === 'ar' 
            ? 'عذراً، الصفحة التي تبحث عنها غير موجودة أو تم نقلها إلى رابط آخر.'
            : 'Sorry, the page you are looking for does not exist or has been moved to another URL.'}
        </p>
        <Link href="/">
          <Button className="bg-primary text-white hover:bg-primary/90 h-12 px-8 font-bold text-base border-0 shadow-sm">
            <Home className="w-5 h-5 ml-2 rtl:mr-2 rtl:ml-0" />
            {language === 'ar' ? 'العودة للرئيسية' : 'Back to Home'}
          </Button>
        </Link>
      </div>
    </Layout>
  );
}
