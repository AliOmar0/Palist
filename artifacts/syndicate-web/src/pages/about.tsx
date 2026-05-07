import { Layout } from "@/components/layout/Layout";
import { useLanguage } from "@/lib/language-context";
import { motion } from "framer-motion";
import { Target, Eye, Award, CheckCircle } from "lucide-react";

export default function About() {
  const { t, language } = useLanguage();

  return (
    <Layout>
      <div className="bg-primary/5 py-12 border-b">
        <div className="container mx-auto px-4 md:px-6">
          <h1 className="text-3xl md:text-4xl font-bold text-foreground mb-4">
            {language === 'ar' ? 'عن النقابة' : 'About the Syndicate'}
          </h1>
          <p className="text-muted-foreground max-w-2xl text-lg">
            {language === 'ar' 
              ? 'نقابة تكنولوجيا المعلومات الفلسطينية هي المظلة الوطنية التي تجمع المهندسين والمطورين والمحترفين في قطاع تكنولوجيا المعلومات، للارتقاء بالمهنة والدفاع عن حقوق منتسبيها.'
              : 'The Palestinian IT Syndicate is the national umbrella gathering engineers, developers, and professionals in the IT sector, to elevate the profession and defend the rights of its members.'}
          </p>
        </div>
      </div>

      <div className="container mx-auto px-4 md:px-6 py-16">
        <div className="grid grid-cols-1 md:grid-cols-2 gap-12">
          
          <motion.div 
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            className="space-y-8"
          >
            <div>
              <div className="flex items-center gap-3 mb-4">
                <div className="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary">
                  <Target className="w-6 h-6" />
                </div>
                <h2 className="text-2xl font-bold text-foreground">
                  {language === 'ar' ? 'رسالتنا' : 'Our Mission'}
                </h2>
              </div>
              <p className="text-muted-foreground leading-relaxed">
                {language === 'ar' 
                  ? 'تمكين محترفي تكنولوجيا المعلومات في فلسطين، وتوفير بيئة داعمة وحاضنة للإبداع والابتكار، وتعزيز دور التكنولوجيا في التنمية المستدامة، مع حماية حقوق ومكتسبات الأعضاء وتطوير قدراتهم المهنية بما يتواكب مع التطورات العالمية.'
                  : 'Empowering IT professionals in Palestine, providing a supportive environment for creativity and innovation, and enhancing the role of technology in sustainable development, while protecting members\' rights and developing their professional capabilities in line with global advancements.'}
              </p>
            </div>

            <div>
              <div className="flex items-center gap-3 mb-4">
                <div className="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary">
                  <Eye className="w-6 h-6" />
                </div>
                <h2 className="text-2xl font-bold text-foreground">
                  {language === 'ar' ? 'رؤيتنا' : 'Our Vision'}
                </h2>
              </div>
              <p className="text-muted-foreground leading-relaxed">
                {language === 'ar'
                  ? 'أن نكون النقابة الرائدة إقليمياً في قيادة التحول الرقمي وبناء مجتمع معرفي متطور، من خلال كفاءات وطنية قادرة على المنافسة عالمياً.'
                  : 'To be the leading regional syndicate in driving digital transformation and building an advanced knowledge society, through national competencies capable of global competition.'}
              </p>
            </div>
          </motion.div>

          <motion.div 
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 0.2 }}
            className="bg-muted/40 rounded-2xl p-8 border"
          >
            <h2 className="text-2xl font-bold text-foreground mb-6">
              {language === 'ar' ? 'أهدافنا الاستراتيجية' : 'Strategic Goals'}
            </h2>
            <ul className="space-y-4">
              {[
                language === 'ar' ? 'تنظيم ومأسسة العمل في قطاع تكنولوجيا المعلومات.' : 'Organizing and institutionalizing work in the IT sector.',
                language === 'ar' ? 'الدفاع عن حقوق ومصالح الأعضاء وتقديم الاستشارات القانونية.' : 'Defending the rights and interests of members and providing legal consultations.',
                language === 'ar' ? 'تطوير كفاءة الأعضاء من خلال برامج تدريبية متخصصة.' : 'Developing members\' efficiency through specialized training programs.',
                language === 'ar' ? 'المساهمة في صياغة السياسات والقوانين المتعلقة بالقطاع التكنولوجي.' : 'Contributing to the drafting of policies and laws related to the tech sector.',
                language === 'ar' ? 'بناء شراكات استراتيجية مع المؤسسات المحلية والدولية.' : 'Building strategic partnerships with local and international institutions.',
              ].map((goal, i) => (
                <li key={i} className="flex items-start gap-3">
                  <CheckCircle className="w-6 h-6 text-secondary shrink-0 mt-0.5" />
                  <span className="text-muted-foreground leading-relaxed">{goal}</span>
                </li>
              ))}
            </ul>
          </motion.div>
        </div>

        <div className="mt-20">
          <h2 className="text-3xl font-bold text-center text-foreground mb-12 relative inline-block left-1/2 -translate-x-1/2">
            {language === 'ar' ? 'مجلس النقابة' : 'Syndicate Council'}
            <span className="absolute -bottom-4 left-1/4 w-1/2 h-1 bg-primary rounded-t-md"></span>
          </h2>
          
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            {[
              { name: language === 'ar' ? 'م. أحمد خالد' : 'Eng. Ahmad Khaled', role: language === 'ar' ? 'نقيب تكنولوجيا المعلومات' : 'Syndicate President' },
              { name: language === 'ar' ? 'د. سارة محمود' : 'Dr. Sarah Mahmoud', role: language === 'ar' ? 'نائب النقيب' : 'Vice President' },
              { name: language === 'ar' ? 'م. طارق عمر' : 'Eng. Tariq Omar', role: language === 'ar' ? 'أمين السر' : 'Secretary General' },
              { name: language === 'ar' ? 'أ. لينا حسن' : 'Ms. Lina Hassan', role: language === 'ar' ? 'أمين الصندوق' : 'Treasurer' },
            ].map((member, i) => (
              <div key={i} className="bg-card border rounded-xl p-6 text-center hover:shadow-md transition-shadow">
                <div className="w-24 h-24 rounded-full bg-muted mx-auto mb-4 border-2 border-primary/10 flex items-center justify-center text-primary/30">
                  <Award className="w-10 h-10" />
                </div>
                <h3 className="font-bold text-lg text-foreground">{member.name}</h3>
                <p className="text-sm text-muted-foreground">{member.role}</p>
              </div>
            ))}
          </div>
        </div>
      </div>
    </Layout>
  );
}
