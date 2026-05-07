import { Router, type IRouter } from "express";
import healthRouter from "./health";
import meRouter from "./me";
import newsRouter from "./news";
import eventsRouter from "./events";
import trainingsRouter from "./trainings";
import publicationsRouter from "./publications";
import membersRouter from "./members";
import contactRouter from "./contact";
import uploadsRouter from "./uploads";
import jobsRouter from "./jobs";
import newsletterRouter from "./newsletter";
import verifyRouter from "./verify";
import auditRouter from "./audit";

const router: IRouter = Router();

router.use(healthRouter);
router.use(meRouter);
router.use(newsRouter);
router.use(eventsRouter);
router.use(trainingsRouter);
router.use(publicationsRouter);
router.use(membersRouter);
router.use(contactRouter);
router.use(uploadsRouter);
router.use(jobsRouter);
router.use(newsletterRouter);
router.use(verifyRouter);
router.use(auditRouter);

export default router;
