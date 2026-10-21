import asyncio
from playwright.async_api import async_playwright
import os

ARTIFACT_DIR = r"C:\Users\AXIO\.gemini\antigravity-ide\brain\d304b5d3-437d-462d-8895-f31564a7e0ac"

async def main():
    async with async_playwright() as p:
        browser = await p.chromium.launch(headless=True)
        page = await browser.new_page(viewport={"width": 1280, "height": 800})
        
        # 1. Dark mode
        await page.goto("http://localhost:3000/", wait_until="networkidle", timeout=15000)
        await asyncio.sleep(1.0)
        await page.screenshot(path=os.path.join(ARTIFACT_DIR, "react_dark_mode.png"))
        print("Captured react_dark_mode.png")
        
        # 2. Toggle to Light mode by clicking theme button
        theme_btn = page.locator("button[title='Toggle Theme']")
        if await theme_btn.count() > 0:
            await theme_btn.click()
            await asyncio.sleep(0.8)
            await page.screenshot(path=os.path.join(ARTIFACT_DIR, "react_light_mode.png"))
            print("Captured react_light_mode.png")
            
            # Go to /pasien in Light Mode
            await page.goto("http://localhost:3000/pasien", wait_until="networkidle")
            await asyncio.sleep(0.8)
            await page.screenshot(path=os.path.join(ARTIFACT_DIR, "react_pasien_light_mode.png"))
            print("Captured react_pasien_light_mode.png")
            
        await browser.close()

if __name__ == "__main__":
    asyncio.run(main())
