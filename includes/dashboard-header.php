<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $title ?? 'KLINIK PRATAMA PUSDIKZI'; ?></title>
  <meta name="description" content="Sistem Informasi KLINIK PRATAMA PUSDIKZI" />
  
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        container: {
          center: true,
          padding: '2rem',
        },
        extend: {
          colors: {
            zeni: {
              primary: '#2E5339',
              'primary-dark': '#1E3926',
              accent: '#D97706',
              success: '#10B981',
              warning: '#F59E0B',
              danger: '#EF4444'
            }
          }
        }
      }
    }
  </script>

  <link rel="stylesheet" href="css/style.css?v=2026.35" />
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="in-dashboard">

  <!-- Header Navigation (HexaBox Topbar) -->
  <header class="header-nav">
    <div class="header-nav-inner flex items-center justify-between w-full">
      <div class="flex items-center gap-2">
        <!-- Mobile Drawer Toggle -->
        <button class="btn btn-outline btn-icon mobile-menu-btn" onclick="toggleMobileSidebar()" title="Buka Menu">
          <i data-lucide="menu"></i>
        </button>

        <!-- Desktop Mini-Sidebar Collapse Toggle (HexaBox style) -->
        <button class="btn btn-outline btn-icon desktop-sidebar-toggle hidden lg:inline-flex" onclick="toggleSidebarCollapse()" title="Perkecil/Perbesar Menu">
          <i data-lucide="panel-left-close"></i>
        </button>

        <!-- Mobile Brand (Visible only when sidebar is off-canvas on mobile) -->
        <a href="index.php" class="mobile-nav-brand lg:hidden flex items-center gap-2" style="text-decoration: none;">
          <div style="width: 34px; height: 34px; border-radius: 8px; background: var(--primary); color: #FFF; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 6px rgba(30,57,38,0.25);">
            <i data-lucide="cross" style="width: 18px; height: 18px;"></i>
          </div>
          <span style="font-size: 1rem; font-weight: 900; color: var(--primary); letter-spacing: -0.01em;">KLINIK PUSDIKZI</span>
        </a>

        <!-- HexaBox Search Bar Input / Trigger -->
        <div class="hidden sm:flex items-center gap-2 search-input-wrapper" onclick="toggleCommandPalette()" style="cursor: pointer;" title="Cari cepat (Ctrl+K)">
          <i data-lucide="search" style="width: 16px; color: var(--text-muted);"></i>
          <span style="font-size: 0.88rem; color: var(--text-muted); font-weight: 500;">Cari pasien, RM, obat...</span>
          <kbd style="font-size: 0.72rem; padding: 2px 6px; background: var(--bg-subtle); border: 1px solid var(--border-color); border-radius: 4px; color: var(--text-muted); margin-left: 6px; font-weight: 700;">Ctrl+K</kbd>
        </div>
      </div>

      <div class="header-actions flex items-center gap-2">
        <!-- SATUSEHAT status indicator pill (HexaBox Badges) -->
        <div class="satusehat-pill hidden md:flex items-center gap-2" style="padding: 0.4rem 0.85rem; border-radius: var(--radius-full); background: var(--primary-bg); border: 1px solid var(--accent-light); font-size: 0.82rem; font-weight: 700; color: var(--primary);">
          <span style="width: 8px; height: 8px; border-radius: 50%; background: #16A34A; display: inline-block; box-shadow: 0 0 6px rgba(22,163,74,0.6);"></span>
          <span>SATUSEHAT Aktif</span>
        </div>

        <!-- Display Antrean TV Shortcut -->
        <a href="antrian-tv.php" target="_blank" class="btn btn-outline btn-sm hidden lg:flex items-center gap-1.5" title="Buka Display Antrean TV">
          <i data-lucide="tv" style="width: 16px;"></i>
          <span>Antrean TV</span>
        </a>

        <!-- Landing Page Shortcut -->
        <a href="index.php" class="btn btn-outline btn-sm header-home-btn flex items-center gap-1.5" title="Kembali ke Landing Page">
          <i data-lucide="home" style="width: 16px;"></i>
          <span class="home-btn-text hidden sm:inline">Landing</span>
        </a>

        <!-- Logout Button -->
        <a href="login.php" class="btn btn-danger btn-sm header-logout-btn flex items-center gap-1.5" title="Keluar">
          <i data-lucide="log-out" style="width: 16px;"></i>
          <span class="logout-btn-text hidden sm:inline">Keluar</span>
        </a>
      </div>
    </div>
  </header>

  <!-- Mobile Sidebar Backdrop Overlay -->
  <div class="sidebar-backdrop" id="sidebar-backdrop" onclick="toggleMobileSidebar(false)"></div>
