import asyncio
from playwright.async_api import async_playwright
import os

ARTIFACT_DIR = r"C:\Users\AXIO\.gemini\antigravity-ide\brain\5685de95-9351-4c54-ad19-ffda8a3b4968"

async def capture_all_detailed_views():
    async with async_playwright() as p:
        browser = await p.chromium.launch(headless=True)
        page = await browser.new_page(viewport={"width": 1920, "height": 1080})
        
        # 1. Capture Input Obat Form in Apotek
        await page.goto("http://localhost:5500/apotek.html", wait_until="networkidle")
        await asyncio.sleep(0.3)
        await page.evaluate("showTab('tambah_obat')")
        await asyncio.sleep(0.4)
        
        # Fill in sample data for demonstration
        form = await page.query_selector("#tab-tambah_obat")
        if form:
            inputs = await form.query_selector_all("input")
            if len(inputs) >= 7:
                await inputs[0].fill("OBT-2026-088") # SKU
                await inputs[1].fill("Ibuprofen 400mg Film-Coated Tablet") # Nama Obat
                await inputs[2].fill("250") # Qty
                await inputs[3].fill("30") # Min Stok
                await inputs[4].fill("4500") # Harga
                await inputs[5].fill("BATCH-IBU-992A") # No Batch
                await inputs[6].fill("2026-09-01") # Tgl Masuk
            card = await form.query_selector(".card")
            if card:
                await card.screenshot(path=os.path.join(ARTIFACT_DIR, "fresh_input_obat_form.png"))
                print("Captured fresh_input_obat_form.png successfully!")

        # 2. Capture Surat Medis & Rujukan Form in Dokter
        await page.goto("http://localhost:5500/dokter.html", wait_until="networkidle")
        await asyncio.sleep(0.3)
        await page.evaluate("showTab('surat_medis')")
        await asyncio.sleep(0.4)
        surat_tab = await page.query_selector("#tab-surat_medis")
        if surat_tab:
            card = await surat_tab.query_selector(".card")
            if card:
                await card.screenshot(path=os.path.join(ARTIFACT_DIR, "fresh_surat_medis_form.png"))
                print("Captured fresh_surat_medis_form.png successfully!")

        # 3. Capture E-Resep & Dispensing in Apotek
        await page.goto("http://localhost:5500/apotek.html", wait_until="networkidle")
        await asyncio.sleep(0.3)
        await page.evaluate("showTab('resep_masuk')")
        await asyncio.sleep(0.4)
        resep_tab = await page.query_selector("#tab-resep_masuk")
        if resep_tab:
            card = await resep_tab.query_selector(".card")
            if card:
                await card.screenshot(path=os.path.join(ARTIFACT_DIR, "fresh_resep_dispensing.png"))
                print("Captured fresh_resep_dispensing.png successfully!")

        await browser.close()

if __name__ == "__main__":
    asyncio.run(capture_all_detailed_views())
