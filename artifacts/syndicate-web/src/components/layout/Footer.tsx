import { Link } from "wouter";
import { useLanguage } from "@/lib/language-context";
import { Facebook, Twitter, Linkedin, Mail, MapPin, Phone } from "lucide-react";

export function Footer() {
  const { t, language } = useLanguage();

  return (
    <footer className="bg-primary text-primary-foreground pt-16 pb-8 border-t-[8px] border-accent">
      <div className="container mx-auto px-4 md:px-6">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
          {/* Brand */}
          <div className="space-y-6">
            <div className="flex items-center gap-3">
              <div className="w-12 h-12 rounded-md bg-accent flex items-center justify-center text-primary font-bold text-2xl shadow-sm">
                PITS
              </div>
              <div className="flex flex-col">
                <span className="font-bold text-white text-lg leading-tight">
                  {language === 'ar' ? 'نقابة تكنولوجيا المعلومات' : 'Palestinian IT Syndicate'}
                </span>
                <span className="text-primary-foreground/70 text-sm">
                  {language === 'ar' ? 'فلسطين' : 'Palestine'}
                </span>
              </div>
            </div>
            <p className="text-primary-foreground/80 leading-relaxed text-sm">
              {t('footer.about')}
            </p>
            <div className="flex gap-4">
              <a href="#" className="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-accent hover:text-primary transition-colors">
                <Facebook className="w-5 h-5" />
              </a>
              <a href="#" className="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-accent hover:text-primary transition-colors">
                <Twitter className="w-5 h-5" />
              </a>
              <a href="#" className="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-accent hover:text-primary transition-colors">
                <Linkedin className="w-5 h-5" />
              </a>
            </div>
          </div>

          {/* Quick Links */}
          <div>
            <h3 className="text-lg font-bold mb-6 text-white border-b border-white/10 pb-4 inline-block">
              {t('footer.links')}
            </h3>
            <ul className="space-y-3">
              {[
                { href: "/about", label: t('nav.about') },
                { href: "/membership", label: t('nav.membership') },
                { href: "/news", label: t('nav.news') },
                { href: "/events", label: t('nav.events') },
                { href: "/training", label: t('nav.training') },
                { href: "/reports", label: t('nav.reports') },
              ].map((link) => (
                <li key={link.href}>
                  <Link 
                    href={link.href} 
                    className="text-primary-foreground/80 hover:text-accent transition-colors flex items-center gap-2"
                  >
                    <span className="w-1.5 h-1.5 rounded-full bg-accent/50 block"></span>
                    {link.label}
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          {/* Contact */}
          <div>
            <h3 className="text-lg font-bold mb-6 text-white border-b border-white/10 pb-4 inline-block">
              {t('footer.contact')}
            </h3>
            <ul className="space-y-4 text-primary-foreground/80 text-sm">
              <li className="flex items-start gap-3">
                <MapPin className="w-5 h-5 text-accent shrink-0 mt-0.5" />
                <span>
                  {language === 'ar' ? 'رام الله، فلسطين - مبنى المجمع المهني' : 'Ramallah, Palestine - Professional Complex Building'}
                </span>
              </li>
              <li className="flex items-center gap-3">
                <Phone className="w-5 h-5 text-accent shrink-0" />
                <span dir="ltr">+970 2 298 0000</span>
              </li>
              <li className="flex items-center gap-3">
                <Mail className="w-5 h-5 text-accent shrink-0" />
                <span>info@palitsyndicate.ps</span>
              </li>
            </ul>
          </div>

          {/* Newsletter */}
          <div>
            <h3 className="text-lg font-bold mb-6 text-white border-b border-white/10 pb-4 inline-block">
              {language === 'ar' ? 'النشرة البريدية' : 'Newsletter'}
            </h3>
            <p className="text-primary-foreground/80 text-sm mb-4">
              {language === 'ar' ? 'اشترك ليصلك أحدث الأخبار والفعاليات المهنية' : 'Subscribe to receive latest professional news and events'}
            </p>
            <form className="space-y-2" onSubmit={(e) => e.preventDefault()}>
              <input 
                type="email" 
                placeholder={language === 'ar' ? 'البريد الإلكتروني' : 'Email Address'} 
                className="w-full bg-white/5 border border-white/10 rounded-md px-4 py-2.5 text-white placeholder:text-white/40 focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent transition-all"
              />
              <button 
                type="submit"
                className="w-full bg-white text-primary font-bold rounded-md px-4 py-2.5 hover:bg-accent transition-colors"
              >
                {language === 'ar' ? 'اشتراك' : 'Subscribe'}
              </button>
            </form>
          </div>
        </div>

        <div className="border-t border-white/10 pt-8 mt-8 flex flex-col md:flex-row items-center justify-between gap-4 text-primary-foreground/60 text-sm">
          <p>{t('footer.rights')}</p>
          <div className="flex gap-4">
            <Link href="/privacy" className="hover:text-white transition-colors">
              {language === 'ar' ? 'سياسة الخصوصية' : 'Privacy Policy'}
            </Link>
            <Link href="/terms" className="hover:text-white transition-colors">
              {language === 'ar' ? 'شروط الاستخدام' : 'Terms of Use'}
            </Link>
          </div>
        </div>
      </div>
    </footer>
  );
}
