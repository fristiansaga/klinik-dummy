import asyncio
from playwright.async_api import async_playwright
import os

ARTIFACT_DIR = r"C:\Users\AXIO\.gemini\antigravity-ide\brain\5685de95-9351-4c54-ad19-ffda8a3b4968"

async def capture_all():
    async with async_playwright() as p:
        browser = await p.chromium.launch(headless=True)
        page = await browser.new_page(viewport={"width": 1920, "height": 1080})
        
        # 1. Tabel Stok Obat Tersedia in Apotek
        await page.goto("http://localhost:5500/apotek.html", wait_until="networkidle")
        await asyncio.sleep(0.3)
        await page.evaluate("showTab('stok_obat')")
        await asyncio.sleep(0.4)
        stok_tab = await page.query_selector("#tab-stok_obat")
        if stok_tab:
            await stok_tab.screenshot(path=os.path.join(ARTIFACT_DIR, "fresh_tabel_stok_obat.png"))
            print("Captured fresh_tabel_stok_obat.png!")

        # 2. WhatsApp Simulator in Pasien
        await page.goto("http://localhost:5500/pasien.html", wait_until="networkidle")
        await asyncio.sleep(0.3)
        await page.evaluate("openWaSimulator('obat_siap')")
        await asyncio.sleep(0.5)
        
        # Capture the whole center overlay with backdrop
        wa_card = await page.query_selector(".wa-window, .wa-phone-frame, #wa-simulator-overlay")
        if wa_card:
            await wa_card.screenshot(path=os.path.join(ARTIFACT_DIR, "fresh_whatsapp_sim.png"))
            print("Captured fresh_whatsapp_sim.png!")
            
        await browser.close()

if __name__ == "__main__":
    asyncio.run(capture_all())
