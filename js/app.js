/* ==========================================================================
   KLINIK PRATAMA PUSDIKZI - Main Application Controller & Interactive Logic
   ========================================================================== */

document.addEventListener("DOMContentLoaded", () => {
  // Global State Manager
  window.AppState = {
    currentRole: "public", // 'public', 'pasien', 'dokter', 'kasir', 'admin'
    currentTab: "beranda",
    adminMasterTab: "dokter",
    theme: "light",
    currentUser: null,
    charts: {}
  };

  try {
    localStorage.removeItem("pusdikzi_theme");
    localStorage.removeItem("pusziad_theme");
  } catch (e) {}

  // Initialize App
  initTheme();
  initLucideIcons();
  initEventListeners();
  handleRouteFromHash();

  // --------------------------------------------------------------------------
  // Theme Manager (Light Mode Standard)
  // --------------------------------------------------------------------------
  function initTheme() {
    document.documentElement.setAttribute("data-theme", "light");
  }

  function toggleTheme() {
    document.documentElement.setAttribute("data-theme", "light");
  }

  function updateThemeIcon() {
    // dark mode disabled
  }

  function initLucideIcons() {
    if (window.lucide) {
      window.lucide.createIcons();
    }
  }

  // --------------------------------------------------------------------------
  // Toast Notifications
  // --------------------------------------------------------------------------
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
    `;
    toast.innerHTML = `<strong>${type.toUpperCase()}:</strong> ${message}`;
    document.body.appendChild(toast);
    setTimeout(() => {
      toast.style.opacity = "0";
      toast.style.transform = "translateY(-10px)";
      setTimeout(() => toast.remove(), 300);
    }, 3500);
  };

  // --------------------------------------------------------------------------
  // Event Listeners Registration
  // --------------------------------------------------------------------------
  function initEventListeners() {
    // Command Palette (Ctrl+K)
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
        document.getElementById("chatbot-panel").classList.toggle("open");
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
        document.getElementById("notif-dropdown").classList.toggle("show");
      });
    }

    // URL Hash Routing & Browser History (Back/Forward)
    window.addEventListener("hashchange", handleRouteFromHash);
    window.addEventListener("popstate", handleRouteFromHash);
  }

  // --------------------------------------------------------------------------
  // Command Palette Handler
  // --------------------------------------------------------------------------
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

  // --------------------------------------------------------------------------
  // Chatbot Simulator
  // --------------------------------------------------------------------------
  window.handleChatbotQuery = function(key, userText) {
    const chatBody = document.getElementById("chatbot-body");
    if (!chatBody) return;
    
    // User Message
    const userMsg = document.createElement("div");
    userMsg.className = "chat-bubble chat-bubble-user";
    userMsg.textContent = userText;
    chatBody.appendChild(userMsg);

    // Bot Typing Indicator
    const typing = document.createElement("div");
    typing.className = "chat-bubble chat-bubble-bot";
    typing.innerHTML = "<em>Pusat Bantuan sedang mengetik...</em>";
    chatBody.appendChild(typing);
    chatBody.scrollTop = chatBody.scrollHeight;

    setTimeout(() => {
      typing.remove();
      const botMsg = document.createElement("div");
      botMsg.className = "chat-bubble chat-bubble-bot";
      
      const responseText = window.KlinikData.faqChatbot[key] || 
        "Terima kasih telah menghubungi Pusat Bantuan KLINIK PRATAMA PUSDIKZI. Petugas kami siap membantu Anda. Untuk bantuan cepat atau pendaftaran langsung, silakan klik menu 'Booking Kunjungan' atau hubungi WhatsApp kami di 0812-9988-7766.";
      
      botMsg.textContent = responseText;
      chatBody.appendChild(botMsg);
      chatBody.scrollTop = chatBody.scrollHeight;
    }, 800);
  };

  // --------------------------------------------------------------------------
  // Mobile Sidebar & Bottom Navigation Controller
  // --------------------------------------------------------------------------
  function toggleMobileSidebar(forceState) {
    if (window.innerWidth > 768 && forceState !== false) {
      return; // Disabled on desktop view
    }
    const sidebar = document.getElementById("dashboard-sidebar");
    const backdrop = document.getElementById("sidebar-backdrop");
    if (!sidebar) return;

    const shouldOpen = typeof forceState === "boolean" ? forceState : !sidebar.classList.contains("open");
    if (shouldOpen) {
      sidebar.classList.add("open");
      if (backdrop) backdrop.classList.add("open");
    } else {
      sidebar.classList.remove("open");
      if (backdrop) backdrop.classList.remove("open");
    }
  }
  window.toggleMobileSidebar = toggleMobileSidebar;

  function renderMobileBottomNav(role, activeTab = "beranda") {
    const nav = document.getElementById("mobile-bottom-nav");
    if (!nav) return;

    let items = [];
    if (role === "public") {
      items = [
        { id: "beranda", icon: "home", label: "Beranda", action: "switchRole('public')" },
        { id: "antrean", icon: "ticket", label: "Antrean", action: "document.getElementById('quick-queue-section')?.scrollIntoView({behavior:'smooth'})" },
        { id: "booking", icon: "calendar", label: "Booking", action: "openBookingModal()" },
        { id: "bantuan", icon: "help-circle", label: "Bantuan", action: "document.getElementById('chatbot-panel')?.classList.toggle('open')" },
        { id: "login", icon: "log-in", label: "Login", action: "switchRole('login')" }
      ];
    } else if (role === "pasien") {
      items = [
        { id: "beranda", icon: "activity", label: "Passport", action: "switchDashboardTab('beranda')" },
        { id: "booking", icon: "calendar", label: "Booking", action: "switchDashboardTab('booking')" },
        { id: "antrean", icon: "clock", label: "Antrean", action: "switchDashboardTab('antrean')" },
        { id: "resep", icon: "pill", label: "Resep", action: "switchDashboardTab('resep')" },
        { id: "menu", icon: "menu", label: "Menu", action: "toggleMobileSidebar()" }
      ];
    } else if (role === "dokter") {
      items = [
        { id: "beranda", icon: "layout-dashboard", label: "Praktik", action: "switchDashboardTab('beranda')" },
        { id: "antrean_periksa", icon: "users", label: "Antrean", action: "switchDashboardTab('antrean_periksa')" },
        { id: "ruang_periksa", icon: "stethoscope", label: "EMR", action: "switchDashboardTab('ruang_periksa')" },
        { id: "riwayat_pasien", icon: "history", label: "Riwayat", action: "switchDashboardTab('riwayat_pasien')" },
        { id: "menu", icon: "menu", label: "Menu", action: "toggleMobileSidebar()" }
      ];
    } else if (role === "kasir") {
      items = [
        { id: "beranda", icon: "layout-dashboard", label: "Kas", action: "switchDashboardTab('beranda')" },
        { id: "antrean_bayar", icon: "credit-card", label: "Antrean", action: "switchDashboardTab('antrean_bayar')" },
        { id: "kasir_billing", icon: "calculator", label: "Billing", action: "switchDashboardTab('kasir_billing')" },
        { id: "rekap_kas", icon: "pie-chart", label: "Rekap", action: "switchDashboardTab('rekap_kas')" },
        { id: "menu", icon: "menu", label: "Menu", action: "toggleMobileSidebar()" }
      ];
    } else if (role === "admin") {
      items = [
        { id: "beranda", icon: "gauge", label: "KPI", action: "switchDashboardTab('beranda')" },
        { id: "rbac", icon: "shield-check", label: "RBAC", action: "switchDashboardTab('rbac')" },
        { id: "master_data", icon: "database", label: "Master", action: "switchDashboardTab('master_data')" },
        { id: "integrasi", icon: "wifi", label: "SatuSehat", action: "switchDashboardTab('integrasi')" },
        { id: "menu", icon: "menu", label: "Menu", action: "toggleMobileSidebar()" }
      ];
    } else if (role === "apoteker") {
      items = [
        { id: "beranda", icon: "layout-dashboard", label: "Apotek", action: "switchDashboardTab('beranda')" },
        { id: "stok_obat", icon: "package", label: "Stok", action: "switchDashboardTab('stok_obat')" },
        { id: "resep_digital", icon: "file-text", label: "E-Resep", action: "switchDashboardTab('resep_digital')" },
        { id: "riwayat_transaksi", icon: "history", label: "Riwayat", action: "switchDashboardTab('riwayat_transaksi')" },
        { id: "menu", icon: "menu", label: "Menu", action: "toggleMobileSidebar()" }
      ];
    } else if (role === "login") {
      items = [
        { id: "beranda", icon: "home", label: "Beranda", action: "switchRole('public')" },
        { id: "pasien", icon: "user", label: "Pasien", action: "switchRole('pasien')" },
        { id: "dokter", icon: "stethoscope", label: "Dokter", action: "switchRole('dokter')" },
        { id: "kasir", icon: "credit-card", label: "Kasir", action: "switchRole('kasir')" },
        { id: "admin", icon: "shield", label: "Admin", action: "switchRole('admin')" }
      ];
    }

    nav.innerHTML = items.map(it => `
      <button class="mobile-nav-item ${(it.id === activeTab || (it.id === 'beranda' && (!activeTab || activeTab === 'beranda')) || (role === 'login' && it.id === 'login')) ? 'active' : ''}" onclick="${it.action}" title="${it.label}">
        <i data-lucide="${it.icon}"></i>
        <span>${it.label}</span>
      </button>
    `).join('');

    initLucideIcons();
  }
  window.renderMobileBottomNav = renderMobileBottomNav;

  // --------------------------------------------------------------------------
  // URL Hash Router & Deep Linking
  // --------------------------------------------------------------------------
  function updateUrlHash(role, tab = null) {
    let newHash = "";
    if (role === "public") {
      newHash = "";
    } else if (role === "login") {
      newHash = "#login";
    } else {
      newHash = `#${role}` + (tab && tab !== "beranda" ? `/${tab}` : "");
    }

    const currentHash = window.location.hash || "";
    if (currentHash !== newHash && (newHash !== "" || currentHash !== "")) {
      if (window.history && window.history.pushState) {
        window.history.pushState(null, "", newHash || window.location.pathname + window.location.search);
      } else {
        window.location.hash = newHash;
      }
    }
  }
  window.updateUrlHash = updateUrlHash;

  function handleRouteFromHash() {
    const rawHash = (window.location.hash || "").replace(/^#\/?/, "").trim();
    if (!rawHash) {
      if (AppState.currentRole !== "public") {
        switchRole("public", null, false);
      } else {
        renderPublicLanding();
        renderMobileBottomNav("public", "beranda");
      }
      return;
    }

    const parts = rawHash.split("/");
    const primary = parts[0].toLowerCase();
    const sub = parts[1] ? parts[1].toLowerCase() : null;

    // Direct role mappings and convenient aliases
    if (primary === "login") {
      switchRole("login", null, false);
    } else if (primary === "beranda" || primary === "public" || primary === "home") {
      switchRole("public", null, false);
    } else if (primary === "pasien" || primary === "patient") {
      switchRole("pasien", null, false);
      if (sub && sub !== "beranda") switchDashboardTab(sub, false);
    } else if (primary === "pendaftaran" || primary === "booking") {
      switchRole("pasien", null, false);
      switchDashboardTab("booking", false);
    } else if (primary === "antrian" || primary === "antrean") {
      switchRole("pasien", null, false);
      switchDashboardTab("antrean", false);
    } else if (primary === "dokter" || primary === "doctor") {
      switchRole("dokter", null, false);
      if (sub && sub !== "beranda") switchDashboardTab(sub, false);
    } else if (primary === "pemeriksaan" || primary === "emr") {
      switchRole("dokter", null, false);
      switchDashboardTab("ruang_periksa", false);
    } else if (primary === "kasir" || primary === "billing") {
      switchRole("kasir", null, false);
      if (sub && sub !== "beranda") switchDashboardTab(sub, false);
    } else if (primary === "pembayaran") {
      switchRole("kasir", null, false);
      switchDashboardTab("kasir_billing", false);
    } else if (primary === "apoteker" || primary === "farmasi" || primary === "apotek" || primary === "obat") {
      switchRole("apoteker", null, false);
      if (sub && sub !== "beranda") switchDashboardTab(sub, false);
      else if (primary === "farmasi" || primary === "obat") switchDashboardTab("stok_obat", false);
    } else if (primary === "admin") {
      switchRole("admin", null, false);
      if (sub && sub !== "beranda") switchDashboardTab(sub, false);
    } else {
      switchRole("public", null, false);
    }
  }
  window.handleRouteFromHash = handleRouteFromHash;

  // --------------------------------------------------------------------------
  // View Router & Switching Logic
  // --------------------------------------------------------------------------
  function switchRole(role, userObj = null, syncHash = true) {
    AppState.currentRole = role;
    AppState.currentUser = userObj || (role === 'pasien' ? window.KlinikData.pasienList[0] : null);
    AppState.currentTab = "beranda";
    toggleMobileSidebar(false);

    document.querySelectorAll(".view-container").forEach(el => el.style.display = "none");

    const roleNav = document.getElementById("role-header-actions");
    const publicLoginNav = document.getElementById("public-login-action");

    if (role === "public") {
      document.body.classList.remove("in-dashboard");
      document.getElementById("view-public-landing").style.display = "block";
      if (roleNav) roleNav.style.display = "none";
      if (publicLoginNav) publicLoginNav.style.display = "block";
      renderPublicLanding();
    } else if (role === "login") {
      document.body.classList.remove("in-dashboard");
      document.getElementById("view-login-screen").style.display = "block";
      if (roleNav) roleNav.style.display = "none";
      if (publicLoginNav) publicLoginNav.style.display = "none";
      renderLoginScreen();
    } else {
      document.body.classList.add("in-dashboard");
      document.getElementById("view-dashboard-layout").style.display = "flex";
      if (roleNav) roleNav.style.display = "flex";
      if (publicLoginNav) publicLoginNav.style.display = "none";
      renderDashboardSidebar(role);
      renderDashboardContent(role, "beranda");
    }

    renderMobileBottomNav(role, "beranda");
    if (syncHash) {
      updateUrlHash(role, "beranda");
    }
    initLucideIcons();
    window.scrollTo({ top: 0, behavior: "smooth" });
  }
  window.switchRole = switchRole;

  // --------------------------------------------------------------------------
  // Public Landing Page Rendering
  // --------------------------------------------------------------------------
  function renderPublicLanding() {
    const container = document.getElementById("public-landing-content");
    if (!container) return;

    const data = window.KlinikData;

    container.innerHTML = `
      <!-- Hero Section -->
      <section style="position: relative; margin-bottom: 5.5rem; min-height: 520px; display: flex; align-items: center; border-radius: var(--radius-xl);">
        <!-- Background Image with Border Radius -->
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; border-radius: var(--radius-xl); overflow: hidden; box-shadow: var(--shadow-lg);">
          <img src="assets/images/hero_clinic_warm.png" alt="Tim Medis KLINIK PRATAMA PUSDIKZI" style="width: 100%; height: 100%; object-fit: cover;" />
          <!-- Gradient Overlay -->
          <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(to right, rgba(20,40,25,0.95) 0%, rgba(20,40,25,0.85) 45%, rgba(20,40,25,0.2) 100%);"></div>
        </div>

        <!-- Content overlay -->
        <div class="flex items-center justify-between gap-8" style="position: relative; z-index: 2; padding: 4rem 3.5rem; width: 100%;">
          <div style="flex: 1.3;">
            <span class="badge badge-orange" style="margin-bottom: 1rem; padding: 0.4rem 1rem;">
              <i data-lucide="sparkles"></i> Healthcare Technology 2026
            </span>
            <h1 style="font-size: 3.5rem; margin-bottom: 1rem; line-height: 1.15; color: #FFF; text-shadow: 0 2px 10px rgba(0,0,0,0.3);">
              Layanan Kesehatan Terpadu <br/><span style="color: var(--accent);">PUSDIKZI</span>
            </h1>
            <p style="font-size: 1.15rem; opacity: 0.95; margin-bottom: 2.5rem; max-width: 600px; color: #FFF; text-shadow: 0 1px 4px rgba(0,0,0,0.3);">
              Sistem Informasi KLINIK PRATAMA PUSDIKZI mengintegrasikan rekam medis digital (EMR), antrean real-time, dan Health Passport dalam satu platform modern.
            </p>
            <div class="flex items-center gap-4">
              <button class="btn btn-orange" onclick="document.getElementById('quick-queue-section').scrollIntoView({behavior: 'smooth'})" style="font-size: 1.05rem; padding: 0.85rem 1.75rem; box-shadow: 0 4px 15px rgba(232, 163, 61, 0.4);">
                <i data-lucide="calendar"></i> Booking Sekarang
              </button>
            </div>
            
            <div class="flex items-center gap-6" style="margin-top: 3.5rem; pt-4; border-top: 1px solid rgba(255,255,255,0.25);">
              <div>
                <h3 style="color:#FFF; font-size: 1.5rem;">15.000+</h3>
                <p style="font-size:0.85rem; color: #E2E8F0;">Pasien Terlayani</p>
              </div>
              <div style="border-left: 1px solid rgba(255,255,255,0.3); padding-left: 1.5rem;">
                <h3 style="color:#FFF; font-size: 1.5rem;">4.9 / 5.0</h3>
                <p style="font-size:0.85rem; color: #E2E8F0;">Kepuasan Pasien</p>
              </div>
              <div style="border-left: 1px solid rgba(255,255,255,0.3); padding-left: 1.5rem;">
                <h3 style="color:#FFF; font-size: 1.5rem;">SATUSEHAT</h3>
                <p style="font-size:0.85rem; color: #E2E8F0;">Terintegrasi Kemenkes</p>
              </div>
            </div>
          </div>
          <div style="flex: 1;"></div>
        </div>
      </section>

      <!-- Quick Queue Section Below Hero -->
      <section id="quick-queue-section" style="margin-bottom: 4rem;">
        <div class="card card-gradient" style="padding: 3rem 4rem; max-width: 800px; margin: 0 auto; border-radius: var(--radius-xl);">
          <div style="text-align: center; margin-bottom: 2rem;">
            <h3 style="margin-bottom: 0.5rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem; font-size: 1.75rem;"><i data-lucide="ticket" style="width:28px;height:28px;"></i> Ambil Antrean Cepat</h3>
            <p style="font-size: 1.05rem; opacity: 0.9;">Dapatkan nomor antrean kunjungan hari ini langsung tanpa login.</p>
          </div>
          <div style="background: var(--bg-card); padding: 2.5rem; border-radius: var(--radius-lg); box-shadow: var(--shadow-lg);">
            <!-- Real-time Queue Status Info -->
            <div style="display: flex; gap: 1rem; margin-bottom: 2rem; padding: 1.25rem; background: rgba(0,0,0,0.03); border-radius: var(--radius-sm); border: 1px solid rgba(0,0,0,0.08);">
              <div style="flex: 1; text-align: center; border-right: 1px solid rgba(0,0,0,0.08);">
                <span style="font-size: 0.9rem; color: var(--text-light); text-transform: uppercase; font-weight: 600;">Antrean Saat Ini</span>
                <h4 style="color: var(--primary); font-size: 2rem; margin-top: 0.3rem; font-weight: 800;">A-011</h4>
              </div>
              <div style="flex: 1; text-align: center;">
                <span style="font-size: 0.9rem; color: var(--text-light); text-transform: uppercase; font-weight: 600;">Antrean Anda Berikutnya</span>
                <h4 style="color: var(--orange); font-size: 2rem; margin-top: 0.3rem; font-weight: 800;">A-012</h4>
              </div>
            </div>

            <form onsubmit="handleQuickQueue(event)" style="display: flex; flex-direction: column; gap: 1.5rem;">
              <div>
                <label style="font-weight:600; font-size:1rem; display:block; margin-bottom:0.5rem; color: var(--text-dark);">Nama Lengkap / NIK</label>
                <input type="text" id="quick-nama" class="chatbot-input" style="width:100%; padding:1rem 1.25rem; font-size:1.1rem; border: 1px solid #ccc; border-radius: var(--radius-sm); color: #333;" placeholder="Masukkan nama..." value="Agus Setiawan" required />
              </div>
              <div>
                <label style="font-weight:600; font-size:1rem; display:block; margin-bottom:0.5rem; color: var(--text-dark);">Poliklinik Tujuan</label>
                <select id="quick-poli" class="chatbot-input" style="width:100%; padding:1rem 1.25rem; font-size:1.1rem; border: 1px solid #ccc; border-radius: var(--radius-sm); color: #333;" required>
                  ${data.poliList.map(p => `<option value="${p.id}">${p.nama}</option>`).join('')}
                </select>
              </div>
              <button type="submit" class="btn btn-orange" style="padding: 1.25rem; font-size: 1.2rem; font-weight: bold; width: 100%; margin-top: 0.5rem; justify-content: center;">
                <i data-lucide="check-circle" style="width: 22px; margin-right: 0.5rem; display: inline-block; vertical-align: middle;"></i> Ambil Nomor Sekarang
              </button>
            </form>

            <div style="margin-top: 1.5rem; text-align: center; font-size: 0.95rem;">
              <span style="color: var(--text-light);">Sudah pernah berobat?</span>
              <a href="#" onclick="switchRole('login')" style="color: var(--primary); font-weight: 600; text-decoration: none; margin-left: 0.3rem;">Login untuk riwayat lengkap &rarr;</a>
            </div>
          </div>
        </div>
      </section>

      <!-- Section Layanan Kami -->
      <section style="margin-bottom: 3.5rem;">
        <div class="flex items-center justify-between" style="margin-bottom: 1.5rem;">
          <div>
            <h2>Layanan & Poliklinik Kami</h2>
            <p>Pilihan dokter spesialis dan penanganan medis komprehensif</p>
          </div>
          <span class="badge badge-primary">6 Poliklinik Aktif</span>
        </div>
        <div class="grid grid-cols-3 gap-6">
          ${data.poliList.map(p => `
            <div class="card card-gradient" style="cursor: pointer;" onclick="openBookingModal('${p.id}')">
              <div class="brand-icon-box" style="margin-bottom: 1rem; background: var(--grad-accent);">
                <i data-lucide="${p.icon}"></i>
              </div>
              <h3 style="margin-bottom: 0.5rem;">${p.nama}</h3>
              <p style="font-size: 0.9rem;">${p.deskripsi}</p>
              <div class="flex items-center gap-1" style="margin-top: 1rem; font-weight: 600; color: var(--primary);">
                <span>Jadwalkan Kunjungan</span> <i data-lucide="arrow-right" style="width: 16px;"></i>
              </div>
            </div>
          `).join('')}
        </div>
      </section>

      <!-- Section Dokter Kami -->
      <section style="margin-bottom: 3.5rem;">
        <div class="flex items-center justify-between" style="margin-bottom: 1.5rem;">
          <div>
            <h2>Dokter Tim Medis</h2>
            <p>Tenaga medis profesional dan berlisensi resmi</p>
          </div>
        </div>
        <div class="grid grid-cols-4 gap-6">
          ${data.dokterList.map(d => `
            <div class="card" style="text-align: center;">
              <img src="${d.foto}" alt="${d.nama}" style="width: 110px; height: 110px; border-radius: 50%; object-fit: cover; margin: 0 auto 1rem; border: 3px solid var(--accent);" />
              <h4>${d.nama}</h4>
              <p style="font-size: 0.85rem; color: var(--primary); font-weight: 600; margin-bottom: 0.5rem;">${d.spesialis}</p>
              <div class="badge badge-orange" style="margin-bottom: 0.85rem;">
                ⭐ ${d.rating} | Pengalaman ${d.pengalaman}
              </div>
              <p style="font-size: 0.8rem; margin-bottom: 1rem;"><i data-lucide="clock" style="width: 14px; inline-block;"></i> ${d.jadwal}</p>
              <button class="btn btn-outline btn-sm" style="width: 100%;" onclick="openBookingModal('', '${d.id}')">
                Booking Konsultasi
              </button>
            </div>
          `).join('')}
        </div>
      </section>

      <!-- Section Lokasi & Kontak -->
      <section class="grid grid-cols-2 gap-8" style="margin-bottom: 3.5rem;">
        <div class="card card-gradient">
          <h3 style="margin-bottom: 1rem;"><i data-lucide="map-pin"></i> Lokasi & Jam Operasional</h3>
          <p style="margin-bottom: 1.25rem;">${data.info.alamat}</p>
          <div style="background: var(--bg-subtle); padding: 1rem; border-radius: var(--radius-md); margin-bottom: 1rem;">
            <p><strong>🕒 Jam Operasional:</strong> ${data.info.operasional}</p>
            <p><strong>📞 Telepon:</strong> ${data.info.telepon}</p>
            <p><strong>✉️ Email:</strong> ${data.info.email}</p>
          </div>
          <div style="height: 180px; background: #D2E3D6; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; border: 1px solid var(--border-color);">
            <div style="text-align: center; color: var(--primary);">
              <i data-lucide="map" style="width: 40px; height: 40px; margin-bottom: 0.5rem;"></i>
              <p style="font-weight: 700;">Peta Lokasi Interaktif KLINIK PRATAMA PUSDIKZI</p>
              <span class="badge badge-primary">GPS: -6.5892, 106.7942</span>
            </div>
          </div>
        </div>

        <div class="card card-gradient">
          <h3 style="margin-bottom: 1rem;"><i data-lucide="message-square"></i> Testimoni Pasien</h3>
          <div style="display: flex; flex-direction: column; gap: 1rem;">
            <div style="background: var(--bg-card); padding: 1rem; border-radius: var(--radius-md); border-left: 4px solid var(--primary);">
              <p style="font-style: italic; font-size: 0.9rem;">"Pelayanan di KLINIK PRATAMA PUSDIKZI sangat modern dan cepat. Tidak perlu antre lama karena progress antrean bisa dipantau real-time dari HP!"</p>
              <div class="flex items-center justify-between" style="margin-top: 0.5rem;">
                <strong style="font-size: 0.85rem;">- Kolonel (Purn) Sudirman</strong>
                <span class="badge badge-warning">⭐⭐⭐⭐⭐ Pasien Poli Dalam</span>
              </div>
            </div>
            <div style="background: var(--bg-card); padding: 1rem; border-radius: var(--radius-md); border-left: 4px solid var(--accent);">
              <p style="font-style: italic; font-size: 0.9rem;">"Dokter giginya sangat ramah dan penanganan sangat hati-hati. Rekam medis saya langsung masuk ke akun personal Health Hub."</p>
              <div class="flex items-center justify-between" style="margin-top: 0.5rem;">
                <strong style="font-size: 0.85rem;">- Maya Indah, S.T.</strong>
                <span class="badge badge-warning">⭐⭐⭐⭐⭐ Pasien Poli Gigi</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Footer -->
      <footer style="background: var(--bg-card); border-top: 1px solid var(--border-color); padding: 2.5rem 0; margin-top: 3rem; border-radius: var(--radius-lg);">
        <div class="grid grid-cols-4 gap-6">
          <div>
            <div class="nav-brand" style="margin-bottom: 0.75rem;">
              <div class="brand-icon-box"><i data-lucide="cross"></i></div>
              <span>PUSDIKZI</span>
            </div>
            <p style="font-size: 0.85rem;">Sistem Informasi Klinik Terpadu dengan sertifikasi standar pelayanan medis modern.</p>
          </div>
          <div>
            <h4>Link Cepat</h4>
            <ul style="list-style: none; margin-top: 0.5rem; font-size: 0.88rem; display: flex; flex-direction: column; gap: 0.4rem;">
              <li><a href="#" onclick="openBookingModal()">Booking Kunjungan</a></li>
              <li><a href="#" onclick="switchRole('login')">Portal Login Multi-Role</a></li>
              <li><a href="#">Jadwal Dokter</a></li>
            </ul>
          </div>
          <div>
            <h4>Legilitas Medis</h4>
            <p style="font-size: 0.85rem; margin-top: 0.5rem;">
              <strong>SIP Dokter:</strong> ${data.info.sip}<br/>
              <strong>Izin Operasional:</strong> ${data.info.izin}<br/>
              <strong>Akreditasi:</strong> Paripurna (KARS)
            </p>
          </div>
          <div>
            <h4>Kontak Darurat</h4>
            <p style="font-size: 0.85rem; margin-top: 0.5rem;">
              Call Center IGD 24 Jam:<br/>
              <strong style="font-size: 1.1rem; color: var(--danger);">${data.info.telepon.split('/')[0].trim()}</strong>
            </p>
          </div>
        </div>
        <div style="text-align: center; margin-top: 2rem; pt-4; border-top: 1px solid var(--border-color); font-size: 0.8rem; color: var(--text-light);">
          © 2026 KLINIK PRATAMA PUSDIKZI - Modern Healthcare Tech. All Rights Reserved.
        </div>
      </footer>
    `;

    initLucideIcons();
  }

  // --------------------------------------------------------------------------
  // Login Screen Rendering
  // --------------------------------------------------------------------------
  function renderLoginScreen() {
    const container = document.getElementById("view-login-screen");
    if (!container) return;

    container.innerHTML = `
      <div class="card grid grid-cols-2 gap-8" style="max-width: 960px; margin: 3rem auto; padding: 0; overflow: hidden; border-radius: var(--radius-xl);">
        <div style="background: var(--grad-primary); color: #FFF; padding: 3rem; display: flex; flex-direction: column; justify-content: space-between;">
          <div>
            <div class="nav-brand" style="color: #FFF; margin-bottom: 2rem;">
              <div class="brand-icon-box" style="background: rgba(255,255,255,0.2);"><i data-lucide="cross"></i></div>
              <span>KLINIK PRATAMA PUSDIKZI</span>
            </div>
            <h2 style="color: #FFF; font-size: 2rem; margin-bottom: 1rem;">Portal Multi-Role Authentication</h2>
            <p style="color: rgba(255,255,255,0.95); font-size: 0.95rem;">Akses aman ke Personal Health Hub, Clinical Workspace, Smart Billing Counter, dan Command Center.</p>
          </div>

          <div style="background: rgba(255,255,255,0.12); padding: 1.25rem; border-radius: var(--radius-lg); backdrop-filter: blur(8px);">
            <p style="font-size: 0.85rem; font-weight: 700; margin-bottom: 1rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--accent);">
              ⚡ Quick Demo 1-Klik Access:
            </p>
            <div class="grid grid-cols-2 gap-3">
              <button class="btn btn-sm" style="background: rgba(255,255,255,0.9); color: var(--primary); border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'" onclick="switchRole('pasien')">
                <i data-lucide="user"></i> Login Pasien
              </button>
              <button class="btn btn-sm" style="background: rgba(255,255,255,0.9); color: var(--primary); border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'" onclick="switchRole('dokter')">
                <i data-lucide="stethoscope"></i> Login Dokter
              </button>
              <button class="btn btn-sm" style="background: rgba(255,255,255,0.9); color: var(--primary); border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'" onclick="switchRole('kasir')">
                <i data-lucide="credit-card"></i> Login Kasir
              </button>
              <button class="btn btn-sm" style="background: rgba(255,255,255,0.9); color: var(--primary); border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'" onclick="switchRole('admin')">
                <i data-lucide="shield"></i> Login Admin
              </button>
              <button class="btn btn-sm" style="background: rgba(255,255,255,0.9); color: var(--primary); border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: all 0.3s ease; grid-column: span 2;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'" onclick="switchRole('apoteker')">
                <i data-lucide="pill"></i> Login Apoteker
              </button>
            </div>
          </div>
        </div>

        <div style="padding: 3.5rem 3rem;">
          <div class="flex gap-2" style="margin-bottom: 2rem; background: var(--bg-subtle); padding: 0.5rem; border-radius: var(--radius-lg); flex-wrap: wrap; justify-content: center; box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);">
            <button class="btn btn-sm active-tab-btn" id="tab-btn-pasien" style="flex: 1 1 30%; font-size: 0.85rem;" onclick="setLoginRoleTab('pasien')"><i data-lucide="user" style="width: 14px;"></i> Pasien</button>
            <button class="btn btn-sm" id="tab-btn-dokter" style="flex: 1 1 30%; font-size: 0.85rem;" onclick="setLoginRoleTab('dokter')"><i data-lucide="stethoscope" style="width: 14px;"></i> Dokter</button>
            <button class="btn btn-sm" id="tab-btn-kasir" style="flex: 1 1 30%; font-size: 0.85rem;" onclick="setLoginRoleTab('kasir')"><i data-lucide="credit-card" style="width: 14px;"></i> Kasir</button>
            <button class="btn btn-sm" id="tab-btn-admin" style="flex: 1 1 45%; font-size: 0.85rem;" onclick="setLoginRoleTab('admin')"><i data-lucide="shield" style="width: 14px;"></i> Admin</button>
            <button class="btn btn-sm" id="tab-btn-apoteker" style="flex: 1 1 45%; font-size: 0.85rem;" onclick="setLoginRoleTab('apoteker')"><i data-lucide="pill" style="width: 14px;"></i> Apoteker</button>
          </div>

          <form onsubmit="handleFormLogin(event)">
            <div style="margin-bottom: 1.25rem;">
              <label style="display: block; font-weight: 600; font-size: 0.88rem; margin-bottom: 0.4rem;">Nomor RM / Email / Username</label>
              <input type="text" id="login-username" class="chatbot-input" style="width: 100%; padding: 0.75rem;" value="PAS-2026-001" required />
            </div>
            <div style="margin-bottom: 1.5rem;">
              <label style="display: block; font-weight: 600; font-size: 0.88rem; margin-bottom: 0.4rem;">Kata Sandi</label>
              <input type="password" id="login-password" class="chatbot-input" style="width: 100%; padding: 0.75rem;" value="••••••••" required />
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.85rem; font-size: 1rem; margin-bottom: 1.25rem;">
              <i data-lucide="log-in"></i> Masuk Sekarang
            </button>
          </form>

          <div id="pasien-fast-onboard" style="border-top: 1px solid var(--border-color); pt-4; margin-top: 1.25rem;">
            <p style="font-size: 0.8rem; text-align: center; margin-bottom: 0.75rem;">Atau masuk lebih cepat dengan:</p>
            <div class="flex gap-2">
              <button class="btn btn-outline btn-sm" style="flex: 1;" onclick="switchRole('pasien')">
                🌐 Google Account
              </button>
              <button class="btn btn-outline btn-sm" style="flex: 1;" onclick="switchRole('pasien')">
                📲 OTP WhatsApp
              </button>
            </div>
          </div>
        </div>
      </div>
    `;

    initLucideIcons();
  }

  window.setLoginRoleTab = function(role) {
    document.querySelectorAll(".active-tab-btn").forEach(b => b.classList.remove("active-tab-btn"));
    const selected = document.getElementById(`tab-btn-${role}`);
    if (selected) selected.classList.add("active-tab-btn");

    const userField = document.getElementById("login-username");
    if (userField) {
      if (role === "pasien") userField.value = "PAS-2026-001";
      else if (role === "dokter") userField.value = "DOC-001";
      else if (role === "kasir") userField.value = "kasir_rina";
      else if (role === "admin") userField.value = "admin_pusdikzi";
      else if (role === "apoteker") userField.value = "apoteker_budi";
    }
  };

  window.handleFormLogin = function(e) {
    e.preventDefault();
    const userField = document.getElementById("login-username").value;
    if (userField.includes("DOC")) switchRole("dokter");
    else if (userField.includes("kasir")) switchRole("kasir");
    else if (userField.includes("admin")) switchRole("admin");
    else if (userField.includes("apoteker")) switchRole("apoteker");
    else switchRole("pasien");
  };

  // --------------------------------------------------------------------------
  // Dashboard Sidebar & Menu Controller
  // --------------------------------------------------------------------------
  function renderDashboardSidebar(role) {
    const sidebar = document.getElementById("dashboard-sidebar");
    if (!sidebar) return;

    let menuItems = [];
    if (role === "pasien") {
      menuItems = [
        { id: "beranda", icon: "activity", label: "Beranda & Passport" },
        { id: "booking", icon: "calendar", label: "Booking Kunjungan" },
        { id: "antrean", icon: "clock", label: "Antrean Real-time" },
        { id: "rekam_medis", icon: "file-text", label: "Rekam Medis Saya" },
        { id: "resep", icon: "pill", label: "Resep & Medication Streak" },
        { id: "tagihan", icon: "receipt", label: "Tagihan Saya" },
        { id: "edukasi", icon: "book-open", label: "Edukasi Kesehatan" },
        { id: "profil", icon: "settings", label: "Profil & Pengaturan" }
      ];
    } else if (role === "dokter") {
      menuItems = [
        { id: "beranda", icon: "layout-dashboard", label: "Beranda Praktik" },
        { id: "antrean_periksa", icon: "users", label: "Antrean Pemeriksaan" },
        { id: "ruang_periksa", icon: "stethoscope", label: "Ruang Periksa EMR" },
        { id: "riwayat_pasien", icon: "history", label: "Riwayat Pasien" },
        { id: "jadwal", icon: "calendar", label: "Jadwal & Cuti" },
        { id: "statistik", icon: "bar-chart-2", label: "Statistik Saya" }
      ];
    } else if (role === "kasir") {
      menuItems = [
        { id: "beranda", icon: "layout-dashboard", label: "Beranda Kas harian" },
        { id: "antrean_bayar", icon: "credit-card", label: "Antrean Pembayaran" },
        { id: "kasir_billing", icon: "calculator", label: "Kasir & Billing" },
        { id: "cetak_dokumen", icon: "printer", label: "Cetak Dokumen" },
        { id: "rekap_kas", icon: "pie-chart", label: "Rekap Kas Shift" },
        { id: "riwayat_transaksi", icon: "receipt", label: "Riwayat Transaksi" }
      ];
    } else if (role === "admin") {
      menuItems = [
        { id: "beranda", icon: "gauge", label: "Command Center KPI" },
        { id: "rbac", icon: "shield-check", label: "Manajemen RBAC" },
        { id: "master_data", icon: "database", label: "Master Data" },
        { id: "pasien_db", icon: "users", label: "Database Pasien" },
        { id: "stok_obat", icon: "package", label: "Stok Obat (Apotek)" },
        { id: "resep_digital", icon: "file-text", label: "Resep Digital (E-Resep)" },
        { id: "laporan", icon: "bar-chart", label: "Laporan & Analitik" },
        { id: "audit_log", icon: "file-code", label: "Audit Log System" },
        { id: "integrasi", icon: "wifi", label: "SATUSEHAT & BPJS" }
      ];
    } else if (role === "apoteker") {
      menuItems = [
        { id: "beranda", icon: "layout-dashboard", label: "Beranda Apotek" },
        { id: "stok_obat", icon: "package", label: "Manajemen Stok Obat" },
        { id: "resep_digital", icon: "file-text", label: "Resep Digital (E-Resep)" },
        { id: "riwayat_transaksi", icon: "history", label: "Riwayat Penyerahan" }
      ];
    }

    sidebar.innerHTML = `
      <div style="padding-bottom: 1rem; border-bottom: 1px solid var(--border-color); margin-bottom: 1rem;">
        <span class="badge badge-primary" style="text-transform: uppercase; font-size: 0.75rem;">Role: ${role}</span>
        <h4 style="margin-top: 0.4rem;">${AppState.currentUser ? AppState.currentUser.nama : 'Pengguna Klinik'}</h4>
      </div>

      <ul class="sidebar-menu">
        ${menuItems.map(item => `
          <li class="sidebar-item ${item.id === AppState.currentTab ? 'active' : ''}" onclick="switchDashboardTab('${item.id}')">
            <i data-lucide="${item.icon}"></i>
            <span>${item.label}</span>
          </li>
        `).join('')}
      </ul>

      <div style="margin-top: auto; border-top: 1px solid var(--border-color); pt-4;">
        <button class="btn btn-outline btn-sm" style="width: 100%; color: var(--danger);" onclick="switchRole('public')">
          <i data-lucide="log-out"></i> Keluar Dashboard
        </button>
      </div>
    `;

    initLucideIcons();
  }

  window.switchDashboardTab = function(tabId, syncHash = true) {
    AppState.currentTab = tabId;
    toggleMobileSidebar(false);
    renderDashboardSidebar(AppState.currentRole);
    renderDashboardContent(AppState.currentRole, tabId);
    renderMobileBottomNav(AppState.currentRole, tabId);
    if (syncHash) {
      updateUrlHash(AppState.currentRole, tabId);
    }
    window.scrollTo({ top: 0, behavior: "smooth" });
  };

  // --------------------------------------------------------------------------
  // Dashboard Content Dispatcher
  // --------------------------------------------------------------------------
  function renderDashboardContent(role, tab) {
    const main = document.getElementById("dashboard-main-content");
    if (!main) return;

    if (role === "pasien") renderPasienHub(main, tab);
    else if (role === "dokter") renderDokterWorkspace(main, tab);
    else if (role === "kasir") renderKasirCounter(main, tab);
    else if (role === "admin") renderAdminCommandCenter(main, tab);
    else if (role === "apoteker") renderApotekerDashboard(main, tab);

    initLucideIcons();
  }

  // --------------------------------------------------------------------------
  // ROLE 1: PASIEN HUB
  // --------------------------------------------------------------------------
  function renderPasienHub(container, tab) {
    const p = window.KlinikData.pasienList[0];

    if (tab === "beranda") {
      container.innerHTML = `
        <div class="health-passport-card" style="margin-bottom: 2rem;">
          <div class="flex items-center justify-between">
            <div>
              <span class="badge badge-orange" style="margin-bottom: 0.5rem;">${p.badge}</span>
              <h2>HEALTH PASSPORT PASIEN</h2>
              <p style="color: rgba(255,255,255,0.9);">No. RM: <strong>${p.id}</strong> | NIK: ${p.nik}</p>
            </div>
            <div style="text-align: right;">
              <span style="font-size: 2rem; font-weight: 800; display: block; line-height: 1;">${p.golDarah}</span>
              <span style="font-size: 0.8rem; opacity: 0.8;">Golongan Darah</span>
            </div>
          </div>

          <div class="vitals-grid">
            <div class="vital-box">
              <span style="font-size: 0.78rem; opacity: 0.8; display: block;">Tekanan Darah</span>
              <strong style="font-size: 1.15rem;">122 / 80 mmHg</strong>
            </div>
            <div class="vital-box">
              <span style="font-size: 0.78rem; opacity: 0.8; display: block;">Detak Jantung</span>
              <strong style="font-size: 1.15rem;">78 bpm</strong>
            </div>
            <div class="vital-box">
              <span style="font-size: 0.78rem; opacity: 0.8; display: block;">Saturasi O2</span>
              <strong style="font-size: 1.15rem;">99 %</strong>
            </div>
            <div class="vital-box">
              <span style="font-size: 0.78rem; opacity: 0.8; display: block;">Streak Kepatuhan</span>
              <strong style="font-size: 1.15rem; color: #FBBF24;">🔥 ${p.streakObat} Hari</strong>
            </div>
          </div>
        </div>

        <div class="grid grid-cols-2 gap-6" style="margin-bottom: 2rem;">
          <div class="card card-gradient">
            <div class="flex items-center justify-between" style="margin-bottom: 1rem;">
              <h4>Status Antrean Hari Ini</h4>
              <span class="badge badge-success">Aktif</span>
            </div>
            <div style="text-align: center; padding: 1rem 0;">
              <span style="font-size: 3rem; font-weight: 800; color: var(--primary); display: block; line-height: 1;">A-001</span>
              <p style="margin-top: 0.5rem;">Poli Spesialis Penyakit Dalam - dr. Ahmad Ridwan, Sp.PD</p>
              <div style="background: var(--bg-subtle); height: 10px; border-radius: var(--radius-full); margin: 1.25rem 0; overflow: hidden;">
                <div style="width: 75%; height: 100%; background: var(--grad-accent);"></div>
              </div>
              <p style="font-size: 0.85rem;">Status: <strong>Sedang Diperiksa di Ruang 2</strong> (Estimasi sisa: 5 menit)</p>
            </div>
          </div>

          <div class="card card-gradient flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between" style="margin-bottom: 1rem;">
                <h4>Widget Kualitas Udara & Cuaca</h4>
                <span class="badge badge-info">Matraman, Jakarta</span>
              </div>
              <div class="flex items-center gap-4">
                <div style="font-size: 2.5rem;">🌤️ 29°C</div>
                <div>
                  <strong style="color: var(--success); font-size: 1.1rem;">AQI 32 - Baik</strong>
                  <p style="font-size: 0.85rem;">Kualitas udara bersih untuk aktivitas outdoor & kesehatan pernapasan.</p>
                </div>
              </div>
            </div>
            <div style="background: var(--accent-light); padding: 0.75rem; border-radius: var(--radius-md); margin-top: 1rem;">
              <p style="font-size: 0.8rem; color: var(--primary);"><strong>💡 Tips Kesehatan Hari Ini:</strong> Tetap hidrasi dengan minum minimal 2 Liter air putih per hari.</p>
            </div>
          </div>
        </div>

        <div class="card card-gradient">
          <h4>Grafik Tren Tekanan Darah (4 Bulan Terakhir)</h4>
          <canvas id="vitalsChart" style="max-height: 220px; width: 100%; margin-top: 1rem;"></canvas>
        </div>
      `;

      setTimeout(() => renderVitalsChart(p.vitalsTrend), 100);

    } else if (tab === "booking") {
      container.innerHTML = `
        <div class="card card-gradient" style="max-width: 720px; margin: 0 auto;">
          <h3>Booking Kunjungan Dokter</h3>
          <p style="margin-bottom: 1.5rem;">Pilih Poliklinik, Dokter, dan Waktu Praktik Kunjungan Anda</p>
          <form onsubmit="handleBookingSubmit(event)">
            <div style="margin-bottom: 1rem;">
              <label style="font-weight:600; font-size:0.9rem;">Poliklinik Tujuan</label>
              <select id="book-poli" class="chatbot-input" style="width:100%; padding:0.75rem;" required>
                ${window.KlinikData.poliList.map(p => `<option value="${p.id}">${p.nama}</option>`).join('')}
              </select>
            </div>
            <div style="margin-bottom: 1rem;">
              <label style="font-weight:600; font-size:0.9rem;">Dokter Pemeriksa</label>
              <select id="book-dokter" class="chatbot-input" style="width:100%; padding:0.75rem;" required>
                ${window.KlinikData.dokterList.map(d => `<option value="${d.id}">${d.nama} (${d.spesialis})</option>`).join('')}
              </select>
            </div>
            <div class="grid grid-cols-2 gap-4" style="margin-bottom: 1.5rem;">
              <div>
                <label style="font-weight:600; font-size:0.9rem;">Tanggal Kunjungan</label>
                <input type="date" class="chatbot-input" style="width:100%; padding:0.75rem;" value="2026-07-28" required />
              </div>
              <div>
                <label style="font-weight:600; font-size:0.9rem;">Jam Praktik</label>
                <select class="chatbot-input" style="width:100%; padding:0.75rem;" required>
                  <option>09.00 - 10.00 WIB</option>
                  <option>10.00 - 11.00 WIB</option>
                  <option>14.00 - 15.00 WIB</option>
                </select>
              </div>
            </div>
            <button type="submit" class="btn btn-orange" style="width: 100%; padding: 0.85rem;">
              <i data-lucide="check-circle"></i> Konfirmasi Booking Kunjungan
            </button>
          </form>
        </div>
      `;
    } else if (tab === "antrean") {
      container.innerHTML = `
        <div class="card card-gradient" style="max-width: 600px; margin: 0 auto; text-align: center;">
          <h3>Monitor Antrean Real-time</h3>
          <p style="margin-bottom: 2rem;">Progress antrean saat ini di Poliklinik Spesialis Penyakit Dalam</p>
          <div style="font-size: 4rem; font-weight: 800; color: var(--primary);">A-001</div>
          <p style="font-weight: 600; color: var(--accent);">Nomor Anda: A-001 (Posisi Terdepan)</p>
          <div style="background: var(--bg-subtle); height: 16px; border-radius: var(--radius-full); margin: 2rem 0; overflow: hidden; position: relative;">
            <div style="width: 90%; height: 100%; background: var(--grad-hero); transition: var(--transition-slow);"></div>
          </div>
          <div class="flex justify-between" style="font-size: 0.85rem; font-weight: 600;">
            <span>A-000 (Selesai)</span>
            <span>A-001 (Ruang Periksa 2)</span>
            <span>A-002 (Menunggu)</span>
          </div>
        </div>
      `;
    } else if (tab === "rekam_medis") {
      container.innerHTML = `
        <h3>Linimasa Rekam Medis Digital</h3>
        <p style="margin-bottom: 2rem;">Riwayat diagnosa, resep, dan hasil pemeriksaan Anda</p>
        <div class="timeline">
          ${p.rekamMedis.map(rm => `
            <div class="timeline-item">
              <div class="timeline-dot"></div>
              <div class="card card-gradient">
                <div class="flex items-center justify-between" style="margin-bottom: 0.5rem;">
                  <h4>${rm.diagnosis}</h4>
                  <span class="badge badge-primary">${rm.tgl}</span>
                </div>
                <p><strong>Dokter:</strong> ${rm.doctor} (${rm.poli})</p>
                <p><strong>Resep Obat:</strong> ${rm.resep}</p>
                <p style="font-style: italic; margin-top: 0.5rem; background: var(--bg-subtle); padding: 0.5rem; border-radius: var(--radius-sm);">
                  "${rm.catatan}"
                </p>
              </div>
            </div>
          `).join('')}
        </div>
      `;
    } else if (tab === "resep") {
      container.innerHTML = `
        <div class="flex items-center justify-between" style="margin-bottom: 1.5rem;">
          <div>
            <h3>Resep & Medication Streak Tracker</h3>
            <p>Jadwal minum obat aktif dan progress kepatuhan harian</p>
          </div>
          <button class="btn btn-orange" onclick="checkInObatStreak()">
            <i data-lucide="check"></i> Check-in Minum Obat Hari Ini (Streak +1)
          </button>
        </div>
        <div class="grid grid-cols-2 gap-6">
          <div class="card card-gradient">
            <span class="badge badge-success" style="margin-bottom: 0.5rem;">Aktif</span>
            <h4>Amlodipine 10mg</h4>
            <p>Dosis: 1x1 Tablet (Pagi Hari Setelah Makan)</p>
            <div class="flex items-center justify-between" style="margin-top: 1rem;">
              <span>Status Hari Ini:</span>
              <span class="badge badge-warning">Sudah Diminum 08.00 WIB</span>
            </div>
          </div>
          <div class="card card-gradient">
            <span class="badge badge-success" style="margin-bottom: 0.5rem;">Aktif</span>
            <h4>Simvastatin 20mg</h4>
            <p>Dosis: 1x1 Tablet (Malam Hari Sebelum Tidur)</p>
            <div class="flex items-center justify-between" style="margin-top: 1rem;">
              <span>Status Hari Ini:</span>
              <span class="badge badge-danger">Jadwal 21.00 WIB</span>
            </div>
          </div>
        </div>
      `;
    } else if (tab === "tagihan") {
      container.innerHTML = `
        <h3>Tagihan & Riwayat Invoice Saya</h3>
        <p style="margin-bottom: 1.5rem;">Daftar transaksi pembayaran medis dan kuitansi</p>
        <div class="card card-gradient">
          <div class="flex items-center justify-between" style="margin-bottom: 1rem;">
            <div>
              <h4>Invoice No: INV/20260727/001</h4>
              <p>Tanggal: 27 Juli 2026 | Poli Spesialis Penyakit Dalam</p>
            </div>
            <span class="badge badge-success">LUNAS</span>
          </div>
          <p style="font-size: 1.1rem; font-weight: 700; color: var(--primary);">Total Tagihan: Rp 175.000</p>
          <div style="margin-top: 1rem;">
            <button class="btn btn-outline btn-sm" onclick="cetakStrukPembayaran('INV/20260727/001')">
              <i data-lucide="download"></i> Unduh Struk / Invoice PDF
            </button>
          </div>
        </div>
      `;
    } else if (tab === "profil") {
      container.innerHTML = `
        <div class="card card-gradient" style="max-width: 600px; margin: 0 auto;">
          <h3>Profil & Pengaturan Akun</h3>
          <form onsubmit="handleProfileSave(event)" style="margin-top: 1.25rem;">
            <div style="margin-bottom: 1rem;">
              <label style="font-weight: 600; font-size: 0.88rem;">Nama Lengkap</label>
              <input class="chatbot-input" style="width:100%; padding:0.75rem;" value="${p.nama}" />
            </div>
            <div style="margin-bottom: 1rem;">
              <label style="font-weight: 600; font-size: 0.88rem;">Nomor Telepon / WhatsApp</label>
              <input class="chatbot-input" style="width:100%; padding:0.75rem;" value="${p.noHp}" />
            </div>
            <div style="margin-bottom: 1.5rem;">
              <label style="font-weight: 600; font-size: 0.88rem;">Sandi Baru</label>
              <input type="password" class="chatbot-input" style="width:100%; padding:0.75rem;" placeholder="Kosongkan jika tidak diubah" />
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%; padding:0.85rem;">
              <i data-lucide="save"></i> Simpan Perubahan Profil
            </button>
          </form>
        </div>
      `;
    } else {
      container.innerHTML = `<div class="card"><h3>Menu ${tab}</h3><p>Modul pasien ${tab} aktif.</p></div>`;
    }
  }

  window.handleBookingSubmit = function(e) {
    e.preventDefault();
    showToast("Booking Kunjungan Berhasil Disimpan! Kode Antrean: A-005. Notifikasi dikirim via WhatsApp.");
    switchDashboardTab("antrean");
  };

  window.checkInObatStreak = function() {
    showToast("Hebat! Check-in Minum Obat Berhasil. Streak Anda bertambah menjadi 8 Hari 🔥");
  };

  window.handleProfileSave = function(e) {
    e.preventDefault();
    showToast("Profil & Preferensi Pengaturan Berhasil Diperbarui!");
  };

  function renderVitalsChart(dataTrend) {
    const ctx = document.getElementById("vitalsChart");
    if (!ctx) return;

    if (AppState.charts.vitals) AppState.charts.vitals.destroy();

    AppState.charts.vitals = new Chart(ctx, {
      type: 'line',
      data: {
        labels: dataTrend.dates,
        datasets: [
          {
            label: 'Sistolik (mmHg)',
            data: dataTrend.sistol,
            borderColor: '#2E5339',
            backgroundColor: 'rgba(46, 83, 57, 0.1)',
            fill: true,
            tension: 0.3
          },
          {
            label: 'Diastolik (mmHg)',
            data: dataTrend.diastol,
            borderColor: '#E8A33D',
            backgroundColor: 'rgba(232, 163, 61, 0.1)',
            fill: true,
            tension: 0.3
          }
        ]
      },
      options: {
        responsive: true,
        plugins: { legend: { position: 'top' } }
      }
    });
  }

  // --------------------------------------------------------------------------
  // ROLE 2: DOKTER WORKSPACE
  // --------------------------------------------------------------------------
  function renderDokterWorkspace(container, tab) {
    if (tab === "beranda" || tab === "antrean_periksa") {
      container.innerHTML = `
        <div class="flex items-center justify-between" style="margin-bottom: 1.5rem;">
          <div>
            <h3>Predictive Priority Patient Queue</h3>
            <p>Pasien diurutkan secara otomatis berdasarkan tingkat urgensi kondisi medis</p>
          </div>
          <span class="badge badge-primary">${window.KlinikData.antreanAktif.length} Pasien Menunggu</span>
        </div>

        <div class="grid grid-cols-1 gap-4">
          ${window.KlinikData.antreanAktif.map(a => `
            <div class="card card-gradient flex items-center justify-between gap-4">
              <div class="flex items-center gap-4">
                <div style="font-size: 1.75rem; font-weight: 800; color: var(--primary); min-width: 80px;">${a.no}</div>
                <div>
                  <div class="flex items-center gap-2">
                    <h4>${a.nama}</h4>
                    <span class="badge ${a.urgensi === 'Tinggi' ? 'badge-danger' : a.urgensi === 'Sedang' ? 'badge-warning' : 'badge-success'}">
                      Urgensi: ${a.urgensi}
                    </span>
                  </div>
                  <p style="font-size: 0.88rem; margin-top: 0.2rem;"><strong>Poli:</strong> ${a.poli} | <strong>Jam:</strong> ${a.waktu}</p>
                  <p style="font-size: 0.85rem; font-style: italic; color: var(--text-dark); margin-top: 0.3rem; background: var(--bg-subtle); padding: 0.35rem 0.65rem; border-radius: var(--radius-sm);">
                    Keluhan: "${a.keluhan}"
                  </p>
                </div>
              </div>
              <button class="btn btn-primary" onclick="switchDashboardTab('ruang_periksa')">
                <i data-lucide="stethoscope"></i> Panggil & Periksa
              </button>
            </div>
          `).join('')}
        </div>
      `;
    } else if (tab === "ruang_periksa") {
      container.innerHTML = `
        <div class="card card-gradient" style="margin-bottom: 1.5rem;">
          <div class="flex items-center justify-between">
            <div>
              <h3>Ruang Periksa EMR Terintegrasi</h3>
              <p>Pasien: <strong>Bambang Soeprapto (PAS-2026-001)</strong> | Laki-laki, 48 Th</p>
            </div>
            <span class="badge badge-danger">Alergi: Penisilin, Udang</span>
          </div>
        </div>

        <div class="grid grid-cols-2 gap-6">
          <div class="card card-gradient">
            <h4>Form EMR SOAP</h4>
            <div style="margin-top: 1rem; display: flex; flex-direction: column; gap: 1rem;">
              <div>
                <label style="font-weight: 600; font-size: 0.85rem;">S (Subjektif - Keluhan Utama)</label>
                <textarea class="chatbot-input" style="width: 100%; height: 70px;">Pasien mengeluh pusing dan tengkuk terasa berat sejak kemarin malam.</textarea>
              </div>
              <div>
                <label style="font-weight: 600; font-size: 0.85rem;">O (Objektif - Vital Signs)</label>
                <div class="grid grid-cols-2 gap-2">
                  <input class="chatbot-input" value="TD: 130/85 mmHg" />
                  <input class="chatbot-input" value="Nadi: 80x/mnt" />
                </div>
              </div>
              <div>
                <label style="font-weight: 600; font-size: 0.85rem;">A (Asesmen - ICD-10 Search)</label>
                <input class="chatbot-input" id="icd-search" placeholder="Ketik kode/nama diagnosa (Contoh: I10)..." value="I10 - Essential (primary) hypertension" oninput="searchICD10(this.value)" />
                <div id="icd-results" style="margin-top: 0.5rem; display: flex; gap: 0.35rem; flex-wrap: wrap;"></div>
              </div>
              <div>
                <label style="font-weight: 600; font-size: 0.85rem;">P (Plan & E-Resep)</label>
                <select class="chatbot-input" id="drug-select-doc" style="width: 100%; margin-bottom: 0.5rem;">
                  <option value="OBT-001">Amlodipine 10mg</option>
                  <option value="OBT-005">Simvastatin 20mg (Perhatian Interaksi!)</option>
                </select>
                <button class="btn btn-outline btn-sm" onclick="checkDrugInteractionDoc()">
                  <i data-lucide="shield-alert"></i> Cek Interaksi Obat Auto
                </button>
              </div>
            </div>
            <button class="btn btn-orange" style="width: 100%; margin-top: 1.5rem; padding: 0.85rem;" onclick="simpanEMR()">
              <i data-lucide="save"></i> Simpan EMR & Selesaikan Pemeriksaan
            </button>
          </div>

          <div class="card card-gradient">
            <h4>Riwayat Vital Signs & Diagnosa Pasien</h4>
            <div style="margin-top: 1rem;">
              <p><strong>Golongan Darah:</strong> O+</p>
              <p><strong>Tinggi / Berat:</strong> 172 cm / 74 kg (BMI: 25.0 - Normal)</p>
              <h5 style="margin-top: 1.25rem; margin-bottom: 0.5rem;">Riwayat Kunjungan Terakhir:</h5>
              <div style="background: var(--bg-card); padding: 0.85rem; border-radius: var(--radius-md); border: 1px solid var(--border-color);">
                <p><strong>10 Jul 2026:</strong> Essential Hypertension (I10)</p>
                <p style="font-size: 0.85rem; opacity: 0.8;">Resep: Amlodipine 10mg (1x1)</p>
              </div>
            </div>
          </div>
        </div>
      `;
    } else {
      container.innerHTML = `<div class="card"><h3>Menu Dokter: ${tab}</h3><p>Modul dokter ${tab} aktif.</p></div>`;
    }
  }

  window.searchICD10 = function(val) {
    const box = document.getElementById("icd-results");
    if (!box) return;
    const matches = window.KlinikData.icd10Database.filter(i => i.code.toLowerCase().includes(val.toLowerCase()) || i.name.toLowerCase().includes(val.toLowerCase()));
    box.innerHTML = matches.slice(0, 3).map(m => `
      <span class="chip-btn" onclick="document.getElementById('icd-search').value = '${m.code} - ${m.name}'">
        ${m.code} - ${m.name}
      </span>
    `).join('');
  };

  window.checkDrugInteractionDoc = function() {
    showToast("⚠️ Peringatan Interaksi Obat: Kombinasi Amlodipine + Simvastatin dapat meningkatkan kadar Simvastatin dalam darah. Dosis Simvastatin disarankan maks 20mg.", "warning");
  };

  window.simpanEMR = function() {
    showToast("Rekam Medis (EMR) Berhasil Disimpan & Terkirim ke Kasir/Farmasi!");
    switchDashboardTab("antrean_periksa");
  };

  // --------------------------------------------------------------------------
  // ROLE 3: KASIR COUNTER
  // --------------------------------------------------------------------------
  function renderKasirCounter(container, tab) {
    const queue = window.KlinikData.antreanBayar;

    if (tab === "beranda" || tab === "antrean_bayar" || tab === "kasir_billing") {
      container.innerHTML = `
        <div class="flex items-center justify-between" style="margin-bottom: 1.5rem;">
          <div>
            <h3>Smart Billing Counter</h3>
            <p>Proses pembayaran cepat dengan integrasi rincian tindakan + obat otomatis</p>
          </div>
          <span class="badge badge-success">Kas Harian Terbuka: Rp 4.850.000</span>
        </div>

        <div class="grid grid-cols-2 gap-6">
          <div class="card card-gradient">
            <h4>Antrean Pembayaran Aktif</h4>
            <div style="margin-top: 1rem; display: flex; flex-direction: column; gap: 0.85rem;">
              ${queue.map(q => `
                <div style="background: var(--bg-card); padding: 1rem; border-radius: var(--radius-md); border-left: 4px solid var(--primary);" class="flex items-center justify-between">
                  <div>
                    <strong>${q.nama}</strong> (${q.invoiceNo})
                    <p style="font-size: 0.85rem;">${q.poli} | Total: <strong style="color: var(--primary);">Rp ${q.total.toLocaleString()}</strong></p>
                  </div>
                  <button class="btn btn-sm btn-orange" onclick="selectInvoiceBilling('${q.invoiceNo}')">
                    Proses Bayar
                  </button>
                </div>
              `).join('')}
            </div>
          </div>

          <div class="card card-gradient" id="kasir-billing-box">
            <h4>Rincian Tagihan Auto-Itemized</h4>
            <div style="margin-top: 1rem;" id="billing-details-content">
              <p style="font-style: italic;">Pilih pasien di sebelah kiri untuk memuat rincian billing.</p>
            </div>
          </div>
        </div>
      `;
    } else {
      container.innerHTML = `<div class="card"><h3>Menu Kasir: ${tab}</h3><p>Modul kasir ${tab} aktif.</p></div>`;
    }
  }

  window.selectInvoiceBilling = function(invNo) {
    const item = window.KlinikData.antreanBayar.find(b => b.invoiceNo === invNo) || window.KlinikData.antreanBayar[0];
    const box = document.getElementById("billing-details-content");
    if (!box) return;

    box.innerHTML = `
      <div style="background: var(--bg-card); padding: 1rem; border-radius: var(--radius-md); margin-bottom: 1rem;">
        <p><strong>No. Invoice:</strong> ${item.invoiceNo}</p>
        <p><strong>Pasien:</strong> ${item.nama} (${item.noRm})</p>
      </div>

      <div style="margin-bottom: 1rem;">
        <h5 style="margin-bottom: 0.5rem;">Item Tagihan:</h5>
        ${item.items.map(i => `
          <div class="flex justify-between" style="font-size: 0.9rem; padding: 0.4rem 0; border-bottom: 1px dashed var(--border-color);">
            <span>${i.name}</span>
            <strong>Rp ${i.Rp.toLocaleString()}</strong>
          </div>
        `).join('')}
      </div>

      <div style="margin-bottom: 1.25rem;">
        <label style="font-weight:600; font-size:0.85rem;">Metode Pembayaran / Split Payment</label>
        <select class="chatbot-input" style="width: 100%;">
          <option>QRIS Instant (GoPay/OVO/ShopeePay/BCA)</option>
          <option>Tunai (Cash)</option>
          <option>Debit / Credit Card EDC</option>
          <option>BPJS Kesehatan (Covered 100%)</option>
        </select>
      </div>

      <div class="flex items-center justify-between" style="font-size: 1.2rem; font-weight: 800; margin-bottom: 1.5rem; color: var(--primary);">
        <span>TOTAL BAYAR:</span>
        <span>Rp ${item.total.toLocaleString()}</span>
      </div>

      <button class="btn btn-primary" style="width: 100%; padding: 0.85rem;" onclick="cetakStrukPembayaran('${item.invoiceNo}')">
        <i data-lucide="printer"></i> Terima Pembayaran & Cetak Struk
      </button>
    `;
    initLucideIcons();
  };

  window.cetakStrukPembayaran = function(invNo) {
    const item = window.KlinikData.antreanBayar.find(b => b.invoiceNo === invNo) || window.KlinikData.antreanBayar[0];
    const receiptBox = document.getElementById("printable-receipt-content");
    const modal = document.getElementById("receipt-modal-overlay");

    if (receiptBox && modal) {
      receiptBox.innerHTML = `
        <div style="text-align: center; border-bottom: 2px dashed var(--border-color); padding-bottom: 1rem; margin-bottom: 1rem;">
          <h3 style="color: var(--primary); margin-bottom: 0.2rem;">KLINIK PRATAMA PUSDIKZI</h3>
          <p style="font-size: 0.8rem;">${window.KlinikData.info.alamat}</p>
          <p style="font-size: 0.78rem;">SIP: ${window.KlinikData.info.sip}</p>
        </div>

        <div style="font-size: 0.85rem; margin-bottom: 1rem;">
          <p><strong>NO INVOICE:</strong> ${item.invoiceNo}</p>
          <p><strong>TANGGAL:</strong> 27 Juli 2026 09:55 WIB</p>
          <p><strong>PASIEN:</strong> ${item.nama} (${item.noRm})</p>
          <p><strong>POLI:</strong> ${item.poli}</p>
        </div>

        <div style="border-top: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color); padding: 0.75rem 0; margin-bottom: 1rem;">
          ${item.items.map(i => `
            <div class="flex justify-between" style="font-size: 0.88rem; margin-bottom: 0.35rem;">
              <span>${i.name}</span>
              <strong>Rp ${i.Rp.toLocaleString()}</strong>
            </div>
          `).join('')}
        </div>

        <div class="flex justify-between" style="font-size: 1.15rem; font-weight: 800; color: var(--primary);">
          <span>TOTAL LUNAS:</span>
          <span>Rp ${item.total.toLocaleString()}</span>
        </div>

        <div style="text-align: center; margin-top: 1.5rem; font-size: 0.78rem; opacity: 0.8;">
          Terima kasih telah berobat di KLINIK PRATAMA PUSDIKZI.<br/>Semoga Lekas Sembuh!
        </div>
      `;
      modal.classList.add("open");
    }

    showToast(`Struk Invoice ${invNo} Berhasil Dicetak!`);
  };

  // --------------------------------------------------------------------------
  // ROLE 4: ADMIN COMMAND CENTER
  // --------------------------------------------------------------------------
  function renderAdminCommandCenter(container, tab) {
    const data = window.KlinikData;

    if (tab === "beranda") {
      container.innerHTML = `
        <div class="grid grid-cols-4 gap-6" style="margin-bottom: 2rem;">
          <div class="card card-gradient">
            <span class="badge badge-primary">Hari Ini</span>
            <h3 style="font-size: 2.2rem; color: var(--primary); margin: 0.5rem 0;">48</h3>
            <p style="font-size: 0.85rem;">Total Pasien Kunjungan</p>
          </div>
          <div class="card card-gradient">
            <span class="badge badge-success">Pendapatan</span>
            <h3 style="font-size: 2.2rem; color: var(--success); margin: 0.5rem 0;">Rp 12.8M</h3>
            <p style="font-size: 0.85rem;">Pendapatan Bulan Ini</p>
          </div>
          <div class="card card-gradient">
            <span class="badge badge-warning">Antrean Aktif</span>
            <h3 style="font-size: 2.2rem; color: var(--warning); margin: 0.5rem 0;">4</h3>
            <p style="font-size: 0.85rem;">Pasien Sedang Antre</p>
          </div>
          <div class="card card-gradient">
            <span class="badge badge-info">SATUSEHAT</span>
            <h3 style="font-size: 2.2rem; color: var(--info); margin: 0.5rem 0;">100%</h3>
            <p style="font-size: 0.85rem;">Status Sinkronisasi Log</p>
          </div>
        </div>

        <div class="grid grid-cols-2 gap-6" style="margin-bottom: 2rem;">
          <div class="card card-gradient">
            <h4>Grafik Kunjungan & Pendapatan Bulanan (2026)</h4>
            <canvas id="adminRevenueChart" style="max-height: 230px; width: 100%; margin-top: 1rem;"></canvas>
          </div>

          <div class="card card-gradient">
            <h4>Heatmap Jam Sibuk Klinik</h4>
            <p style="font-size: 0.85rem; margin-bottom: 1rem;">Analisis kepadatan pengunjung berdasarkan jam operasional</p>
            <div class="grid grid-cols-4 gap-2" style="text-align: center;">
              <div style="background: #D1FAE5; padding: 0.75rem; border-radius: var(--radius-sm);">07.00 - 09.00<br/><strong>Rendah</strong></div>
              <div style="background: #FCA5A5; padding: 0.75rem; border-radius: var(--radius-sm); color: #7F1D1D;">09.00 - 12.00<br/><strong>Puncak 🔥</strong></div>
              <div style="background: #FEF3C7; padding: 0.75rem; border-radius: var(--radius-sm);">13.00 - 16.00<br/><strong>Sedang</strong></div>
              <div style="background: #FCA5A5; padding: 0.75rem; border-radius: var(--radius-sm); color: #7F1D1D;">16.00 - 19.00<br/><strong>Tinggi 🔥</strong></div>
            </div>
          </div>
        </div>
      `;

      setTimeout(renderAdminCharts, 100);

    } else if (tab === "master_data") {
      container.innerHTML = `
        <div class="flex items-center justify-between" style="margin-bottom: 1.5rem;">
          <div>
            <h3>Master Data Klinik</h3>
            <p>Kelola data dokter, poliklinik, obat, dan struktur tarif</p>
          </div>
          <button class="btn btn-primary btn-sm" onclick="showToast('Form Tambah Master Data Baru Diaktifkan')">
            + Tambah Entry Baru
          </button>
        </div>

        <div class="flex gap-2" style="margin-bottom: 1rem; background: var(--bg-subtle); padding: 0.35rem; border-radius: var(--radius-md);">
          <button class="btn btn-sm ${AppState.adminMasterTab === 'dokter' ? 'active-tab-btn' : ''}" onclick="setAdminMasterTab('dokter')">Master Dokter</button>
          <button class="btn btn-sm ${AppState.adminMasterTab === 'poli' ? 'active-tab-btn' : ''}" onclick="setAdminMasterTab('poli')">Master Poliklinik</button>
          <button class="btn btn-sm ${AppState.adminMasterTab === 'icd' ? 'active-tab-btn' : ''}" onclick="setAdminMasterTab('icd')">Master ICD-10</button>
        </div>

        <div id="master-tab-content"></div>
      `;
      renderMasterSubtabContent();

    } else if (tab === "pasien_db") {
      container.innerHTML = `
        <div class="flex items-center justify-between" style="margin-bottom: 1.5rem;">
          <div>
            <h3>Master Database Pasien</h3>
            <p>Master Patient Index (MPI) KLINIK PRATAMA PUSDIKZI</p>
          </div>
          <button class="btn btn-outline btn-sm" onclick="showToast('Data Pasien Berhasil Di-export ke Format Excel / CSV')">
            <i data-lucide="file-spreadsheet"></i> Export Excel
          </button>
        </div>

        <div class="table-responsive card">
          <table class="custom-table">
            <thead>
              <tr>
                <th>No. RM</th>
                <th>Nama Pasien</th>
                <th>NIK</th>
                <th>Gender</th>
                <th>Alergi</th>
                <th>Streak</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              ${data.pasienList.map(p => `
                <tr>
                  <td><strong>${p.id}</strong></td>
                  <td>${p.nama}</td>
                  <td>${p.nik}</td>
                  <td>${p.gender}</td>
                  <td><span class="badge badge-danger">${p.alergi}</span></td>
                  <td>🔥 ${p.streakObat} Hari</td>
                  <td>
                    <button class="btn btn-outline btn-sm" onclick="showToast('Membuka detail profil pasien ${p.nama}')">Detail</button>
                  </td>
                </tr>
              `).join('')}
            </tbody>
          </table>
        </div>
      `;
    } else if (tab === "stok_obat" || tab === "resep_digital") {
      renderApotekerDashboard(container, tab);
    } else if (tab === "rbac") {
      container.innerHTML = `
        <h3>Manajemen Hak Akses (RBAC Visual Matrix)</h3>
        <p style="margin-bottom: 1.5rem;">Matriks konfigurasi izin modul untuk setiap role di KLINIK PRATAMA PUSDIKZI</p>
        <div class="table-responsive card">
          <table class="custom-table">
            <thead>
              <tr>
                <th>Fitur / Modul</th>
                <th>Pasien</th>
                <th>Dokter</th>
                <th>Kasir</th>
                <th>Admin</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Booking Kunjungan Online</td>
                <td><input type="checkbox" checked /></td>
                <td><input type="checkbox" checked /></td>
                <td><input type="checkbox" /></td>
                <td><input type="checkbox" checked /></td>
              </tr>
              <tr>
                <td>Input EMR & SOAP Diagnosa</td>
                <td><input type="checkbox" /></td>
                <td><input type="checkbox" checked /></td>
                <td><input type="checkbox" /></td>
                <td><input type="checkbox" checked /></td>
              </tr>
              <tr>
                <td>Proses Transaksi Kasir</td>
                <td><input type="checkbox" /></td>
                <td><input type="checkbox" /></td>
                <td><input type="checkbox" checked /></td>
                <td><input type="checkbox" checked /></td>
              </tr>
              <tr>
                <td>Master Data & User Access</td>
                <td><input type="checkbox" /></td>
                <td><input type="checkbox" /></td>
                <td><input type="checkbox" /></td>
                <td><input type="checkbox" checked /></td>
              </tr>
            </tbody>
          </table>
        </div>
      `;
    } else if (tab === "integrasi") {
      container.innerHTML = `
        <h3>Status Integrasi SATUSEHAT & BPJS</h3>
        <p style="margin-bottom: 2rem;">Konektivitas real-time portal Kemenkes dan BPJS Health Bridge</p>
        <div class="grid grid-cols-2 gap-6">
          <div class="card card-gradient">
            <div class="flex items-center justify-between" style="margin-bottom: 1rem;">
              <h4>Portal SATUSEHAT Kemenkes</h4>
              <span class="badge badge-success">🟢 Connected (${data.integrasi.satuSehatLatency})</span>
            </div>
            <p>Sertifikat IHIS: <strong>ACTIVE</strong></p>
            <p>Terakhir Sinkronisasi: ${data.integrasi.satuSehatLastSync}</p>
          </div>
          <div class="card card-gradient">
            <div class="flex items-center justify-between" style="margin-bottom: 1rem;">
              <h4>BPJS vClaim Bridge</h4>
              <span class="badge badge-success">🟢 Connected</span>
            </div>
            <p>Versi API: ${data.integrasi.bpjsBridgeVersion}</p>
            <p>Status SEP Direct: <strong>ONLINE</strong></p>
          </div>
        </div>
      `;
    } else {
      container.innerHTML = `<div class="card"><h3>Menu Admin: ${tab}</h3><p>Modul admin ${tab} aktif.</p></div>`;
    }
  }

  window.setAdminMasterTab = function(subtab) {
    AppState.adminMasterTab = subtab;
    renderMasterSubtabContent();
  };

  function renderMasterSubtabContent() {
    const box = document.getElementById("master-tab-content");
    if (!box) return;

    if (AppState.adminMasterTab === "dokter") {
      box.innerHTML = `
        <div class="table-responsive card">
          <table class="custom-table">
            <thead>
              <tr>
                <th>ID Dokter</th>
                <th>Nama Dokter</th>
                <th>Spesialis</th>
                <th>No. STR</th>
                <th>Alumni</th>
                <th>Rating</th>
              </tr>
            </thead>
            <tbody>
              ${window.KlinikData.dokterList.map(d => `
                <tr>
                  <td><strong>${d.id}</strong></td>
                  <td>${d.nama}</td>
                  <td>${d.spesialis}</td>
                  <td>${d.str}</td>
                  <td>${d.alumni}</td>
                  <td>⭐ ${d.rating}</td>
                </tr>
              `).join('')}
            </tbody>
          </table>
        </div>
      `;
    } else if (AppState.adminMasterTab === "poli") {
      box.innerHTML = `
        <div class="table-responsive card">
          <table class="custom-table">
            <thead>
              <tr>
                <th>ID Poli</th>
                <th>Nama Poliklinik</th>
                <th>Deskripsi</th>
              </tr>
            </thead>
            <tbody>
              ${window.KlinikData.poliList.map(p => `
                <tr>
                  <td><strong>${p.id}</strong></td>
                  <td>${p.nama}</td>
                  <td>${p.deskripsi}</td>
                </tr>
              `).join('')}
            </tbody>
          </table>
        </div>
      `;
    } else {
      box.innerHTML = `
        <div class="table-responsive card">
          <table class="custom-table">
            <thead>
              <tr>
                <th>Kode ICD-10</th>
                <th>Nama Diagnosa (Inggris/Indonesia)</th>
                <th>Kategori</th>
              </tr>
            </thead>
            <tbody>
              ${window.KlinikData.icd10Database.map(i => `
                <tr>
                  <td><strong>${i.code}</strong></td>
                  <td>${i.name}</td>
                  <td><span class="badge badge-primary">${i.category}</span></td>
                </tr>
              `).join('')}
            </tbody>
          </table>
        </div>
      `;
    }
  }

  window.autoGeneratePO = function() {
    showToast("Auto Purchase Order Berhasil Diterbitkan untuk Amoxicillin 500mg (Stok Kritis) ke Supplier PT Bio Medika.");
  };

  function renderAdminCharts() {
    const ctx = document.getElementById("adminRevenueChart");
    if (!ctx) return;

    if (AppState.charts.adminRev) AppState.charts.adminRev.destroy();

    AppState.charts.adminRev = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
        datasets: [
          {
            label: 'Kunjungan Pasien',
            data: [420, 480, 510, 590, 640, 710, 780],
            backgroundColor: '#2E5339',
            borderRadius: 6
          },
          {
            label: 'Pendapatan (Juta Rp)',
            data: [65, 72, 80, 95, 105, 118, 128],
            backgroundColor: '#E8A33D',
            borderRadius: 6
          }
        ]
      },
      options: {
        responsive: true,
        plugins: { legend: { position: 'top' } }
      }
    });
  }

  // --------------------------------------------------------------------------
  // ROLE 5: APOTEKER (FARMASI)
  // --------------------------------------------------------------------------
  function renderApotekerDashboard(container, tab) {
    if (tab === "beranda") {
      const lowStockCount = window.KlinikData.obatList.filter(o => o.stok <= o.minStok).length;
      const resepCount = window.KlinikData.resepAktif.length;
      container.innerHTML = `
        <div class="flex items-center justify-between" style="margin-bottom: 2rem;">
          <div>
            <h2>Beranda Apotek & Farmasi</h2>
            <p>Ringkasan stok obat dan resep digital hari ini</p>
          </div>
          <span class="badge badge-primary">${new Date().toLocaleDateString('id-ID', {weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'})}</span>
        </div>
        <div class="grid grid-cols-3 gap-6">
          <div class="card card-gradient">
            <h3 style="margin-bottom: 0.5rem;"><i data-lucide="alert-triangle" style="color: var(--danger);"></i> Stok Kritis</h3>
            <p style="font-size: 2.5rem; font-weight: 800; color: var(--danger);">${lowStockCount}</p>
            <p style="font-size: 0.85rem; margin-top: 0.5rem;">Item obat perlu segera di-restock</p>
            <button class="btn btn-outline btn-sm" style="width: 100%; margin-top: 1rem;" onclick="switchDashboardTab('stok_obat')">Cek Stok</button>
          </div>
          <div class="card card-gradient">
            <h3 style="margin-bottom: 0.5rem;"><i data-lucide="file-text" style="color: var(--accent);"></i> Resep Menunggu</h3>
            <p style="font-size: 2.5rem; font-weight: 800; color: var(--accent);">${resepCount}</p>
            <p style="font-size: 0.85rem; margin-top: 0.5rem;">Antrean E-Resep siap diracik</p>
            <button class="btn btn-primary btn-sm" style="width: 100%; margin-top: 1rem;" onclick="switchDashboardTab('resep_digital')">Racik Resep</button>
          </div>
          <div class="card card-gradient">
            <h3 style="margin-bottom: 0.5rem;"><i data-lucide="package" style="color: var(--primary);"></i> Total Item Obat</h3>
            <p style="font-size: 2.5rem; font-weight: 800; color: var(--primary);">${window.KlinikData.obatList.length}</p>
            <p style="font-size: 0.85rem; margin-top: 0.5rem;">Tersedia di inventori apotek</p>
          </div>
        </div>
      `;
    } else if (tab === "stok_obat") {
      container.innerHTML = `
        <div class="flex items-center justify-between" style="margin-bottom: 2rem;">
          <div>
            <h2>Manajemen Stok Obat</h2>
            <p>Pantau inventori farmasi dan lakukan pemesanan (PO)</p>
          </div>
          <button class="btn btn-primary btn-sm" onclick="document.getElementById('add-obat-modal-overlay').classList.add('open'); if(window.lucide) window.lucide.createIcons();"><i data-lucide="plus"></i> Tambah Obat Baru</button>
        </div>
        <div class="table-responsive card">
          <table class="custom-table">
            <thead>
              <tr>
                <th>Kode</th>
                <th>Nama Obat</th>
                <th>Kategori / Bentuk</th>
                <th>Sisa Stok</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              ${window.KlinikData.obatList.map(o => {
                const isKritis = o.stok <= o.minStok;
                return `
                <tr style="${isKritis ? 'background-color: rgba(239, 68, 68, 0.05);' : ''}">
                  <td><strong>${o.id}</strong></td>
                  <td>${o.nama}</td>
                  <td><span class="badge badge-info">${o.kategori}</span></td>
                  <td><strong style="color: ${isKritis ? 'var(--danger)' : 'inherit'};">${o.stok} ${o.satuan}</strong></td>
                  <td>${isKritis ? '<span class="badge badge-danger">Kritis</span>' : '<span class="badge badge-success">Aman</span>'}</td>
                  <td>
                    ${isKritis ? '<button class="btn btn-sm btn-outline" style="color: var(--danger); border-color: var(--danger);" onclick="showToast(\'Request PO diterbitkan ke Gudang Pusat\')">Request PO</button>' : '<button class="btn btn-sm btn-outline">Detail</button>'}
                  </td>
                </tr>
                `;
              }).join('')}
            </tbody>
          </table>
        </div>
      `;
    } else if (tab === "resep_digital") {
      if (window.KlinikData.resepAktif.length === 0) {
        container.innerHTML = `
          <div class="card text-center" style="padding: 4rem 2rem;">
            <i data-lucide="check-circle" style="width: 48px; height: 48px; color: var(--success); margin: 0 auto 1rem;"></i>
            <h2>Semua Resep Selesai</h2>
            <p style="color: var(--text-light); margin-top: 0.5rem;">Tidak ada antrean resep yang menunggu saat ini.</p>
          </div>
        `;
        return;
      }
      
      container.innerHTML = `
        <div style="margin-bottom: 2rem;">
          <h2>Antrean Resep Digital (E-Resep)</h2>
          <p>Daftar resep dari dokter yang harus diracik hari ini</p>
        </div>
        <div class="grid grid-cols-2 gap-6">
          ${window.KlinikData.resepAktif.map(r => `
            <div class="card card-gradient" id="card-resep-${r.id}">
              <div class="flex items-center justify-between" style="border-bottom: 1px solid var(--border-color); padding-bottom: 1rem; margin-bottom: 1rem;">
                <div>
                  <h4 style="margin-bottom: 0.2rem;">${r.namaPasien}</h4>
                  <p style="font-size: 0.85rem; color: var(--text-light);">No. Resep: <strong>${r.id}</strong></p>
                </div>
                <span class="badge badge-warning">Menunggu</span>
              </div>
              <p style="font-size: 0.85rem; margin-bottom: 1rem;"><i data-lucide="stethoscope" style="width: 14px; inline-block;"></i> Pengirim: ${r.dokter}</p>
              
              <ul style="list-style: none; padding-left: 0; margin-bottom: 1.5rem; display: flex; flex-direction: column; gap: 0.5rem;">
                ${r.items.map(item => `
                  <li style="background: var(--bg-card); padding: 0.75rem; border-radius: var(--radius-sm); border: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
                    <div>
                      <strong>${item.namaObat}</strong>
                      <p style="font-size: 0.8rem; color: var(--text-light); margin-top: 0.2rem;">Dosis: ${item.dosis}</p>
                    </div>
                    <span class="badge badge-primary">${item.jumlah} Pcs</span>
                  </li>
                `).join('')}
              </ul>
              
              <button class="btn btn-primary" style="width: 100%;" onclick="fulfillResep('${r.id}')">
                <i data-lucide="check"></i> Tandai Selesai Diracik & Serahkan
              </button>
            </div>
          `).join('')}
        </div>
      `;
    } else {
      container.innerHTML = `<div class="card"><h3>Modul Apotek: ${tab}</h3><p>Modul dalam tahap pengembangan.</p></div>`;
    }
  }

  window.fulfillResep = function(resepId) {
    const idx = window.KlinikData.resepAktif.findIndex(r => r.id === resepId);
    if (idx !== -1) {
      window.KlinikData.resepAktif.splice(idx, 1);
      const card = document.getElementById('card-resep-' + resepId);
      if (card) {
        card.style.opacity = '0';
        card.style.transform = 'scale(0.95)';
        setTimeout(() => {
          showToast("Resep " + resepId + " berhasil diserahkan ke pasien!", "success");
          switchDashboardTab("resep_digital");
        }, 300);
      }
    }
  };

  window.handleAddMedicine = function(e) {
    e.preventDefault();
    const id = document.getElementById("obat-id").value;
    const nama = document.getElementById("obat-nama").value;
    const kategori = document.getElementById("obat-kategori").value;
    const stok = parseInt(document.getElementById("obat-stok").value);
    
    window.KlinikData.obatList.push({
      id: id,
      nama: nama,
      kategori: kategori,
      stok: stok,
      satuan: "Strip",
      minStok: 5,
      harga: 15000
    });
    
    document.getElementById("add-obat-modal-overlay").classList.remove("open");
    showToast("Obat " + nama + " berhasil ditambahkan ke inventori!", "success");
    e.target.reset();
    switchDashboardTab("stok_obat");
  };

  window.openBookingModal = function(poliId = "", docId = "") {
    switchRole("pasien");
    switchDashboardTab("booking");
  };

  window.handleQuickQueue = function(e) {
    e.preventDefault();
    const namaInput = document.getElementById("quick-nama").value.trim().toLowerCase();
    const poliName = document.getElementById("quick-poli").selectedOptions[0].text;
    
    // Check if patient exists in data
    const patientExists = window.KlinikData.pasienList.some(p => 
      p.nama.toLowerCase() === namaInput || p.nik === namaInput
    );

    if (patientExists) {
      showToast(`Berhasil! Nomor antrean Anda: A-012 untuk ${poliName}. Mengalihkan ke dashboard pasien...`, "success");
      setTimeout(() => {
        switchRole("pasien");
      }, 1500);
    } else {
      // Show register modal
      document.getElementById("reg-nama").value = document.getElementById("quick-nama").value;
      document.getElementById("register-queue-modal-overlay").classList.add("open");
      if(window.lucide) window.lucide.createIcons();
    }
    
    e.target.reset();
  };

  window.handleRegisterQueue = function(e) {
    e.preventDefault();
    showToast(`Pendaftaran berhasil! Akun dibuat dan Antrean diambil. Mengalihkan ke dashboard...`, "success");
    document.getElementById("register-queue-modal-overlay").classList.remove("open");
    setTimeout(() => {
      switchRole("pasien");
    }, 1500);
  };
});
