import fitz  # PyMuPDF
import os

pdf_path = r"e:\Sistem Informasi Klinik Zeni\Walkthrough_Sistem_Informasi_Klinik_PUSZIAD.pdf"
output_dir = r"e:\Sistem Informasi Klinik Zeni\pdf_preview"
os.makedirs(output_dir, exist_ok=True)

doc = fitz.open(pdf_path)
print(f"Total Pages in PDF: {len(doc)}")

for i, page in enumerate(doc):
    pix = page.get_pixmap(dpi=150)
    img_path = os.path.join(output_dir, f"page_{i+1:02d}.png")
    pix.save(img_path)
    print(f"Saved {img_path}")

print("All PDF pages converted to PNG successfully!")
