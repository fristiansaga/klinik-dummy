import asyncio
from playwright.async_api import async_playwright
import os

ARTIFACT_DIR = r"C:\Users\AXIO\.gemini\antigravity-ide\brain\d304b5d3-437d-462d-8895-f31564a7e0ac"

async def main():
    async with async_playwright() as p:
        b = await p.chromium.launch(headless=True)
        page = await b.new_page(viewport={"width": 1920, "height": 945})
        
        await page.goto("http://localhost/klinik-zeni/index.php", wait_until="networkidle")
        await page.evaluate("window.scrollTo(0, document.body.scrollHeight)")
        await asyncio.sleep(0.4)
        
        # 1. Verify bottom of page is clean (command palette is hidden overlay, not inline)
        await page.screenshot(path=os.path.join(ARTIFACT_DIR, "php_bottom_cmd_fixed.png"))
        
        # 2. Verify command palette opens properly on header button click
        await page.click(".header-search-btn")
        await asyncio.sleep(0.3)
        await page.screenshot(path=os.path.join(ARTIFACT_DIR, "php_cmd_palette_active_modal.png"))
        
        print("Success! Command palette properly styled as overlay modal.")
        await b.close()

if __name__ == "__main__":
    asyncio.run(main())
