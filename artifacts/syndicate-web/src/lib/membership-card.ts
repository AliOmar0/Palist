import { jsPDF } from "jspdf";
import QRCode from "qrcode";

interface CardInput {
  fullName: string;
  fullNameEn?: string | null;
  membershipNumber: string | null;
  membershipTier: string | null;
  cardId: string;
  expiresAt: string | null;
  verifyUrl: string;
}

export async function generateMembershipCardPdf(card: CardInput): Promise<void> {
  const doc = new jsPDF({ orientation: "landscape", unit: "mm", format: [85.6, 54] });

  // background
  doc.setFillColor(0, 73, 83);
  doc.rect(0, 0, 85.6, 54, "F");

  // accent stripe
  doc.setFillColor(245, 223, 77);
  doc.rect(0, 47, 85.6, 7, "F");

  // header
  doc.setTextColor(255, 255, 255);
  doc.setFont("helvetica", "bold");
  doc.setFontSize(8);
  doc.text("PALESTINIAN IT SYNDICATE", 5, 7);
  doc.setFont("helvetica", "normal");
  doc.setFontSize(6);
  doc.text("Member ID Card", 5, 11);

  // name
  doc.setFont("helvetica", "bold");
  doc.setFontSize(12);
  doc.text(card.fullNameEn || card.fullName, 5, 22);

  // details
  doc.setFont("helvetica", "normal");
  doc.setFontSize(7);
  doc.setTextColor(245, 223, 77);
  doc.text(`Member #: ${card.membershipNumber ?? "—"}`, 5, 30);
  if (card.membershipTier) {
    doc.text(`Tier: ${card.membershipTier}`, 5, 35);
  }
  if (card.expiresAt) {
    doc.text(`Expires: ${new Date(card.expiresAt).toISOString().slice(0, 10)}`, 5, 40);
  }

  // QR code
  const qr = await QRCode.toDataURL(card.verifyUrl, {
    margin: 0,
    color: { dark: "#004953", light: "#ffffff" },
    width: 256,
  });
  doc.addImage(qr, "PNG", 60, 18, 22, 22);

  // footer
  doc.setTextColor(0, 73, 83);
  doc.setFont("helvetica", "bold");
  doc.setFontSize(6);
  doc.text("palitsyndicate.ps", 5, 52);

  doc.save(`palist-membership-${card.membershipNumber ?? card.cardId.slice(0, 8)}.pdf`);
}
