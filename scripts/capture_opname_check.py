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
        out_path = os.path.join(ARTIFACT_DIR, "php_stock_opname_no_scroll.png")
        await page.screenshot(path=out_path)
        print(f"Captured: {out_path}")
        await b.close()

if __name__ == "__main__":
    asyncio.run(main())
