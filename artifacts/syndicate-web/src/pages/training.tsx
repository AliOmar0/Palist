import { useQuery } from "@tanstack/react-query";
import { Link } from "wouter";
import { Layout } from "@/components/layout/Layout";
import { useLanguage } from "@/lib/language-context";
import { Button } from "@/components/ui/button";
import { BookOpen, Monitor, Award, Users, Lightbulb } from "lucide-react";
import { apiFetch } from "@/lib/queryClient";

interface TrainingRow {
  id: number;
  titleAr: string;
  titleEn: string | null;
  descriptionAr: string | null;
  descriptionEn: string | null;
  coverImage: string | null;
  category: string | null;
  durationHours: number | null;
  startsAt: string | null;
  registrationUrl: string | null;
}

export default function Training() {
  const { language } = useLanguage();
  const isAr = language === "ar";

  const { data: programs = [], isLoading, isError } = useQuery<TrainingRow[]>({
    queryKey: ["trainings"],
    queryFn: () => apiFetch<TrainingRow[]>("/api/trainings"),
  });

  return (
    <Layout>
      <div className="bg-primary/5 py-12 border-b">
        <div className="container mx-auto px-4 md:px-6">
          <h1 className="text-3xl md:text-4xl font-bold text-foreground mb-4">
            {isAr ? "التدريب وبناء القدرات" : "Training & Capacity Building"}
          </h1>
          <p className="text-muted-foreground max-w-2xl text-lg">
            {isAr
              ? "برامج تدريبية متخصصة ومعتمدة لتطوير مهاراتك التقنية والقيادية لتواكب متطلبات سوق العمل."
              : "Specialized and certified training programs to develop your technical and leadership skills."}
          </p>
        </div>
      </div>

      <div className="container mx-auto px-4 md:px-6 py-16">
        <div className="grid grid-cols-2 md:grid-cols-4 gap-4 mb-16">
          {[
            { icon: Users, num: "+5000", label: isAr ? "متدرب" : "Trainees" },
            { icon: BookOpen, num: String(programs.length), label: isAr ? "برنامج متاح" : "Available programs" },
            { icon: Award, num: "45", label: isAr ? "مدرب معتمد" : "Certified trainers" },
            { icon: Monitor, num: "10", label: isAr ? "مختبرات مجهزة" : "Equipped labs" },
          ].map((stat) => (
            <div key={stat.label} className="bg-card border rounded-lg p-6 text-center shadow-sm">
              <stat.icon className="w-8 h-8 text-secondary mx-auto mb-3" />
              <div className="text-2xl font-bold text-primary mb-1" dir="ltr">{stat.num}</div>
              <div className="text-sm text-muted-foreground font-medium">{stat.label}</div>
            </div>
          ))}
        </div>

        <h2 className="text-2xl font-bold text-foreground mb-8">
          {isAr ? "البرامج المتاحة للتسجيل" : "Available Training Programs"}
        </h2>

        {isLoading && (
          <p className="text-center text-muted-foreground py-12">
            {isAr ? "جاري تحميل البرامج التدريبية..." : "Loading training programs..."}
          </p>
        )}
        {isError && (
          <p className="text-center text-destructive py-12">
            {isAr ? "تعذّر تحميل البرامج التدريبية." : "Could not load training programs."}
          </p>
        )}
        {!isLoading && !isError && programs.length === 0 && (
          <div className="rounded-lg border bg-card p-8 text-center">
            <Lightbulb className="mx-auto mb-3 h-10 w-10 text-secondary" />
            <h3 className="text-xl font-bold text-foreground">
              {isAr ? "لا توجد برامج تدريبية متاحة حالياً" : "No training programs are available right now"}
            </h3>
            <p className="mx-auto mt-2 max-w-xl text-sm text-muted-foreground">
              {isAr
                ? "ما اقتراحاتك للتدريب؟ شاركنا المهارات أو المواضيع التي تحتاجها وسنأخذها بعين الاعتبار في الخطة القادمة."
                : "What training would you suggest? Share the skills or topics you need and we will consider them for the next plan."}
            </p>
            <Link href="/contact">
              <Button className="mt-5 bg-accent text-primary hover:bg-accent/90 font-semibold">
                {isAr ? "إرسال اقتراح تدريب" : "Send a training suggestion"}
              </Button>
            </Link>
          </div>
        )}

        <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
          {programs.map((program) => {
            const title = isAr ? program.titleAr : program.titleEn || program.titleAr;
            const desc = isAr
              ? program.descriptionAr
              : program.descriptionEn || program.descriptionAr;
            return (
              <article key={program.id} className="bg-card border rounded-lg overflow-hidden shadow-sm flex flex-col">
                {program.coverImage && (
                  <img src={program.coverImage} alt={title} className="h-48 w-full object-cover" />
                )}
                <div className="p-6 flex-1 flex flex-col">
                  <div className="flex flex-wrap gap-2 mb-4">
                    {program.category && (
                      <span className="bg-primary/10 text-primary text-xs font-bold px-2.5 py-1 rounded-md">
                        {program.category}
                      </span>
                    )}
                    {program.startsAt && (
                      <span className="bg-muted text-muted-foreground text-xs font-bold px-2.5 py-1 rounded-md">
                        {new Date(program.startsAt).toLocaleDateString(isAr ? "ar" : "en")}
                      </span>
                    )}
                  </div>
                  <h3 className="text-xl font-bold text-foreground mb-3">{title}</h3>
                  {desc && <p className="text-muted-foreground text-sm leading-relaxed mb-6 flex-1">{desc}</p>}
                  <div className="bg-muted/40 rounded-md p-4 mb-6">
                    <div className="flex justify-between items-center">
                      <span className="text-sm text-muted-foreground">{isAr ? "المدة" : "Duration"}</span>
                      <span className="font-bold text-sm">
                        {program.durationHours
                          ? isAr ? `${program.durationHours} ساعة` : `${program.durationHours} hours`
                          : isAr ? "تعلن لاحقاً" : "To be announced"}
                      </span>
                    </div>
                  </div>

                  {program.registrationUrl ? (
                    <a href={program.registrationUrl} target="_blank" rel="noreferrer">
                      <Button className="w-full bg-primary text-primary-foreground hover:bg-primary/90 font-bold">
                        {isAr ? "التسجيل في الدورة" : "Register for course"}
                      </Button>
                    </a>
                  ) : (
                    <Button disabled className="w-full">
                      {isAr ? "التسجيل يعلن لاحقاً" : "Registration opens soon"}
                    </Button>
                  )}
                </div>
              </article>
            );
          })}
        </div>
      </div>
    </Layout>
  );
}
