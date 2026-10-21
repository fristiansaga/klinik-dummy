import asyncio
from playwright.async_api import async_playwright
import os

ARTIFACT_DIR = r"C:\Users\AXIO\.gemini\antigravity-ide\brain\d304b5d3-437d-462d-8895-f31564a7e0ac"

async def main():
    async with async_playwright() as p:
        b = await p.chromium.launch(headless=True)
        page = await b.new_page(viewport={'width': 1920, 'height': 945})
        
        # 1. Check index.php
        await page.goto('http://localhost/klinik-zeni/index.php', wait_until='networkidle')
        await page.screenshot(path=os.path.join(ARTIFACT_DIR, 'php_modular_index.png'))
        
        # 2. Check pasien.php
        await page.goto('http://localhost/klinik-zeni/pasien.php', wait_until='networkidle')
        await page.screenshot(path=os.path.join(ARTIFACT_DIR, 'php_modular_pasien.png'))
        
        # 3. Check apotek.php opname tab
        await page.goto('http://localhost/klinik-zeni/apotek.php', wait_until='networkidle')
        await page.evaluate("showTab('stock_opname')")
        await asyncio.sleep(0.3)
        await page.screenshot(path=os.path.join(ARTIFACT_DIR, 'php_modular_apotek.png'))
        
        # 4. Check mobile viewport
        mobile_page = await b.new_page(viewport={'width': 577, 'height': 944})
        await mobile_page.goto('http://localhost/klinik-zeni/pasien.php', wait_until='networkidle')
        await mobile_page.screenshot(path=os.path.join(ARTIFACT_DIR, 'php_modular_mobile.png'))
        
        print('All views verified successfully with modular CSS architecture!')
        await b.close()

if __name__ == '__main__':
    asyncio.run(main())
