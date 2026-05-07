import type { Request, Response, NextFunction } from "express";
import { db, adminAuditLogTable } from "@workspace/db";
import type { AuthedRequest } from "./auth";

export function auditAdmin(entityType: string) {
  return function (req: Request, res: Response, next: NextFunction) {
    res.on("finish", () => {
      if (res.statusCode >= 400) return;
      const method = req.method.toUpperCase();
      if (!["POST", "PATCH", "PUT", "DELETE"].includes(method)) return;
      const action = method === "POST" ? "create" : method === "DELETE" ? "delete" : "update";
      const a = req as AuthedRequest;
      const actorUserId = a.userId;
      if (!actorUserId) return;
      const idFromParams = (req.params as { id?: string }).id ?? null;
      const payload =
        req.body && typeof req.body === "object" ? (req.body as Record<string, unknown>) : null;
      db.insert(adminAuditLogTable)
        .values({
          actorUserId,
          actorEmail: null,
          action,
          entityType,
          entityId: idFromParams,
          payload: payload as never,
        })
        .catch(() => {
          /* swallow audit failures */
        });
    });
    next();
  };
}
