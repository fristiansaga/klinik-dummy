/* ==========================================================================
   KLINIK PRATAMA PUSDIKZI - Shared Utilities & Helpers
   ========================================================================== */

(function() {
  // Light Mode Only (Permanent Standard)
  try {
    localStorage.removeItem("pusdikzi_theme");
    localStorage.removeItem("pusziad_theme");
  } catch (e) {}
  document.documentElement.setAttribute("data-theme", "light");

  window.toggleTheme = function() {
    document.documentElement.setAttribute("data-theme", "light");
  };

  window.updateThemeIcon = function() {
    // darkmode disabled
  };

  // Toast Notification
  window.showToast = function(message, type = "success") {
    const toast = document.createElement("div");
    toast.className = `toast toast-${type} flex items-center gap-2 card`;
    toast.style.cssText = `
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 9999;
      background: var(--bg-card);
      border-left: 5px solid ${type === "success" ? "var(--success)" : type === "warning" ? "var(--warning)" : "var(--danger)"};
      padding: 0.85rem 1.25rem;
      box-shadow: var(--shadow-lg);
      border-radius: var(--radius-md);
      animation: slideIn 0.3s ease-out;
      color: var(--text-main);
    `;
    toast.innerHTML = `<strong>${type.toUpperCase()}:</strong> <span>${message}</span>`;
    document.body.appendChild(toast);
    setTimeout(() => {
      toast.style.opacity = "0";
      toast.style.transform = "translateY(-10px)";
      toast.style.transition = "all 0.3s ease";
      setTimeout(() => toast.remove(), 300);
    }, 3500);
  };

  // Init Lucide Icons helper
  window.initIcons = function() {
    if (window.lucide) {
      window.lucide.createIcons();
    }
  };

  // Global Tab Switcher for all Dashboard pages (Pasien, Dokter, Apotek, Kasir, Admin)
  window.showTab = function(tabName, btn) {
    document.querySelectorAll('.tab-pane').forEach(el => {
      el.style.display = 'none';
    });
    
    document.querySelectorAll('.sidebar-menu-item').forEach(el => {
      el.classList.remove('active');
    });

    const target = document.getElementById('tab-' + tabName);
    if (target) {
      target.style.display = 'block';
    }

    if (btn) {
      btn.classList.add('active');
    } else {
      document.querySelectorAll('.sidebar-menu-item').forEach(el => {
        const onclick = el.getAttribute('onclick') || '';
        if (onclick.includes(`'${tabName}'`)) {
          el.classList.add('active');
        }
      });
    }

    if (window.toggleMobileSidebar) {
      window.toggleMobileSidebar(false);
    }
    window.scrollTo({ top: 0, behavior: 'smooth' });
    if (window.initIcons) window.initIcons();
  };

  // Toggle Mobile Sidebar Drawer
  window.toggleMobileSidebar = function(open) {
    const sidebar = document.getElementById('dashboard-sidebar');
    const backdrop = document.getElementById('sidebar-backdrop');
    if (!sidebar) return;

    if (open === true) {
      sidebar.classList.add('open');
      if (backdrop) backdrop.classList.add('open');
    } else if (open === false) {
      sidebar.classList.remove('open');
      if (backdrop) backdrop.classList.remove('open');
    } else {
      sidebar.classList.toggle('open');
      if (backdrop) backdrop.classList.toggle('open');
    }
  };

  // Toggle Desktop Mini-Sidebar (HexaBox)
  window.toggleSidebarCollapse = function() {
    document.body.classList.toggle('sidebar-mini');
    const isMini = document.body.classList.contains('sidebar-mini');
    localStorage.setItem('pusdikzi_sidebar_mini', isMini ? '1' : '0');
    if (window.initIcons) window.initIcons();
  };

  // Restore mini sidebar state if saved
  if (localStorage.getItem('pusdikzi_sidebar_mini') === '1') {
    document.body.classList.add('sidebar-mini');
  }

  // Patient Booking Handler
  window.handlePatientBooking = function(e) {
    e.preventDefault();
    if (window.showToast) window.showToast("Pendaftaran berhasil. Nomor antrean Anda: A-005", "success");
    window.showTab('antrean');
  };

  // Doctor SOAP Form Handler
  window.handleSoapSubmit = function(e) {
    e.preventDefault();
    if (window.showToast) window.showToast("Catatan medis SOAP tersimpan dan resep elektronik telah dikirim ke farmasi.", "success");
  };

  // Doctor Certificate & Referral Generator
  window.toggleCertFields = function() {
    const type = document.getElementById("cert-type")?.value || "";
    const sakitFields = document.getElementById("cert-sakit-fields");
    const rujukanFields = document.getElementById("cert-rujukan-fields");
    const diagInput = document.getElementById("cert-keperluan");

    if (type.includes("Rujukan")) {
      if (sakitFields) sakitFields.style.display = "none";
      if (rujukanFields) rujukanFields.style.display = "grid";
      if (diagInput) diagInput.value = "Hypertensive Heart Disease / Evaluasi Ekokardiografi Lanjutan";
    } else if (type.includes("Sehat")) {
      if (sakitFields) sakitFields.style.display = "none";
      if (rujukanFields) rujukanFields.style.display = "none";
      if (diagInput) diagInput.value = "Pemeriksaan Kesehatan Fisik (MCU) & Bebas Buta Warna";
    } else {
      if (sakitFields) sakitFields.style.display = "grid";
      if (rujukanFields) rujukanFields.style.display = "none";
      if (diagInput) diagInput.value = "Febris H-2 ec Susp. Viral Infection / Perlu Istirahat Fisik";
    }
  };

  window.handleGenerateCertificate = function(e) {
    e.preventDefault();
    const type = document.getElementById("cert-type")?.value || "Surat Keterangan Dokter";
    const diag = document.getElementById("cert-keperluan")?.value || "-";
    const modal = document.getElementById("cert-modal-overlay");
    const titleEl = document.getElementById("modal-cert-title");
    const diagEl = document.getElementById("modal-cert-diag");
    const descEl = document.getElementById("modal-cert-desc");
    const noEl = document.getElementById("modal-cert-no");

    if (diagEl) diagEl.textContent = `: ${diag}`;

    if (type.includes("Rujukan")) {
      const rs = document.getElementById("cert-rs-tujuan")?.value || "RS Tk. IV Salak Bogor";
      const poli = document.getElementById("cert-poli-tujuan")?.value || "Spesialis Penyakit Dalam";
      if (titleEl) titleEl.textContent = "SURAT RUJUKAN PASIEN RAWAT JALAN (FKTP)";
      if (noEl) noEl.textContent = `RUJ-${Date.now().toString().slice(-8)}`;
      if (descEl) descEl.innerHTML = `Mohon pemeriksaan dan penanganan lebih lanjut terhadap pasien tersebut di atas pada <strong>${rs}</strong> (${poli}) dengan diagnosa: <em>${diag}</em>. Terapi sementara telah diberikan di FKTP.`;
    } else if (type.includes("Sehat")) {
      if (titleEl) titleEl.textContent = "SURAT KETERANGAN BERBADAN SEHAT (SKBS)";
      if (noEl) noEl.textContent = `SKBS-${Date.now().toString().slice(-8)}`;
      if (descEl) descEl.innerHTML = `Menerangkan bahwa pasien tersebut di atas telah kami periksa dan dinyatakan <strong>BERBADAN SEHAT</strong> secara fisik dan mental untuk keperluan kedinasan/umum.`;
    } else {
      const days = document.getElementById("cert-days")?.value || "2";
      if (titleEl) titleEl.textContent = "SURAT KETERANGAN DOKTER (IZIN SAKIT)";
      if (noEl) noEl.textContent = `SKD-${Date.now().toString().slice(-8)}`;
      if (descEl) descEl.innerHTML = `Mengingat kondisi kesehatannya, pasien tersebut di atas memerlukan <strong>istirahat selama ${days} hari</strong> terhitung mulai tanggal 30 Agustus 2026.`;
    }

    if (modal) modal.classList.add("open");
    if (window.lucide) window.lucide.createIcons();
    if (window.showToast) window.showToast(`${type} berhasil diterbitkan.`, "success");
  };

  // Pharmacy Handlers
  window.handleSimpanOpname = function() {
    if (window.showToast) window.showToast("Hasil pemeriksaan stok fisik berhasil disimpan dan disesuaikan.", "success");
  };

  window.handleSaveMedicine = function(e) {
    e.preventDefault();
    if (window.showToast) window.showToast("Data obat dan penerimaan stok baru berhasil disimpan.", "success");
    setTimeout(() => {
      window.showTab('stock_opname');
    }, 1000);
  };

  window.updateSelisih = function(inputEl, stokSistem) {
    const fisik = parseFloat(inputEl.value) || 0;
    const selisih = fisik - stokSistem;
    const selisihEl = inputEl.closest('tr').querySelector('.selisih-val');
    if (selisihEl) {
      selisihEl.textContent = (selisih > 0 ? `+${selisih}` : selisih);
      if (selisih < 0) {
        selisihEl.style.color = "var(--danger)";
      } else if (selisih > 0) {
        selisihEl.style.color = "var(--warning)";
      } else {
        selisihEl.style.color = "var(--success)";
      }
    }
  };

  // Command Palette
  window.toggleCommandPalette = function() {
    const palette = document.getElementById("cmd-palette-modal");
    if (palette) {
      palette.classList.toggle("open");
      if (palette.classList.contains("open")) {
        const input = document.getElementById("cmd-input");
        if (input) input.focus();
      }
    }
  };

  // Chatbot logic
  window.handleChatbotQuery = function(key, userText) {
    const chatBody = document.getElementById("chatbot-body");
    if (!chatBody) return;
    
    const userMsg = document.createElement("div");
    userMsg.className = "chat-bubble chat-bubble-user";
    userMsg.textContent = userText;
    chatBody.appendChild(userMsg);

    const typing = document.createElement("div");
    typing.className = "chat-bubble chat-bubble-bot";
    typing.innerHTML = "<em>Pusat Bantuan sedang mengetik...</em>";
    chatBody.appendChild(typing);
    chatBody.scrollTop = chatBody.scrollHeight;

    setTimeout(() => {
      typing.remove();
      const botMsg = document.createElement("div");
      botMsg.className = "chat-bubble chat-bubble-bot";
      
      const faqData = (window.KlinikData && window.KlinikData.faqChatbot) || {
        jadwal: "KLINIK PRATAMA PUSDIKZI buka setiap Senin - Sabtu pukul 07.30 - 21.00 WIB. IGD & Layanan Darurat siaga 24 Jam.",
        bpjs: "Ya, kami menerima pasien BPJS Kesehatan (Faskes Tingkat 1 PUSDIKZI) dan Asuransi Swasta AdMedika/Mandiri Inhealth.",
        booking: "Anda dapat mengambil antrean online langsung melalui menu 'Portal Pasien' atau tombol 'Booking Sekarang'.",
        lokasi: "Jl. Jenderal Sudirman No. 45, Kompleks PUSDIKZI (Samping Makodiklat). Telp: (0251) 832-1234."
      };
      
      const responseText = faqData[key] || 
        "Terima kasih telah menghubungi Pusat Bantuan KLINIK PRATAMA PUSDIKZI. Petugas kami siap membantu Anda. Untuk bantuan cepat atau pendaftaran langsung, silakan hubungi WhatsApp kami di 0812-9988-7766.";
      
      botMsg.textContent = responseText;
      chatBody.appendChild(botMsg);
      chatBody.scrollTop = chatBody.scrollHeight;
    }, 600);
  };

  // Text-to-speech for queue call
  window.playAudioCall = function(nomor, tujuan) {
    if ('speechSynthesis' in window) {
      window.speechSynthesis.cancel();
      const text = `Nomor antrean, ${nomor.split('').join(' ')}, silakan menuju ke ${tujuan}`;
      const utterance = new SpeechSynthesisUtterance(text);
      utterance.lang = 'id-ID';
      utterance.rate = 0.9;
      window.speechSynthesis.speak(utterance);
    }
  };

  // Format Rupiah
  window.formatRupiah = function(number) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
  };

  /* ==========================================================================
     WhatsApp / SMS Gateway Notification Simulator Engine
     ========================================================================== */
  const waTemplates = {
    antrean: {
      title: "📢 Panggilan Antrean Pasien",
      body: "Halo Bpk/Ibu *Achmad Nurhadi*,<br/><br/>Nomor antrean Anda *A-004* di *Poli Umum (dr. Siti Rahmawati)* segera dipanggil. Saat ini nomor *A-003* sedang dilayani (Sisa 1 antrean lagi).<br/><br/>Mohon bersiap di Ruang Tunggu Poli Umum Lt. 1.",
      buttons: ["📱 Cek Status Antrean Live", "📍 Peta Lokasi Ruang Tunggu"]
    },
    obat_siap: {
      title: "💊 Obat Farmasi Siap Diambil",
      body: "Halo Bpk/Ibu *Achmad Nurhadi* (No. RM: RM-2026-0881),<br/><br/>E-Resep Anda dengan ID *RX-0830-05* telah *SELESAI DIRACIK & DIKEMAS* oleh Instalasi Farmasi KLINIK PUSDIKZI.<br/><br/>Silakan ambil obat di *Loket Apotek Farmasi* dengan menunjukkan Kartu Pasien Digital Anda.",
      buttons: ["📄 Lihat E-Resep & Aturan Pakai", "⭐ Beri Ulasan Layanan"]
    },
    kontrol_h1: {
      title: "📅 Pengingat Kontrol Ulang Dokter (H-1)",
      body: "Salam Sehat Bpk/Ibu *Ibu Siti Aminah*,<br/><br/>Mengingatkan jadwal *Kontrol Rutin Poli Penyakit Dalam* bersama *dr. Agus Susanto, Sp.PD* pada:<br/>🗓️ *Besok, Senin 31 Agustus 2026*<br/>⏰ *Pukul 09:00 WIB*<br/>🏥 Ruang Periksa 2 Klinik PUSDIKZI.<br/><br/>Harap membawa Kartu BPJS & Health Passport Anda.",
      buttons: ["✅ Konfirmasi Hadir", "🔄 Reschedule Jadwal"]
    },
    surat_medis: {
      title: "📄 Surat Medis & Hasil Lab Terbit",
      body: "Halo Bpk/Ibu *Achmad Nurhadi*,<br/><br/>*Surat Keterangan Sakit Digital (2 Hari)* & *Hasil Lab Cepat POCT (GDS: 110 mg/dL)* Anda telah resmi diterbitkan oleh dokter dan terverifikasi tanda tangan elektronik SATUSEHAT.<br/><br/>Anda dapat melihat & mengunduh PDF resminya langsung.",
      buttons: ["📥 Download Surat Sakit (PDF)", "🧪 Lihat Hasil Lab Lengkap"]
    },
    booking_sukses: {
      title: "🎟️ Konfirmasi Booking Kunjungan Online",
      body: "Terima kasih telah melakukan reservasi online di *KLINIK PRATAMA PUSDIKZI*.<br/><br/>🔖 *No. Booking:* BK-2026-0902<br/>👤 *Pasien:* Achmad Nurhadi (BPJS)<br/>🩺 *Poli:* Poli Penyakit Dalam<br/>👨‍⚕️ *Dokter:* dr. Agus Susanto, Sp.PD<br/>🕒 *Estimasi Jam Layanan:* 08:30 WIB.",
      buttons: ["🪪 Buka Kartu Digital", "❌ Batalkan Reservasi"]
    }
  };

  window.openWaSimulator = function(type = "antrean", customData = {}) {
    let overlay = document.getElementById("wa-simulator-overlay");
    if (!overlay) {
      overlay = document.createElement("div");
      overlay.id = "wa-simulator-overlay";
      overlay.className = "wa-simulator-overlay";
      overlay.innerHTML = `
        <div class="wa-phone-frame">
          <div class="wa-phone-notch"><div class="wa-phone-notch-camera"></div></div>
          
          <!-- WA Header -->
          <div class="wa-header">
            <div class="wa-header-profile">
              <button onclick="closeWaSimulator()" style="background:transparent; border:none; color:#FFF; cursor:pointer; padding:0; margin-right:4px;">
                <i data-lucide="arrow-left" style="width:20px; height:20px;"></i>
              </button>
              <div class="wa-header-avatar">PZ</div>
              <div class="wa-header-info">
                <h4>KLINIK PUSDIKZI <i data-lucide="check-circle-2" style="width:14px; height:14px; color:#38BDF8; fill:#38BDF8;"></i></h4>
                <small>Official Verified Business Account</small>
              </div>
            </div>
            <button onclick="closeWaSimulator()" style="background:transparent; border:none; color:#FFF; cursor:pointer;">
              <i data-lucide="x" style="width:20px; height:20px;"></i>
            </button>
          </div>

          <!-- Template Switcher Pills -->
          <div style="background:#054c44; padding:0.5rem 0.75rem; display:flex; gap:0.4rem; overflow-x:auto;">
            <button class="badge" style="cursor:pointer; border:none; background:#128C7E; color:#FFF;" onclick="switchWaTemplate('antrean')">Antrean</button>
            <button class="badge" style="cursor:pointer; border:none; background:rgba(255,255,255,0.2); color:#FFF;" onclick="switchWaTemplate('obat_siap')">Obat Siap</button>
            <button class="badge" style="cursor:pointer; border:none; background:rgba(255,255,255,0.2); color:#FFF;" onclick="switchWaTemplate('kontrol_h1')">Kontrol H-1</button>
            <button class="badge" style="cursor:pointer; border:none; background:rgba(255,255,255,0.2); color:#FFF;" onclick="switchWaTemplate('surat_medis')">Surat & Lab</button>
            <button class="badge" style="cursor:pointer; border:none; background:rgba(255,255,255,0.2); color:#FFF;" onclick="switchWaTemplate('booking_sukses')">Booking</button>
          </div>

          <!-- Chat Canvas -->
          <div class="wa-chat-canvas" id="wa-chat-canvas">
            <div class="wa-date-pill">HARI INI</div>
            
            <div class="wa-bubble-received">
              <div class="wa-bubble-title" id="wa-msg-title">
                <i data-lucide="bell" style="width:16px;"></i> Notifikasi Layanan
              </div>
              <div id="wa-msg-body" style="color:#1F2937;">
                Pesan simulasi WhatsApp...
              </div>
              <div class="wa-action-btn-group" id="wa-btn-group">
                <!-- Action buttons -->
              </div>
              <div class="wa-bubble-footer">
                <span id="wa-timestamp">09:42</span>
                <i data-lucide="check-check" style="width:14px; height:14px; color:#0284C7;"></i>
              </div>
            </div>
          </div>

          <!-- Footer Action -->
          <div class="wa-footer-bar">
            <input type="text" class="wa-input-box" placeholder="Ketik balasan pasien..." readonly value="Terima kasih, saya segera menuju loket!" />
            <button onclick="sendWaReplySim()" style="background:#075E54; border:none; color:#FFF; width:36px; height:36px; border-radius:50%; display:flex; align-items:center; justify-content:center; cursor:pointer;">
              <i data-lucide="send" style="width:16px; height:16px;"></i>
            </button>
          </div>
        </div>
      `;
      document.body.appendChild(overlay);
    }

    switchWaTemplate(type, customData);
    overlay.classList.add("open");
    initIcons();
    showToast("Pratinjau notifikasi WhatsApp dibuka.", "success");
  };

  window.closeWaSimulator = function() {
    const overlay = document.getElementById("wa-simulator-overlay");
    if (overlay) overlay.classList.remove("open");
  };

  window.switchWaTemplate = function(type, customData = {}) {
    const tpl = waTemplates[type] || waTemplates.antrean;
    const titleEl = document.getElementById("wa-msg-title");
    const bodyEl = document.getElementById("wa-msg-body");
    const btnGroup = document.getElementById("wa-btn-group");
    const timeEl = document.getElementById("wa-timestamp");

    if (titleEl) titleEl.innerHTML = `<i data-lucide="shield-check" style="width:16px; color:#075E54;"></i> ${tpl.title}`;
    if (bodyEl) bodyEl.innerHTML = tpl.body;
    
    const now = new Date();
    if (timeEl) timeEl.textContent = `${String(now.getHours()).padStart(2, '0')}:${String(now.getMinutes()).padStart(2, '0')}`;

    if (btnGroup) {
      btnGroup.innerHTML = tpl.buttons.map(btnText => `
        <button class="wa-action-btn" onclick="showToast('Aksi: ${btnText}', 'success')">
          ${btnText}
        </button>
      `).join('');
    }

    initIcons();
  };

  window.sendWaReplySim = function() {
    const canvas = document.getElementById("wa-chat-canvas");
    if (!canvas) return;
    const replyBubble = document.createElement("div");
    replyBubble.style.cssText = `
      align-self: flex-end;
      max-width: 80%;
      background: #DCF8C6;
      border-radius: 12px;
      border-top-right-radius: 2px;
      padding: 0.75rem 1rem;
      color: #111827;
      font-size: 0.85rem;
      line-height: 1.4;
      box-shadow: 0 1.5px 3px rgba(0,0,0,0.15);
      margin-top: 0.5rem;
    `;
    const now = new Date();
    const timeStr = `${String(now.getHours()).padStart(2, '0')}:${String(now.getMinutes()).padStart(2, '0')}`;
    replyBubble.innerHTML = `
      <div>Terima kasih informasinya, saya segera menuju lokasi.</div>
      <div style="display:flex; justify-content:flex-end; align-items:center; gap:3px; font-size:0.65rem; color:#6B7280; margin-top:4px;">
        <span>${timeStr}</span>
        <i data-lucide="check-check" style="width:13px; height:13px; color:#0284C7;"></i>
      </div>
    `;
    canvas.appendChild(replyBubble);
    canvas.scrollTop = canvas.scrollHeight;
    initIcons();
    showToast("Balasan pesan terkirim.", "success");
  };

  document.addEventListener("DOMContentLoaded", () => {
    initIcons();

    // Command palette key shortcut Ctrl+K
    document.addEventListener("keydown", (e) => {
      if ((e.ctrlKey || e.metaKey) && e.key === "k") {
        e.preventDefault();
        toggleCommandPalette();
      }
    });

    // Close Modals on Overlay Click
    document.querySelectorAll(".modal-overlay").forEach(overlay => {
      overlay.addEventListener("click", (e) => {
        if (e.target === overlay) overlay.classList.remove("open");
      });
    });

    // Chatbot Trigger
    const chatTrigger = document.getElementById("chatbot-trigger");
    if (chatTrigger) {
      chatTrigger.addEventListener("click", () => {
        const panel = document.getElementById("chatbot-panel");
        if (panel) panel.classList.toggle("open");
      });
    }

    // Chatbot Quick Chips
    document.querySelectorAll(".chip-btn").forEach(chip => {
      chip.addEventListener("click", (e) => {
        const queryKey = e.target.getAttribute("data-key");
        handleChatbotQuery(queryKey, e.target.textContent);
      });
    });

    // Chatbot Custom Input
    const chatInput = document.getElementById("chatbot-input");
    if (chatInput) {
      chatInput.addEventListener("keypress", (e) => {
        if (e.key === "Enter" && chatInput.value.trim() !== "") {
          const text = chatInput.value.trim();
          chatInput.value = "";
          handleChatbotQuery("custom", text);
        }
      });
    }

    // Bell Notification Dropdown Toggle
    const notifBtn = document.getElementById("notif-bell-btn");
    if (notifBtn) {
      notifBtn.addEventListener("click", () => {
        const dropdown = document.getElementById("notif-dropdown");
        if (dropdown) dropdown.classList.toggle("show");
      });
    }
  });

  // ==========================================================================
  // Stock Opname Global Single Edit/Save Controller
  // ==========================================================================
  window.isOpnameEditing = false;

  window.toggleGlobalEditOpname = function(btn) {
    window.isOpnameEditing = !window.isOpnameEditing;
    const steppers = document.querySelectorAll('.opname-stepper');
    const inputs = document.querySelectorAll('.opname-input');
    const btns = document.querySelectorAll('.opname-btn');
    const targetBtn = btn || document.getElementById('btn-toggle-global-opname');

    if (window.isOpnameEditing) {
      // Enter Edit Mode
      steppers.forEach(s => s.classList.add('is-editing'));
      inputs.forEach(inp => inp.disabled = false);
      btns.forEach(b => b.disabled = false);

      if (inputs.length > 0) inputs[0].focus();

      if (targetBtn) {
        targetBtn.className = "btn btn-primary btn-sm flex items-center gap-1";
        targetBtn.innerHTML = '<i data-lucide="check" style="width: 16px;"></i> Simpan Semua Penyesuaian';
        if (window.lucide) window.lucide.createIcons();
      }

      if (window.showToast) {
        window.showToast("Mode ubah aktif. Sesuaikan jumlah fisik obat dengan tombol + atau -.", "warning");
      }
    } else {
      // Exit Edit Mode & Save
      steppers.forEach(s => s.classList.remove('is-editing'));
      inputs.forEach(inp => inp.disabled = true);
      btns.forEach(b => b.disabled = true);

      if (targetBtn) {
        targetBtn.className = "btn btn-outline btn-sm flex items-center gap-1";
        targetBtn.innerHTML = '<i data-lucide="edit-3" style="width: 16px;"></i> Edit Penyesuaian Fisik';
        if (window.lucide) window.lucide.createIcons();
      }

      if (window.showToast) {
        window.showToast("Penyesuaian stok fisik obat tersimpan.", "success");
      }
    }
  };

  window.stepOpname = function(rowId, delta, stokSistem) {
    if (!window.isOpnameEditing) {
      if (window.showToast) {
        window.showToast("Pilih 'Edit Penyesuaian Fisik' terlebih dahulu untuk mengubah jumlah stok.", "warning");
      }
      return;
    }

    const input = document.getElementById(`input-opname-${rowId}`);
    if (!input || input.disabled) return;

    let currentVal = parseInt(input.value) || 0;
    let nextVal = Math.max(0, currentVal + delta);
    input.value = nextVal;
    window.calculateSelisih(rowId, stokSistem);
  };

  window.calculateSelisih = function(rowId, stokSistem) {
    const input = document.getElementById(`input-opname-${rowId}`);
    const selisihEl = document.getElementById(`selisih-${rowId}`);
    if (!input || !selisihEl) return;

    const fisik = parseInt(input.value) || 0;
    const diff = fisik - stokSistem;

    if (diff === 0) {
      selisihEl.textContent = "0";
      selisihEl.style.color = "var(--success)";
    } else if (diff > 0) {
      selisihEl.textContent = `+${diff}`;
      selisihEl.style.color = "var(--info)";
    } else {
      selisihEl.textContent = `${diff}`;
      selisihEl.style.color = "var(--danger)";
    }
  };

  window.openReceiptModal = function(nama, rm, penjamin, total) {
    const modal = document.getElementById("receipt-modal-overlay");
    if (!modal) return;

    const elNama = document.getElementById("rec-nama");
    const elRm = document.getElementById("rec-rm");
    const elPenjamin = document.getElementById("rec-penjamin");
    const elTotal = document.getElementById("rec-total");
    const elBpjsRow = document.getElementById("rec-bpjs-cover-row");
    const elBpjsNote = document.getElementById("rec-bpjs-note");

    if (elNama) elNama.textContent = nama || "Achmad Nurhadi";
    if (elRm) elRm.textContent = rm || "RM-2026-0881";
    if (elPenjamin) elPenjamin.textContent = penjamin || "Umum Mandiri";

    const isBpjs = total === 0 || (penjamin && penjamin.toLowerCase().includes("bpjs"));

    if (isBpjs) {
      if (elTotal) {
        elTotal.textContent = "Rp 0 (Bebas Biaya)";
        elTotal.style.color = "var(--success)";
      }
      if (elBpjsRow) elBpjsRow.style.display = "flex";
      if (elBpjsNote) elBpjsNote.style.display = "block";
    } else {
      if (elTotal) {
        elTotal.textContent = window.formatRupiah ? window.formatRupiah(total) : `Rp ${total.toLocaleString('id-ID')}`;
        elTotal.style.color = "var(--primary)";
      }
      if (elBpjsRow) elBpjsRow.style.display = "none";
      if (elBpjsNote) elBpjsNote.style.display = "none";
    }

    modal.classList.add("open");
    if (window.lucide) window.lucide.createIcons();
    if (window.showToast) window.showToast("Pratinjau kuitansi pembayaran dibuka.", "success");
  };

  window.closeReceiptModal = function() {
    const modal = document.getElementById("receipt-modal-overlay");
    if (modal) modal.classList.remove("open");
  };

  window.openRiwayatModalPasien = function() {
    const modal = document.getElementById("riwayat-modal-overlay");
    if (modal) modal.classList.add("open");
    if (window.lucide) window.lucide.createIcons();
    if (window.showToast) window.showToast("Ringkasan riwayat medis dibuka.", "success");
  };

  window.closeRiwayatModalPasien = function() {
    const modal = document.getElementById("riwayat-modal-overlay");
    if (modal) modal.classList.remove("open");
  };

  window.openRujukanModalPasien = function() {
    const modal = document.getElementById("rujukan-modal-overlay");
    if (modal) modal.classList.add("open");
    if (window.lucide) window.lucide.createIcons();
    if (window.showToast) window.showToast("Pratinjau surat rujukan faskes dibuka.", "success");
  };

  window.closeRujukanModalPasien = function() {
    const modal = document.getElementById("rujukan-modal-overlay");
    if (modal) modal.classList.remove("open");
  };

  // Hexabox & Dashspace Charts Initialization
  window.initAdminCharts = function() {
    const canvasKunjungan = document.getElementById("chart-kunjungan");
    if (canvasKunjungan && typeof Chart !== "undefined") {
      const ctx = canvasKunjungan.getContext("2d");
      
      const gradBpjs = ctx.createLinearGradient(0, 0, 0, 260);
      gradBpjs.addColorStop(0, 'rgba(30, 57, 38, 0.35)');
      gradBpjs.addColorStop(1, 'rgba(30, 57, 38, 0.0)');

      const gradUmum = ctx.createLinearGradient(0, 0, 0, 260);
      gradUmum.addColorStop(0, 'rgba(2, 132, 199, 0.25)');
      gradUmum.addColorStop(1, 'rgba(2, 132, 199, 0.0)');

      new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
          datasets: [
            {
              label: 'Pasien BPJS (Faskes 1)',
              data: [142, 168, 155, 182, 195, 120, 45],
              borderColor: '#1E3926',
              backgroundColor: gradBpjs,
              borderWidth: 3,
              tension: 0.4,
              fill: true,
              pointBackgroundColor: '#1E3926',
              pointRadius: 4,
              pointHoverRadius: 6
            },
            {
              label: 'Pasien Umum / Tunai',
              data: [38, 45, 42, 50, 58, 35, 12],
              borderColor: '#0284C7',
              backgroundColor: gradUmum,
              borderWidth: 2.5,
              borderDash: [4, 4],
              tension: 0.4,
              fill: true,
              pointBackgroundColor: '#0284C7',
              pointRadius: 3,
              pointHoverRadius: 5
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'top',
              labels: {
                boxWidth: 12,
                usePointStyle: true,
                font: { family: "'Plus Jakarta Sans', sans-serif", size: 12, weight: '600' }
              }
            },
            tooltip: {
              padding: 12,
              backgroundColor: '#0F172A',
              titleFont: { family: "'Plus Jakarta Sans', sans-serif", size: 13, weight: '700' },
              bodyFont: { family: "'Plus Jakarta Sans', sans-serif", size: 12 }
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              grid: { color: '#F1F5F9' },
              ticks: { font: { family: "'Plus Jakarta Sans', sans-serif", size: 11 } }
            },
            x: {
              grid: { display: false },
              ticks: { font: { family: "'Plus Jakarta Sans', sans-serif", size: 11, weight: '600' } }
            }
          }
        }
      });
    }

    const canvasPenyakit = document.getElementById("chart-penyakit");
    if (canvasPenyakit && typeof Chart !== "undefined") {
      const ctxPenyakit = canvasPenyakit.getContext("2d");
      new Chart(ctxPenyakit, {
        type: 'doughnut',
        data: {
          labels: ['Hipertensi (I10)', 'ISPA Akut (J06.9)', 'Diabetes (E11)', 'Gastritis (K30)', 'Karies Gigi (K02.1)'],
          datasets: [{
            data: [34, 26, 18, 14, 8],
            backgroundColor: ['#1E3926', '#10B981', '#F59E0B', '#0284C7', '#8B5CF6'],
            borderWidth: 3,
            borderColor: '#FFFFFF',
            hoverOffset: 6
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          cutout: '70%',
          plugins: {
            legend: { display: false },
            tooltip: {
              padding: 10,
              backgroundColor: '#0F172A',
              callbacks: {
                label: function(item) {
                  return ` ${item.label}: ${item.raw}%`;
                }
              }
            }
          }
        }
      });
    }
  };

  document.addEventListener("DOMContentLoaded", function() {
    setTimeout(window.initAdminCharts, 300);
  });
})();




