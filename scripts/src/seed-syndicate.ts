import {
  db,
  newsTable,
  eventsTable,
  trainingsTable,
  publicationsTable,
} from "@workspace/db";

async function main() {
  console.log("Seeding initial syndicate content (real titles from pis.ps)...");

  // Idempotency: serial PKs mean onConflictDoNothing won't help.
  // Skip seeding entirely if any news row already exists.
  const existing = await db.select({ id: newsTable.id }).from(newsTable).limit(1);
  if (existing.length > 0) {
    console.log("News already present — skipping seed (run after wiping tables to re-seed).");
    process.exit(0);
  }

  // Real news taken from the PHP/SQL export of palist.ps (palist_legion dump).
  const news = [
    {
      titleAr: "لقاء مع موظفي وزارة الاتصالات وتكنولوجيا المعلومات وانتخاب جهات الاتصال",
      titleEn: "Meeting with Ministry of Telecom & IT staff and election of liaison officers",
      summaryAr:
        "بمبادرة من موظفي وزارة الاتصالات وتكنولوجيا المعلومات، جرت انتخابات لاختيار جهات تواصل رسمية بين الوزارة ونقابة العلوم المعلوماتية التكنولوجية الفلسطينية، بحضور معالي الوزير د.م. اسحاق سدر ونقيب المعلوماتية د. ميسون إبراهيم.",
      summaryEn:
        "Staff of the Palestinian Ministry of Telecom & IT held elections to choose official liaison officers between the ministry and the Palestinian IT Syndicate, attended by Minister Dr. Ishaq Sider and Syndicate President Dr. Maysoon Ibrahim.",
      category: "partnerships",
    },
    {
      titleAr: "البنك العربي ونقابة العلوم المعلوماتية التكنولوجية الفلسطينية يوقعان اتفاقية تعاون",
      titleEn: "Arab Bank and the Palestinian IT Syndicate sign a cooperation agreement",
      summaryAr:
        "وقّع البنك العربي اتفاقية تعاون مع النقابة لتقديم حزمة من العروض والخدمات المصرفية الشاملة لمنتسبيها، ضمن مزايا برنامج عربي بريميوم للمهنيين.",
      summaryEn:
        "Arab Bank signed a cooperation agreement with the Syndicate to offer members a package of comprehensive banking services as part of the Arabi Premium program for professionals.",
      category: "partnerships",
    },
    {
      titleAr: "توقيع مذكرة تفاهم بين مجموعة مسار العالمية والنقابة في مدينة روابي",
      titleEn: "MoU signed between Massar International Group and the Syndicate in Rawabi",
      summaryAr:
        "وقّعت مجموعة مسار العالمية ونقابة العلوم المعلوماتية التكنولوجية مذكرة تفاهم للتعاون في الأنشطة المشتركة في مجال التكنولوجيا والعلوم المعلوماتية، بحضور بشار المصري ود. ميسون إبراهيم.",
      summaryEn:
        "Massar International Group and the Palestinian IT Syndicate signed an MoU to cooperate on joint activities in technology and informatics, attended by Bashar Al-Masri and Dr. Maysoon Ibrahim.",
      category: "partnerships",
    },
    {
      titleAr: "توقيع اتفاقية تعاون مشترك بين النقابة وجامعة القدس المفتوحة",
      titleEn: "Joint cooperation agreement signed between the Syndicate and Al-Quds Open University",
      summaryAr:
        "وقّعت النقابة وجامعة القدس المفتوحة اتفاقية لتطوير التعاون العلمي والأكاديمي عبر بحوث مشتركة، مؤتمرات، وورش عمل، إلى جانب برامج ونشاطات مشتركة.",
      summaryEn:
        "The Syndicate and Al-Quds Open University signed an agreement to develop scientific and academic cooperation through joint research, conferences, workshops, and joint programs.",
      category: "partnerships",
    },
    {
      titleAr: "النقابة تطلق البرنامج التدريبي الوطني لتأهيل مطوري البرمجيات",
      titleEn: "Syndicate launches national training program for software developers",
      summaryAr:
        "في إطار جهودها للارتقاء بالكفاءات الوطنية، أعلنت النقابة عن إطلاق برنامج تدريبي بالتعاون مع كبرى الشركات.",
      summaryEn:
        "As part of its efforts to elevate national competencies, the Syndicate announced a training program in collaboration with major tech companies.",
      category: "announcements",
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
