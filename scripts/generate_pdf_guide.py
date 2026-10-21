import asyncio
import os
import base64
from playwright.async_api import async_playwright

WORKSPACE_DIR = r"e:\Sistem Informasi Klinik Zeni"
ARTIFACT_DIR = r"C:\Users\AXIO\.gemini\antigravity-ide\brain\5685de95-9351-4c54-ad19-ffda8a3b4968"

def get_b64(filename):
    p = os.path.join(ARTIFACT_DIR, filename)
    if not os.path.exists(p):
        return ""
    with open(p, "rb") as f:
        return f"data:image/png;base64,{base64.b64encode(f.read()).decode('utf-8')}"

# Load 100% fresh, complete screenshots corresponding to all sitemap nodes & features
img_daftar = get_b64("fresh_daftar_form.png")
img_queue = get_b64("fresh_queue_hub.png")
img_pasien = get_b64("fresh_patient_card_main.png")
img_whatsapp = get_b64("fresh_whatsapp_modal.png")
img_dokter_soap = get_b64("fresh_dokter_soap_form.png")
img_surat_medis = get_b64("fresh_surat_medis_form.png")
img_tabel_stok = get_b64("fresh_tabel_stok_obat.png")
img_apotek_opname = get_b64("fresh_apotek_workspace.png")
img_input_obat = get_b64("fresh_input_obat_form.png")
img_kasir = get_b64("fresh_kasir_workspace.png")
img_kasir_table = get_b64("fresh_kasir_billing_table.png")
img_kasir_receipt = get_b64("fresh_kasir_receipt_modal.png")
img_kwitansi_bpjs = get_b64("fresh_kwitansi_bpjs.png")
img_kwitansi_umum = get_b64("fresh_kwitansi_umum.png")
img_antrian_tv = get_b64("fresh_antrian_tv_clean.png")
img_admin_satusehat = get_b64("fresh_admin_satusehat.png")
img_cmd_palette = get_b64("fresh_cmd_palette.png")
img_mobile = get_b64("fresh_mobile_pasien.png")

