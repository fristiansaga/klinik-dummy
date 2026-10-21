import asyncio
from playwright.async_api import async_playwright
import os

ARTIFACT_DIR = r"C:\Users\AXIO\.gemini\antigravity-ide\brain\5685de95-9351-4c54-ad19-ffda8a3b4968"

async def capture_kasir_views():
    async with async_playwright() as p:
        browser = await p.chromium.launch(headless=True)
        page = await browser.new_page(viewport={"width": 1920, "height": 1080})
        
        # 1. Capture Kasir Billing Queue & Table
        await page.goto("http://localhost:5500/kasir.html", wait_until="networkidle")
        await asyncio.sleep(0.3)
        await page.evaluate("showTab('antrean_bayar')")
        await asyncio.sleep(0.4)
        antrean_tab = await page.query_selector("#tab-antrean_bayar")
        if antrean_tab:
            await antrean_tab.screenshot(path=os.path.join(ARTIFACT_DIR, "fresh_kasir_billing_table.png"))
            print("Captured fresh_kasir_billing_table.png!")

        # 2. Capture Official Cashier Receipt Modal (Kuitansi Pembayaran)
        await page.evaluate("openReceiptModal('Hendra Kusuma', 'RM-2026-0551', 'Umum Mandiri', 275000)")
        await asyncio.sleep(0.5)
        receipt_modal = await page.query_selector("#receipt-modal-overlay .modal-card")
        if receipt_modal:
            await receipt_modal.screenshot(path=os.path.join(ARTIFACT_DIR, "fresh_kasir_receipt_modal.png"))
            print("Captured fresh_kasir_receipt_modal.png!")

        await browser.close()

if __name__ == "__main__":
    asyncio.run(capture_kasir_views())
