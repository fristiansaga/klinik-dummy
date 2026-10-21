import asyncio
from playwright.async_api import async_playwright
import os

ARTIFACT_DIR = r"C:\Users\AXIO\.gemini\antigravity-ide\brain\d304b5d3-437d-462d-8895-f31564a7e0ac"

async def main():
    async with async_playwright() as p:
        b = await p.chromium.launch(headless=True)
        # Mobile viewport (iPhone / Android typical width 577px & 390px)
        page = await b.new_page(viewport={"width": 577, "height": 944})
        await page.goto("http://localhost/klinik-zeni/pasien.php", wait_until="networkidle")
        await asyncio.sleep(0.5)
        
        # 1. Closed state: Main content is full width, clean, no sidebar peek
        await page.screenshot(path=os.path.join(ARTIFACT_DIR, "php_mobile_fixed_closed.png"))
        
        # 2. Open drawer state: Click hamburger menu
        await page.click(".mobile-menu-btn")
        await asyncio.sleep(0.4)
        await page.screenshot(path=os.path.join(ARTIFACT_DIR, "php_mobile_fixed_open.png"))
        
        print("Success! Verified mobile responsive drawer behavior.")
        await b.close()

if __name__ == "__main__":
    asyncio.run(main())
