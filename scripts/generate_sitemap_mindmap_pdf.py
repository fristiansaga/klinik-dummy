import os
import sys
from playwright.sync_api import sync_playwright

html_content = """<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sitemap & Mindmap - Sistem Informasi Klinik Pratama Pusdikzi</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;600;700;800;900&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #0d5c46;
      --primary-dark: #07382a;
      --primary-light: #e6f4f0;
      --primary-border: #167e60;
      --accent-blue: #3b82f6;
      --accent-purple: #a855f7;
      --accent-amber: #f59e0b;
      --accent-rose: #f43f5e;
      --accent-cyan: #06b6d4;
      --accent-emerald: #10b981;
      --bg: #090f1d;
      --card-bg: rgba(15, 23, 42, 0.9);
      --text-main: #f8fafc;
      --text-muted: #94a3b8;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
      background-color: var(--bg);
      color: var(--text-main);
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }

    @page {
      size: A4 landscape;
      margin: 0;
    }

    .page {
      width: 297mm;
      height: 210mm;
      position: relative;
      background: radial-gradient(circle at 50% 5%, #162a4a 0%, #070d18 100%);
      color: #f8fafc;
      padding: 8.5mm 12mm 7.5mm 12mm;
      page-break-after: always;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    /* Header */
    .page-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1.5px solid rgba(255, 255, 255, 0.12);
      padding-bottom: 5px;
      margin-bottom: 7px;
    }

    .header-left {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .header-logo-badge {
      width: 32px;
      height: 32px;
      background: linear-gradient(135deg, #10b981 0%, #047857 100%);
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
    }

    .header-titles h1 {
      font-family: 'Outfit', sans-serif;
      font-size: 14.5px;
      font-weight: 800;
      letter-spacing: 0.4px;
      color: #ffffff;
      line-height: 1.2;
    }

    .header-titles p {
      font-size: 9px;
      color: #94a3b8;
      font-weight: 500;
    }

    .header-tag {
      background: rgba(16, 185, 129, 0.15);
      border: 1px solid rgba(16, 185, 129, 0.4);
      color: #34d399;
      padding: 3px 9px;
      border-radius: 20px;
      font-size: 8.5px;
      font-weight: 700;
      letter-spacing: 0.5px;
      text-transform: uppercase;
    }

    /* Footer */
    .page-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      padding-top: 5px;
      font-size: 8px;
      color: #64748b;
    }

    .page-footer span strong {
      color: #94a3b8;
    }

    /* =========================================
       PAGE 1: MINDMAP CANVAS & NODES
    ========================================= */
    .mindmap-container {
      position: relative;
      flex: 1;
      display: grid;
      grid-template-columns: 1fr 225px 1fr;
      grid-template-rows: 1fr 1fr 1fr;
      gap: 12px 20px;
      align-items: center;
      justify-content: center;
      margin: 2px 0;
    }

    /* Central Hub */
    .center-hub {
      grid-column: 2;
      grid-row: 2;
      background: linear-gradient(145deg, #0d5c46, #053326);
      border: 2px solid #34d399;
      border-radius: 16px;
      padding: 13px 11px;
      text-align: center;
      box-shadow: 0 0 40px rgba(52, 211, 153, 0.45), inset 0 1px 1px rgba(255, 255, 255, 0.3);
      position: relative;
      z-index: 10;
    }

    .hub-badge {
      display: inline-block;
      background: #34d399;
      color: #064e3b;
      font-size: 7.5px;
      font-weight: 800;
      padding: 2px 7px;
      border-radius: 10px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 3px;
    }

    .hub-title {
      font-family: 'Outfit', sans-serif;
      font-size: 13.5px;
      font-weight: 900;
      color: #ffffff;
      line-height: 1.2;
      margin-bottom: 3px;
    }

    .hub-subtitle {
      font-size: 8px;
      color: #a7f3d0;
      line-height: 1.3;
    }

    .hub-meta {
      margin-top: 6px;
      padding-top: 4px;
      border-top: 1px dashed rgba(255, 255, 255, 0.25);
      font-size: 7.2px;
      color: #e2e8f0;
      display: flex;
      justify-content: space-around;
    }

    /* Mindmap Cards */
    .branch-card {
      background: var(--card-bg);
      border-radius: 11px;
      padding: 9px 11px;
      border: 1px solid rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(8px);
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.35);
      position: relative;
      display: flex;
      flex-direction: column;
      gap: 3.5px;
      z-index: 5;
    }

    .branch-card.green {
      border-left: 4px solid #10b981;
      background: linear-gradient(135deg, rgba(16, 185, 129, 0.14) 0%, rgba(15, 23, 42, 0.92) 100%);
    }

    .branch-card.blue {
      border-left: 4px solid #3b82f6;
      background: linear-gradient(135deg, rgba(59, 130, 246, 0.14) 0%, rgba(15, 23, 42, 0.92) 100%);
    }

    .branch-card.purple {
      border-left: 4px solid #a855f7;
      background: linear-gradient(135deg, rgba(168, 85, 247, 0.14) 0%, rgba(15, 23, 42, 0.92) 100%);
    }

    .branch-card.amber {
      border-left: 4px solid #f59e0b;
      background: linear-gradient(135deg, rgba(245, 158, 11, 0.14) 0%, rgba(15, 23, 42, 0.92) 100%);
    }

    .branch-card.rose {
      border-left: 4px solid #f43f5e;
      background: linear-gradient(135deg, rgba(244, 63, 94, 0.14) 0%, rgba(15, 23, 42, 0.92) 100%);
    }

    .branch-card.cyan {
      border-left: 4px solid #06b6d4;
      background: linear-gradient(135deg, rgba(6, 182, 212, 0.14) 0%, rgba(15, 23, 42, 0.92) 100%);
    }

    .branch-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .branch-title-group {
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .branch-icon {
      font-size: 15px;
    }

    .branch-name {
      font-family: 'Outfit', sans-serif;
      font-size: 11.5px;
      font-weight: 800;
      color: #ffffff;
      letter-spacing: 0.2px;
    }

    .branch-file-tag {
      font-family: 'JetBrains Mono', monospace;
      font-size: 7.2px;
      color: #94a3b8;
      background: rgba(255, 255, 255, 0.08);
      padding: 1.5px 5px;
      border-radius: 4px;
      border: 1px solid rgba(255, 255, 255, 0.06);
    }

    .subnodes-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 4px 6px;
      margin-top: 2px;
    }

    .subnode-item {
      background: rgba(255, 255, 255, 0.04);
      border: 1px solid rgba(255, 255, 255, 0.05);
      border-radius: 5px;
      padding: 3.5px 5.5px;
    }

    .subnode-title {
      font-size: 8px;
      font-weight: 700;
      color: #e2e8f0;
      display: flex;
      align-items: center;
      gap: 3px;
    }

    .subnode-title::before {
      content: "•";
      font-size: 9px;
    }

    .branch-card.green .subnode-title::before { color: #34d399; }
    .branch-card.blue .subnode-title::before { color: #60a5fa; }
    .branch-card.purple .subnode-title::before { color: #c084fc; }
    .branch-card.amber .subnode-title::before { color: #fbbf24; }
    .branch-card.rose .subnode-title::before { color: #fb7185; }
    .branch-card.cyan .subnode-title::before { color: #22d3ee; }

    .subnode-desc {
      font-size: 7px;
      color: #94a3b8;
      line-height: 1.25;
      margin-top: 1px;
      padding-left: 6px;
    }

    /* SVG Lines */
    .mindmap-svg-lines {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: 2;
    }

    .pos-top-left { grid-column: 1; grid-row: 1; }
    .pos-mid-left { grid-column: 1; grid-row: 2; }
    .pos-bot-left { grid-column: 1; grid-row: 3; }
    
    .pos-top-right { grid-column: 3; grid-row: 1; }
    .pos-mid-right { grid-column: 3; grid-row: 2; }
    .pos-bot-right { grid-column: 3; grid-row: 3; }


    /* =========================================
       PAGE 2: DETAILED HIERARCHY & RBAC MATRIX
    ========================================= */
    .grid-page2 {
      display: grid;
      grid-template-columns: 1.15fr 1fr;
      gap: 12px;
      flex: 1;
      height: 100%;
      align-items: stretch;
    }

    .panel-box {
      background: rgba(15, 23, 42, 0.85);
      border-radius: 9px;
      border: 1px solid rgba(255, 255, 255, 0.1);
      padding: 9px 12px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 100%;
    }

    .panel-header {
      font-family: 'Outfit', sans-serif;
      font-size: 10.5px;
      font-weight: 800;
      color: #ffffff;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding-bottom: 4px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      margin-bottom: 4px;
    }

    .tree-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 6px;
      flex: 1;
    }

    .tree-box {
      background: rgba(255, 255, 255, 0.035);
      border: 1px solid rgba(255, 255, 255, 0.06);
      border-radius: 6px;
      padding: 6px 8px;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      gap: 4px;
    }

    .tree-box-title {
      font-size: 8px;
      font-weight: 800;
      color: #38bdf8;
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
      padding-bottom: 2px;
      margin-bottom: 2px;
    }

    .tree-list {
      font-size: 7.2px;
      color: #cbd5e1;
      line-height: 1.35;
      display: flex;
      flex-direction: column;
      gap: 1.5px;
    }

    .tree-list div {
      display: flex;
      justify-content: space-between;
    }

    .tree-list span.endpoint {
      font-family: 'JetBrains Mono', monospace;
      font-size: 6.5px;
      color: #34d399;
    }

    /* Matrix Table */
    .rbac-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 7.5px;
      flex: 1;
    }

    .rbac-table th {
      background: rgba(255, 255, 255, 0.08);
      color: #f8fafc;
      font-weight: 700;
      text-align: left;
      padding: 3.5px 5px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.15);
    }

    .rbac-table td {
      padding: 3px 5px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
      color: #cbd5e1;
    }

    .rbac-category-row {
      background: rgba(14, 165, 233, 0.12);
      color: #38bdf8 !important;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.3px;
      font-size: 7px;
    }

    .check-yes {
      display: inline-block;
      width: 12px;
      height: 12px;
      background: rgba(16, 185, 129, 0.25);
      color: #34d399;
      border-radius: 50%;
      text-align: center;
      line-height: 12px;
      font-weight: bold;
      font-size: 7.5px;
    }

    .check-no {
      color: #475569;
      font-size: 8px;
      display: inline-block;
      width: 12px;
      text-align: center;
    }

    /* =========================================
       PAGE 3: WORKFLOW & ENTITY ARCHITECTURE
    ========================================= */
    .workflow-grid {
      display: flex;
      flex-direction: column;
      gap: 7px;
      flex: 1;
      height: 100%;
      justify-content: space-between;
    }

    .steps-container {
      display: grid;
      grid-template-columns: repeat(6, 1fr);
      gap: 6px;
    }

    .step-card {
      background: rgba(15, 23, 42, 0.88);
      border-radius: 8px;
      padding: 7px 8px;
      border-top: 3px solid #38bdf8;
      border-left: 1px solid rgba(255, 255, 255, 0.08);
      border-right: 1px solid rgba(255, 255, 255, 0.08);
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      display: flex;
      flex-direction: column;
      position: relative;
    }

    .step-badge-num {
      position: absolute;
      top: -6.5px;
      right: 6px;
      background: #0369a1;
      color: #ffffff;
      font-size: 7px;
      font-weight: 800;
      padding: 1px 4.5px;
      border-radius: 4px;
    }

    .step-card.s1 { border-top-color: #10b981; }
    .step-card.s2 { border-top-color: #06b6d4; }
    .step-card.s3 { border-top-color: #3b82f6; }
    .step-card.s4 { border-top-color: #a855f7; }
    .step-card.s5 { border-top-color: #f59e0b; }
    .step-card.s6 { border-top-color: #f43f5e; }

    .step-head-title {
      font-family: 'Outfit', sans-serif;
      font-size: 8.8px;
      font-weight: 800;
      color: #ffffff;
      margin-bottom: 1.5px;
    }

    .step-actor {
      font-size: 6.5px;
      font-weight: 700;
      color: #94a3b8;
      text-transform: uppercase;
      margin-bottom: 3.5px;
    }

    .step-bullets {
      font-size: 6.8px;
      color: #cbd5e1;
      line-height: 1.32;
      display: flex;
      flex-direction: column;
      gap: 1.5px;
    }

    .step-bullets div {
      position: relative;
      padding-left: 6.5px;
    }

    .step-bullets div::before {
      content: "›";
      position: absolute;
      left: 0;
      color: #38bdf8;
      font-weight: bold;
    }

    /* Middle 2-col in Page 3 */
    .page3-mid-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 8px;
      flex: 1;
      align-items: stretch;
    }

    .sub-box {
      background: rgba(30, 41, 59, 0.6);
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: 8px;
      padding: 7px 10px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 100%;
    }

    .sub-box-title {
      font-size: 8.2px;
      font-weight: 800;
      color: #34d399;
      display: flex;
      align-items: center;
      gap: 4px;
      border-bottom: 1px dashed rgba(255, 255, 255, 0.1);
      padding-bottom: 3px;
      margin-bottom: 4px;
    }

    .entity-map {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 5px;
      font-size: 6.8px;
    }

    .entity-item {
      background: rgba(255, 255, 255, 0.035);
      border: 1px solid rgba(255, 255, 255, 0.05);
      border-radius: 4px;
      padding: 4px 6px;
    }

    .entity-name {
      font-weight: 700;
      color: #60a5fa;
      margin-bottom: 1.5px;
    }

    .entity-fields {
      color: #94a3b8;
      line-height: 1.25;
    }

    .fhir-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 7.2px;
    }

    .fhir-table th {
      color: #f1f5f9;
      text-align: left;
      padding: 2.5px 4.5px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.15);
    }

    .fhir-table td {
      padding: 2.8px 4.5px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
      color: #cbd5e1;
    }

    /* Bottom Architecture Banner */
    .page3-bottom-banner {
      background: rgba(15, 23, 42, 0.7);
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: 7px;
      padding: 6px 10px;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 8px;
      font-size: 7px;
      color: #94a3b8;
    }

    .banner-col strong {
      color: #38bdf8;
      display: block;
      margin-bottom: 1px;
    }
  </style>
</head>
<body>

  <!-- ==================== HALAMAN 1: MASTER MINDMAP SITEMAP ==================== -->
  <div class="page" id="page1">
    <div class="page-header">
      <div class="header-left">
        <div class="header-logo-badge">🏥</div>
        <div class="header-titles">
          <h1>SITEMAP & PETA PIKIRAN (MINDMAP) SISTEM INFORMASI KLINIK</h1>
          <p>KLINIK PRATAMA PUSDIKZI / PUSZIAD — ARSITEKTUR REKAM MEDIS ELEKTRONIK & OPERASIONAL TERPADU</p>
        </div>
      </div>
      <div class="header-tag">✨ PETA NAVIGASI & MODUL 2026</div>
    </div>

    <!-- Mindmap Graph Canvas -->
    <div class="mindmap-container">
      
      <!-- SVG Connecting Curves -->
      <svg class="mindmap-svg-lines" viewBox="0 0 1000 600" preserveAspectRatio="none">
        <defs>
          <linearGradient id="gradGreen" x1="50%" y1="50%" x2="20%" y2="20%">
            <stop offset="0%" stop-color="#34d399" stop-opacity="0.9"/>
            <stop offset="100%" stop-color="#10b981" stop-opacity="0.3"/>
          </linearGradient>
          <linearGradient id="gradBlue" x1="50%" y1="50%" x2="20%" y2="50%">
            <stop offset="0%" stop-color="#60a5fa" stop-opacity="0.9"/>
            <stop offset="100%" stop-color="#3b82f6" stop-opacity="0.3"/>
          </linearGradient>
          <linearGradient id="gradPurple" x1="50%" y1="50%" x2="20%" y2="80%">
            <stop offset="0%" stop-color="#c084fc" stop-opacity="0.9"/>
            <stop offset="100%" stop-color="#a855f7" stop-opacity="0.3"/>
          </linearGradient>
          <linearGradient id="gradAmber" x1="50%" y1="50%" x2="80%" y2="20%">
            <stop offset="0%" stop-color="#fbbf24" stop-opacity="0.9"/>
            <stop offset="100%" stop-color="#f59e0b" stop-opacity="0.3"/>
          </linearGradient>
          <linearGradient id="gradRose" x1="50%" y1="50%" x2="80%" y2="50%">
            <stop offset="0%" stop-color="#fb7185" stop-opacity="0.9"/>
            <stop offset="100%" stop-color="#f43f5e" stop-opacity="0.3"/>
          </linearGradient>
          <linearGradient id="gradCyan" x1="50%" y1="50%" x2="80%" y2="80%">
            <stop offset="0%" stop-color="#22d3ee" stop-opacity="0.9"/>
            <stop offset="100%" stop-color="#06b6d4" stop-opacity="0.3"/>
          </linearGradient>
        </defs>

        <!-- Curve Lines from Center Hub (500, 300) -->
        <path d="M 385 270 C 290 270, 240 145, 180 145" fill="none" stroke="url(#gradGreen)" stroke-width="2.5" stroke-dasharray="5 3"/>
        <path d="M 380 300 C 280 300, 240 300, 180 300" fill="none" stroke="url(#gradBlue)" stroke-width="2.5"/>
        <path d="M 385 330 C 290 330, 240 455, 180 455" fill="none" stroke="url(#gradPurple)" stroke-width="2.5" stroke-dasharray="5 3"/>

        <path d="M 615 270 C 710 270, 760 145, 820 145" fill="none" stroke="url(#gradAmber)" stroke-width="2.5" stroke-dasharray="5 3"/>
        <path d="M 620 300 C 720 300, 760 300, 820 300" fill="none" stroke="url(#gradRose)" stroke-width="2.5"/>
        <path d="M 615 330 C 710 330, 760 455, 820 455" fill="none" stroke="url(#gradCyan)" stroke-width="2.5" stroke-dasharray="5 3"/>
      </svg>

      <!-- BRANCH 1: PORTAL PASIEN & PUBLIK -->
      <div class="branch-card green pos-top-left">
        <div class="branch-header">
          <div class="branch-title-group">
            <span class="branch-icon">🌐</span>
            <span class="branch-name">Portal Pasien & Publik</span>
          </div>
          <span class="branch-file-tag">index / pasien / daftar</span>
        </div>
        <div class="subnodes-grid">
          <div class="subnode-item">
            <div class="subnode-title">Tiket Antrean Instan</div>
            <div class="subnode-desc">Ambil tiket mandiri NIK/RM, estimasi waktu & kuota dokter real-time.</div>
          </div>
          <div class="subnode-item">
            <div class="subnode-title">Personal Health Hub</div>
            <div class="subnode-desc">Health Passport, tanda vital, alergi obat, riwayat rekam medis.</div>
          </div>
          <div class="subnode-item">
            <div class="subnode-title">Booking Jadwal Dokter</div>
            <div class="subnode-desc">Reservasi online poliklinik, konfirmasi WhatsApp, kalender dokter.</div>
          </div>
          <div class="subnode-item">
            <div class="subnode-title">Medication Streak</div>
            <div class="subnode-desc">Pengingat minum obat harian, E-Resep & rincian tagihan digital.</div>
          </div>
        </div>
      </div>

      <!-- BRANCH 2: DOKTER & CLINICAL WORKSPACE -->
      <div class="branch-card blue pos-mid-left">
        <div class="branch-header">
          <div class="branch-title-group">
            <span class="branch-icon">🩺</span>
            <span class="branch-name">Clinical Dokter & EMR</span>
          </div>
          <span class="branch-file-tag">dokter.html / .php</span>
        </div>
        <div class="subnodes-grid">
          <div class="subnode-item">
            <div class="subnode-title">Predictive Triage</div>
            <div class="subnode-desc">Antrean prioritas (Emergency/Lansia), status panggil pasien.</div>
          </div>
          <div class="subnode-item">
            <div class="subnode-title">Pemeriksaan SOAP</div>
            <div class="subnode-desc">Anamnesis Subjektif, Objektif TTV, Asesmen & Rencana Terapi.</div>
          </div>
          <div class="subnode-item">
            <div class="subnode-title">Katalog ICD-10 & Resep</div>
            <div class="subnode-desc">Smart ICD-10 search, E-Prescribing, auto-warning interaksi obat.</div>
          </div>
          <div class="subnode-item">
            <div class="subnode-title">Surat Medis & Rujukan</div>
            <div class="subnode-desc">Cetak Surat Keterangan Sakit & Surat Rujukan Faskes Lanjutan.</div>
          </div>
        </div>
      </div>

      <!-- BRANCH 3: FARMASI & APOTEK -->
      <div class="branch-card purple pos-bot-left">
        <div class="branch-header">
          <div class="branch-title-group">
            <span class="branch-icon">💊</span>
            <span class="branch-name">Farmasi & Stok Obat</span>
          </div>
          <span class="branch-file-tag">apotek.html / .php</span>
        </div>
        <div class="subnodes-grid">
          <div class="subnode-item">
            <div class="subnode-title">Resep Masuk Real-Time</div>
            <div class="subnode-desc">Antrean E-Resep dokter, verifikasi dosis & telaah farmasi.</div>
          </div>
          <div class="subnode-item">
            <div class="subnode-title">Stok Kritis & FEFO/FIFO</div>
            <div class="subnode-desc">Warning batas minimum obat, monitoring tanggal kedaluwarsa.</div>
          </div>
          <div class="subnode-item">
            <div class="subnode-title">Peracikan & Etiket</div>
            <div class="subnode-desc">Status racik obat, print etiket dosis & aturan pakai pasien.</div>
          </div>
          <div class="subnode-item">
            <div class="subnode-title">Stok Opname Digital</div>
            <div class="subnode-desc">Audit fisik obat, penyesuaian stok sistem & riwayat mutasi.</div>
          </div>
        </div>
      </div>

      <!-- CENTER HUB -->
      <div class="center-hub">
        <span class="hub-badge">PUSAT SISTEM INFORMASI</span>
        <div class="hub-title">KLINIK PRATAMA PUSDIKZI</div>
        <div class="hub-subtitle">Sistem Rekam Medis Elektronik Terpadu & Tata Kelola Operasional</div>
        <div class="hub-meta">
          <span>⚡ Livewire / PHP</span>
          <span>🛡️ SATUSEHAT Ready</span>
          <span>👥 Multi-Role RBAC</span>
        </div>
      </div>

      <!-- BRANCH 4: KASIR & SMART BILLING -->
      <div class="branch-card amber pos-top-right">
        <div class="branch-header">
          <div class="branch-title-group">
            <span class="branch-icon">💳</span>
            <span class="branch-name">Kasir & Smart Billing</span>
          </div>
          <span class="branch-file-tag">kasir.html / .php</span>
        </div>
        <div class="subnodes-grid">
          <div class="subnode-item">
            <div class="subnode-title">Kalkulasi Tagihan Auto</div>
            <div class="subnode-desc">Agregasi biaya tindakan dokter + obat apotek + admin loket.</div>
          </div>
          <div class="subnode-item">
            <div class="subnode-title">Multi-Metode Bayar</div>
            <div class="subnode-desc">Tunai + kalkulator kembalian, QRIS dinamis, transfer, BPJS.</div>
          </div>
          <div class="subnode-item">
            <div class="subnode-title">Kwitansi & E-Receipt</div>
            <div class="subnode-desc">Cetak struk resmi thermal/A4 & pengiriman kwitansi via WA.</div>
          </div>
          <div class="subnode-item">
            <div class="subnode-title">Rekap Shift & Keuangan</div>
            <div class="subnode-desc">Laporan kas harian shift, ringkasan omzet & penutupan buku.</div>
          </div>
        </div>
      </div>

      <!-- BRANCH 5: DISPLAY ANTRIAN TV -->
      <div class="branch-card rose pos-mid-right">
        <div class="branch-header">
          <div class="branch-title-group">
            <span class="branch-icon">📺</span>
            <span class="branch-name">Display Antrean TV</span>
          </div>
          <span class="branch-file-tag">antrian-tv.html / .php</span>
        </div>
        <div class="subnodes-grid">
          <div class="subnode-item">
            <div class="subnode-title">Panggilan Suara TTS</div>
            <div class="subnode-desc">Text-to-Speech otomatis pemanggil nomor tiket & ruang poli.</div>
          </div>
          <div class="subnode-item">
            <div class="subnode-title">Multi-Poli Dashboard</div>
            <div class="subnode-desc">Layar split: Poli Umum, Gigi, KIA, Lab, dan Loket Farmasi.</div>
          </div>
          <div class="subnode-item">
            <div class="subnode-title">Running Text & Info</div>
            <div class="subnode-desc">Ticker pengumuman jadwal dokter bertugas & promo klinik.</div>
          </div>
          <div class="subnode-item">
            <div class="subnode-title">Video Edukasi Promkes</div>
            <div class="subnode-desc">Media edukasi kesehatan terintegrasi untuk ruang tunggu.</div>
          </div>
        </div>
      </div>

      <!-- BRANCH 6: ADMIN & COMMAND CENTER -->
      <div class="branch-card cyan pos-bot-right">
        <div class="branch-header">
          <div class="branch-title-group">
            <span class="branch-icon">🛡️</span>
            <span class="branch-name">Admin & Command Center</span>
          </div>
          <span class="branch-file-tag">admin.html / login.html</span>
        </div>
        <div class="subnodes-grid">
          <div class="subnode-item">
            <div class="subnode-title">Dashboard Eksekutif</div>
            <div class="subnode-desc">KPI kunjungan, grafik tren penyakit, analitik omzet klinik.</div>
          </div>
          <div class="subnode-item">
            <div class="subnode-title">Manajemen Akun RBAC</div>
            <div class="subnode-desc">Hak akses 5 role (Pasien, Dokter, Kasir, Apoteker, Admin).</div>
          </div>
          <div class="subnode-item">
            <div class="subnode-title">Master Data Klinik</div>
            <div class="subnode-desc">Katalog dokter, jadwal praktek, tarif tindakan & master obat.</div>
          </div>
          <div class="subnode-item">
            <div class="subnode-title">Audit Log & SATUSEHAT</div>
            <div class="subnode-desc">Security log, integrasi FHIR HL7 Kemenkes & BPJS VClaim.</div>
          </div>
        </div>
      </div>

    </div>

    <div class="page-footer">
      <span>Dokumen Resmi: <strong>Peta Arsitektur & Mindmap Sistem Informasi Klinik PUSDIKZI</strong></span>
      <span>Halaman 1 dari 3 — Diagram Peta Pikiran Utama</span>
    </div>
  </div>

  <!-- ==================== HALAMAN 2: SITEMAP STRUKTURAL & MATRIKS HAK AKSES ==================== -->
  <div class="page" id="page2">
    <div class="page-header">
      <div class="header-left">
        <div class="header-logo-badge">🗺️</div>
        <div class="header-titles">
          <h1>STRUKTUR SITEMAP DETAIL & MATRIKS HAK AKSES (RBAC)</h1>
          <p>KLINIK PRATAMA PUSDIKZI — HIRARKI NAVIGASI HALAMAN & PEMETAAN HAK AKSES PERAN PENGGUNA</p>
        </div>
      </div>
      <div class="header-tag">🔐 ROLE-BASED ACCESS CONTROL</div>
    </div>

    <div class="grid-page2">
      
      <!-- KOLOM KIRI: TREE HIERARCHY SITEMAP -->
      <div class="panel-box">
        <div class="panel-header">
          <span>🌳 Hirarki Halaman, Modul & Endpoint File</span>
          <span style="font-size: 7.5px; color: #94a3b8; font-weight: normal;">6 Modul Utama • 24 Sub-Fitur</span>
        </div>
        
        <div class="tree-grid">
          
          <div class="tree-box">
            <div class="tree-box-title">
              <span>🏠 1. Public & Pasien</span>
              <span class="endpoint">index / daftar / pasien</span>
            </div>
            <div class="tree-list">
              <div><span>├─ Beranda & Profil Klinik</span> <span class="endpoint">index.html</span></div>
              <div><span>├─ Ambil Tiket Antrean</span> <span class="endpoint">#quick-ticket</span></div>
              <div><span>├─ Pendaftaran Pasien Baru</span> <span class="endpoint">daftar.html</span></div>
              <div><span>├─ Booking Jadwal Dokter</span> <span class="endpoint">#booking</span></div>
              <div><span>├─ Health Passport (TTV)</span> <span class="endpoint">pasien.html</span></div>
              <div><span>└─ Medication Tracker</span> <span class="endpoint">#pill-streak</span></div>
            </div>
          </div>

          <div class="tree-box">
            <div class="tree-box-title">
              <span>🩺 2. Clinical Workspace</span>
              <span class="endpoint">dokter.html / .php</span>
            </div>
            <div class="tree-list">
              <div><span>├─ Queue Prioritas & Triage</span> <span class="endpoint">#queue-list</span></div>
              <div><span>├─ Panggil & Skip Antrean</span> <span class="endpoint">#call-action</span></div>
              <div><span>├─ Form EMR SOAP Terpadu</span> <span class="endpoint">#soap-entry</span></div>
              <div><span>├─ Search Koding ICD-10</span> <span class="endpoint">#icd10-modal</span></div>
              <div><span>├─ E-Resep & Cek Interaksi</span> <span class="endpoint">#e-prescribe</span></div>
              <div><span>└─ Cetak Surat Sakit / Rujukan</span> <span class="endpoint">#surat-cetak</span></div>
            </div>
          </div>

          <div class="tree-box">
            <div class="tree-box-title">
              <span>💊 3. Farmasi & Apotek</span>
              <span class="endpoint">apotek.html / .php</span>
            </div>
            <div class="tree-list">
              <div><span>├─ Feed Resep Dokter Masuk</span> <span class="endpoint">#resep-queue</span></div>
              <div><span>├─ Telaah Klinis & Dosis</span> <span class="endpoint">#telaah-modal</span></div>
              <div><span>├─ Peracikan & Print Etiket</span> <span class="endpoint">#etiket-print</span></div>
              <div><span>├─ Alert Stok Kritis/Expired</span> <span class="endpoint">#stock-alert</span></div>
              <div><span>├─ Kartu Stok Digital (FEFO)</span> <span class="endpoint">#kartu-stok</span></div>
              <div><span>└─ Stok Opname & Mutasi</span> <span class="endpoint">#opname-audit</span></div>
            </div>
          </div>

          <div class="tree-box">
            <div class="tree-box-title">
              <span>💳 4. Kasir & Smart Billing</span>
              <span class="endpoint">kasir.html / .php</span>
            </div>
            <div class="tree-list">
              <div><span>├─ Agregasi Biaya Tindakan</span> <span class="endpoint">#billing-calc</span></div>
              <div><span>├─ Kasir Tunai & Kalkulator</span> <span class="endpoint">#cash-pay</span></div>
              <div><span>├─ Dynamic QRIS & Transfer</span> <span class="endpoint">#qris-gateway</span></div>
              <div><span>├─ Cetak Struk / Kwitansi</span> <span class="endpoint">#receipt-print</span></div>
              <div><span>├─ Rekapitulasi Kas Shift</span> <span class="endpoint">#shift-recap</span></div>
              <div><span>└─ Kirim Kwitansi via WA</span> <span class="endpoint">#wa-send</span></div>
            </div>
          </div>

          <div class="tree-box">
            <div class="tree-box-title">
              <span>📺 5. Display TV Antrean</span>
              <span class="endpoint">antrian-tv.html / .php</span>
            </div>
            <div class="tree-list">
              <div><span>├─ Monitor Multi-Poliklinik</span> <span class="endpoint">#multi-poli</span></div>
              <div><span>├─ Panggilan Suara TTS Auto</span> <span class="endpoint">#tts-engine</span></div>
              <div><span>├─ Running Text Pengumuman</span> <span class="endpoint">#running-text</span></div>
              <div><span>└─ Video Promkes & Edukasi</span> <span class="endpoint">#promkes-media</span></div>
            </div>
          </div>

          <div class="tree-box">
            <div class="tree-box-title">
              <span>🛡️ 6. Admin & Tata Kelola</span>
              <span class="endpoint">admin.html / login.html</span>
            </div>
            <div class="tree-list">
              <div><span>├─ Executive KPI Dashboard</span> <span class="endpoint">#kpi-metrics</span></div>
              <div><span>├─ Manajemen Pengguna (5 Role)</span> <span class="endpoint">#rbac-user</span></div>
              <div><span>├─ Master Data Tarif & Obat</span> <span class="endpoint">#master-data</span></div>
              <div><span>├─ Audit Log & SATUSEHAT</span> <span class="endpoint">#satusehat-log</span></div>
              <div><span>└─ Backup Database Sistem</span> <span class="endpoint">#backup-tool</span></div>
            </div>
          </div>

        </div>

        <div style="font-size: 7.2px; color: #94a3b8; border-top: 1px dashed rgba(255,255,255,0.08); padding-top: 3px;">
          • <strong>Arsitektur Terpadu:</strong> Mendukung antarmuka responsif (Mobile/Desktop) dengan sinkronisasi reaktif Livewire & REST API.
        </div>
      </div>

      <!-- KOLOM KANAN: RBAC MATRIX -->
      <div class="panel-box">
        <div class="panel-header">
          <span>🛡️ Matriks Akses Peran (Role-Based Access Control)</span>
          <span style="font-size: 7.5px; color: #34d399; font-weight: bold;">5 Hak Akses Peran</span>
        </div>

        <table class="rbac-table">
          <thead>
            <tr>
              <th>Fitur & Modul Fungsional</th>
              <th style="text-align: center;">Pasien</th>
              <th style="text-align: center;">Dokter</th>
              <th style="text-align: center;">Kasir</th>
              <th style="text-align: center;">Apotek</th>
              <th style="text-align: center;">Admin</th>
            </tr>
          </thead>
          <tbody>
            <tr class="rbac-category-row"><td colspan="6">A. Pendaftaran & Antrean</td></tr>
            <tr>
              <td>Ambil Nomor Antrean & Booking Dokter</td>
              <td style="text-align:center"><span class="check-yes">✓</span></td>
              <td style="text-align:center"><span class="check-yes">✓</span></td>
              <td style="text-align:center"><span class="check-yes">✓</span></td>
              <td style="text-align:center"><span class="check-no">—</span></td>
              <td style="text-align:center"><span class="check-yes">✓</span></td>
            </tr>
            <tr>
              <td>Display Antrean TV & Audio TTS</td>
              <td style="text-align:center"><span class="check-yes">✓</span></td>
              <td style="text-align:center"><span class="check-yes">✓</span></td>
              <td style="text-align:center"><span class="check-yes">✓</span></td>
              <td style="text-align:center"><span class="check-yes">✓</span></td>
              <td style="text-align:center"><span class="check-yes">✓</span></td>
            </tr>

            <tr class="rbac-category-row"><td colspan="6">B. Rekam Medis Elektronik (EMR)</td></tr>
            <tr>
              <td>Akses Personal Health Passport</td>
              <td style="text-align:center"><span class="check-yes">✓</span></td>
              <td style="text-align:center"><span class="check-yes">✓</span></td>
              <td style="text-align:center"><span class="check-no">—</span></td>
              <td style="text-align:center"><span class="check-no">—</span></td>
              <td style="text-align:center"><span class="check-yes">✓</span></td>
            </tr>
            <tr>
              <td>Input Pemeriksaan SOAP & ICD-10</td>
              <td style="text-align:center"><span class="check-no">—</span></td>
              <td style="text-align:center"><span class="check-yes">✓</span></td>
              <td style="text-align:center"><span class="check-no">—</span></td>
              <td style="text-align:center"><span class="check-no">—</span></td>
              <td style="text-align:center"><span class="check-yes">✓</span></td>
            </tr>
            <tr>
              <td>Pembuatan E-Resep & Surat Medis</td>
              <td style="text-align:center"><span class="check-no">—</span></td>
              <td style="text-align:center"><span class="check-yes">✓</span></td>
              <td style="text-align:center"><span class="check-no">—</span></td>
              <td style="text-align:center"><span class="check-no">—</span></td>
              <td style="text-align:center"><span class="check-yes">✓</span></td>
            </tr>

            <tr class="rbac-category-row"><td colspan="6">C. Farmasi & Kasir</td></tr>
            <tr>
              <td>Validasi Resep, Dispensing & Etiket</td>
              <td style="text-align:center"><span class="check-no">—</span></td>
              <td style="text-align:center"><span class="check-no">—</span></td>
              <td style="text-align:center"><span class="check-no">—</span></td>
              <td style="text-align:center"><span class="check-yes">✓</span></td>
              <td style="text-align:center"><span class="check-yes">✓</span></td>
            </tr>
            <tr>
              <td>Stok Opname, FEFO & Kartu Stok</td>
              <td style="text-align:center"><span class="check-no">—</span></td>
              <td style="text-align:center"><span class="check-no">—</span></td>
              <td style="text-align:center"><span class="check-no">—</span></td>
              <td style="text-align:center"><span class="check-yes">✓</span></td>
              <td style="text-align:center"><span class="check-yes">✓</span></td>
            </tr>
            <tr>
              <td>Proses Pembayaran & Cetak Kwitansi</td>
              <td style="text-align:center"><span class="check-no">—</span></td>
              <td style="text-align:center"><span class="check-no">—</span></td>
              <td style="text-align:center"><span class="check-yes">✓</span></td>
              <td style="text-align:center"><span class="check-no">—</span></td>
              <td style="text-align:center"><span class="check-yes">✓</span></td>
            </tr>

            <tr class="rbac-category-row"><td colspan="6">D. Tata Kelola & Sistem</td></tr>
            <tr>
              <td>Rekap Shift Kasir & Laporan Keuangan</td>
              <td style="text-align:center"><span class="check-no">—</span></td>
              <td style="text-align:center"><span class="check-no">—</span></td>
              <td style="text-align:center"><span class="check-yes">✓</span></td>
              <td style="text-align:center"><span class="check-no">—</span></td>
              <td style="text-align:center"><span class="check-yes">✓</span></td>
            </tr>
            <tr>
              <td>Master Data, Audit Log & SATUSEHAT</td>
              <td style="text-align:center"><span class="check-no">—</span></td>
              <td style="text-align:center"><span class="check-no">—</span></td>
              <td style="text-align:center"><span class="check-no">—</span></td>
              <td style="text-align:center"><span class="check-no">—</span></td>
              <td style="text-align:center"><span class="check-yes">✓</span></td>
            </tr>
          </tbody>
        </table>

        <div style="font-size: 7.2px; color: #94a3b8; line-height: 1.25;">
          <strong style="color: #38bdf8;">Prinsip Keamanan:</strong> Berpedoman pada regulasi Permenkes No. 24 Tahun 2022 tentang Rekam Medis Elektronik dengan pembatasan hak akses berbasis peranan jabatan (*Least Privilege*).
        </div>
      </div>

    </div>

    <div class="page-footer">
      <span>Dokumen Resmi: <strong>Peta Arsitektur & Mindmap Sistem Informasi Klinik PUSDIKZI</strong></span>
      <span>Halaman 2 dari 3 — Hirarki Navigasi & Matriks Akses</span>
    </div>
  </div>

  <!-- ==================== HALAMAN 3: DIAGRAM ALUR DATA & TEKNIS ==================== -->
  <div class="page" id="page3">
    <div class="page-header">
      <div class="header-left">
        <div class="header-logo-badge">⚡</div>
        <div class="header-titles">
          <h1>ALUR DATA PASIEN TERINTEGRASI & ARSITEKTUR TEKNIS</h1>
          <p>KLINIK PRATAMA PUSDIKZI — END-TO-END PATIENT LIFECYCLE, DATAFLOW, & STANDAR INTEGRASI</p>
        </div>
      </div>
      <div class="header-tag">🔄 END-TO-END CLINICAL PIPELINE</div>
    </div>

    <div class="workflow-grid">
      
      <!-- 6-STEP PIPELINE -->
      <div class="steps-container">
        
        <div class="step-card s1">
          <div class="step-badge-num">01</div>
          <div class="step-head-title">Pendaftaran & Tiket</div>
          <div class="step-actor">👤 Pasien / Loket</div>
          <div class="step-bullets">
            <div>Ambil tiket antrean mandiri</div>
            <div>Validasi NIK / No. BPJS</div>
            <div>Sinkron kuota poliklinik</div>
            <div>Kirim status ke TV Antrean</div>
          </div>
        </div>

        <div class="step-card s2">
          <div class="step-badge-num">02</div>
          <div class="step-head-title">Triase & Tanda Vital</div>
          <div class="step-actor">🩺 Perawat / Triage</div>
          <div class="step-bullets">
            <div>Input TD, HR, Suhu, SpO2</div>
            <div>Anamnesis awal & alergi</div>
            <div>Skoring triase prioritas</div>
            <div>Data auto masuk ke EMR</div>
          </div>
        </div>

        <div class="step-card s3">
          <div class="step-badge-num">03</div>
          <div class="step-head-title">Konsultasi & SOAP</div>
          <div class="step-actor">👨‍⚕️ Dokter Spesialis</div>
          <div class="step-bullets">
            <div>Anamnesis & Fisik SOAP</div>
            <div>Koding ICD-10 otomatis</div>
            <div>Terbit E-Resep & tindakan</div>
            <div>Cetak Surat Medis/Rujukan</div>
          </div>
        </div>

        <div class="step-card s4">
          <div class="step-badge-num">04</div>
          <div class="step-head-title">Farmasi & Dispensing</div>
          <div class="step-actor">💊 Apoteker</div>
          <div class="step-bullets">
            <div>Resep realtime masuk feed</div>
            <div>Telaah klinis & interaksi</div>
            <div>Racik & print etiket dosis</div>
            <div>Potong kartu stok auto</div>
          </div>
        </div>

        <div class="step-card s5">
          <div class="step-badge-num">05</div>
          <div class="step-head-title">Kasir & Pembayaran</div>
          <div class="step-actor">💳 Kasir Billing</div>
          <div class="step-bullets">
            <div>Agregasi tindakan & obat</div>
            <div>Bayar: Tunai, QRIS, BPJS</div>
            <div>Cetak kwitansi resmi / WA</div>
            <div>Rekap omzet kasir per-shift</div>
          </div>
        </div>

        <div class="step-card s6">
          <div class="step-badge-num">06</div>
          <div class="step-head-title">Arsip & SATUSEHAT</div>
          <div class="step-actor">🛡️ Admin & Kemenkes</div>
          <div class="step-bullets">
            <div>Arsip rekam medis digital</div>
            <div>Bridging FHIR SATUSEHAT</div>
            <div>Update Health Passport</div>
            <div>Klaim BPJS VClaim terkirim</div>
          </div>
        </div>

      </div>

      <!-- MIDDLE SECTION: ENTITY MAP & SATUSEHAT FHIR -->
      <div class="page3-mid-grid">
        
        <!-- Entity Relationship Data Map -->
        <div class="sub-box">
          <div class="sub-box-title">
            <span>🗄️ Model Relasi Entitas Data (Database Entity Schema)</span>
          </div>
          <div class="entity-map">
            <div class="entity-item">
              <div class="entity-name">🏷️ Pasien</div>
              <div class="entity-fields">id, no_rm, nik, nama, tgl_lahir, jk, no_hp, alamat, gol_darah, alergi</div>
            </div>
            <div class="entity-item">
              <div class="entity-name">🎫 Antrian</div>
              <div class="entity-fields">id, nomor, poli_id, pasien_id, status, triage_priority, created_at</div>
            </div>
            <div class="entity-item">
              <div class="entity-name">📋 RekamMedis</div>
              <div class="entity-fields">id, pasien_id, dokter_id, subjektif, objektif, icd10_code, plan_terapi</div>
            </div>
            <div class="entity-item">
              <div class="entity-name">💊 ResepObat</div>
              <div class="entity-fields">id, rm_id, obat_id, dosis, frekuensi, aturan_pakai, status_racik</div>
            </div>
            <div class="entity-item">
              <div class="entity-name">📦 Obat / Stok</div>
              <div class="entity-fields">id, kode, nama, kategori, stok, min_stok, expired_at, no_batch, harga</div>
            </div>
            <div class="entity-item">
              <div class="entity-name">💳 Transaksi</div>
              <div class="entity-fields">id, invoice_no, pasien_id, total, metode, status_bayar, kasir_id</div>
            </div>
          </div>
          <div style="font-size: 7.2px; color: #94a3b8;">
            • Hubungan relasional Foreign-Key terindeks untuk integritas data medis dan kecepatan pencarian riwayat pasien.
          </div>
        </div>

        <!-- SATUSEHAT & Interoperability -->
        <div class="sub-box">
          <div class="sub-box-title">
            <span>🌐 Standar Interoperabilitas Kemenkes SATUSEHAT (FHIR HL7)</span>
          </div>
          <table class="fhir-table">
            <thead>
              <tr>
                <th>Resource FHIR</th>
                <th>Sumber Data Sistem</th>
                <th>Tujuan Integrasi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong style="color:#38bdf8">Patient</strong></td>
                <td>Data Master Pasien & NIK</td>
                <td>Pencocokan Identitas Master Patient Index (IHS)</td>
              </tr>
              <tr>
                <td><strong style="color:#34d399">Encounter</strong></td>
                <td>Kunjungan & Antrean Poli</td>
                <td>Pencatatan Riwayat Episode Rawat Jalan</td>
              </tr>
              <tr>
                <td><strong style="color:#fbbf24">Condition</strong></td>
                <td>Assessment SOAP / ICD-10</td>
                <td>Pelaporan Diagnosis Klinis Terstandar Kemenkes</td>
              </tr>
              <tr>
                <td><strong style="color:#c084fc">MedicationRequest</strong></td>
                <td>E-Resep Obat Dokter</td>
                <td>KFA (Kamus Farmasi & Alkes) Kemenkes RI</td>
              </tr>
              <tr>
                <td><strong style="color:#fb7185">Observation</strong></td>
                <td>TTV (Tekanan Darah, HR, SpO2)</td>
                <td>Data Pemeriksaan Klinis & Tanda Vital Pasien</td>
              </tr>
            </tbody>
          </table>
          <div style="font-size: 7.2px; color: #94a3b8;">
            • Format pertukaran data JSON HL7 FHIR v4.0.1 resmi Kementerian Kesehatan Republik Indonesia.
          </div>
        </div>

      </div>

      <!-- BOTTOM BANNER -->
      <div class="page3-bottom-banner">
        <div class="banner-col">
          <strong>💻 Frontend Modern</strong>
          HTML5/CSS3 glassmorphism, responsive mobile hub, Dark/Light mode switcher & Command Palette (Ctrl+K).
        </div>
        <div class="banner-col">
          <strong>⚙️ Backend & API</strong>
          PHP 8.2+ MVC & Laravel Livewire v3 SPA, REST API endpoint sinkronisasi rekam medis multi-klien.
        </div>
        <div class="banner-col">
          <strong>🛡️ Keamanan & Enkripsi</strong>
          Audit trail log aktivitas, enkripsi data medis sensitif, proteksi CSRF/XSS, dan backup berkala.
        </div>
        <div class="banner-col">
          <strong>📑 Standar Akreditasi</strong>
          Memenuhi regulasi Permenkes No. 24 Tahun 2022 untuk standarisasi Rekam Medis Elektronik (RME).
        </div>
      </div>

    </div>

    <div class="page-footer">
      <span>Dokumen Resmi: <strong>Peta Arsitektur & Mindmap Sistem Informasi Klinik PUSDIKZI</strong></span>
      <span>Halaman 3 dari 3 — Diagram Alur Kerja & Spesifikasi Teknis</span>
    </div>
  </div>

</body>
</html>
"""

