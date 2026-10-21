import asyncio
from playwright.async_api import async_playwright
import os

ARTIFACT_DIR = r"C:\Users\AXIO\.gemini\antigravity-ide\brain\5685de95-9351-4c54-ad19-ffda8a3b4968"

async def capture_kwitansi():
    async with async_playwright() as p:
        browser = await p.chromium.launch(headless=True)
        page = await browser.new_page(viewport={"width": 1400, "height": 1000}, device_scale_factor=2)
        
        # 1. Kwitansi Umum
        await page.goto("http://localhost:5500/kasir.html", wait_until="networkidle")
        await asyncio.sleep(0.3)
        await page.evaluate("openReceiptModal('Hendra Kusuma', 'RM-2026-0551', 'Umum Mandiri', 275000)")
        await asyncio.sleep(0.5)
        receipt_el = await page.query_selector("#receipt-modal-overlay .modal-card")
        if receipt_el:
            await receipt_el.screenshot(path=os.path.join(ARTIFACT_DIR, "fresh_kwitansi_umum.png"))
            print("Captured fresh_kwitansi_umum.png!")

        # 2. Kwitansi BPJS Bebas Biaya
        await page.evaluate("openReceiptModal('Ibu Siti Aminah', 'RM-2026-0412', 'BPJS Kesehatan (FKTP PUSDIKZI)', 0)")
        await asyncio.sleep(0.5)
        receipt_bpjs = await page.query_selector("#receipt-modal-overlay .modal-card")
        if receipt_bpjs:
            await receipt_bpjs.screenshot(path=os.path.join(ARTIFACT_DIR, "fresh_kwitansi_bpjs.png"))
            print("Captured fresh_kwitansi_bpjs.png!")
            
        await browser.close()

if __name__ == "__main__":
    asyncio.run(capture_kwitansi())
