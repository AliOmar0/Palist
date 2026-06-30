import { Layout } from "@/components/layout/Layout";
import { useLanguage } from "@/lib/language-context";
import { useQuery } from "@tanstack/react-query";
import { apiFetch } from "@/lib/queryClient";
import { motion } from "framer-motion";
import { Mail, User } from "lucide-react";
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from "@/components/ui/dialog";

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
          {data?.map((m, i) => {
            const name = isAr ? m.nameAr : m.nameEn ?? m.nameAr;
            const position = isAr ? m.positionAr ?? m.positionEn : m.positionEn ?? m.positionAr;
            const bio = isAr ? m.bioAr ?? m.bioEn : m.bioEn ?? m.bioAr;
            return (
              <Dialog key={m.id}>
                <motion.article
                  initial={{ opacity: 0, y: 20 }}
                  animate={{ opacity: 1, y: 0 }}
                  transition={{ delay: i * 0.05 }}
                  className="bg-card rounded-lg border overflow-hidden shadow-sm hover:shadow-md transition-shadow"
                >
                  <DialogTrigger asChild>
                    <button
                      type="button"
                      className="aspect-[4/3] w-full bg-muted/40 flex items-center justify-center overflow-hidden focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary"
                      aria-label={isAr ? `عرض معلومات ${name}` : `View ${name} information`}
                    >
                      {m.photoUrl ? (
                        <img
                          src={m.photoUrl}
                          alt={name}
                          className="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                        />
                      ) : (
                        <User className="w-16 h-16 text-muted-foreground/40" />
                      )}
                    </button>
                  </DialogTrigger>
                  <div className="p-5">
                    <h3 className="text-lg font-bold text-foreground">{name}</h3>
                    {position && (
                      <p className="text-sm text-primary font-medium mt-1">{position}</p>
                    )}
                    {bio && (
                      <p className="text-sm text-muted-foreground mt-3 leading-relaxed line-clamp-4">
                        {bio}
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
                <DialogContent className="max-w-xl">
                  <DialogHeader>
                    <DialogTitle>{name}</DialogTitle>
                    {position && <DialogDescription>{position}</DialogDescription>}
                  </DialogHeader>
                  <div className="grid gap-5 sm:grid-cols-[180px_1fr]">
                    <div className="aspect-square rounded-lg bg-muted/40 overflow-hidden flex items-center justify-center">
                      {m.photoUrl ? (
                        <img src={m.photoUrl} alt={name} className="w-full h-full object-cover" />
                      ) : (
                        <User className="w-14 h-14 text-muted-foreground/40" />
                      )}
                    </div>
                    <div>
                      {bio ? (
                        <p className="text-sm leading-relaxed text-foreground whitespace-pre-wrap">{bio}</p>
                      ) : (
                        <p className="text-sm text-muted-foreground">
                          {isAr ? "لا توجد نبذة منشورة بعد." : "No biography has been published yet."}
                        </p>
                      )}
                      {m.email && (
                        <a
                          href={`mailto:${m.email}`}
                          className="mt-4 inline-flex items-center gap-2 text-sm text-primary hover:underline"
                        >
                          <Mail className="w-4 h-4" />
                          {m.email}
                        </a>
                      )}
                    </div>
                  </div>
                </DialogContent>
              </Dialog>
            );
          })}
        </div>
      </div>
    </Layout>
  );
}
