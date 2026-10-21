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
        
        # 1. Capture locked initial state
        await page.screenshot(path=os.path.join(ARTIFACT_DIR, "php_opname_stepper_locked.png"))
        
        # 2. Click Edit on Row 1 (Paracetamol) and click + twice
        await page.click("#row-opname-1 button:has-text('Edit')")
        await asyncio.sleep(0.3)
        await page.click("#stepper-1 button[title='Tambah']")
        await asyncio.sleep(0.2)
        await page.click("#stepper-1 button[title='Tambah']")
        await asyncio.sleep(0.3)
        
        # Capture active editing mode screenshot
        await page.screenshot(path=os.path.join(ARTIFACT_DIR, "php_opname_stepper_editing.png"))
        
        # 3. Click Simpan
        await page.click("#row-opname-1 button:has-text('Simpan')")
        await asyncio.sleep(0.5)
        
        # Capture saved state with toast
        await page.screenshot(path=os.path.join(ARTIFACT_DIR, "php_opname_stepper_saved.png"))
        
        print("Success! Captured all 3 stepper states.")
        await b.close()

if __name__ == "__main__":
    asyncio.run(main())
