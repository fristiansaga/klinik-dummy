import asyncio
from playwright.async_api import async_playwright
import os

ARTIFACT_DIR = r"C:\Users\AXIO\.gemini\antigravity-ide\brain\5685de95-9351-4c54-ad19-ffda8a3b4968"

async def capture_wa_phone():
    async with async_playwright() as p:
        # Using phone-like viewport to render authentic WhatsApp chat screen
        browser = await p.chromium.launch(headless=True)
        page = await browser.new_page(viewport={"width": 480, "height": 840})
        await page.goto("http://localhost:5500/pasien.html", wait_until="networkidle")
        await asyncio.sleep(0.3)
        await page.evaluate("openWaSimulator('obat_siap')")
        await asyncio.sleep(0.5)
        
        # Take screenshot of the screen with WA open
        await page.screenshot(path=os.path.join(ARTIFACT_DIR, "fresh_whatsapp_phone.png"))
        print("Captured fresh_whatsapp_phone.png successfully!")
        
        await browser.close()

if __name__ == "__main__":
    asyncio.run(capture_wa_phone())
