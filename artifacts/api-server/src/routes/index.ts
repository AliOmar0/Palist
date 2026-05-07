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

export default router;
