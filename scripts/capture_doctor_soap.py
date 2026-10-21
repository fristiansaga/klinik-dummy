import asyncio
from playwright.async_api import async_playwright
import os

ARTIFACT_DIR = r"C:\Users\AXIO\.gemini\antigravity-ide\brain\5685de95-9351-4c54-ad19-ffda8a3b4968"

async def capture_soap():
    async with async_playwright() as p:
        browser = await p.chromium.launch(headless=True)
        page = await browser.new_page(viewport={"width": 1920, "height": 1080})
        await page.goto("http://localhost:5500/dokter.html", wait_until="networkidle")
        await asyncio.sleep(0.3)
        
        # Click button to open SOAP
        await page.evaluate("showTab('ruang_periksa')")
        await asyncio.sleep(0.5)
        
        # Capture form card of SOAP
        soap_el = await page.query_selector("#tab-ruang_periksa")
        if soap_el:
            await soap_el.screenshot(path=os.path.join(ARTIFACT_DIR, "fresh_dokter_soap_form.png"))
            print("Captured fresh_dokter_soap_form.png successfully!")
            
        await browser.close()

if __name__ == "__main__":
    asyncio.run(capture_soap())
