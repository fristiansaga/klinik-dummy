import os
import sys
from reportlab.lib.pagesizes import letter, A4
from reportlab.lib import colors
from reportlab.platypus import (
    SimpleDocTemplate, Paragraph, Spacer, Image, Table, TableStyle, PageBreak, KeepTogether, HRFlowable
)
from reportlab.lib.styles import getSampleStyleSheet, ParagraphStyle
from reportlab.lib.units import inch
from reportlab.pdfgen import canvas

# Define output PDF path
pdf_path = r"e:\Sistem Informasi Klinik Zeni\Walkthrough_Sistem_Informasi_Klinik_PUSZIAD.pdf"
img_dir = r"e:\Sistem Informasi Klinik Zeni\screenshots"

# Custom Canvas class for Header, Footer & Page Numbers
class NumberedCanvas(canvas.Canvas):
    def __init__(self, *args, **kwargs):
        super().__init__(*args, **kwargs)
        self._saved_page_states = []

    def showPage(self):
        self._saved_page_states.append(dict(self.__dict__))
        self._startPage()

    def save(self):
        num_pages = len(self._saved_page_states)
        for state in self._saved_page_states:
            self.__dict__.update(state)
            self.draw_page_decorations(num_pages)
            super().showPage()
        super().save()

    def draw_page_decorations(self, page_count):
        self.saveState()
        
        # Don't draw header/footer on cover page (page 1)
        if self._pageNumber > 1:
            # Header
            self.setFont("Helvetica-Bold", 8)
            self.setFillColor(colors.HexColor("#1B4D3E"))
            self.drawString(36, 810, "KLINIK PRATAMA PUSDIKZI — DOKUMENTASI & PANDUAN PENGGUNA SISTEM INFORMASI 2026")
            
            self.setStrokeColor(colors.HexColor("#CBD5E1"))
            self.setLineWidth(0.5)
            self.line(36, 804, 576, 804)
            
            # Footer
            self.setFont("Helvetica", 8)
            self.setFillColor(colors.HexColor("#64748B"))
            self.drawString(36, 25, "© 2026 KLINIK PRATAMA PUSDIKZI | Layanan Kesehatan Terpadu, Modern & Terpercaya")
            
            page_text = f"Halaman {self._pageNumber} dari {page_count}"
            self.drawRightString(576, 25, page_text)
            self.line(36, 35, 576, 35)
            
        self.restoreState()

