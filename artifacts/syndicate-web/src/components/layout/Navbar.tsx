import { Link, useLocation } from "wouter";
import { useLanguage } from "@/lib/language-context";
import { Button } from "@/components/ui/button";
import { Globe, Menu, X } from "lucide-react";
import { useState, useEffect } from "react";
import { cn } from "@/lib/utils";

export function Navbar() {
  const [location] = useLocation();
  const { language, toggleLanguage, t } = useLanguage();
  const [isScrolled, setIsScrolled] = useState(false);
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);

  useEffect(() => {
    const handleScroll = () => {
      setIsScrolled(window.scrollY > 20);
    };
    window.addEventListener("scroll", handleScroll);
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  const navLinks = [
    { href: "/", label: t("nav.home") },
    { href: "/about", label: t("nav.about") },
    { href: "/membership", label: t("nav.membership") },
    { href: "/news", label: t("nav.news") },
    { href: "/events", label: t("nav.events") },
    { href: "/training", label: t("nav.training") },
    { href: "/reports", label: t("nav.reports") },
    { href: "/contact", label: t("nav.contact") },
  ];

  return (
    <header
      className={cn(
        "fixed top-0 w-full z-50 transition-all duration-300 border-b",
        isScrolled
          ? "bg-white/95 backdrop-blur-md border-border shadow-sm py-3"
          : "bg-white border-transparent py-5"
      )}
    >
      <div className="container mx-auto px-4 md:px-6 flex items-center justify-between">
        {/* Logo */}
        <Link href="/" className="flex items-center gap-2 group">
          <div className="w-10 h-10 rounded-md bg-primary flex items-center justify-center text-white font-bold text-xl shadow-sm group-hover:bg-primary/90 transition-colors">
            PITS
          </div>
          <div className="flex flex-col">
            <span className="font-bold text-primary leading-tight text-sm md:text-base">
              {language === 'ar' ? 'نقابة تكنولوجيا المعلومات الفلسطينية' : 'Palestinian IT Syndicate'}
            </span>
            <span className="text-[10px] md:text-xs text-muted-foreground font-medium uppercase tracking-wider">
              {language === 'ar' ? 'نقابة مهنية وطنية' : 'National Professional Body'}
            </span>
          </div>
        </Link>

        {/* Desktop Nav */}
        <nav className="hidden lg:flex items-center gap-1 xl:gap-2">
          {navLinks.map((link) => (
            <Link
              key={link.href}
              href={link.href}
              className={cn(
                "px-3 py-2 rounded-md text-sm font-medium transition-colors hover:bg-muted hover:text-primary",
                location === link.href ? "text-primary bg-primary/5" : "text-foreground"
              )}
            >
              {link.label}
            </Link>
          ))}
        </nav>

        {/* Actions */}
        <div className="hidden lg:flex items-center gap-4">
          <button
            onClick={toggleLanguage}
            className="flex items-center gap-1.5 text-sm font-medium text-muted-foreground hover:text-primary transition-colors"
          >
            <Globe className="w-4 h-4" />
            <span>{language === 'ar' ? 'English' : 'العربية'}</span>
          </button>
          
          <Button className="bg-accent text-primary hover:bg-accent/90 font-semibold px-6 shadow-sm border-0">
            {t("nav.join")}
          </Button>
        </div>

        {/* Mobile Toggle */}
        <button
          className="lg:hidden p-2 text-foreground"
          onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
        >
          {mobileMenuOpen ? <X className="w-6 h-6" /> : <Menu className="w-6 h-6" />}
        </button>
      </div>

      {/* Mobile Menu */}
      {mobileMenuOpen && (
        <div className="lg:hidden absolute top-full left-0 w-full bg-white border-b border-border shadow-lg py-4 px-4 flex flex-col gap-4">
          <nav className="flex flex-col gap-2">
            {navLinks.map((link) => (
              <Link
                key={link.href}
                href={link.href}
                className={cn(
                  "px-4 py-3 rounded-md text-base font-medium transition-colors",
                  location === link.href ? "text-primary bg-primary/5" : "text-foreground hover:bg-muted"
                )}
                onClick={() => setMobileMenuOpen(false)}
              >
                {link.label}
              </Link>
            ))}
          </nav>
          
          <div className="h-px bg-border my-2" />
          
          <div className="flex flex-col gap-4 px-2">
            <button
              onClick={() => {
                toggleLanguage();
                setMobileMenuOpen(false);
              }}
              className="flex items-center gap-2 text-base font-medium text-foreground py-2"
            >
              <Globe className="w-5 h-5" />
              <span>{language === 'ar' ? 'Switch to English' : 'التبديل إلى العربية'}</span>
            </button>
            
            <Button className="bg-accent text-primary hover:bg-accent/90 font-bold w-full py-6 text-lg border-0">
              {t("nav.join")}
            </Button>
          </div>
        </div>
      )}
    </header>
  );
}
