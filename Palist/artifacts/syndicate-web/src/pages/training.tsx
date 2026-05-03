import { Layout } from "@/components/layout/Layout";
import { useLanguage } from "@/lib/language-context";
import { Button } from "@/components/ui/button";
import { BookOpen, Monitor, Award, Users } from "lucide-react";

export default function Training() {
  const { language } = useLanguage();

  const programs = [
    {
      id: 1,
      title: language === 'ar' ? 'دورة المطور المحترف الواجهات الأمامية (React & Vite)' : 'Professional Frontend Developer (React & Vite)',
      type: language === 'ar' ? 'وجاهي' : 'In-person',
      duration: language === 'ar' ? '60 ساعة' : '60 Hours',
      level: language === 'ar' ? 'متقدم' : 'Advanced',
      desc: language === 'ar' ? 'بناء تطبيقات ويب حديثة بأداء عالي باستخدام أحدث تقنيات الواجهات الأمامية.' : 'Build modern, high-performance web applications using the latest frontend technologies.',
      price: '500 ILS',
      discount: '30% for Members'
    },
    {
      id: 2,
      title: language === 'ar' ? 'أمن المعلومات والشبكات' : 'Information Security & Networks',
      type: language === 'ar' ? 'مدمج' : 'Hybrid',
      duration: language === 'ar' ? '40 ساعة' : '40 Hours',
      level: language === 'ar' ? 'متوسط' : 'Intermediate',
      desc: language === 'ar' ? 'أساسيات حماية البيانات والشبكات المؤسسية والتعرف على الثغرات الشائعة وكيفية سدها.' : 'Fundamentals of data and corporate network protection, identifying common vulnerabilities.',
      price: '400 ILS',
      discount: 'Free for Full Members'
    },
    {
      id: 3,
      title: language === 'ar' ? 'إدارة المشاريع الرشيقة (Agile/Scrum)' : 'Agile Project Management',
      type: language === 'ar' ? 'أونلاين' : 'Online',
      duration: language === 'ar' ? '20 ساعة' : '20 Hours',
      level: language === 'ar' ? 'مبتدئ' : 'Beginner',
      desc: language === 'ar' ? 'مبادئ الإدارة الرشيقة للمشاريع التكنولوجية وكيفية تطبيق إطار سكروم بفعالية.' : 'Principles of agile management for tech projects and how to effectively apply the Scrum framework.',
      price: '200 ILS',
      discount: '50% for Members'
    }
  ];

  return (
    <Layout>
      <div className="bg-primary/5 py-12 border-b">
        <div className="container mx-auto px-4 md:px-6">
          <h1 className="text-3xl md:text-4xl font-bold text-foreground mb-4">
            {language === 'ar' ? 'التدريب وبناء القدرات' : 'Training & Capacity Building'}
          </h1>
          <p className="text-muted-foreground max-w-2xl text-lg">
            {language === 'ar' 
              ? 'برامج تدريبية متخصصة ومعتمدة لتطوير مهاراتك التقنية والقيادية لتواكب متطلبات سوق العمل المتسارعة.'
              : 'Specialized and certified training programs to develop your technical and leadership skills to keep up with the fast-paced job market.'}
          </p>
        </div>
      </div>

      <div className="container mx-auto px-4 md:px-6 py-16">
        
        {/* Stats */}
        <div className="grid grid-cols-2 md:grid-cols-4 gap-4 mb-16">
          {[
            { icon: Users, num: '+5000', label: language === 'ar' ? 'متدرب' : 'Trainees' },
            { icon: BookOpen, num: '+120', label: language === 'ar' ? 'برنامج تدريبي' : 'Training Programs' },
            { icon: Award, num: '45', label: language === 'ar' ? 'مدرب معتمد' : 'Certified Trainers' },
            { icon: Monitor, num: '10', label: language === 'ar' ? 'مختبرات مجهزة' : 'Equipped Labs' },
          ].map((stat, i) => (
            <div key={i} className="bg-white border rounded-xl p-6 text-center shadow-sm">
              <stat.icon className="w-8 h-8 text-secondary mx-auto mb-3" />
              <div className="text-2xl font-bold text-primary mb-1" dir="ltr">{stat.num}</div>
              <div className="text-sm text-muted-foreground font-medium">{stat.label}</div>
            </div>
          ))}
        </div>

        <h2 className="text-2xl font-bold text-foreground mb-8">
          {language === 'ar' ? 'البرامج المتاحة للتسجيل' : 'Available Programs'}
        </h2>

        <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
          {programs.map((prog) => (
            <div key={prog.id} className="bg-white border rounded-2xl overflow-hidden shadow-sm flex flex-col">
              <div className="p-6 flex-1 flex flex-col">
                <div className="flex gap-2 mb-4">
                  <span className="bg-blue-100 text-blue-700 text-xs font-bold px-2.5 py-1 rounded-md">{prog.type}</span>
                  <span className="bg-gray-100 text-gray-700 text-xs font-bold px-2.5 py-1 rounded-md">{prog.level}</span>
                </div>
                <h3 className="text-xl font-bold text-foreground mb-3">{prog.title}</h3>
                <p className="text-muted-foreground text-sm leading-relaxed mb-6 flex-1">{prog.desc}</p>
                
                <div className="bg-gray-50 rounded-xl p-4 mb-6">
                  <div className="flex justify-between items-center mb-2">
                    <span className="text-sm text-muted-foreground">{language === 'ar' ? 'المدة' : 'Duration'}</span>
                    <span className="font-bold text-sm">{prog.duration}</span>
                  </div>
                  <div className="flex justify-between items-center mb-2">
                    <span className="text-sm text-muted-foreground">{language === 'ar' ? 'الرسوم' : 'Price'}</span>
                    <span className="font-bold text-sm" dir="ltr">{prog.price}</span>
                  </div>
                  <div className="flex justify-between items-center">
                    <span className="text-sm text-secondary font-bold bg-secondary/10 px-2 py-0.5 rounded">{prog.discount}</span>
                  </div>
                </div>

                <Button className="w-full bg-primary text-primary-foreground hover:bg-primary/90 font-bold">
                  {language === 'ar' ? 'التسجيل في الدورة' : 'Register for Course'}
                </Button>
              </div>
            </div>
          ))}
        </div>
      </div>
    </Layout>
  );
}
