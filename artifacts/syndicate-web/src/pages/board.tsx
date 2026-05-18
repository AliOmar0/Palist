import { Layout } from "@/components/layout/Layout";
import { useLanguage } from "@/lib/language-context";
import { useQuery } from "@tanstack/react-query";
import { apiFetch } from "@/lib/queryClient";
import { motion } from "framer-motion";
import { Mail, User } from "lucide-react";

interface BoardMember {
  id: number;
  nameAr: string;
  nameEn: string | null;
  positionAr: string | null;
  positionEn: string | null;
  email: string | null;
  photoUrl: string | null;
  bioAr: string | null;
  bioEn: string | null;
  displayOrder: number;
  active: boolean;
}

export default function Board() {
  const { language } = useLanguage();
  const isAr = language === "ar";
  const { data, isLoading } = useQuery<BoardMember[]>({
    queryKey: ["board-members"],
    queryFn: () => apiFetch("/api/board-members"),
  });

  return (
    <Layout>
      <div className="bg-primary/5 py-12 border-b">
        <div className="container mx-auto px-4 md:px-6">
          <p className="text-xs font-bold text-secondary uppercase tracking-widest mb-2">
            {isAr ? "النقابة" : "Syndicate"}
          </p>
          <h1 className="text-3xl md:text-4xl font-bold text-foreground mb-4">
            {isAr ? "مجلس الإدارة" : "Board of Directors"}
          </h1>
          <p className="text-muted-foreground max-w-2xl text-lg">
            {isAr
              ? "تعرّف على أعضاء مجلس إدارة نقابة العلوم المعلوماتية التكنولوجية الفلسطينية."
              : "Meet the members of the Board of Directors of the Palestinian IT Syndicate."}
          </p>
        </div>
      </div>

      <div className="container mx-auto px-4 md:px-6 py-16">
        {isLoading && (
          <p className="text-muted-foreground">{isAr ? "جاري التحميل..." : "Loading..."}</p>
        )}
        {!isLoading && (data?.length ?? 0) === 0 && (
          <p className="text-muted-foreground">
            {isAr ? "لم يتم نشر أعضاء مجلس الإدارة بعد." : "Board members will be announced soon."}
          </p>
        )}
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          {data?.map((m, i) => (
            <motion.article
              key={m.id}
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ delay: i * 0.05 }}
              className="bg-card rounded-xl border overflow-hidden shadow-sm hover:shadow-md transition-shadow"
            >
              <div className="aspect-[4/3] bg-muted/40 flex items-center justify-center overflow-hidden">
                {m.photoUrl ? (
                  <img
                    src={m.photoUrl}
                    alt={isAr ? m.nameAr : m.nameEn ?? m.nameAr}
                    className="w-full h-full object-cover"
                  />
                ) : (
                  <User className="w-16 h-16 text-muted-foreground/40" />
                )}
              </div>
              <div className="p-5">
                <h3 className="text-lg font-bold text-foreground">
                  {isAr ? m.nameAr : m.nameEn ?? m.nameAr}
                </h3>
                {(m.positionAr || m.positionEn) && (
                  <p className="text-sm text-primary font-medium mt-1">
                    {isAr ? m.positionAr ?? m.positionEn : m.positionEn ?? m.positionAr}
                  </p>
                )}
                {(m.bioAr || m.bioEn) && (
                  <p className="text-sm text-muted-foreground mt-3 leading-relaxed line-clamp-4">
                    {isAr ? m.bioAr ?? m.bioEn : m.bioEn ?? m.bioAr}
                  </p>
                )}
                {m.email && (
                  <a
                    href={`mailto:${m.email}`}
                    className="inline-flex items-center gap-2 text-sm text-primary hover:underline mt-4"
                  >
                    <Mail className="w-4 h-4" />
                    {m.email}
                  </a>
                )}
              </div>
            </motion.article>
          ))}
        </div>
      </div>
    </Layout>
  );
}
