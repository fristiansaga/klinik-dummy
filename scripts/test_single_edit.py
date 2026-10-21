import asyncio
from playwright.async_api import async_playwright
import os

ARTIFACT_DIR = r"C:\Users\AXIO\.gemini\antigravity-ide\brain\d304b5d3-437d-462d-8895-f31564a7e0ac"

async def main():
    async with async_playwright() as p:
        b = await p.chromium.launch(headless=True)
        page = await b.new_page(viewport={"width": 1920, "height": 945})
        await page.goto("http://localhost/klinik-zeni/apotek.php", wait_until="networkidle")
        await page.evaluate("showTab('stock_opname')")
        await asyncio.sleep(0.6)
        
        # 1. Capture locked state with single top button
        await page.screenshot(path=os.path.join(ARTIFACT_DIR, "php_single_edit_locked.png"))
        
        # 2. Click the single top Edit button
        await page.click("#btn-toggle-global-opname")
        await asyncio.sleep(0.3)
        
        # Adjust some numbers
        await page.click("#stepper-1 button[title='Tambah']")
        await asyncio.sleep(0.2)
        await page.click("#stepper-4 button[title='Tambah']")
        await asyncio.sleep(0.3)
        
        # Capture editing mode screenshot
        await page.screenshot(path=os.path.join(ARTIFACT_DIR, "php_single_edit_active.png"))
        
        # 3. Click Save button on top
        await page.click("#btn-toggle-global-opname")
        await asyncio.sleep(0.5)
        
        # Capture saved state
        await page.screenshot(path=os.path.join(ARTIFACT_DIR, "php_single_edit_saved.png"))
        
        print("Success! Tested single global edit button workflow.")
        await b.close()

if __name__ == "__main__":
    asyncio.run(main())