def create_walkthrough_pdf():
    doc = SimpleDocTemplate(
        pdf_path,
        pagesize=A4,
        leftMargin=36,
        rightMargin=36,
        topMargin=54,
        bottomMargin=45
    )

    styles = getSampleStyleSheet()
    
    # Custom Palette
    PRIMARY = colors.HexColor("#1B4D3E")     # Deep Forest Green
    ACCENT = colors.HexColor("#E8A33D")      # Warm Gold
    SECONDARY = colors.HexColor("#2D6A4F")   # Medium Green
    TEXT_DARK = colors.HexColor("#1E293B")   # Dark Slate
    TEXT_MUTED = colors.HexColor("#64748B")  # Muted Gray
    BG_LIGHT = colors.HexColor("#F8FAFC")    # Soft Off-White
    BORDER_COLOR = colors.HexColor("#E2E8F0")

    # Custom Typography Styles
    styles.add(ParagraphStyle(
        'CoverTitle',
        parent=styles['Normal'],
        fontName='Helvetica-Bold',
        fontSize=24,
        leading=28,
        textColor=PRIMARY,
        alignment=0,
        spaceAfter=10
    ))

    styles.add(ParagraphStyle(
        'CoverSubtitle',
        parent=styles['Normal'],
        fontName='Helvetica',
        fontSize=12,
        leading=16,
        textColor=TEXT_MUTED,
        alignment=0,
        spaceAfter=20
    ))

    styles.add(ParagraphStyle(
        'SecHeading',
        parent=styles['Normal'],
        fontName='Helvetica-Bold',
        fontSize=16,
        leading=20,
        textColor=PRIMARY,
        spaceBefore=15,
        spaceAfter=8,
        keepWithNext=True
    ))

    styles.add(ParagraphStyle(
        'SubSecHeading',
        parent=styles['Normal'],
        fontName='Helvetica-Bold',
        fontSize=12,
        leading=16,
        textColor=SECONDARY,
        spaceBefore=12,
        spaceAfter=6,
        keepWithNext=True
    ))

    styles.add(ParagraphStyle(
        'BodyTextCustom',
        parent=styles['Normal'],
        fontName='Helvetica',
        fontSize=9.5,
        leading=13.5,
        textColor=TEXT_DARK,
        spaceAfter=6
    ))

    styles.add(ParagraphStyle(
        'BulletCustom',
        parent=styles['Normal'],
        fontName='Helvetica',
        fontSize=9,
        leading=13,
        textColor=TEXT_DARK,
        leftIndent=12,
        spaceAfter=4
    ))

    styles.add(ParagraphStyle(
        'CaptionText',
        parent=styles['Normal'],
        fontName='Helvetica-Oblique',
        fontSize=8.5,
        leading=11,
        textColor=TEXT_MUTED,
        alignment=1,
        spaceBefore=4,
        spaceAfter=12
    ))

    styles.add(ParagraphStyle(
        'CalloutBoxText',
        parent=styles['Normal'],
        fontName='Helvetica',
        fontSize=9,
        leading=13,
        textColor=PRIMARY
    ))

    story = []

    # Helper function to embed scaled screenshots safely
    def get_image(filename, width=7.2*inch, height=3.8*inch):
        path = os.path.join(img_dir, filename)
        if os.path.exists(path):
            return Image(path, width=width, height=height)
        else:
            return Paragraph(f"<i>[Gambar screenshot {filename} tidak ditemukan]</i>", styles['CaptionText'])

    # =========================================================================
    # COVER / HEADER SECTION
    # =========================================================================
    # Header Banner Card
    header_data = [
        [
            Paragraph("<b>KLINIK PRATAMA PUSDIKZI</b><br/><font size=8 color='#64748B'>Jl. Jenderal Sudirman No. 35, Bogor | Telp: (0251) 832-1234</font>", styles['BodyTextCustom']),
            Paragraph("<b>IZIN OPERASIONAL:</b> 440/PUSDIKZI/2025<br/><b>SIP DOKTER:</b> 503/123/DISKES/2024", styles['BodyTextCustom'])
        ]
    ]
    t_head = Table(header_data, colWidths=[4.2*inch, 3.0*inch])
    t_head.setStyle(TableStyle([
        ('BACKGROUND', (0,0), (-1,-1), BG_LIGHT),
        ('BOX', (0,0), (-1,-1), 1, BORDER_COLOR),
        ('PADDING', (0,0), (-1,-1), 8),
        ('VALIGN', (0,0), (-1,-1), 'MIDDLE'),
    ]))
    story.append(t_head)
    story.append(Spacer(1, 15))

    story.append(Paragraph("WALKTHROUGH & PANDUAN PENGGUNAAN<br/>SISTEM INFORMASI KLINIK PRATAMA PUSDIKZI", styles['CoverTitle']))
    story.append(Paragraph("Dokumentasi Operasional Lengkap untuk Pasien, Dokter, Kasir, Admin, dan Apoteker<br/><i>Dilengkapi Screenshot Visual Layanan & Modul Sistem Informasi Modern 2026</i>", styles['CoverSubtitle']))
    
    story.append(HRFlowable(width="100%", thickness=2, color=PRIMARY, spaceBefore=0, spaceAfter=12))

    # Ringkasan Eksekutif Callout
    summary_html = """
    <b>RINGKASAN SISTEM & METADATA DOKUMEN:</b><br/>
    Sistem Informasi KLINIK PRATAMA PUSDIKZI didesain sebagai platform manajemen kesehatan terpadu modern yang mengintegrasikan seluruh lini layanan medis klinik. Platform ini mendukung pengolahan Rekam Medis Elektronik (EMR) berbasis SOAP, antrean real-time, Health Passport Pasien, Smart Billing Counter, serta terhubung langsung ke Portal SATUSEHAT Kemenkes & BPJS Health Bridge. Dokumen ini merupakan panduan walkthrough resmi bagi seluruh pemangku kepentingan.
    """
    t_sum = Table([[Paragraph(summary_html, styles['CalloutBoxText'])]], colWidths=[7.2*inch])
    t_sum.setStyle(TableStyle([
        ('BACKGROUND', (0,0), (-1,-1), colors.HexColor("#E6F4EA")),
        ('BOX', (0,0), (-1,-1), 1, colors.HexColor("#34A853")),
        ('PADDING', (0,0), (-1,-1), 10),
    ]))
    story.append(t_sum)
    story.append(Spacer(1, 15))

    # Table of Roles Overview
    story.append(Paragraph("Ringkasan Akses Role & Hak Akses Pengguna", styles['SubSecHeading']))
    roles_table_data = [
        ["Role Pengguna", "Nama Modul / Workspace", "Fungsi Utama & Fitur Unggulan"],
        ["Pasien", "Personal Health Hub", "Health Passport, Monitoring Vitals, Booking Kunjungan, Status Antrean, E-Resep & Streak Obat"],
        ["Dokter", "Clinical Workspace (EMR)", "Antrean Pemeriksaan SOAP, Auto-Lookup ICD-10 & ICD-9 CM, E-Prescribing, Check Interaksi Obat"],
        ["Kasir", "Smart Billing Counter", "Itemized Billing Auto-Calculator, Multi-Payment Gateway (QRIS/Cash/BPJS), Print Struk PDF"],
        ["Admin", "Command Center KPI", "Analytics Harian/Bulanan, Manajemen Master Data (Dokter/Obat/Pasien), Audit Log & SATUSEHAT Sync"],
        ["Apoteker", "Apotek Digital Workspace", "Manajemen Stok Obat Farmasi, Verifikasi Resep Masuk, Penyerahan Obat & Batch Tracking"]
    ]
    t_roles = Table(roles_table_data, colWidths=[1.1*inch, 1.8*inch, 4.3*inch])
    t_roles.setStyle(TableStyle([
        ('BACKGROUND', (0,0), (-1,0), PRIMARY),
        ('TEXTCOLOR', (0,0), (-1,0), colors.white),
        ('FONTNAME', (0,0), (-1,0), 'Helvetica-Bold'),
        ('FONTSIZE', (0,0), (-1,0), 8.5),
        ('BOTTOMPADDING', (0,0), (-1,0), 6),
        ('BACKGROUND', (0,1), (-1,-1), BG_LIGHT),
        ('GRID', (0,0), (-1,-1), 0.5, BORDER_COLOR),
        ('FONTNAME', (0,1), (-1,-1), 'Helvetica'),
        ('FONTSIZE', (0,1), (-1,-1), 8),
        ('VALIGN', (0,0), (-1,-1), 'MIDDLE'),
        ('PADDING', (0,0), (-1,-1), 5),
    ]))
    story.append(t_roles)
    story.append(Spacer(1, 15))

    # Screenshot 1: Landing Page Public
    story.append(Paragraph("1. Halaman Utama Portal Publik (Landing Page Klinik)", styles['SubSecHeading']))
    story.append(Paragraph("Halaman awal publik yang diakses calon pasien dan masyarakat umum untuk melihat profil klinik, daftar poliklinik spesialis, serta jadwal operasional resmi.", styles['BodyTextCustom']))
    story.append(get_image("01_landing_page.png", width=7.2*inch, height=3.5*inch))
    story.append(Paragraph("Gambar 1.1: Tampilan Landing Page KLINIK PRATAMA PUSDIKZI dengan Hero Banner & Header Navigasi.", styles['CaptionText']))

    story.append(Spacer(1, 8))

    # Fitur Antrean Cepat Homepage (Tanpa Akun)
    story.append(Paragraph("1.1. Fitur Antrean Cepat di Homepage (Solusi Pasien Tanpa Akun / Walk-in)", styles['SubSecHeading']))
    story.append(Paragraph("Bagi pasien baru atau pasien darurat/walk-in yang <b>belum memiliki akun atau belum pernah login</b>, klinik menyediakan modul <b>Ambil Antrean Cepat</b> langsung pada homepage tanpa hambatan registrasi rumit:", styles['BodyTextCustom']))
    
    quick_queue_features = """
    <b>KEUNGGULAN FITUR ANTREAN CEPAT DI HOMEPAGE:</b><br/>
    • <b>Tanpa Syarat Login / Download Aplikasi:</b> Pasien cukup membuka link homepage klinik dari browser HP atau monitor kiosk pendaftaran mandiri.<br/>
    • <b>Input Cepat 2 Langkah:</b> Cukup mengisi Nama Lengkap / NIK KTP dan memilih Poliklinik tujuan (Poli Penyakit Dalam, Gigi, Umum, KIA, Mata, Anak).<br/>
    • <b>Penerbitan Nomor Tiket Instan:</b> Sistem langsung menerbitkan nomor antrean resmi (contoh: <b>A-012</b>) lengkap dengan display live nomor antrean yang sedang dilayani saat ini (<b>A-011</b>) dan estimasi jam periksa.<br/>
    • <b>Registrasi Otomatis Akun Baru:</b> Apabila NIK belum terdaftar di sistem rekam medis, sistem menampilkan formulir instan (NIK, No BPJS, Tempat Tanggal Lahir, TB/BB) untuk langsung dibuatkan akun Health Hub personal secara otomatis.
    """
    t_qq = Table([[Paragraph(quick_queue_features, styles['CalloutBoxText'])]], colWidths=[7.2*inch])
    t_qq.setStyle(TableStyle([
        ('BACKGROUND', (0,0), (-1,-1), colors.HexColor("#FEF3C7")),
        ('BOX', (0,0), (-1,-1), 1, colors.HexColor("#F59E0B")),
        ('PADDING', (0,0), (-1,-1), 8),
    ]))
    story.append(t_qq)
    story.append(Spacer(1, 8))

    story.append(get_image("01b_quick_queue_homepage.png", width=7.2*inch, height=3.5*inch))
    story.append(Paragraph("Gambar 1.2: Modul Ambil Antrean Cepat di Homepage dengan Live Antrean Display untuk Pasien Tanpa Akun.", styles['CaptionText']))

    story.append(PageBreak())

    # =========================================================================
    # BAGIAN 1: PANDUAN PENGGUNA PASIEN
    # =========================================================================
    story.append(Paragraph("BAGIAN 1: PANDUAN PENGGUNA PASIEN (Personal Health Hub)", styles['SecHeading']))
    story.append(Paragraph("Pasien memiliki portal personal mandiri untuk memantau kesehatan, mendaftar kunjungan, dan mengakses rekam medis digital secara transparan.", styles['BodyTextCustom']))
    
    # Fitur Pasien 1: Health Passport & Vitals
    story.append(Paragraph("1.2. Health Passport Digital & Tren Vital Signs", styles['SubSecHeading']))
    story.append(Paragraph("Dashboard Pasien menampilkan <b>Health Passport Digital</b> berisi identitas medis (No. RM, NIK, Golongan Darah), indikator vital terkini (Tekanan Darah, Detak Jantung, Saturation O2), serta <b>Medication Streak</b> untuk mendorong kepatuhan minum obat.", styles['BodyTextCustom']))
    story.append(Paragraph("• <b>Visualisasi Tren:</b> Grafik interaktif yang memantau perkembangan tekanan darah (Sistol & Diastol) selama 4 bulan terakhir.<br/>• <b>Widget Kualitas Udara:</b> Parameter Lingkungan (AQI) dan tips kesehatan harian terintegrasi.", styles['BulletCustom']))
    story.append(get_image("03_pasien_dashboard.png", width=7.2*inch, height=3.8*inch))
    story.append(Paragraph("Gambar 1.3: Personal Health Hub Pasien - Health Passport, Status Antrean Real-time, dan Grafik Tren Vitals.", styles['CaptionText']))

    story.append(Spacer(1, 10))

    # Fitur Pasien 2: Booking Kunjungan Online
    story.append(Paragraph("1.3. Booking Kunjungan Online & Pendaftaran Poliklinik", styles['SubSecHeading']))
    story.append(Paragraph("Pasien dapat menjadwalkan kunjungan berobat secara online tanpa perlu datang dan mengantre dari pagi di klinik.", styles['BodyTextCustom']))
    story.append(Paragraph("<b>Langkah-Langkah Booking Kunjungan:</b><br/>"
                           "1. Masuk ke tab <i>'Booking Kunjungan'</i> di sidebar kiri Dashboard Pasien.<br/>"
                           "2. Pilih <b>Poliklinik Tujuan</b> (Umum, Gigi, Kebidanan/KIA, Spesialis Penyakit Dalam, Anak, atau Mata).<br/>"
                           "3. Pilih <b>Dokter Spesialis</b> dan tentukan tanggal serta sesi jam kunjungan.<br/>"
                           "4. Isikan <b>Keluhan Utama</b> atau alasan konsultasi medis.<br/>"
                           "5. Klik tombol <i>'Konfirmasi Booking & Ambil Tiket'</i> untuk menerbitkan nomor antrean resmi.", styles['BodyTextCustom']))
    story.append(get_image("04_pasien_booking.png", width=7.2*inch, height=3.7*inch))
    story.append(Paragraph("Gambar 1.3: Form Booking Kunjungan Online Poliklinik & Jadwal Dokter.", styles['CaptionText']))

    story.append(PageBreak())

    # Fitur Pasien 3: Antrean Real-time & Resep
    story.append(Paragraph("1.3. Pemantauan Antrean Real-Time & Riwayat E-Resep", styles['SubSecHeading']))
    story.append(Paragraph("Modul ini memberikan informasi transparan terkait estimasi panggilan periksa dan ketersediaan obat pasien.", styles['BodyTextCustom']))
    
    antrean_resep_table = [
        [
            Paragraph("<b>Monitoring Antrean Real-Time</b><br/>Pasien dapat melihat status panggilan dokter secara langsung dari HP/Laptop. Sistem menampilkan nomor antrean yang sedang diperiksa di ruang dokter, sisa antrean, dan estimasi waktu penanganan.", styles['BodyTextCustom']),
            Paragraph("<b>Akses E-Resep & Riwayat Obat</b><br/>Pasien memiliki akses penuh terhadap daftar resep digital yang diberikan oleh dokter, lengkap dengan aturan pakai (dosis), status penyiapan di apotek, dan tombol konfirmasi minum obat harian.", styles['BodyTextCustom'])
        ]
    ]
    t_ar = Table(antrean_resep_table, colWidths=[3.5*inch, 3.5*inch])
    t_ar.setStyle(TableStyle([
        ('BACKGROUND', (0,0), (-1,-1), BG_LIGHT),
        ('BOX', (0,0), (-1,-1), 1, BORDER_COLOR),
        ('PADDING', (0,0), (-1,-1), 8),
        ('VALIGN', (0,0), (-1,-1), 'TOP'),
    ]))
    story.append(t_ar)
    story.append(Spacer(1, 10))

    story.append(get_image("05_pasien_antrean.png", width=7.2*inch, height=3.6*inch))
    story.append(Paragraph("Gambar 1.4: Tab Antrean Real-time Pasien dengan Status Dipanggil & Progress Periksa.", styles['CaptionText']))

    story.append(Spacer(1, 10))

    story.append(get_image("06_pasien_resep.png", width=7.2*inch, height=3.6*inch))
    story.append(Paragraph("Gambar 1.5: Modul E-Resep & Tracking Kepatuhan Minum Obat (Medication Streak).", styles['CaptionText']))

    story.append(PageBreak())

    # =========================================================================
    # BAGIAN 2: PANDUAN PENGGUNA DOKTER
    # =========================================================================
    story.append(Paragraph("BAGIAN 2: PANDUAN PENGGUNA DOKTER (Clinical Workspace & EMR)", styles['SecHeading']))
    story.append(Paragraph("Workspace klinis dokter dirancang ergonomis untuk mempercepat konsultasi medis, akurasi diagnosis, dan keamanan pemberian resep obat.", styles['BodyTextCustom']))

    story.append(Paragraph("2.1. Beranda Praktik & Antrean Pemeriksaan Pasien", styles['SubSecHeading']))
    story.append(Paragraph("Saat dokter mengaktifkan role Dokter, sistem menampilkan <b>Antrean Pemeriksaan Aktif</b> harian. Dokter dapat menekan tombol <i>'Panggil Pasien'</i> untuk memberikan notifikasi otomatis ke ruang tunggu maupun HP pasien.", styles['BodyTextCustom']))
    story.append(get_image("07_dokter_dashboard.png", width=7.2*inch, height=3.7*inch))
    story.append(Paragraph("Gambar 2.1: Clinical Workspace Dokter - Antrean Pasien Aktif & Ringkasan Praktik Harian.", styles['CaptionText']))

    story.append(Spacer(1, 10))

    story.append(Paragraph("2.2. Pengisian EMR Digital (Metode SOAP) & Kodifikasi Medis", styles['SubSecHeading']))
    story.append(Paragraph("Sistem EMR KLINIK PRATAMA PUSDIKZI mengadopsi standar internasional penulisan medis <b>SOAP</b> (Subjective, Objective, Assessment, Plan):", styles['BodyTextCustom']))
    story.append(Paragraph("• <b>S (Subjective):</b> Anamnesis keluhan utama dan riwayat penyakit pasien.<br/>"
                           "• <b>O (Objective):</b> Pemeriksaan fisik, Tanda Vital (TD, Nadi, Suhu, RR), dan hasil lab/EKG.<br/>"
                           "• <b>A (Assessment):</b> Penentuan Diagnosis Utama & Sekunder menggunakan pencarian standar <b>ICD-10</b>.<br/>"
                           "• <b>P (Plan):</b> Rencana tindakan medis (<b>ICD-9 CM</b>), edukasi, dan E-Prescribing.", styles['BulletCustom']))
    story.append(get_image("08_dokter_emr.png", width=7.2*inch, height=3.7*inch))
    story.append(Paragraph("Gambar 2.2: Form Ruang Periksa EMR (SOAP) - Auto-Lookup ICD-10 & ICD-9 CM.", styles['CaptionText']))

    story.append(PageBreak())

    # Fitur Dokter 3: E-Resep & Drug Interaction
    story.append(Paragraph("2.3. E-Prescribing & Peringatan Otomatis Interaksi Obat (Safety Warning)", styles['SubSecHeading']))
    story.append(Paragraph("Sistem dilengkapi engine pencegahan kelalaian medis (Medical Safety Rules) yang bekerja secara real-time saat dokter meresepkan obat:", styles['BodyTextCustom']))
    
    doc_safety_features = [
        ["Fitur Keamanan Resep", "Mekanisme Kerja Engine AI / Rules", "Dampak Terhadap Keselamatan Pasien"],
        ["Drug-Drug Interaction Alert", "Mendeteksi kontraindikasi antar obat (Contoh: Amlodipine + Simvastatin).", "Mencegah efek toksisitas obat atau reaksi samping yang membahayakan."],
        ["Stock Check & Warning", "Menampilkan indikator stok obat farmasi secara real-time.", "Mencegah penulisan resep untuk obat yang sedang habis di apotek."],
        ["Allergy Check", "Peringatan otomatis jika pasien memiliki riwayat alergi obat tertentu.", "Menghindari reaksi syok anafilaktik akibat alergi obat."]
    ]
    t_ds = Table(doc_safety_features, colWidths=[1.6*inch, 3.2*inch, 2.4*inch])
    t_ds.setStyle(TableStyle([
        ('BACKGROUND', (0,0), (-1,0), SECONDARY),
        ('TEXTCOLOR', (0,0), (-1,0), colors.white),
        ('FONTNAME', (0,0), (-1,0), 'Helvetica-Bold'),
        ('FONTSIZE', (0,0), (-1,0), 8.5),
        ('BACKGROUND', (0,1), (-1,-1), BG_LIGHT),
        ('GRID', (0,0), (-1,-1), 0.5, BORDER_COLOR),
        ('FONTNAME', (0,1), (-1,-1), 'Helvetica'),
        ('FONTSIZE', (0,1), (-1,-1), 8),
        ('PADDING', (0,0), (-1,-1), 5),
    ]))
    story.append(t_ds)
    story.append(Spacer(1, 10))

    story.append(get_image("09_dokter_eresep.png", width=7.2*inch, height=3.7*inch))
    story.append(Paragraph("Gambar 2.3: Modul E-Prescribing Dokter dengan Peringatan Interaksi Obat & Stok Apotek.", styles['CaptionText']))

    story.append(PageBreak())

    # =========================================================================
    # BAGIAN 3: PANDUAN PENGGUNA KASIR
    # =========================================================================
    story.append(Paragraph("BAGIAN 3: PANDUAN PENGGUNA KASIR (Smart Billing Counter)", styles['SecHeading']))
    story.append(Paragraph("Modul Kasir mengintegrasikan seluruh kalkulasi biaya tindakan medis dari Dokter dan resep obat dari Farmasi menjadi rincian invoice transparan.", styles['BodyTextCustom']))

    story.append(Paragraph("3.1. Alur Proses Pembayaran & Multi-Payment Gateway", styles['SubSecHeading']))
    story.append(Paragraph("<b>Alur Pembayaran Kasir:</b><br/>"
                           "1. Kasir memilih antrean pasien berstatus <i>'Selesai Periksa'</i> di sisi kiri.<br/>"
                           "2. Sistem secara otomatis memuat <b>Rincian Tagihan Auto-Itemized</b> (Biaya Konsultasi Dokter, Resep Obat, dan Tindakan Medis).<br/>"
                           "3. Kasir memilih metode pembayaran: <b>QRIS Instant Dynamic</b>, <b>Tunai (Cash)</b>, <b>Kartu Debit/Kredit EDC</b>, atau <b>BPJS Kesehatan (Covered 100%)</b>.<br/>"
                           "4. Klik tombol <i>'Terima Pembayaran & Cetak Struk'</i>.", styles['BodyTextCustom']))
    story.append(get_image("10_kasir_dashboard.png", width=7.2*inch, height=3.7*inch))
    story.append(Paragraph("Gambar 3.1: Smart Billing Counter Kasir - Rincian Itemized Tagihan & Opsi Pembayaran.", styles['CaptionText']))

    story.append(Spacer(1, 10))

    story.append(Paragraph("3.2. Penerbitan & Cetak Struk / Invoice Resmi", styles['SubSecHeading']))
    story.append(Paragraph("Setelah pembayaran terverifikasi, modal cetak kuitansi resmi akan terbuka. Kasir dapat langsung mencetak struk fisik thermal paper atau menyimpan dokumen dalam bentuk PDF resmi.", styles['BodyTextCustom']))
    story.append(get_image("11_kasir_struk_modal.png", width=7.2*inch, height=3.7*inch))
    story.append(Paragraph("Gambar 3.2: Modal Preview Struk Invoice Pembayaran Resmi KLINIK PRATAMA PUSDIKZI.", styles['CaptionText']))

    story.append(PageBreak())

    # =========================================================================
    # BAGIAN 4: PANDUAN PENGGUNA ADMIN & APOTEKER
    # =========================================================================
    story.append(Paragraph("BAGIAN 4: PANDUAN PENGGUNA ADMIN & APOTEKER (Command Center)", styles['SecHeading']))
    story.append(Paragraph("Command Center memberikan pengawasan penuh terhadap operasional klinik, manajemen inventaris obat, integrasi instansi pemerintah, dan log keamanan.", styles['BodyTextCustom']))

    story.append(Paragraph("4.1. Strategic KPI Analytics Dashboard", styles['SubSecHeading']))
    story.append(Paragraph("Admin dapat memantau indikator kinerja utama klinik dalam tampilan visual real-time: Total Pasien Terlayani, Total Pendapatan Harian/Bulanan, Status Antrean Aktif, dan Persentase Sinkronisasi SATUSEHAT (100%).", styles['BodyTextCustom']))
    story.append(get_image("12_admin_dashboard.png", width=7.2*inch, height=3.6*inch))
    story.append(Paragraph("Gambar 4.1: Command Center Admin - Strategic KPI Analytics Dashboard & Tren Kunjungan.", styles['CaptionText']))

    story.append(Spacer(1, 10))

    story.append(Paragraph("4.2. Manajemen Master Data Obat & Warning Stok Kritis", styles['SubSecHeading']))
    story.append(Paragraph("Modul Farmasi & Master Data Obat memudahkan pengawasan stok obat. Sistem memberikan penanda warna khusus bagi obat berstatus <b>Stok Kritis</b> (di bawah batas minimum stok) untuk segera diterbitkan Auto Purchase Order (PO).", styles['BodyTextCustom']))
    story.append(get_image("13_admin_master_obat.png", width=7.2*inch, height=3.6*inch))
    story.append(Paragraph("Gambar 4.2: Master Data Obat & Inventaris Farmasi dengan Indikator Stok Kritis.", styles['CaptionText']))

    story.append(PageBreak())

    # Fitur Admin 3: SATUSEHAT & Audit Log
    story.append(Paragraph("4.3. Monitoring Integrasi SATUSEHAT Kemenkes & System Audit Log", styles['SubSecHeading']))
    story.append(Paragraph("Untuk memenuhi regulasi Kementerian Kesehatan RI, seluruh rekam medis pasien disinkronkan secara otomatis ke Portal SATUSEHAT Kemenkes. Admin dapat memantau latency koneksi (45 ms) dan jejak aktivitas penggunan pada <b>System Audit Log</b>.", styles['BodyTextCustom']))
    story.append(get_image("14_admin_satusehat_audit.png", width=7.2*inch, height=3.7*inch))
    story.append(Paragraph("Gambar 4.3: Monitor Integrasi SATUSEHAT Kemenkes, BPJS Bridge, dan Audit Log System.", styles['CaptionText']))

    story.append(Spacer(1, 10))

    # =========================================================================
    # BAGIAN 5: FITUR TAMBAHAN & AKSESIBILITAS
    # =========================================================================
    story.append(Paragraph("BAGIAN 5: FITUR TAMBAHAN & AKSESIBILITAS SISTEM", styles['SecHeading']))
    story.append(Paragraph("Sistem Informasi KLINIK PRATAMA PUSDIKZI dilengkapi berbagai fitur pendukung untuk kenyamanan dan navigasi cepat bagi seluruh pengguna.", styles['BodyTextCustom']))

    story.append(Paragraph("5.1. Multi-Role Login & Quick Switcher", styles['SubSecHeading']))
    story.append(Paragraph("Layar login mendukung otentikasi multi-role (Pasien, Dokter, Kasir, Admin, Apoteker) serta tombol <b>1-Klik Quick Access Demo</b> untuk memudahkan navigasi pengujian sistem.", styles['BodyTextCustom']))
    story.append(get_image("02_login_screen.png", width=7.2*inch, height=3.5*inch))
    story.append(Paragraph("Gambar 5.1: Layar Multi-Role Login Portal dengan Quick Demo Access Buttons.", styles['CaptionText']))

    story.append(Spacer(1, 10))

    story.append(Paragraph("5.2. Pusat Bantuan & FAQ Interaktif serta Command Palette (Ctrl+K)", styles['SubSecHeading']))
    story.append(Paragraph("• <b>Pusat Bantuan & FAQ:</b> Widget floating bantuan dengan ikon <i>help-circle</i> yang melayani konsultasi informasi jadwal, BPJS, syarat booking, dan peta lokasi secara otomatis 24 jam.<br/>"
                           "• <b>Command Palette (Ctrl+K):</b> Fitur pencarian kilat via keyboard shortcut untuk langsung berpindah antar modul atau mencari data pasien/obat secara instan.", styles['BodyTextCustom']))
    story.append(get_image("15_chatbot_command.png", width=7.2*inch, height=3.5*inch))
    story.append(Paragraph("Gambar 5.2: Panel Pusat Bantuan & FAQ 24 Jam serta Command Palette Navigator.", styles['CaptionText']))

    story.append(PageBreak())

    # =========================================================================
    # BAGIAN 6: OPTIMASI LAYAR SMARTPHONE / HP (MOBILE APP EXPERIENCE)
    # =========================================================================
    story.append(Paragraph("BAGIAN 6: OPTIMASI LAYAR SMARTPHONE / HP (NATIVE APP EXPERIENCE)", styles['SecHeading']))
    story.append(Paragraph("Sistem Informasi KLINIK PRATAMA PUSDIKZI telah dioptimalkan secara mendalam untuk perangkat smartphone (Android & iOS) dengan tampilan dan kenyamanan setara <i>Native Mobile Application</i>.", styles['BodyTextCustom']))

    story.append(Paragraph("6.1. Sticky Bottom Navigation Bar & Mobile Off-Canvas Drawer", styles['SubSecHeading']))
    story.append(Paragraph("• <b>Sticky Bottom Navigation Bar:</b> Bar navigasi bawah dengan efek <i>glassmorphism blur</i> yang menyesuaikan menu otomatis berdasarkan peran aktif (Pasien, Dokter, Kasir, Admin, Apoteker).<br/>"
                           "• <b>Off-Canvas Sidebar Drawer:</b> Sidebar desktop bertransisi menjadi drawer samping yang halus dengan backdrop blur saat menekan tombol Menu.<br/>"
                           "• <b>Touch-First UI:</b> Seluruh tombol tindakan, form input, dan metrik tanda vital disesuaikan dengan standar sentuhan jempol (minimum target 44px).", styles['BodyTextCustom']))
    
    # Table showing mobile screenshots side-by-side
    mob_img1 = get_image(os.path.join("mobile", "01_mobile_landing.png"), width=2.3*inch, height=4.2*inch)
    mob_img2 = get_image(os.path.join("mobile", "04_mobile_pasien_dashboard.png"), width=2.3*inch, height=4.2*inch)
    mob_img3 = get_image(os.path.join("mobile", "06_mobile_drawer.png"), width=2.3*inch, height=4.2*inch)

    mobile_table = Table([[mob_img1, mob_img2, mob_img3]], colWidths=[2.4*inch, 2.4*inch, 2.4*inch])
    mobile_table.setStyle(TableStyle([
        ('ALIGN', (0,0), (-1,-1), 'CENTER'),
        ('VALIGN', (0,0), (-1,-1), 'MIDDLE'),
        ('PADDING', (0,0), (-1,-1), 2),
    ]))
    story.append(mobile_table)
    story.append(Paragraph("Gambar 6.1: Antarmuka Mobile: (Kiri) Landing Page & Bottom Nav, (Tengah) Health Passport HP, (Kanan) Off-Canvas Drawer.", styles['CaptionText']))

    story.append(Spacer(1, 15))

    # =========================================================================
    # PENUTUP & SOP CHECKLIST
    # =========================================================================
    story.append(Paragraph("PENUTUP & CHECKLIST SOP OPERASIONAL HARIAN", styles['SecHeading']))
    
    sop_data = [
        ["Role / Petugas", "SOP Awal Shift (Buka)", "SOP Selama Shift", "SOP Akhir Shift (Tutup)"],
        ["Pasien", "Booking online / Ambil nomor antrean cepat di hero page.", "Pantau status panggilan periksa di HP dari tab 'Antrean'.", "Cek e-resep & simpan struk pembayaran di Health Hub."],
        ["Dokter", "Login workspace & pastikan status ruangan periksa AKTIF.", "Panggil pasien, isi EMR SOAP, input ICD-10/ICD-9 & E-Resep.", "Verifikasi seluruh EMR ter-submit & pastikan sync SATUSEHAT."],
        ["Kasir", "Buka kas harian & cek ketersediaan kertas struk cetak.", "Proses billing pasien selesai periksa, terima QRIS/Cash/BPJS.", "Cetak Rekap Kas Shift & cocokkan total penerimaan kasir."],
        ["Admin", "Cek status server, BPJS bridge, & SATUSEHAT latency.", "Monitor stok obat kritis & jalankan PO otomatis jika diperlukan.", "Tinjau Audit Log harian & backup database sistem."]
    ]
    t_sop = Table(sop_data, colWidths=[1.1*inch, 2.0*inch, 2.1*inch, 2.0*inch])
    t_sop.setStyle(TableStyle([
        ('BACKGROUND', (0,0), (-1,0), PRIMARY),
        ('TEXTCOLOR', (0,0), (-1,0), colors.white),
        ('FONTNAME', (0,0), (-1,0), 'Helvetica-Bold'),
        ('FONTSIZE', (0,0), (-1,0), 8),
        ('BACKGROUND', (0,1), (-1,-1), BG_LIGHT),
        ('GRID', (0,0), (-1,-1), 0.5, BORDER_COLOR),
        ('FONTNAME', (0,1), (-1,-1), 'Helvetica'),
        ('FONTSIZE', (0,1), (-1,-1), 7.5),
        ('PADDING', (0,0), (-1,-1), 5),
    ]))
    story.append(t_sop)
    story.append(Spacer(1, 15))

    story.append(Paragraph("<b>HUBUNGI BANTUAN TEKNIS IT KLINIK PRATAMA PUSDIKZI:</b><br/>"
                           "Jika terjadi kendala operasional sistem, hubungi Tim IT Helpdesk di (021) 8590-1234 Ext. 88 / Email: support@klinikpusdikzi.go.id", styles['BodyTextCustom']))

    # Build PDF
    doc.build(story, canvasmaker=NumberedCanvas)
    print(f"PDF Walkthrough successfully generated at: {pdf_path}")

if __name__ == "__main__":
    create_walkthrough_pdf()
