import { Router, type IRouter } from "express";
import multer from "multer";
import path from "node:path";
import fs from "node:fs";
import crypto from "node:crypto";
import { requireAuth } from "../middlewares/auth";

const UPLOAD_DIR = path.resolve(process.cwd(), "uploads");
fs.mkdirSync(UPLOAD_DIR, { recursive: true });

const ALLOWED_MIME = new Set([
  "image/png",
  "image/jpeg",
  "image/jpg",
  "image/webp",
  "image/gif",
  "image/svg+xml",
]);

const storage = multer.diskStorage({
  destination: (_req, _file, cb) => cb(null, UPLOAD_DIR),
  filename: (_req, file, cb) => {
    const ext = path.extname(file.originalname).toLowerCase().slice(0, 10) || ".bin";
    const id = crypto.randomBytes(12).toString("hex");
    cb(null, `${Date.now()}-${id}${ext}`);
  },
});

const upload = multer({
  storage,
  limits: { fileSize: 5 * 1024 * 1024 },
  fileFilter: (_req, file, cb) => {
    if (ALLOWED_MIME.has(file.mimetype)) cb(null, true);
    else cb(new Error("Unsupported image type"));
  },
});

const router: IRouter = Router();

router.post("/uploads", requireAuth, upload.single("file"), (req, res) => {
  if (!req.file) return res.status(400).json({ error: "No file uploaded" });
  const url = `/api/uploads/${req.file.filename}`;
  return res.status(201).json({ url, filename: req.file.filename, size: req.file.size });
});

router.get("/uploads/:filename", (req, res) => {
  const name = req.params.filename;
  if (!/^[A-Za-z0-9._-]+$/.test(name)) {
    res.status(400).end();
    return;
  }
  const fp = path.join(UPLOAD_DIR, name);
  if (!fp.startsWith(UPLOAD_DIR)) {
    res.status(400).end();
    return;
  }
  if (!fs.existsSync(fp)) {
    res.status(404).end();
    return;
  }
  res.sendFile(fp);
});

export default router;
