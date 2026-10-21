import asyncio
from playwright.async_api import async_playwright
import os

ARTIFACT_DIR = r"C:\Users\AXIO\.gemini\antigravity-ide\brain\5685de95-9351-4c54-ad19-ffda8a3b4968"

async def capture_obat_and_wa():
    async with async_playwright() as p:
        browser = await p.chromium.launch(headless=True)
        page = await browser.new_page(viewport={"width": 1920, "height": 1080})
        
        # 1. Capture Tabel Obat Tersedia in Apotek
        await page.goto("http://localhost:5500/apotek.html", wait_until="networkidle")
        await asyncio.sleep(0.3)
        await page.evaluate("showTab('stok_obat')")
        await asyncio.sleep(0.4)
        stok_tab = await page.query_selector("#tab-stok_obat")
        if stok_tab:
            await stok_tab.screenshot(path=os.path.join(ARTIFACT_DIR, "fresh_tabel_stok_obat.png"))
            print("Captured fresh_tabel_stok_obat.png!")

        # 2. Capture WhatsApp Simulator Modal in Pasien
        await page.goto("http://localhost:5500/pasien.html", wait_until="networkidle")
        await asyncio.sleep(0.3)
        await page.evaluate("openWaSimulator('obat_siap')")
        await asyncio.sleep(0.5)
        
        # Capture the WA modal
        wa_modal = await page.query_selector("#wa-simulator-modal .modal-card, #wa-simulator-modal, .wa-modal, .modal-card")
        if wa_modal:
            await wa_modal.screenshot(path=os.path.join(ARTIFACT_DIR, "fresh_whatsapp_modal.png"))
            print("Captured fresh_whatsapp_modal.png!")
        else:
            # Full viewport if specific class not found
            await page.screenshot(path=os.path.join(ARTIFACT_DIR, "fresh_whatsapp_modal.png"))
            print("Captured full view with WA modal!")

        await browser.close()

if __name__ == "__main__":
    asyncio.run(capture_obat_and_wa())
