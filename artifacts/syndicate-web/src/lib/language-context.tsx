import React, { createContext, useContext, useState, useEffect } from 'react';

type Language = 'ar' | 'en';

interface LanguageContextType {
  language: Language;
  toggleLanguage: () => void;
  t: (key: string) => string;
}

const translations = {
  ar: {
    // Navigation
    'nav.home': 'الرئيسية',
    'nav.about': 'عن النقابة',
    'nav.membership': 'العضوية',
    'nav.news': 'الأخبار',
    'nav.events': 'الفعاليات',
    'nav.training': 'التدريب',
    'nav.reports': 'التقارير',
    'nav.contact': 'اتصل بنا',
    'nav.join': 'انضم الآن',
    
    // Hero
    'hero.title': 'نُمكّن محترفي تكنولوجيا المعلومات في فلسطين',
    'hero.subtitle': 'النقابة الوطنية التي تجمع، تدعم، وتطور خبراء التكنولوجيا والمعلومات نحو مستقبل رقمي رائد.',
    'hero.primary_cta': 'انضم للنقابة',
    'hero.secondary_cta': 'استكشف الخدمات',
    
    // Services
    'services.membership.title': 'تسجيل العضوية',
    'services.membership.desc': 'انضم إلى شبكة المحترفين واستفد من مزايا العضوية المتعددة.',
    'services.training.title': 'التدريب وورش العمل',
    'services.training.desc': 'برامج متخصصة لتطوير مهاراتك ومواكبة أحدث التقنيات.',
    'services.fund.title': 'صندوق دعم التشغيل',
    'services.fund.desc': 'مبادرات لتعزيز فرص العمل ودعم المشاريع الريادية.',
    'services.legal.title': 'الدعم القانوني والمهني',
    'services.legal.desc': 'استشارات وتوجيهات قانونية لحماية حقوقك المهنية.',
    
    // Sections
    'section.news': 'آخر الأخبار والإعلانات',
    'section.events': 'الفعاليات القادمة',
    'section.reports': 'التقارير والإصدارات',
    'section.quick_access': 'وصول سريع',
    
    // Quick Access
    'quick.regulations': 'الأنظمة والقوانين',
    'quick.requirements': 'شروط العضوية',
    'quick.forms': 'النماذج والتحميلات',
    'quick.directory': 'دليل الأعضاء',
    
    // Footer
    'footer.about': 'نقابة تكنولوجيا المعلومات الفلسطينية هي المظلة الوطنية التي تجمع خبراء ومحترفي قطاع تكنولوجيا المعلومات في فلسطين.',
    'footer.contact': 'معلومات التواصل',
    'footer.links': 'روابط سريعة',
    'footer.rights': 'جميع الحقوق محفوظة © 2025 نقابة تكنولوجيا المعلومات الفلسطينية.',
  },
  en: {
    // Navigation
    'nav.home': 'Home',
    'nav.about': 'About',
    'nav.membership': 'Membership',
    'nav.news': 'News',
    'nav.events': 'Events',
    'nav.training': 'Training',
    'nav.reports': 'Reports',
    'nav.contact': 'Contact',
    'nav.join': 'Join Now',
    
    // Hero
    'hero.title': 'Empowering IT Professionals Across Palestine',
    'hero.subtitle': 'The national syndicate uniting, supporting, and developing tech professionals towards a leading digital future.',
    'hero.primary_cta': 'Join the Syndicate',
    'hero.secondary_cta': 'Explore Services',
    
    // Services
    'services.membership.title': 'Membership Registration',
    'services.membership.desc': 'Join the professional network and benefit from various membership perks.',
    'services.training.title': 'Training & Workshops',
    'services.training.desc': 'Specialized programs to develop your skills and keep up with the latest tech.',
    'services.fund.title': 'Employment Support Fund',
    'services.fund.desc': 'Initiatives to enhance job opportunities and support entrepreneurial projects.',
    'services.legal.title': 'Legal & Professional Support',
    'services.legal.desc': 'Consultations and legal guidance to protect your professional rights.',
    
    // Sections
    'section.news': 'Latest News & Announcements',
    'section.events': 'Upcoming Events',
    'section.reports': 'Reports & Publications',
    'section.quick_access': 'Quick Access',
    
    // Quick Access
    'quick.regulations': 'Regulations & Laws',
    'quick.requirements': 'Membership Requirements',
    'quick.forms': 'Forms & Downloads',
    'quick.directory': 'Member Directory',
    
    // Footer
    'footer.about': 'The Palestinian IT Syndicate is the national umbrella gathering experts and professionals in the IT sector across Palestine.',
    'footer.contact': 'Contact Info',
    'footer.links': 'Quick Links',
    'footer.rights': 'All rights reserved © 2025 Palestinian IT Syndicate.',
  }
};

const LanguageContext = createContext<LanguageContextType | undefined>(undefined);

export function LanguageProvider({ children }: { children: React.ReactNode }) {
  const [language, setLanguage] = useState<Language>('ar');

  useEffect(() => {
    document.documentElement.dir = language === 'ar' ? 'rtl' : 'ltr';
    document.documentElement.lang = language;
  }, [language]);

  const toggleLanguage = () => {
    setLanguage(prev => prev === 'ar' ? 'en' : 'ar');
  };

  const t = (key: string) => {
    return (translations[language] as any)[key] || key;
  };

  return (
    <LanguageContext.Provider value={{ language, toggleLanguage, t }}>
      {children}
    </LanguageContext.Provider>
  );
}

export function useLanguage() {
  const context = useContext(LanguageContext);
  if (context === undefined) {
    throw new Error('useLanguage must be used within a LanguageProvider');
  }
  return context;
}
