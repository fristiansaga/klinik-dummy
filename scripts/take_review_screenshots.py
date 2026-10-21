import asyncio
from playwright.async_api import async_playwright
import os

ARTIFACT_DIR = r"C:\Users\AXIO\.gemini\antigravity-ide\brain\d304b5d3-437d-462d-8895-f31564a7e0ac"

pages_to_capture = [
    ("http://localhost/klinik-zeni/index.php", "php_landing_page.png", 1280, 800),
    ("http://localhost/klinik-zeni/pasien.php", "php_pasien_portal.png", 1280, 800),
    ("http://localhost/klinik-zeni/dokter.php", "php_dokter_workspace.png", 1280, 800),
    ("http://localhost/klinik-zeni/apotek.php", "php_apotek_farmasi.png", 1280, 800),
    ("http://localhost/klinik-zeni/kasir.php", "php_kasir_billing.png", 1280, 800),
    ("http://localhost/klinik-zeni/admin.php", "php_admin_center.png", 1280, 800),
    ("http://localhost:3000/", "react_landing_page.png", 1280, 800),
    ("http://localhost:3000/pasien", "react_pasien_portal.png", 1280, 800),
    ("http://localhost:3000/antrian-tv", "react_antrian_tv.png", 1280, 800),
]

async def main():
    async with async_playwright() as p:
        browser = await p.chromium.launch(headless=True)
        for url, filename, w, h in pages_to_capture:
            try:
                page = await browser.new_page(viewport={"width": w, "height": h})
                print(f"Navigating to {url}...")
                await page.goto(url, wait_until="networkidle", timeout=15000)
                await asyncio.sleep(1.0)
                out_path = os.path.join(ARTIFACT_DIR, filename)
                await page.screenshot(path=out_path, full_page=False)
                print(f"Captured: {out_path}")
                await page.close()
            except Exception as e:
                print(f"Error capturing {url}: {e}")
        await browser.close()

if __name__ == "__main__":
    asyncio.run(main())
