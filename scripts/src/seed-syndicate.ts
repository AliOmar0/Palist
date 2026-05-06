import {
  db,
  newsTable,
  eventsTable,
  trainingsTable,
  publicationsTable,
} from "@workspace/db";

function pickArEn(value: string | null | undefined): { ar: string; en: string } {
  if (!value) return { ar: "", en: "" };
  const parts = value.split("<>");
  return { en: (parts[0] ?? "").trim(), ar: (parts[1] ?? "").trim() };
}

async function main() {
  console.log("Seeding initial syndicate content...");

  const news = [
    {
      titleAr: "النقابة تطلق البرنامج التدريبي الوطني لتأهيل مطوري البرمجيات",
      titleEn: "Syndicate launches national training program for software developers",
      summaryAr:
        "في إطار جهودها للارتقاء بالكفاءات الوطنية، أعلنت نقابة تكنولوجيا المعلومات عن إطلاق برنامج تدريبي بالتعاون مع كبرى الشركات.",
      summaryEn:
        "As part of its efforts to elevate national competencies, the IT Syndicate announced a training program in collaboration with major tech companies.",
      contentAr: "تفاصيل البرنامج ستُعلن لاحقاً عبر القنوات الرسمية للنقابة.",
      contentEn: "Program details will be announced via the syndicate's official channels.",
      category: "announcements",
    },
    {
      titleAr: "اجتماع مجلس النقابة يناقش لائحة العضوية الجديدة",
      titleEn: "Syndicate council meets to discuss new membership regulations",
      summaryAr: "ناقش مجلس النقابة تحديث لائحة العضوية لمواكبة التطور المهني في القطاع.",
      summaryEn: "The council discussed updating the membership regulations to keep pace with professional development.",
      category: "council",
    },
    {
      titleAr: "شراكة استراتيجية مع جامعات فلسطينية لتعزيز التعليم التقني",
      titleEn: "Strategic partnership with Palestinian universities to advance technical education",
      summaryAr: "وقّعت النقابة مذكرات تفاهم مع عدد من الجامعات لتطوير المناهج التقنية.",
      summaryEn: "The syndicate signed MoUs with several universities to develop technical curricula.",
      category: "partnerships",
    },
  ];

  const events = [
    {
      titleAr: "مؤتمر فلسطين لتكنولوجيا المعلومات 2026",
      titleEn: "Palestine IT Conference 2026",
      descriptionAr: "المؤتمر السنوي لقطاع تكنولوجيا المعلومات في فلسطين.",
      descriptionEn: "The annual conference for Palestine's IT sector.",
      location: "رام الله / Ramallah",
      startsAt: new Date("2026-09-12T09:00:00Z"),
      endsAt: new Date("2026-09-13T17:00:00Z"),
    },
    {
      titleAr: "ورشة الذكاء الاصطناعي للمحترفين",
      titleEn: "AI for Professionals Workshop",
      descriptionAr: "ورشة عملية حول تطبيقات الذكاء الاصطناعي في بيئة العمل.",
      descriptionEn: "Hands-on workshop on AI applications in the workplace.",
      location: "نابلس / Nablus",
      startsAt: new Date("2026-07-20T10:00:00Z"),
    },
  ];

  const trainings = [
    {
      titleAr: "تطوير الويب الكامل (Full-Stack)",
      titleEn: "Full-Stack Web Development",
      descriptionAr: "برنامج تدريبي شامل لتطوير تطبيقات الويب باستخدام أحدث التقنيات.",
      descriptionEn: "Comprehensive program for building modern web applications.",
      category: "development",
      durationHours: 120,
    },
    {
      titleAr: "أمن المعلومات للمختصين",
      titleEn: "Cybersecurity for Specialists",
      descriptionAr: "تدريب متقدم في مجال أمن المعلومات والاختبار الأخلاقي.",
      descriptionEn: "Advanced training in information security and ethical hacking.",
      category: "security",
      durationHours: 80,
    },
    {
      titleAr: "تحليل البيانات وعلوم البيانات",
      titleEn: "Data Analytics & Data Science",
      descriptionAr: "تعلّم كيفية استخلاص القيمة من البيانات باستخدام Python و SQL.",
      descriptionEn: "Learn to extract value from data using Python and SQL.",
      category: "data",
      durationHours: 100,
    },
  ];

  const publications = [
    {
      titleAr: "التقرير السنوي لعام 2024",
      titleEn: "Annual Report 2024",
      summaryAr: "نظرة شاملة على إنجازات النقابة وأنشطتها خلال عام 2024.",
      summaryEn: "A comprehensive overview of the syndicate's achievements during 2024.",
      category: "annual-report",
    },
    {
      titleAr: "دليل العضوية وحقوق المنتسبين",
      titleEn: "Membership Guide & Rights",
      summaryAr: "دليل تفصيلي لحقوق وواجبات أعضاء النقابة.",
      summaryEn: "A detailed guide to the rights and duties of syndicate members.",
      category: "guide",
    },
  ];

  await db.insert(newsTable).values(news).onConflictDoNothing();
  await db.insert(eventsTable).values(events).onConflictDoNothing();
  await db.insert(trainingsTable).values(trainings).onConflictDoNothing();
  await db.insert(publicationsTable).values(publications).onConflictDoNothing();

  console.log(`Inserted ${news.length} news, ${events.length} events, ${trainings.length} trainings, ${publications.length} publications.`);
  process.exit(0);
}

main().catch((err) => {
  console.error(err);
  process.exit(1);
});

// Used by tooling to satisfy the workspace package import — keeps pickArEn used.
void pickArEn;
