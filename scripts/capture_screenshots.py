import os
import time
import subprocess
from playwright.sync_api import sync_playwright

output_dir = r"e:\Sistem Informasi Klinik Zeni\screenshots"
mobile_dir = r"e:\Sistem Informasi Klinik Zeni\screenshots\mobile"
os.makedirs(output_dir, exist_ok=True)
os.makedirs(mobile_dir, exist_ok=True)

# Start simple local server
server_proc = subprocess.Popen(["python", "-m", "http.server", "8098"], cwd=r"e:\Sistem Informasi Klinik Zeni")
time.sleep(1.5)

try:
    with sync_playwright() as p:
        # === 1. DESKTOP VIEW (1440 x 900) ===
        browser = p.chromium.launch(headless=True)
        page = browser.new_page(viewport={"width": 1440, "height": 900})
        
        print("Navigating to local website (Desktop)...")
        page.goto("http://localhost:8098/index.html")
        page.wait_for_timeout(1000)
        
        # 1. Landing Page
        print("Capturing 01_landing_page.png...")
        page.screenshot(path=os.path.join(output_dir, "01_landing_page.png"))
        
        # 1b. Quick Queue Homepage
        print("Capturing 01b_quick_queue_homepage.png...")
        page.evaluate("document.getElementById('quick-queue-section').scrollIntoView()")
        page.wait_for_timeout(600)
        page.screenshot(path=os.path.join(output_dir, "01b_quick_queue_homepage.png"))
        
        # 2. Login Screen
        print("Capturing 02_login_screen.png...")
        page.evaluate("switchRole('login')")
        page.wait_for_timeout(800)
        page.screenshot(path=os.path.join(output_dir, "02_login_screen.png"))
        
        # 3. Pasien Dashboard - Beranda
        print("Capturing 03_pasien_dashboard.png...")
        page.evaluate("switchRole('pasien')")
        page.wait_for_timeout(800)
        page.screenshot(path=os.path.join(output_dir, "03_pasien_dashboard.png"))
        
        # 4. Pasien Dashboard - Booking
        print("Capturing 04_pasien_booking.png...")
        page.evaluate("switchDashboardTab('booking')")
        page.wait_for_timeout(800)
        page.screenshot(path=os.path.join(output_dir, "04_pasien_booking.png"))
        
        # 5. Pasien Dashboard - Antrean
        print("Capturing 05_pasien_antrean.png...")
        page.evaluate("switchDashboardTab('antrean')")
        page.wait_for_timeout(800)
        page.screenshot(path=os.path.join(output_dir, "05_pasien_antrean.png"))
        
        # 6. Pasien Dashboard - Resep
        print("Capturing 06_pasien_resep.png...")
        page.evaluate("switchDashboardTab('resep')")
        page.wait_for_timeout(800)
        page.screenshot(path=os.path.join(output_dir, "06_pasien_resep.png"))
        
        # 7. Dokter Dashboard - Clinical Workspace (Beranda)
        print("Capturing 07_dokter_dashboard.png...")
        page.evaluate("switchRole('dokter')")
        page.wait_for_timeout(800)
        page.screenshot(path=os.path.join(output_dir, "07_dokter_dashboard.png"))
        
        # 8. Dokter Dashboard - EMR Tab
        print("Capturing 08_dokter_emr.png...")
        page.evaluate("switchDashboardTab('ruang_periksa')")
        page.wait_for_timeout(800)
        page.screenshot(path=os.path.join(output_dir, "08_dokter_emr.png"))
        
        # 9. Dokter Dashboard - Resep Tab
        print("Capturing 09_dokter_eresep.png...")
        page.evaluate("switchDashboardTab('antrean_periksa')")
        page.wait_for_timeout(800)
        page.screenshot(path=os.path.join(output_dir, "09_dokter_eresep.png"))
        
        # 10. Kasir Dashboard - Billing Counter
        print("Capturing 10_kasir_dashboard.png...")
        page.evaluate("switchRole('kasir')")
        page.wait_for_timeout(800)
        page.evaluate("selectInvoiceBilling('INV/20260727/001')")
        page.wait_for_timeout(500)
        page.screenshot(path=os.path.join(output_dir, "10_kasir_dashboard.png"))
        
        # 11. Kasir Dashboard - Receipt Modal
        print("Capturing 11_kasir_struk_modal.png...")
        page.evaluate("cetakStrukPembayaran('INV/20260727/001')")
        page.wait_for_timeout(800)
        page.screenshot(path=os.path.join(output_dir, "11_kasir_struk_modal.png"))
        page.evaluate("document.getElementById('receipt-modal-overlay').classList.remove('open')")
        
        # 12. Admin Dashboard - Command Center (Beranda)
        print("Capturing 12_admin_dashboard.png...")
        page.evaluate("switchRole('admin')")
        page.wait_for_timeout(800)
        page.screenshot(path=os.path.join(output_dir, "12_admin_dashboard.png"))
        
        # 13. Admin Dashboard - Master Data (Obat Tab)
        print("Capturing 13_admin_master_obat.png...")
        page.evaluate("switchDashboardTab('master_data')")
        page.wait_for_timeout(500)
        page.evaluate("if(typeof switchAdminMasterTab === 'function') switchAdminMasterTab('obat');")
        page.wait_for_timeout(800)
        page.screenshot(path=os.path.join(output_dir, "13_admin_master_obat.png"))
        
        # 14. Admin Dashboard - SATUSEHAT & Audit Log
        print("Capturing 14_admin_satusehat_audit.png...")
        page.evaluate("switchDashboardTab('integrasi')")
        page.wait_for_timeout(800)
        page.screenshot(path=os.path.join(output_dir, "14_admin_satusehat_audit.png"))
        
        # 15. Global Feature - Pusat Bantuan & FAQ
        print("Capturing 15_chatbot_command.png...")
        page.evaluate("switchRole('public')")
        page.evaluate("document.getElementById('chatbot-panel').classList.add('open')")
        page.wait_for_timeout(800)
        page.screenshot(path=os.path.join(output_dir, "15_chatbot_command.png"))
        
        browser.close()

        # === 2. MOBILE VIEW (iPhone 14) ===
        iphone = p.devices['iPhone 14']
        mobile_browser = p.chromium.launch(headless=True)
        mobile_context = mobile_browser.new_context(**iphone)
        m_page = mobile_context.new_page()
        
        print("Navigating to local website (Mobile)...")
        m_page.goto("http://localhost:8098/index.html")
        m_page.wait_for_timeout(1000)
        
        m_page.screenshot(path=os.path.join(mobile_dir, "01_mobile_landing.png"))
        
        m_page.evaluate("switchRole('pasien')")
        m_page.wait_for_timeout(800)
        m_page.screenshot(path=os.path.join(mobile_dir, "04_mobile_pasien_dashboard.png"))

        m_page.evaluate("toggleMobileSidebar(true)")
        m_page.wait_for_timeout(600)
        m_page.screenshot(path=os.path.join(mobile_dir, "06_mobile_drawer.png"))
        
        mobile_browser.close()
        print("All desktop & mobile screenshots captured successfully!")
finally:
    server_proc.terminate()
