import os
import time
import subprocess
from playwright.sync_api import sync_playwright

output_dir = r"e:\Sistem Informasi Klinik Zeni\screenshots\mobile"
os.makedirs(output_dir, exist_ok=True)

# Start simple local server
server_proc = subprocess.Popen(["python", "-m", "http.server", "8089"], cwd=r"e:\Sistem Informasi Klinik Zeni")
time.sleep(1.5)

try:
    with sync_playwright() as p:
        # iPhone 14 / standard modern HP viewport
        iphone = p.devices['iPhone 14']
        browser = p.chromium.launch(headless=True)
        context = browser.new_context(**iphone)
        page = context.new_page()
        
        print("Navigating to local website on mobile viewport...")
        page.goto("http://localhost:8089/index.html")
        page.wait_for_timeout(1000)
        
        # 1. Mobile Landing Page
        print("Capturing 01_mobile_landing.png...")
        page.screenshot(path=os.path.join(output_dir, "01_mobile_landing.png"), full_page=False)
        
        # 2. Mobile Quick Queue Section
        print("Capturing 02_mobile_quick_queue.png...")
        page.evaluate("document.getElementById('quick-queue-section').scrollIntoView()")
        page.wait_for_timeout(500)
        page.screenshot(path=os.path.join(output_dir, "02_mobile_quick_queue.png"))
        
        # 3. Mobile Login Screen
        print("Capturing 03_mobile_login.png...")
        page.evaluate("switchRole('login')")
        page.wait_for_timeout(800)
        page.screenshot(path=os.path.join(output_dir, "03_mobile_login.png"))
        
        # 4. Mobile Pasien Dashboard (Health Passport & Bottom Nav)
        print("Capturing 04_mobile_pasien_dashboard.png...")
        page.evaluate("switchRole('pasien')")
        page.wait_for_timeout(800)
        page.screenshot(path=os.path.join(output_dir, "04_mobile_pasien_dashboard.png"))
        
        # 5. Mobile Pasien Antrean Tab
        print("Capturing 05_mobile_pasien_antrean.png...")
        page.evaluate("switchDashboardTab('antrean')")
        page.wait_for_timeout(800)
        page.screenshot(path=os.path.join(output_dir, "05_mobile_pasien_antrean.png"))

        # 6. Mobile Pasien Sidebar Drawer
        print("Capturing 06_mobile_drawer.png...")
        page.evaluate("toggleMobileSidebar(true)")
        page.wait_for_timeout(600)
        page.screenshot(path=os.path.join(output_dir, "06_mobile_drawer.png"))
        page.evaluate("toggleMobileSidebar(false)")
        page.wait_for_timeout(400)
        
        # 7. Mobile Dokter Workspace
        print("Capturing 07_mobile_dokter_dashboard.png...")
        page.evaluate("switchRole('dokter')")
        page.wait_for_timeout(800)
        page.screenshot(path=os.path.join(output_dir, "07_mobile_dokter_dashboard.png"))
        
        # 8. Mobile Kasir Billing
        print("Capturing 08_mobile_kasir_billing.png...")
        page.evaluate("switchRole('kasir')")
        page.wait_for_timeout(800)
        page.evaluate("selectInvoiceBilling('INV/20260727/001')")
        page.wait_for_timeout(500)
        page.screenshot(path=os.path.join(output_dir, "08_mobile_kasir_billing.png"))
        
        # 9. Mobile Chatbot Tanya AI
        print("Capturing 09_mobile_chatbot.png...")
        page.evaluate("document.getElementById('chatbot-panel').classList.add('open')")
        page.wait_for_timeout(600)
        page.screenshot(path=os.path.join(output_dir, "09_mobile_chatbot.png"))
        
        print("Mobile screenshots completed successfully!")
        browser.close()
finally:
    server_proc.terminate()
