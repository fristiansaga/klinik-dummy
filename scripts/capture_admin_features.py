import asyncio
from playwright.async_api import async_playwright
import os

ARTIFACT_DIR = r"C:\Users\AXIO\.gemini\antigravity-ide\brain\5685de95-9351-4c54-ad19-ffda8a3b4968"

async def capture_admin_and_features():
    async with async_playwright() as p:
        browser = await p.chromium.launch(headless=True)
        page = await browser.new_page(viewport={"width": 1920, "height": 1080})
        
        # 1. Admin RBAC
        await page.goto("http://localhost:5500/admin.html", wait_until="networkidle")
        await asyncio.sleep(0.3)
        await page.evaluate("showTab('rbac')")
        await asyncio.sleep(0.4)
        rbac_tab = await page.query_selector("#tab-rbac")
        if rbac_tab:
            await rbac_tab.screenshot(path=os.path.join(ARTIFACT_DIR, "fresh_admin_rbac.png"))
            print("Captured fresh_admin_rbac.png!")

        # 2. Admin Master Data
        await page.evaluate("showTab('master_data')")
        await asyncio.sleep(0.4)
        master_tab = await page.query_selector("#tab-master_data")
        if master_tab:
            await master_tab.screenshot(path=os.path.join(ARTIFACT_DIR, "fresh_admin_master.png"))
            print("Captured fresh_admin_master.png!")

        # 3. Admin SATUSEHAT Integrasi
        await page.evaluate("showTab('integrasi')")
        await asyncio.sleep(0.4)
        satusehat_tab = await page.query_selector("#tab-integrasi")
        if satusehat_tab:
            await satusehat_tab.screenshot(path=os.path.join(ARTIFACT_DIR, "fresh_admin_satusehat.png"))
            print("Captured fresh_admin_satusehat.png!")

        # 4. Command Palette (Ctrl+K)
        await page.goto("http://localhost:5500/index.html", wait_until="networkidle")
        await asyncio.sleep(0.3)
        await page.evaluate("toggleCommandPalette(true)")
        await asyncio.sleep(0.4)
        cmd_modal = await page.query_selector(".cmd-palette")
        if cmd_modal:
            await cmd_modal.screenshot(path=os.path.join(ARTIFACT_DIR, "fresh_cmd_palette.png"))
            print("Captured fresh_cmd_palette.png!")

        # 5. Fullscreen TV Antrean
        await page.goto("http://localhost:5500/antrian-tv.html", wait_until="networkidle")
        await asyncio.sleep(0.5)
        await page.screenshot(path=os.path.join(ARTIFACT_DIR, "fresh_antrian_tv_clean.png"))
        print("Captured fresh_antrian_tv_clean.png!")

        await browser.close()

if __name__ == "__main__":
    asyncio.run(capture_admin_and_features())