html_path = r"e:\Sistem Informasi Klinik Zeni\Sitemap_Mindmap_Klinik_PUSZIAD.html"
pdf_path = r"e:\Sistem Informasi Klinik Zeni\Sitemap_Mindmap_Klinik_PUSZIAD.pdf"
preview_dir = r"e:\Sistem Informasi Klinik Zeni\pdf_preview"

# Write HTML file
with open(html_path, "w", encoding="utf-8") as f:
    f.write(html_content)

# Ensure preview directory exists
os.makedirs(preview_dir, exist_ok=True)

# Generate PDF using Playwright
with sync_playwright() as p:
    browser = p.chromium.launch(args=["--no-sandbox", "--disable-setuid-sandbox"])
    page = browser.new_page(viewport={"width": 1920, "height": 1080})
    
    # Load HTML
    page.goto(f"file:///{html_path.replace(os.sep, '/')}", wait_until="networkidle")
    
    # Generate Landscape A4 PDF
    page.pdf(
        path=pdf_path,
        format="A4",
        landscape=True,
        print_background=True,
        margin={"top": "0mm", "bottom": "0mm", "left": "0mm", "right": "0mm"}
    )
    print(f"High-Resolution PDF successfully generated: {pdf_path}")
    
    # Take high-definition screenshots of each page for preview
    pages_els = page.query_selector_all(".page")
    for idx, page_el in enumerate(pages_els):
        preview_img = os.path.join(preview_dir, f"sitemap_mindmap_page_{idx+1}.png")
        page_el.screenshot(path=preview_img)
        print(f"Page {idx+1} preview captured: {preview_img}")
        
    browser.close()
    print("ALL DONE SUCCESSFULLY!")
