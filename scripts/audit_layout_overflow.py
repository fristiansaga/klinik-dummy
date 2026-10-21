import asyncio
from playwright.async_api import async_playwright
import os

ARTIFACT_DIR = r"C:\Users\AXIO\.gemini\antigravity-ide\brain\d304b5d3-437d-462d-8895-f31564a7e0ac"

pages_and_tabs = [
    ("http://localhost/klinik-zeni/index.php", "audit_index.png", None),
    ("http://localhost/klinik-zeni/pasien.php", "audit_pasien_passport.png", "passport"),
    ("http://localhost/klinik-zeni/pasien.php", "audit_pasien_booking.png", "booking"),
    ("http://localhost/klinik-zeni/pasien.php", "audit_pasien_antrean.png", "antrean"),
    ("http://localhost/klinik-zeni/pasien.php", "audit_pasien_resep.png", "resep"),
    ("http://localhost/klinik-zeni/pasien.php", "audit_pasien_riwayat.png", "riwayat"),
    ("http://localhost/klinik-zeni/dokter.php", "audit_dokter_antrean.png", "antrean_periksa"),
    ("http://localhost/klinik-zeni/dokter.php", "audit_dokter_soap.png", "soap_emr"),
    ("http://localhost/klinik-zeni/dokter.php", "audit_dokter_surat.png", "surat_medis"),
    ("http://localhost/klinik-zeni/apotek.php", "audit_apotek_beranda.png", "beranda"),
    ("http://localhost/klinik-zeni/apotek.php", "audit_apotek_stok.png", "stok_obat"),
    ("http://localhost/klinik-zeni/apotek.php", "audit_apotek_opname.png", "stock_opname"),
    ("http://localhost/klinik-zeni/kasir.php", "audit_kasir_beranda.png", "beranda_kasir"),
    ("http://localhost/klinik-zeni/kasir.php", "audit_kasir_tagihan.png", "antrean_bayar"),
    ("http://localhost/klinik-zeni/admin.php", "audit_admin_beranda.png", "beranda"),
    ("http://localhost/klinik-zeni/admin.php", "audit_admin_rbac.png", "rbac"),
    ("http://localhost/klinik-zeni/admin.php", "audit_admin_master.png", "master_data"),
]

async def main():
    async with async_playwright() as p:
        b = await p.chromium.launch(headless=True)
        for url, filename, tab in pages_and_tabs:
            page = await b.new_page(viewport={"width": 1920, "height": 945})
            await page.goto(url, wait_until="networkidle")
            if tab:
                # Trigger showTab(tab)
                await page.evaluate(f"if (typeof showTab === 'function') {{ showTab('{tab}'); }}")
                await asyncio.sleep(0.5)
            
            # Check for any element overflowing horizontally beyond body
            overflowing = await page.evaluate('''() => {
                const bodyWidth = document.body.clientWidth;
                const badElements = [];
                document.querySelectorAll('*').forEach(el => {
                    const rect = el.getBoundingClientRect();
                    if (rect.right > bodyWidth + 2 && el.tagName !== 'HTML' && el.tagName !== 'BODY') {
                        badElements.push({ tag: el.tagName, class: el.className, right: rect.right, bodyWidth });
                    }
                });
                return badElements;
            }''')
            if overflowing:
                print(f"[{filename}] Found {len(overflowing)} overflowing elements:", overflowing[:3])
            else:
                print(f"[{filename}] Clean! No overflowing elements.")
                
            await page.screenshot(path=os.path.join(ARTIFACT_DIR, filename), full_page=False)
            await page.close()
        await b.close()

if __name__ == "__main__":
    asyncio.run(main())
