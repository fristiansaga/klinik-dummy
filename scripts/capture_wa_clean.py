import asyncio
from playwright.async_api import async_playwright
import os

ARTIFACT_DIR = r"C:\Users\AXIO\.gemini\antigravity-ide\brain\5685de95-9351-4c54-ad19-ffda8a3b4968"

async def capture_wa():
    async with async_playwright() as p:
        browser = await p.chromium.launch(headless=True)
        page = await browser.new_page(viewport={"width": 1920, "height": 1080})
        await page.goto("http://localhost:5500/pasien.html", wait_until="networkidle")
        await asyncio.sleep(0.3)
        await page.evaluate("openWaSimulator('obat_siap')")
        await asyncio.sleep(0.5)
        
        wa_frame = await page.query_selector(".wa-phone-frame")
        if wa_frame:
            await wa_frame.screenshot(path=os.path.join(ARTIFACT_DIR, "fresh_whatsapp_modal.png"))
            print("Captured fresh_whatsapp_modal.png cleanly!")
        else:
            print("wa_frame not found")
            
        await browser.close()

if __name__ == "__main__":
    asyncio.run(capture_wa())
