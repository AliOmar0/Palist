import { Link, useLocation } from "wouter";
import { useLanguage } from "@/lib/language-context";
import { Button } from "@/components/ui/button";
import { Globe, Menu, X, LogOut, LayoutDashboard, UserCircle, Moon, Sun } from "lucide-react";
import { useState, useEffect } from "react";
import { cn } from "@/lib/utils";
import { Show, useUser, useClerk } from "@clerk/react";
import { useTheme } from "@/lib/theme-context";

export function Navbar() {
  const [location] = useLocation();
  const { language, toggleLanguage, t } = useLanguage();
  const { theme, toggleTheme } = useTheme();
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
    { href: "/jobs", label: language === 'ar' ? 'وظائف' : 'Jobs' },
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
        <Link href="/" className="flex items-center group">
          <img
            src="https://palist.ps/uploads/100Q1000W384H1693724962799404612.png"
            alt="Palist - نقابة العلوم المعلوماتية التكنولوجية الفلسطينية"
            className="h-12 md:h-14 w-auto object-contain shrink-0 group-hover:opacity-90 transition-opacity"
          />
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
            aria-label={language === 'ar' ? 'Switch to English' : 'التبديل إلى العربية'}
            className="flex items-center gap-1.5 text-sm font-medium text-muted-foreground hover:text-primary transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded px-1"
          >
            <Globe className="w-4 h-4" />
            <span>{language === 'ar' ? 'English' : 'العربية'}</span>
          </button>

          <button
            onClick={toggleTheme}
            aria-label={theme === 'dark' ? (language === 'ar' ? 'الوضع الفاتح' : 'Light mode') : (language === 'ar' ? 'الوضع الليلي' : 'Dark mode')}
            className="p-2 rounded-md text-muted-foreground hover:text-primary hover:bg-muted transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary"
          >
            {theme === 'dark' ? <Sun className="w-4 h-4" /> : <Moon className="w-4 h-4" />}
          </button>

          <Show when="signed-out">
            <Link href="/sign-in">
              <button className="text-sm font-medium text-foreground hover:text-primary transition-colors">
                {language === 'ar' ? 'تسجيل الدخول' : 'Sign in'}
              </button>
            </Link>
            <Link href="/sign-up">
              <Button className="bg-accent text-primary hover:bg-accent/90 font-semibold px-6 shadow-sm border-0">
                {t("nav.join")}
              </Button>
            </Link>
          </Show>

          <Show when="signed-in">
            <UserMenu />
          </Show>
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

            <button
              onClick={toggleTheme}
              className="flex items-center gap-2 text-base font-medium text-foreground py-2"
            >
              {theme === 'dark' ? <Sun className="w-5 h-5" /> : <Moon className="w-5 h-5" />}
              <span>
                {theme === 'dark'
                  ? (language === 'ar' ? 'الوضع الفاتح' : 'Light mode')
                  : (language === 'ar' ? 'الوضع الليلي' : 'Dark mode')}
              </span>
            </button>

            <Show when="signed-out">
              <Link href="/sign-in" onClick={() => setMobileMenuOpen(false)}>
                <Button variant="outline" className="w-full py-5 text-base">
                  {language === 'ar' ? 'تسجيل الدخول' : 'Sign in'}
                </Button>
              </Link>
              <Link href="/sign-up" onClick={() => setMobileMenuOpen(false)}>
                <Button className="bg-accent text-primary hover:bg-accent/90 font-bold w-full py-6 text-lg border-0">
                  {t("nav.join")}
                </Button>
              </Link>
            </Show>

            <Show when="signed-in">
              <Link href="/dashboard" onClick={() => setMobileMenuOpen(false)}>
                <Button className="bg-primary text-white w-full py-5 text-base">
                  <LayoutDashboard className="w-4 h-4 me-2" />
                  {language === 'ar' ? 'لوحة التحكم' : 'Dashboard'}
                </Button>
              </Link>
              <SignOutButton onDone={() => setMobileMenuOpen(false)} fullWidth />
            </Show>
          </div>
        </div>
      )}
    </header>
  );
}

function UserMenu() {
  const { user } = useUser();
  const [open, setOpen] = useState(false);
  const initials = `${user?.firstName?.[0] ?? ""}${user?.lastName?.[0] ?? ""}`.toUpperCase() || "U";
  return (
    <div className="relative">
      <button
        onClick={() => setOpen((o) => !o)}
        className="flex items-center gap-2 p-1 rounded-full hover:bg-muted transition-colors"
      >
        {user?.imageUrl ? (
          <img src={user.imageUrl} alt="" className="w-9 h-9 rounded-full object-cover" />
        ) : (
          <div className="w-9 h-9 rounded-full bg-primary text-white flex items-center justify-center text-sm font-bold">
            {initials}
          </div>
        )}
      </button>
      {open && (
        <>
          <div className="fixed inset-0 z-40" onClick={() => setOpen(false)} />
          <div className="absolute end-0 mt-2 w-56 bg-white border rounded-lg shadow-lg z-50 py-1">
            <div className="px-4 py-2 border-b">
              <p className="text-sm font-semibold truncate">{user?.firstName ?? user?.username}</p>
              <p className="text-xs text-muted-foreground truncate">
                {user?.primaryEmailAddress?.emailAddress}
              </p>
            </div>
            <Link href="/dashboard" onClick={() => setOpen(false)} className="flex items-center gap-2 px-4 py-2 text-sm hover:bg-muted">
              <LayoutDashboard className="w-4 h-4" /> Dashboard
            </Link>
            <Link href="/profile" onClick={() => setOpen(false)} className="flex items-center gap-2 px-4 py-2 text-sm hover:bg-muted">
              <UserCircle className="w-4 h-4" /> {user?.firstName ? "Edit profile" : "Profile"}
            </Link>
            <SignOutButton onDone={() => setOpen(false)} />
          </div>
        </>
      )}
    </div>
  );
}

function SignOutButton({ onDone, fullWidth }: { onDone?: () => void; fullWidth?: boolean }) {
  const { signOut } = useClerk();
  const [, navigate] = useLocation();
  return (
    <button
      onClick={async () => {
        onDone?.();
        await signOut();
        navigate("/");
      }}
      className={cn(
        "flex items-center gap-2 text-sm text-destructive hover:bg-muted",
        fullWidth ? "w-full justify-center py-3 rounded-md border border-destructive/30" : "px-4 py-2 w-full text-start",
      )}
    >
      <LogOut className="w-4 h-4" /> Sign out
    </button>
  );
}
