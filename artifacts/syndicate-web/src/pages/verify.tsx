import { useQuery } from "@tanstack/react-query";
import { useRoute } from "wouter";
import { Layout } from "@/components/layout/Layout";
import { useLanguage } from "@/lib/language-context";
import { apiFetch } from "@/lib/queryClient";
import { CheckCircle2, XCircle } from "lucide-react";

interface VerifyResponse {
  fullName: string;
  fullNameEn: string | null;
  membershipTier: string | null;
  membershipNumber: string | null;
  status: string;
  expiresAt: string | null;
  reviewedAt: string | null;
  valid: boolean;
}

export default function Verify() {
  const [, params] = useRoute("/verify/:cardId");
  const cardId = params?.cardId;
  const { language } = useLanguage();
  const isAr = language === "ar";

  const { data, isLoading, isError } = useQuery<VerifyResponse>({
    queryKey: ["verify", cardId],
    queryFn: () => apiFetch<VerifyResponse>(`/api/verify/${cardId}`),
    enabled: Boolean(cardId),
    retry: false,
  });

  return (
    <Layout>
      <div className="container mx-auto px-4 md:px-6 py-16 max-w-xl">
        <h1 className="text-2xl md:text-3xl font-bold mb-8 text-center">
          {isAr ? "التحقّق من بطاقة العضوية" : "Membership card verification"}
        </h1>

        {isLoading && (
          <p className="text-center text-muted-foreground">
            {isAr ? "جاري التحقّق..." : "Verifying..."}
          </p>
        )}

        {(isError || (data && !data.valid)) && (
          <div className="rounded-xl border-2 border-destructive/40 bg-destructive/5 p-8 text-center">
            <XCircle className="w-12 h-12 mx-auto text-destructive mb-3" />
            <p className="font-bold text-lg text-destructive">
              {isAr ? "بطاقة غير صالحة" : "Invalid card"}
            </p>
            <p className="text-sm text-muted-foreground mt-2">
              {isAr
                ? "لم يتم العثور على عضوية معتمدة بهذه البطاقة، أو أنّها منتهية الصلاحية."
                : "No active membership found for this card, or it has expired."}
            </p>
          </div>
        )}

        {data && data.valid && (
          <div className="rounded-xl border-2 border-green-300 bg-green-50/40 p-8 text-center">
            <CheckCircle2 className="w-12 h-12 mx-auto text-green-600 mb-3" />
            <p className="font-bold text-lg text-green-700 mb-4">
              {isAr ? "عضوية صالحة" : "Valid membership"}
            </p>
            <dl className="text-sm text-foreground space-y-2 text-start max-w-sm mx-auto">
              <div className="flex justify-between border-b py-1">
                <dt className="text-muted-foreground">{isAr ? "الاسم" : "Name"}</dt>
                <dd className="font-semibold">{isAr ? data.fullName : data.fullNameEn || data.fullName}</dd>
              </div>
              {data.membershipNumber && (
                <div className="flex justify-between border-b py-1">
                  <dt className="text-muted-foreground">{isAr ? "رقم العضوية" : "Member #"}</dt>
                  <dd className="font-mono">{data.membershipNumber}</dd>
                </div>
              )}
              {data.membershipTier && (
                <div className="flex justify-between border-b py-1">
                  <dt className="text-muted-foreground">{isAr ? "الفئة" : "Tier"}</dt>
                  <dd className="capitalize">{data.membershipTier}</dd>
                </div>
              )}
              {data.expiresAt && (
                <div className="flex justify-between border-b py-1">
                  <dt className="text-muted-foreground">{isAr ? "ينتهي في" : "Expires"}</dt>
                  <dd>
                    {new Date(data.expiresAt).toLocaleDateString(isAr ? "ar" : "en", {
                      year: "numeric",
                      month: "short",
                      day: "numeric",
                    })}
                  </dd>
                </div>
              )}
            </dl>
          </div>
        )}
      </div>
    </Layout>
  );
}