html_content = f"""<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Buku Panduan Operasional Lengkap SIMKLINIK Pratama PUSDIKZI TNI AD</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@500;600;700&display=swap');

  @page {{
    size: 210mm 297mm;
    margin: 0;
  }}

  * {{
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    -webkit-print-color-adjust: exact !important;
    print-color-adjust: exact !important;
  }}

  body {{
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: #1e293b;
    background: #ffffff;
    font-size: 8.9pt;
    line-height: 1.42;
  }}

  /* Exact A4 Page Container */
  .a4-page {{
    width: 210mm;
    height: 297mm;
    max-height: 297mm;
    padding: 13mm 18mm 11mm 18mm;
    position: relative;
    page-break-after: always;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    overflow: hidden;
    background: #ffffff;
  }}

  /* Running Header & Footer */
  .page-header {{
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 2px solid #2E5339;
    padding-bottom: 5px;
    margin-bottom: 9px;
  }}
  .page-header .brand {{
    font-size: 8.5pt;
    font-weight: 800;
    color: #2E5339;
    letter-spacing: 0.5px;
    display: flex;
    align-items: center;
    gap: 6px;
    text-transform: uppercase;
  }}
  .page-header .doc-type {{
    font-size: 7.8pt;
    font-weight: 700;
    color: #64748b;
  }}

  .page-footer {{
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid #E2E8F0;
    padding-top: 4px;
    margin-top: 5px;
    font-size: 7.6pt;
    color: #64748b;
  }}
  .page-footer .page-num {{
    font-weight: 800;
    color: #2E5339;
    background: #F0FDF4;
    padding: 2px 8px;
    border-radius: 4px;
    border: 1px solid #DCFCE7;
  }}

  .content-body {{
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
  }}

  /* Headings */
  h1.title-chapter {{
    font-size: 11.8pt;
    font-weight: 900;
    color: #1E3926;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 7px;
    text-transform: uppercase;
    letter-spacing: -0.2px;
  }}
  h2.title-section {{
    font-size: 9pt;
    font-weight: 800;
    color: #0f172a;
    margin-top: 5px;
    margin-bottom: 3px;
    border-left: 3.5px solid #2E5339;
    padding-left: 6px;
  }}
  p {{
    font-size: 8.4pt;
    color: #334155;
    margin-bottom: 4px;
    text-align: justify;
  }}
  ul, ol {{
    margin-left: 16px;
    margin-bottom: 5px;
    font-size: 8.4pt;
    color: #334155;
  }}
  li {{
    margin-bottom: 2px;
  }}

  .callout {{
    background: #F0FDF4;
    border-left: 3.5px solid #2E5339;
    padding: 5px 8px;
    border-radius: 0 6px 6px 0;
    margin: 4px 0;
    font-size: 8pt;
  }}
  .callout-title {{
    font-weight: 800;
    color: #1E3926;
    margin-bottom: 1px;
    font-size: 8.3pt;
  }}

  table.data-table {{
    width: 100%;
    border-collapse: collapse;
    margin: 5px 0;
    font-size: 7.8pt;
  }}
  table.data-table th {{
    background: #2E5339;
    color: white;
    padding: 4px 6px;
    text-align: left;
    font-weight: 700;
    border: 1px solid #1E3926;
  }}
  table.data-table td {{
    padding: 4px 6px;
    border: 1px solid #CBD5E1;
    color: #334155;
  }}
  table.data-table tr:nth-child(even) {{
    background: #F8FAFC;
  }}

  .frame-screenshot {{
    background: #F8FAFC;
    border: 1.5px solid #CBD5E1;
    border-radius: 7px;
    padding: 4px;
    margin: 4px 0 2px 0;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    text-align: center;
  }}
  .frame-screenshot img {{
    width: 100%;
    max-height: 96mm;
    object-fit: contain;
    border-radius: 4px;
    border: 1px solid #E2E8F0;
    display: block;
    background: #ffffff;
  }}
  .frame-caption {{
    font-size: 7.3pt;
    color: #475569;
    margin-top: 3px;
    font-weight: 700;
  }}

  .grid-2col {{
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 7px;
    margin: 4px 0;
  }}
  .card-box {{
    background: #F8FAFC;
    border: 1px solid #E2E8F0;
    border-radius: 6px;
    padding: 6px 8px;
  }}
  .card-box h3 {{
    font-size: 8.1pt;
    font-weight: 800;
    color: #2E5339;
    margin-bottom: 2px;
    border-bottom: 1px dashed #CBD5E1;
    padding-bottom: 2px;
  }}

  /* Sitemap Visual Styling */
  .sitemap-container {{
    display: flex;
    flex-direction: column;
    gap: 5px;
    margin-top: 3px;
  }}
  .sitemap-zone {{
    border: 1.5px solid #CBD5E1;
    border-radius: 7px;
    padding: 5px 9px;
    background: #ffffff;
  }}
  .zone-header {{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 3px;
    border-bottom: 1px solid #E2E8F0;
    padding-bottom: 2px;
  }}
  .zone-title {{
    font-size: 8.3pt;
    font-weight: 800;
    display: flex;
    align-items: center;
    gap: 5px;
  }}
  .zone-badge {{
    font-size: 6.8pt;
    font-weight: 800;
    padding: 2px 6px;
    border-radius: 9999px;
  }}
  .sitemap-node-grid {{
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
    gap: 4px;
  }}
  .sitemap-node {{
    background: #F8FAFC;
    border: 1px solid #E2E8F0;
    border-radius: 5px;
    padding: 3px 5px;
    font-size: 7.3pt;
  }}
  .node-url {{
    font-family: 'JetBrains Mono', monospace;
    font-size: 7pt;
    font-weight: 700;
    color: #2E5339;
    display: block;
    margin-bottom: 1px;
  }}
  .node-desc {{
    color: #64748b;
    line-height: 1.2;
    display: block;
  }}

  /* Cover Custom */
  .cover-container {{
    border: 3px double #2E5339;
    height: 100%;
    border-radius: 8px;
    padding: 20px 18px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    background: linear-gradient(150deg, #FAFAF9 0%, #EDF7ED 100%);
  }}
  .cover-top {{
    text-align: center;
    border-bottom: 2px solid #2E5339;
    padding-bottom: 14px;
  }}
  .cover-emblem {{
    width: 56px;
    height: 56px;
    background: #2E5339;
    color: white;
    border-radius: 14px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    margin-bottom: 8px;
    box-shadow: 0 4px 10px rgba(46,83,57,0.3);
  }}
  .cover-title-box {{
    text-align: center;
    margin: 18px 0;
  }}
  .cover-main-title {{
    font-size: 18pt;
    font-weight: 900;
    color: #0f172a;
    line-height: 1.25;
    text-transform: uppercase;
    letter-spacing: -0.5px;
    margin-bottom: 10px;
  }}
  .cover-main-title span {{
    color: #2E5339;
  }}
  .cover-desc {{
    font-size: 9.5pt;
    color: #475569;
    max-width: 90%;
    margin: 0 auto 16px auto;
    line-height: 1.45;
  }}
  .badge-chip {{
    display: inline-block;
    padding: 3px 10px;
    border-radius: 9999px;
    font-size: 7.5pt;
    font-weight: 800;
    letter-spacing: 0.5px;
    margin: 2px;
  }}
  .badge-primary {{ background: #2E5339; color: #ffffff; }}
  .badge-gold {{ background: #FEF3C7; color: #92400E; border: 1px solid #FCD34D; }}
  .badge-blue {{ background: #E0F2FE; color: #0369A1; border: 1px solid #BAE6FD; }}

  .cover-bot {{
    background: #ffffff;
    border-radius: 8px;
    border: 1px solid #cbd5e1;
    padding: 10px 14px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 8pt;
  }}
</style>
</head>
<body>

<!-- HALAMAN 1: COVER RESMI -->
<div class="a4-page" style="padding: 14mm 14mm;">
  <div class="cover-container">
    <div class="cover-top">
      <div class="cover-emblem">⚕️</div>
      <div style="font-size: 12pt; font-weight: 900; color: #2E5339; letter-spacing: 2px; text-transform: uppercase;">
        KORPS ZENI TNI ANGKATAN DARAT
      </div>
      <div style="font-size: 9pt; font-weight: 700; color: #64748b; letter-spacing: 1px; margin-top: 2px;">
        KLINIK PRATAMA PUSAT PENDIDIKAN ZENI (PUSDIKZI) KODIKLATAD
      </div>
    </div>

    <div class="cover-title-box">
      <div class="cover-main-title">
        BUKU PANDUAN OPERASIONAL LENGKAP<br>
        <span>SIMKLINIK PRATAMA PUSDIKZI</span>
      </div>
      <div class="cover-desc">
        Pedoman Penggunaan Lengkap Berdasarkan Pemetaan Peta Situs (Sitemap): Pendaftaran Mandiri Pasien Baru, Digital Health Passport, Simulator Notifikasi WhatsApp, Workspace Dokter EMR SOAP, Penerbitan Surat Medis/Rujukan, Tabel Stok Obat Tersedia, Instalasi Farmasi Stok FEFO & Input Obat, Kasir Smart Billing, Display TV Antrean, dan Admin Center SATUSEHAT
      </div>
      <div>
        <span class="badge-chip badge-primary">FASKES TINGKAT PERTAMA</span>
        <span class="badge-chip badge-gold">KODE: FASKES-PUSDIKZI-01</span>
        <span class="badge-chip badge-blue">TERAKREDITASI SATUSEHAT & BPJS</span>
      </div>
    </div>

    <div class="cover-bot">
      <div>
        <strong style="color: #0f172a; display: block; font-size: 8.3pt;">Pusat Pelayanan Medis PUSDIKZI</strong>
        <span style="color: #64748b;">Jl. Jenderal Sudirman No. 35, Bogor Tengah, Kota Bogor</span>
      </div>
      <div style="text-align: right;">
        <strong style="color: #0f172a; display: block; font-size: 8.3pt;">Dokumen Operasional Resmi 2026</strong>
        <span style="color: #64748b;">Jejaring Rujukan: RS Tk. III Salak Bogor</span>
      </div>
    </div>
  </div>
</div>

<!-- HALAMAN 2: DAFTAR ISI & MATRIKS HAK AKSES -->
<div class="a4-page">
  <div class="page-header">
    <div class="brand">⚕️ KLINIK PRATAMA PUSDIKZI TNI AD</div>
    <div class="doc-type">DAFTAR ISI & PROFIL SISTEM</div>
  </div>

  <div class="content-body">
    <h1 class="title-chapter">📑 DAFTAR ISI & MATRIKS WEWENANG</h1>
    
    <div class="grid-2col" style="margin-bottom: 5px;">
      <div class="card-box">
        <h3>BAB 1: PETA SITUS NAVIGASI (SITEMAP)</h3>
        <p style="margin: 0; font-size: 7.3pt; color: #475569;">Struktur pohon halaman 5 zona operasional sistem.</p>
      </div>
      <div class="card-box">
        <h3>BAB 2: PENDAFTARAN PASIEN BARU MANDIRI</h3>
        <p style="margin: 0; font-size: 7.3pt; color: #475569;">Formulir registrasi mandiri & auto-generate No. RM.</p>
      </div>
      <div class="card-box">
        <h3>BAB 3: LOKET ANTREAN & TIKET WALK-IN</h3>
        <p style="margin: 0; font-size: 7.3pt; color: #475569;">Ambil tiket antrean cepat tanpa login di beranda.</p>
      </div>
      <div class="card-box">
        <h3>BAB 4: DIGITAL HEALTH PASSPORT PASIEN</h3>
        <p style="margin: 0; font-size: 7.3pt; color: #475569;">Kartu pasien IHS SATUSEHAT & hasil lab POCT.</p>
      </div>
      <div class="card-box">
        <h3>BAB 5: NOTIFIKASI GATEWAY WHATSAPP</h3>
        <p style="margin: 0; font-size: 7.3pt; color: #475569;">Simulasi notifikasi obat siap, antrean, & kontrol.</p>
      </div>
      <div class="card-box">
        <h3>BAB 6: WORKSPACE DOKTER EMR SOAP</h3>
        <p style="margin: 0; font-size: 7.3pt; color: #475569;">Pemeriksaan klinis SOAP, ICD-10, & E-Resep.</p>
      </div>
      <div class="card-box">
        <h3>BAB 7: SURAT KETERANGAN & RUJUKAN</h3>
        <p style="margin: 0; font-size: 7.3pt; color: #475569;">Penerbitan surat sakit, SKBS, & rujukan RS Salak.</p>
      </div>
      <div class="card-box">
        <h3>BAB 8: TABEL STOK OBAT TERSEDIA</h3>
        <p style="margin: 0; font-size: 7.3pt; color: #475569;">Katalog master obat, sisa stok, & batas minimum.</p>
      </div>
      <div class="card-box">
        <h3>BAB 9: INSTALASI FARMASI & STOK FEFO</h3>
        <p style="margin: 0; font-size: 7.3pt; color: #475569;">Dispensing E-Resep & Stock Opname Stepper.</p>
      </div>
      <div class="card-box">
        <h3>BAB 10: INPUT OBAT & LOG INBOUND</h3>
        <p style="margin: 0; font-size: 7.3pt; color: #475569;">Registrasi SKU master obat & batch kadaluarsa.</p>
      </div>
      <div class="card-box">
        <h3>BAB 11: KASIR & SMART BILLING</h3>
        <p style="margin: 0; font-size: 7.3pt; color: #475569;">Tagihan otomatis, diskon BPJS, & kuitansi resmi.</p>
      </div>
      <div class="card-box">
        <h3>BAB 12: DISPLAY TV ANTREAN & SUARA TTS</h3>
        <p style="margin: 0; font-size: 7.3pt; color: #475569;">Antrean TV smart display & panggilan suara TTS.</p>
      </div>
      <div class="card-box">
        <h3>BAB 13: ADMIN CENTER & SATUSEHAT</h3>
        <p style="margin: 0; font-size: 7.3pt; color: #475569;">Manajemen RBAC, Master Data & Audit FHIR.</p>
      </div>
      <div class="card-box">
        <h3>BAB 14: COMMAND PALETTE & MOBILE</h3>
        <p style="margin: 0; font-size: 7.3pt; color: #475569;">Pencarian kilat Ctrl+K & Menu Off-Canvas.</p>
      </div>
    </div>

    <h2 class="title-section">Matriks Hak Akses Pengguna (Role-Based Access Control)</h2>
    <table class="data-table">
      <thead>
        <tr>
          <th style="width: 18%;">Role</th>
          <th style="width: 54%;">Wewenang Operasional</th>
          <th style="width: 28%;">Akses Menu Kunci</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><strong>👤 Pasien / Publik</strong></td>
          <td>Pendaftaran mandiri, antrean walk-in, Health Passport, notifikasi WhatsApp.</td>
          <td>Portal Pasien & Monitor</td>
        </tr>
        <tr>
          <td><strong>🩺 Dokter Medis</strong></td>
          <td>Antrean poli, EMR SOAP, diagnosa ICD-10, e-resep, surat sakit & rujukan RS Salak.</td>
          <td>Clinical Workspace Dokter</td>
        </tr>
        <tr>
          <td><strong>💊 Petugas Farmasi</strong></td>
          <td>Penerimaan resep, dispensing obat, input master obat baru, stok FEFO & opname.</td>
          <td>Instalasi Farmasi & Apotek</td>
        </tr>
        <tr>
          <td><strong>💳 Kasir Billing</strong></td>
          <td>Kalkulasi tagihan tindakan/obat, penjaminan BPJS/Dinas Rp 0,-, kuitansi resmi.</td>
          <td>Kasir & Pembayaran</td>
        </tr>
        <tr>
          <td><strong>🛡️ Administrator</strong></td>
          <td>KPI kunjungan, manajemen akun staf (RBAC), master tarif, audit SATUSEHAT.</td>
          <td>Admin Command Center</td>
        </tr>
      </tbody>
    </table>

    <div class="callout" style="margin-top: 2px;">
      <div class="callout-title">🏛️ Standar Regulasi Nasional</div>
      SIMKLINIK Pratama PUSDIKZI memenuhi <strong>Permenkes No. 24 Tahun 2022</strong> (RME Nasional), bridging <strong>BPJS Kesehatan (P-Care)</strong>, dan <strong>SATUSEHAT Kemenkes RI</strong>.
    </div>
  </div>

  <div class="page-footer">
    <span>Klinik Pratama PUSDIKZI Kodiklatad</span>
    <span class="page-num">Halaman 2</span>
  </div>
</div>

<!-- HALAMAN 3: BAB 1 - PETA SITUS LENGKAP (SITEMAP) -->
<div class="a4-page">
  <div class="page-header">
    <div class="brand">⚕️ KLINIK PRATAMA PUSDIKZI TNI AD</div>
    <div class="doc-type">BAB 1: PETA SITUS (SITEMAP)</div>
  </div>

  <div class="content-body">
    <h1 class="title-chapter">🗺️ BAB 1: PETA SITUS & ARSITEKTUR NAVIGASI (SITEMAP)</h1>
    
    <p>
      Peta situs visual sistem yang menghubungkan seluruh 5 zona operasional SIMKLINIK Pratama PUSDIKZI TNI AD:
    </p>

    <div class="sitemap-container">
      
      <!-- Zona 1 -->
      <div class="sitemap-zone" style="border-left: 4px solid #10B981;">
        <div class="zone-header">
          <div class="zone-title" style="color: #065F46;"><span>🟢 ZONA 1: PUBLIK & PORTAL PASIEN</span></div>
          <span class="zone-badge" style="background: #D1FAE5; color: #065F46;">Akses Terbuka & Pasien</span>
        </div>
        <div class="sitemap-node-grid">
          <div class="sitemap-node"><span class="node-url">/daftar.html</span><span class="node-desc">Pendaftaran Pasien Baru Mandiri & Auto No. RM</span></div>
          <div class="sitemap-node"><span class="node-url">/index.html</span><span class="node-desc">Beranda, Loket Antrean 3-Kolom, Roster Dokter</span></div>
          <div class="sitemap-node"><span class="node-url">/pasien.html</span><span class="node-desc">Digital Health Passport, Kartu Pasien, Lab POCT</span></div>
          <div class="sitemap-node"><span class="node-url">#whatsapp-gateway</span><span class="node-desc">Simulasi Pesan WhatsApp Otomatis ke Pasien</span></div>
          <div class="sitemap-node"><span class="node-url">/antrian-tv.html</span><span class="node-desc">Display Antrean TV Fullscreen + Suara TTS</span></div>
        </div>
      </div>

      <!-- Zona 2 -->
      <div class="sitemap-zone" style="border-left: 4px solid #2563EB;">
        <div class="zone-header">
          <div class="zone-title" style="color: #1E40AF;"><span>🩺 ZONA 2: CLINICAL WORKSPACE DOKTER (EMR)</span></div>
          <span class="zone-badge" style="background: #DBEAFE; color: #1E40AF;">Akses Medis (SIP)</span>
        </div>
        <div class="sitemap-node-grid">
          <div class="sitemap-node"><span class="node-url">/dokter.html</span><span class="node-desc">Ruang Periksa Rekam Medis SOAP & POCT Lab</span></div>
          <div class="sitemap-node"><span class="node-url">#diagnosa-icd10</span><span class="node-desc">Katalog Diagnosa Standar ICD-10 WHO</span></div>
          <div class="sitemap-node"><span class="node-url">#e-prescribing</span><span class="node-desc">E-Resep Digital Paperless ke Meja Farmasi</span></div>
          <div class="sitemap-node"><span class="node-url">#surat-medis</span><span class="node-desc">Surat Sakit & Surat Rujukan RS Salak Bogor</span></div>
        </div>
      </div>

      <!-- Zona 3 -->
      <div class="sitemap-zone" style="border-left: 4px solid #D97706;">
        <div class="zone-header">
          <div class="zone-title" style="color: #92400E;"><span>💊 ZONA 3: INSTALASI FARMASI & LOGISTIK OBAT</span></div>
          <span class="zone-badge" style="background: #FEF3C7; color: #92400E;">Akses Farmasi</span>
        </div>
        <div class="sitemap-node-grid">
          <div class="sitemap-node"><span class="node-url">/apotek.html</span><span class="node-desc">Antrean E-Resep & Dispensing Obat Siap Ambil</span></div>
          <div class="sitemap-node"><span class="node-url">#stok_obat</span><span class="node-desc">Tabel Master Stok Obat Tersedia & Batas Minimum</span></div>
          <div class="sitemap-node"><span class="node-url">#tambah-obat</span><span class="node-desc">Formulir Input Master Obat & Log Batch Masuk</span></div>
          <div class="sitemap-node"><span class="node-url">#stok-fefo</span><span class="node-desc">Monitoring Mutasi Obat Berdasarkan ED Terdekat</span></div>
          <div class="sitemap-node"><span class="node-url">#stock-opname</span><span class="node-desc">Wizard Stock Opname Stepper & Selisih Fisik</span></div>
        </div>
      </div>

      <!-- Zona 4 -->
      <div class="sitemap-zone" style="border-left: 4px solid #7C3AED;">
        <div class="zone-header">
          <div class="zone-title" style="color: #5B21B6;"><span>💳 ZONA 4: KASIR & SMART BILLING COUNTER</span></div>
          <span class="zone-badge" style="background: #EDE9FE; color: #5B21B6;">Akses Kasir</span>
        </div>
        <div class="sitemap-node-grid">
          <div class="sitemap-node"><span class="node-url">/kasir.html</span><span class="node-desc">Kalkulasi Tagihan (Konsultasi + Lab + Obat)</span></div>
          <div class="sitemap-node"><span class="node-url">#metode-bayar</span><span class="node-desc">Pembayaran Tunai, QRIS Statis/Dinamis, Debit</span></div>
          <div class="sitemap-node"><span class="node-url">#kuitansi-bpjs</span><span class="node-desc">Kuitansi Bebas Biaya BPJS/Dinas & Rekap Shift</span></div>
        </div>
      </div>

      <!-- Zona 5 -->
      <div class="sitemap-zone" style="border-left: 4px solid #0F172A;">
        <div class="zone-header">
          <div class="zone-title" style="color: #0F172A;"><span>🛡️ ZONA 5: ADMINISTRATOR & FITUR GLOBAL</span></div>
          <span class="zone-badge" style="background: #E2E8F0; color: #0F172A;">Akses Admin</span>
        </div>
        <div class="sitemap-node-grid">
          <div class="sitemap-node"><span class="node-url">/admin.html</span><span class="node-desc">Dashboard Eksekutif, RBAC, Master Tarif/Poli</span></div>
          <div class="sitemap-node"><span class="node-url">#satusehat</span><span class="node-desc">Audit Trail Log Keamanan & Metadata SATUSEHAT</span></div>
          <div class="sitemap-node"><span class="node-url">Ctrl + K / UI</span><span class="node-desc">Modal Command Palette & Mobile Drawer Menu</span></div>
        </div>
      </div>

    </div>
  </div>

  <div class="page-footer">
    <span>Klinik Pratama PUSDIKZI Kodiklatad</span>
    <span class="page-num">Halaman 3</span>
  </div>
</div>

<!-- HALAMAN 4: BAB 2 - PENDAFTARAN PASIEN BARU MANDIRI -->
<div class="a4-page">
  <div class="page-header">
    <div class="brand">⚕️ KLINIK PRATAMA PUSDIKZI TNI AD</div>
    <div class="doc-type">BAB 2: PENDAFTARAN PASIEN BARU</div>
  </div>

  <div class="content-body">
    <h1 class="title-chapter">📝 BAB 2: PENDAFTARAN PASIEN BARU (SELF-SERVICE)</h1>
    
    <p>
      Bagi calon pasien yang <strong>belum pernah berobat atau belum memiliki Nomor Rekam Medis (No. RM)</strong>, sistem menyediakan formulir pendaftaran mandiri cepat di halaman <code>/daftar.html</code>:
    </p>

    <h2 class="title-section">Tahapan Registrasi Pasien Baru Mandiri:</h2>
    <ol>
      <li>Buka halaman <strong><code>/daftar.html</code></strong> atau klik tautan <em>"Pasien Baru?"</em> pada loket utama.</li>
      <li>Masukkan <strong>Nomor Induk Kependudukan (NIK KTP) 16 digit</strong> dan <strong>Nama Lengkap</strong>.</li>
      <li>Lengkapi tanggal lahir, jenis kelamin, golongan darah, dan <strong>Nomor WhatsApp Aktif</strong>.</li>
      <li>Pilih <strong>Jenis Penjamin Biaya</strong> (BPJS Kesehatan 13 digit / Dinas TNI-AD / Umum).</li>
      <li>Tuliskan <strong>Riwayat Alergi Obat/Makanan</strong> untuk dicantumkan pada peringatan medis.</li>
      <li>Buat <strong>PIN Keamanan 6 Angka</strong> untuk login ke portal pasien, lalu tekan tombol hijau utama.</li>
    </ol>

    <div class="frame-screenshot">
      <img src="{img_daftar}" style="max-height: 94mm;" alt="Formulir Pendaftaran Pasien Baru Mandiri">
      <div class="frame-caption">Gambar 2.1: Formulir Pendaftaran Mandiri Pasien Baru untuk Penerbitan No. RM & Health Passport</div>
    </div>

    <div class="callout">
      <div class="callout-title">🆔 Penerbitan Nomor RM Otomatis</div>
      Setelah tombol ditekan, sistem menerbitkan Nomor RM resmi (contoh: <code>RM-2026-0881</code>) dan langsung membuka lembar Digital Health Passport pasien.
    </div>
  </div>

  <div class="page-footer">
    <span>Klinik Pratama PUSDIKZI Kodiklatad</span>
    <span class="page-num">Halaman 4</span>
  </div>
</div>

<!-- HALAMAN 5: BAB 3 - LOKET ANTREAN MANDIRI 3-KOLOM -->
<div class="a4-page">
  <div class="page-header">
    <div class="brand">⚕️ KLINIK PRATAMA PUSDIKZI TNI AD</div>
    <div class="doc-type">BAB 3: LOKET ANTREAN MANDIRI</div>
  </div>

  <div class="content-body">
    <h1 class="title-chapter">🎫 BAB 3: LOKET ANTREAN MANDIRI & TIKET WALK-IN</h1>
    
    <p>
      Bagi pasien yang sudah terdaftar dan datang langsung (*walk-in*) ke klinik untuk mengambil tiket antrean:
    </p>

    <h2 class="title-section">Langkah Pengambilan Tiket Antrean Cepat:</h2>
    <ol>
      <li>Buka Beranda Klinik: <code>/index.html</code> pada kiosk pendaftaran mandiri atau smartphone.</li>
      <li>Pada kolom tengah <strong>"LOKET PENDAFTARAN ANTREAN MANDIRI"</strong>:
        <ul>
          <li>Ketik <strong>Nama Lengkap Pasien atau NIK KTP</strong>.</li>
          <li>Pilih <strong>Tujuan Poliklinik</strong> (Umum, Gigi, Penyakit Dalam, KIA, atau Laboratorium).</li>
          <li>Pilih <strong>Kategori Penjamin</strong> (Dinas TNI-AD, Persit KCK, BPJS Kesehatan, atau Umum).</li>
        </ul>
      </li>
      <li>Tekan tombol hijau: <strong>"🖨️ Cetak & Ambil Tiket Antrean (A-004)"</strong>.</li>
      <li>Tiket elektronik resmi terbit dan nomor antrean langsung terdaftar pada sistem display TV ruang tunggu.</li>
    </ol>

    <div class="frame-screenshot">
      <img src="{img_queue}" alt="Loket Pendaftaran Antrean Mandiri">
      <div class="frame-caption">Gambar 3.1: Formulir Loket Pendaftaran Antrean Mandiri 3-Kolom dengan Tombol Cetak Tiket</div>
    </div>

    <div class="callout">
      <div class="callout-title">⚡ Estimasi Waktu Tunggu Real-Time</div>
      Sistem secara otomatis menghitung estimasi waktu tunggu (rata-rata 8 menit per pasien) dan mengirim data ke antrean dokter terkait.
    </div>
  </div>

  <div class="page-footer">
    <span>Klinik Pratama PUSDIKZI Kodiklatad</span>
    <span class="page-num">Halaman 5</span>
  </div>
</div>

<!-- HALAMAN 6: BAB 4 - DIGITAL HEALTH PASSPORT PASIEN -->
<div class="a4-page">
  <div class="page-header">
    <div class="brand">⚕️ KLINIK PRATAMA PUSDIKZI TNI AD</div>
    <div class="doc-type">BAB 4: DIGITAL HEALTH PASSPORT</div>
  </div>

  <div class="content-body">
    <h1 class="title-chapter">💳 BAB 4: DIGITAL HEALTH PASSPORT PASIEN</h1>
    
    <p>
      Kartu identitas kesehatan digital terpadu <strong>Digital Health Passport</strong> merangkum profil medis pasien:
    </p>

    <h2 class="title-section">Fitur-Fitur Health Passport Pasien Terkini:</h2>
    <ul>
      <li><strong>Kartu Pasien Digital:</strong> Nama Lengkap, Nomor RM, NIK, Golongan Darah, <em>Nomor IHS SATUSEHAT Kemenkes</em> (<code>IHS: P-8829103991</code>), serta <em>Peringatan Alergi Obat</em>.</li>
      <li><strong>Status BPJS Aktif:</strong> Indikator kepesertaan terhubung ke Faskes 1 KLINIK PUSDIKZI.</li>
      <li><strong>Hasil Lab POCT Terkini:</strong> Gula Darah Sewaktu (GDS), Kolesterol, Asam Urat terverifikasi.</li>
      <li><strong>Tombol Interaktif:</strong> Aktivasi Notifikasi WhatsApp & Cetak Kartu Fisik.</li>
    </ul>

    <div class="frame-screenshot">
      <img src="{img_pasien}" alt="Digital Health Passport Pasien">
      <div class="frame-caption">Gambar 4.1: Kartu Pasien Digital Versi Baru dengan Nomor IHS SATUSEHAT & Indikator BPJS Aktif</div>
    </div>

    <div class="callout">
      <div class="callout-title">💊 Medication Streak Tracker</div>
      Memungkinkan pasien mencatat dan memantau kepatuhan konsumsi obat harian secara teratur.
    </div>
  </div>

  <div class="page-footer">
    <span>Klinik Pratama PUSDIKZI Kodiklatad</span>
    <span class="page-num">Halaman 6</span>
  </div>
</div>

<!-- HALAMAN 7: BAB 5 - SIMULATOR NOTIFIKASI GATEWAY WHATSAPP -->
<div class="a4-page">
  <div class="page-header">
    <div class="brand">⚕️ KLINIK PRATAMA PUSDIKZI TNI AD</div>
    <div class="doc-type">BAB 5: NOTIFIKASI WHATSAPP</div>
  </div>

  <div class="content-body">
    <h1 class="title-chapter">📲 BAB 5: SIMULATOR NOTIFIKASI GATEWAY WHATSAPP</h1>
    
    <p>
      Sistem dilengkapi <strong>WhatsApp Gateway Notification Engine</strong> yang mengirimkan pemberitahuan otomatis ke smartphone pasien untuk memastikan komunikasi medis berjalan tepat waktu:
    </p>

    <h2 class="title-section">5 Skenario Notifikasi WhatsApp Otomatis:</h2>
    <ol>
      <li><strong>💊 Obat Farmasi Siap Diambil:</strong> Pemberitahuan seketika saat E-Resep selesai diracik dan dikemas oleh apoteker, lengkap dengan tombol <em>"Lihat Aturan Pakai"</em>.</li>
      <li><strong>📢 Panggilan Antrean Pasien:</strong> Peringatan saat nomor antrean pasien sisa 1 nomor lagi sebelum dipanggil dokter ke ruang periksa.</li>
      <li><strong>📅 Pengingat Kontrol Ulang (H-1):</strong> Notifikasi otomatis 24 jam sebelum jadwal konsultasi dokter spesialis.</li>
      <li><strong>📄 Surat Medis & Lab Terbit:</strong> Tautan unduh PDF Surat Keterangan Sakit & hasil tes lab POCT resmi.</li>
      <li><strong>🎟️ Konfirmasi Booking Kunjungan:</strong> Bukti reservasi jadwal poli online dengan estimasi jam layanan.</li>
    </ol>

    <div class="frame-screenshot">
      <img src="{img_whatsapp}" style="max-height: 94mm;" alt="Simulator Notifikasi WhatsApp Gateway">
      <div class="frame-caption">Gambar 5.1: Tampilan Simulator WhatsApp Gateway Klinik PUSDIKZI (Official Verified Account)</div>
    </div>

    <div class="callout">
      <div class="callout-title">💬 Interaktivitas Dua Arah</div>
      Pasien dapat membalas pesan konfirmasi kehadiran atau menekan tombol aksi cepat langsung dari aplikasi WhatsApp.
    </div>
  </div>

  <div class="page-footer">
    <span>Klinik Pratama PUSDIKZI Kodiklatad</span>
    <span class="page-num">Halaman 7</span>
  </div>
</div>

<!-- HALAMAN 8: BAB 6 - CLINICAL WORKSPACE DOKTER EMR SOAP -->
<div class="a4-page">
  <div class="page-header">
    <div class="brand">⚕️ KLINIK PRATAMA PUSDIKZI TNI AD</div>
    <div class="doc-type">BAB 6: WORKSPACE DOKTER EMR</div>
  </div>

  <div class="content-body">
    <h1 class="title-chapter">🩺 BAB 6: CLINICAL WORKSPACE DOKTER (EMR SOAP)</h1>
    
    <p>
      Lembar kerja rekam medis elektronik (RME) komprehensif dokter berstandar Permenkes No. 24/2022:
    </p>

    <h2 class="title-section">Struktur Lembar Kerja Pemeriksaan SOAP:</h2>
    <ol>
      <li><strong>Header Pasien:</strong> Nama, No. RM, status penjaminan BPJS, nomor panggil (<code>A-004</code>), dan alert alergi obat.</li>
      <li><strong>[S] Subjektif:</strong> Anamnesa keluhan utama dan riwayat penyakit sekarang.</li>
      <li><strong>[O] Objektif & Lab POCT:</strong> Tanda vital (TD, Suhu, Nadi, SpO2) dan hasil tes cepat POCT (GDS, Kolesterol, Asam Urat, Hb).</li>
      <li><strong>[A] Asesmen ICD-10:</strong> Diagnosa standar WHO (<code>J00 - Nasopharyngitis acuta / ISPA Akut</code>).</li>
      <li><strong>[P] Plan & E-Prescribing:</strong> Peresepan obat digital dan tombol kirim paperless.</li>
    </ol>

    <div class="frame-screenshot">
      <img src="{img_dokter_soap}" style="max-height: 94mm;" alt="Lembar Kerja Dokter EMR SOAP">
      <div class="frame-caption">Gambar 6.1: Lembar Kerja Ruang Periksa Dokter EMR SOAP Lengkap dengan Hasil Lab POCT & E-Resep</div>
    </div>

    <div class="callout">
      <div class="callout-title">⚡ Pengiriman Resep Instan</div>
      Menekan tombol <em>"Simpan Rekam Medis EMR & Kirim E-Resep"</em> meneruskan data terapi ke instalasi farmasi.
    </div>
  </div>

  <div class="page-footer">
    <span>Klinik Pratama PUSDIKZI Kodiklatad</span>
    <span class="page-num">Halaman 8</span>
  </div>
</div>

<!-- HALAMAN 9: BAB 7 - PENERBITAN SURAT MEDIS & RUJUKAN -->
<div class="a4-page">
  <div class="page-header">
    <div class="brand">⚕️ KLINIK PRATAMA PUSDIKZI TNI AD</div>
    <div class="doc-type">BAB 7: SURAT MEDIS & RUJUKAN</div>
  </div>

  <div class="content-body">
    <h1 class="title-chapter">📄 BAB 7: PENERBITAN SURAT MEDIS & RUJUKAN RESMI</h1>
    
    <p>
      Dokter dapat menerbitkan surat keterangan resmi berstandar militer dan rujukan berjenjang BPJS:
    </p>

    <h2 class="title-section">Jenis Dokumen Medis yang Diterbitkan:</h2>
    <ul>
      <li><strong>Surat Keterangan Sakit (Izin Istirahat Fisik):</strong> Menetapkan jumlah hari istirahat pasien dinas/sipil disertai diagnosa klinis dan tanggal mulai berlaku.</li>
      <li><strong>Surat Keterangan Berbadan Sehat (SKBS):</strong> Untuk keperluan dinas militer, kenaikan pangkat, seleksi pendidikan prajurit siswa, atau umum.</li>
      <li><strong>Surat Rujukan Berjenjang (RS Tk. III Salak Bogor):</strong> Format bridging BPJS FKTP ke Rumah Sakit Rujukan Lanjutan bila memerlukan tindakan spesialis lebih mendalam.</li>
    </ul>

    <div class="frame-screenshot">
      <img src="{img_surat_medis}" style="max-height: 94mm;" alt="Formulir Penerbitan Surat Medis">
      <div class="frame-caption">Gambar 7.1: Formulir Penerbitan Surat Keterangan Sakit, SKBS, dan Surat Rujukan Berjenjang</div>
    </div>

    <div class="callout">
      <div class="callout-title">🖨️ Verifikasi Elektronik & Barcode</div>
      Surat yang diterbitkan dilengkapi barcode verifikasi digital dan langsung dapat dicetak atau diunduh oleh pasien melalui portal pribadinya.
    </div>
  </div>

  <div class="page-footer">
    <span>Klinik Pratama PUSDIKZI Kodiklatad</span>
    <span class="page-num">Halaman 9</span>
  </div>
</div>

<!-- HALAMAN 10: BAB 8 - TABEL STOK OBAT TERSEDIA -->
<div class="a4-page">
  <div class="page-header">
    <div class="brand">⚕️ KLINIK PRATAMA PUSDIKZI TNI AD</div>
    <div class="doc-type">BAB 8: TABEL STOK OBAT</div>
  </div>

  <div class="content-body">
    <h1 class="title-chapter">💊 BAB 8: TABEL INVENTORI & MASTER STOK OBAT TERSEDIA</h1>
    
    <p>
      Menu <strong>Manajemen Stok Obat</strong> (<code>/apotek.html#stok_obat</code>) menyajikan katalog seluruh perbekalan farmasi yang tersedia di klinik beserta status batas minimum:
    </p>

    <h2 class="title-section">Struktur Tabel Stok Obat & Indikator Ketersediaan:</h2>
    <ul>
      <li><strong>Kode Obat & SKU:</strong> Kode unik inventori (contoh: <code>OBT-001</code> Paracetamol, <code>OBT-002</code> Amoxicillin).</li>
      <li><strong>Nama Obat & Bentuk Sediaan:</strong> Tablet strip, sirup botol, kapsul, suspensi, atau injeksi ampul.</li>
      <li><strong>Kategori Terapi:</strong> Analgesik, Antibiotik, Antihipertensi, Antidiabetes, atau Antasida Lambung.</li>
      <li><strong>Jumlah Sisa Stok & Batas Minimum:</strong> Menampilkan sisa unit fisik nyata dan ambang batas minimum (*reorder point*).</li>
      <li><strong>Status Stok Berwarna:</strong>
        <br>🟢 <span class="badge" style="background:#DCFCE7; color:#166534; font-weight:700;">Stok Aman</span> — Stok di atas batas minimum.
        <br>🟡 <span class="badge" style="background:#FEF3C7; color:#92400E; font-weight:700;">Perlu Restock</span> — Mendekati batas minimum persediaan.
        <br>🔴 <span class="badge" style="background:#FEE2E2; color:#991B1B; font-weight:700;">Kritis / Menipis</span> — Di bawah batas minimum, wajib order segera.
      </li>
    </ul>

    <div class="frame-screenshot">
      <img src="{img_tabel_stok}" style="max-height: 94mm;" alt="Tabel Inventori Stok Obat Tersedia">
      <div class="frame-caption">Gambar 8.1: Tabel Inventori & Master Stok Obat Farmasi dengan Status Ketersediaan Real-Time</div>
    </div>

    <div class="callout">
      <div class="callout-title">🔄 Sinkronisasi Otomatis Dispensing</div>
      Setiap kali resep diserahkan ke pasien, sistem secara otomatis mengurangi jumlah sisa stok obat secara real-time.
    </div>
  </div>

  <div class="page-footer">
    <span>Klinik Pratama PUSDIKZI Kodiklatad</span>
    <span class="page-num">Halaman 10</span>
  </div>
</div>

<!-- HALAMAN 11: BAB 9 - INSTALASI FARMASI & STOK FEFO -->
<div class="a4-page">
  <div class="page-header">
    <div class="brand">⚕️ KLINIK PRATAMA PUSDIKZI TNI AD</div>
    <div class="doc-type">BAB 9: INSTALASI FARMASI FEFO</div>
  </div>

  <div class="content-body">
    <h1 class="title-chapter">📦 BAB 9: INSTALASI FARMASI & STOCK OPNAME FEFO</h1>
    
    <p>
      Instalasi Farmasi mengelola antrean resep elektronik dari ruang dokter dan menerapkan sistem pengeluaran obat <strong>First Expired, First Out (FEFO)</strong>:
    </p>

    <h2 class="title-section">Alur Pelayanan Resep & Monitoring FEFO:</h2>
    <ul>
      <li><strong>Antrean Resep Masuk:</strong> Resep muncul seketika berstatus <span style="background: #FEF3C7; color: #92400E; padding: 1px 6px; border-radius: 4px; font-weight: 700;">Siap Diracik</span>.</li>
      <li><strong>Prinsip FEFO:</strong> Mengeluarkan obat dari nomor batch dengan tanggal kadaluarsa paling dekat untuk menjamin efektivitas obat.</li>
      <li><strong>Early Warning System Kadaluarsa:</strong>
        <br>🔴 <em>Kritis (&lt; 30 Hari):</em> Wajib karantina atau retur ke distributor.
        <br>🟡 <em>Waspada (&lt; 90 Hari):</em> Prioritas utama untuk segera dikeluarkan.
        <br>🟢 <em>Aman (&gt; 6 Bulan):</em> Penyimpanan optimal dalam kondisi baik.
      </li>
      <li><strong>Stock Opname Stepper:</strong> Penyesuaian stok fisik nyata secara presisi.</li>
    </ul>

    <div class="frame-screenshot">
      <img src="{img_apotek_opname}" style="max-height: 94mm;" alt="Modul Farmasi & Stock Opname FEFO">
      <div class="frame-caption">Gambar 9.1: Monitor Instalasi Farmasi dengan Indikator Early Warning & Pelacak Batch FEFO</div>
    </div>

    <div class="callout">
      <div class="callout-title">📲 Notifikasi Obat Siap Ambil</div>
      Setelah obat dikemas dan diserahkan, sistem dapat mengirim notifikasi otomatis ke nomor WhatsApp pasien.
    </div>
  </div>

  <div class="page-footer">
    <span>Klinik Pratama PUSDIKZI Kodiklatad</span>
    <span class="page-num">Halaman 11</span>
  </div>
</div>

<!-- HALAMAN 12: BAB 10 - INPUT PENERIMAAN OBAT & BATCH MASUK -->
<div class="a4-page">
  <div class="page-header">
    <div class="brand">⚕️ KLINIK PRATAMA PUSDIKZI TNI AD</div>
    <div class="doc-type">BAB 10: INPUT PENERIMAAN OBAT</div>
  </div>

  <div class="content-body">
    <h1 class="title-chapter">📥 BAB 10: INPUT PENERIMAAN OBAT & BATCH MASUK</h1>
    
    <p>
      Petugas farmasi mencatat setiap penerimaan perbekalan kesehatan dari Pedagang Besar Farmasi (PBF) atau Gudang Bekkes TNI AD melalui menu <strong>Input Penerimaan Obat</strong> (<code>/apotek.html#tambah_obat</code>):
    </p>

    <h2 class="title-section">Panduan Input Master Obat & Log Batch Inbound:</h2>
    <ol>
      <li><strong>Kode Obat / SKU:</strong> Masukkan kode unik perbekalan medis (contoh: <code>OBT-2026-088</code>).</li>
      <li><strong>Kategori Farmasi:</strong> Pilih jenis sediaan (Tablet/Kapsul, Sirup, Injeksi/Ampul, Salep/Krim, atau Alkes).</li>
      <li><strong>Nama Obat & Dosis:</strong> Tulis nama generik/paten beserta kekuatan sediaan (contoh: <em>Ibuprofen 400mg Film-Coated Tablet</em>).</li>
      <li><strong>Jumlah Diterima (Qty) & Stok Minimum:</strong> Masukkan total unit fisik masuk dan batas alert restock.</li>
      <li><strong>Harga Satuan (Rp):</strong> Nilai nominal per unit obat untuk kalkulasi billing.</li>
      <li><strong>Informasi Batch & Kadaluarsa:</strong> Input <em>Nomor Batch Pabrik</em> (misal: <code>BATCH-IBU-992A</code>), <em>Tanggal Masuk Inbound</em>, <em>Tanggal Kadaluarsa (ED)</em>, dan <em>Nama PBF Distributor</em>.</li>
      <li>Tekan tombol: <strong>"Simpan Master & Log Batch Masuk"</strong>. Kartu stok otomatis bertambah.</li>
    </ol>

    <div class="frame-screenshot">
      <img src="{img_input_obat}" style="max-height: 94mm;" alt="Formulir Input Penerimaan Obat">
      <div class="frame-caption">Gambar 10.1: Formulir Input Penerimaan Obat Baru, Registrasi SKU & Log Batch Inbound</div>
    </div>

    <div class="callout">
      <div class="callout-title">🔒 Validasi Mutu & Keamanan Pasien</div>
      Pencatatan batch pabrik dan tanggal kadaluarsa yang akurat merupakan syarat mutlak kepatuhan standar akreditasi KARS & Permenkes RI.
    </div>
  </div>

  <div class="page-footer">
    <span>Klinik Pratama PUSDIKZI Kodiklatad</span>
    <span class="page-num">Halaman 12</span>
  </div>
</div>

<!-- HALAMAN 13: BAB 11 - KASIR & SMART BILLING -->
<div class="a4-page">
  <div class="page-header">
    <div class="brand">⚕️ KLINIK PRATAMA PUSDIKZI TNI AD</div>
    <div class="doc-type">BAB 11: KASIR & SMART BILLING</div>
  </div>

  <div class="content-body">
    <h1 class="title-chapter">💳 BAB 11: KASIR, SMART BILLING & KUITANSI RESMI</h1>
    
    <p>
      Modul Kasir mengkalkulasi seluruh tagihan secara otomatis dan menerbitkan <strong>Bukti Transaksi & Struk Kuitansi Resmi</strong> berstandar Kodiklat TNI AD:
    </p>

    <h2 class="title-section">Fitur Utama Kasir & Penerbitan Kuitansi:</h2>
    <ul>
      <li><strong>Antrean Billing Pasien:</strong> Menampilkan invoice masuk (<code>INV-0830-01</code>), layanan poli, penjamin, dan status bayar.</li>
      <li><strong>Kwitansi Pasien BPJS / Dinas (Rp 0,- Bebas Biaya):</strong> Otomatis memotong 100% tagihan sesuai program kapitasi JKN FKTP.</li>
      <li><strong>Kwitansi Pasien Umum:</strong> Rincian itemized biaya dokter, tindakan lab POCT, dan obat farmasi dengan kalkulasi kembalian.</li>
    </ul>

    <div class="grid-2col" style="margin-top: 4px;">
      <div>
        <div class="frame-screenshot">
          <img src="{img_kwitansi_bpjs}" style="max-height: 56mm;" alt="Kwitansi Resmi BPJS Bebas Biaya">
          <div class="frame-caption">Gambar 11.1: Struk Kuitansi Resmi Pasien BPJS FKTP (Rp 0,- Bebas Biaya 100%)</div>
        </div>
      </div>
      <div>
        <div class="frame-screenshot">
          <img src="{img_kwitansi_umum}" style="max-height: 56mm;" alt="Kwitansi Pasien Umum">
          <div class="frame-caption">Gambar 11.2: Struk Kuitansi Transaksi Pasien Umum Mandiri (Rp 275.000)</div>
        </div>
      </div>
    </div>

    <div class="callout" style="margin-top: 4px;">
      <div class="callout-title">🖨️ Format Kuitansi Siap Cetak & Ekspor PDF</div>
      Kwitansi dapat dicetak langsung ke printer thermal struk kasir atau diunduh oleh pasien melalui portal digital pribadinya.
    </div>
  </div>

  <div class="page-footer">
    <span>Klinik Pratama PUSDIKZI Kodiklatad</span>
    <span class="page-num">Halaman 13</span>
  </div>
</div>

<!-- HALAMAN 14: BAB 12 - DISPLAY TV ANTREAN & AUDIO TTS -->
<div class="a4-page">
  <div class="page-header">
    <div class="brand">⚕️ KLINIK PRATAMA PUSDIKZI TNI AD</div>
    <div class="doc-type">BAB 12: DISPLAY TV ANTREAN</div>
  </div>

  <div class="content-body">
    <h1 class="title-chapter">📺 BAB 12: DISPLAY TV ANTREAN & PANGGILAN AUDIO TTS</h1>
    
    <p>
      Layar Display Antrean TV (<code>/antrian-tv.html</code>) dipasang pada Smart TV ruang tunggu klinik dengan visual resolusi tinggi dan fitur pemanggilan otomatis:
    </p>

    <h2 class="title-section">Fitur dan Pengoperasian TV Display Ruang Tunggu:</h2>
    <ul>
      <li><strong>Panggilan Suara Text-to-Speech (TTS):</strong> Pemanggilan audio otomatis berbahasa Indonesia yang jernih (*"Nomor Antrean A-004, silakan menuju Ruang Periksa 2 Poli Penyakit Dalam"*).</li>
      <li><strong>Grid Antrean Multi-Poli:</strong> Menampilkan nomor antrean yang sedang diperiksa di Poli Umum, Gigi, Penyakit Dalam, KIA, dan UGD.</li>
      <li><strong>Running Text & Video Edukasi:</strong> Menampilkan pesan layanan masyarakat, protokol kesehatan, dan jadwal dokter dinas hari ini.</li>
      <li><strong>Mode Fullscreen Otomatis:</strong> Tombol fullscreen siap pakai untuk kiosk smart TV tanpa toolbar browser.</li>
    </ul>

    <div class="frame-screenshot">
      <img src="{img_antrian_tv}" style="max-height: 94mm;" alt="Layar Display TV Antrean Fullscreen">
      <div class="frame-caption">Gambar 12.1: Tampilan Layar Display TV Antrean Fullscreen Ruang Tunggu dengan Panggilan Suara TTS</div>
    </div>

    <div class="callout">
      <div class="callout-title">🔊 Fleksibilitas Pemanggilan Audio</div>
      Panggilan suara dapat dipicu langsung oleh dokter dari ruang periksa atau diulang secara manual oleh petugas loket pendaftaran.
    </div>
  </div>

  <div class="page-footer">
    <span>Klinik Pratama PUSDIKZI Kodiklatad</span>
    <span class="page-num">Halaman 14</span>
  </div>
</div>

<!-- HALAMAN 15: BAB 13 - ADMIN CENTER & GLOBAL COMMAND PALETTE -->
<div class="a4-page">
  <div class="page-header">
    <div class="brand">⚕️ KLINIK PRATAMA PUSDIKZI TNI AD</div>
    <div class="doc-type">BAB 13: ADMIN & COMMAND PALETTE</div>
  </div>

  <div class="content-body">
    <h1 class="title-chapter">🛡️ BAB 13: ADMIN CENTER, SATUSEHAT & SHORTCUT GLOBAL</h1>
    
    <div class="grid-2col" style="margin-bottom: 4px;">
      <div>
        <h2 class="title-section" style="margin-top: 0;">13.1 Audit SATUSEHAT Kemenkes</h2>
        <p style="font-size: 8pt;">Monitoring sinkronisasi data rekam medis ke server nasional:</p>
        <ul style="font-size: 8pt; margin-left: 14px;">
          <li>Log pertukaran resource FHIR (Encounter & Condition).</li>
          <li>Enkripsi data RME berstandar AES-256 Bit.</li>
          <li>Manajemen akun staf bertingkat (RBAC).</li>
        </ul>
        <div class="frame-screenshot" style="margin-top: 2px;">
          <img src="{img_admin_satusehat}" style="max-height: 44mm;" alt="Audit SATUSEHAT">
          <div class="frame-caption">Gambar 13.1: Panel Audit SATUSEHAT Kemenkes RI</div>
        </div>
      </div>

      <div>
        <h2 class="title-section" style="margin-top: 0;">13.2 Command Palette & Mobile Drawer</h2>
        <p style="font-size: 8pt;">Akses kilat navigasi seluruh modul sistem:</p>
        <ul style="font-size: 8pt; margin-left: 14px;">
          <li>Tekan <code>Ctrl + K</code> untuk membuka kotak pencarian kilat.</li>
          <li>Menu <em>Off-Canvas Drawer</em> responsif di smartphone.</li>
          <li>Theme Switcher Mode Terang & Gelap.</li>
        </ul>
        <div class="frame-screenshot" style="margin-top: 2px;">
          <img src="{img_cmd_palette}" style="max-height: 44mm;" alt="Command Palette">
          <div class="frame-caption">Gambar 13.2: Modal Command Palette (Ctrl+K)</div>
        </div>
      </div>
    </div>

    <h2 class="title-section">13.3 Pelayanan Kesehatan Digital Terpadu Korps Zeni TNI AD</h2>
    <p>
      Seluruh modul SIMKLINIK Pratama PUSDIKZI telah terintegrasi secara *end-to-end* mulai dari pendaftaran mandiri, konsultasi dokter, stok farmasi FEFO, smart billing kasir, hingga pelaporan audit Kemenkes demi memberikan pelayanan medis yang prima, cepat, dan profesional bagi prajurit siswa, dinas organik, Persit KCK, dan masyarakat umum.
    </p>

    <div class="callout" style="margin-top: 2px;">
      <div class="callout-title">🎖️ Faskes Mandiri Berstandar Nasional</div>
      Didukung infrastruktur modern yang siap dideploy baik secara lokal maupun cloud hosting (Netlify / Web Server).
    </div>
  </div>

  <div class="page-footer">
    <span>Klinik Pratama PUSDIKZI Kodiklatad</span>
    <span class="page-num">Halaman 15</span>
  </div>
</div>

</body>
</html>
"""

async def generate_pdf():
    print("Generating Comprehensive 15-Page Master PDF Guide with WhatsApp & Available Medicine Table...")
    async with async_playwright() as p:
        browser = await p.chromium.launch(headless=True)
        page = await browser.new_page()
        
        await page.set_content(html_content, wait_until='networkidle')
        
        pdf_workspace_path = os.path.join(WORKSPACE_DIR, "PANDUAN_LENGKAP_KLINIK_PUSDIKZI.pdf")
        pdf_artifact_path = os.path.join(ARTIFACT_DIR, "PANDUAN_LENGKAP_KLINIK_PUSDIKZI.pdf")
        
        await page.pdf(
            path=pdf_workspace_path,
            format='A4',
            print_background=True,
            margin={'top': '0mm', 'right': '0mm', 'bottom': '0mm', 'left': '0mm'}
        )
        
        await page.pdf(
            path=pdf_artifact_path,
            format='A4',
            print_background=True,
            margin={'top': '0mm', 'right': '0mm', 'bottom': '0mm', 'left': '0mm'}
        )
        
        await browser.close()
        print("Comprehensive 15-Page Master PDF generated successfully!")

if __name__ == "__main__":
    asyncio.run(generate_pdf())
