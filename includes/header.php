<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $title ?? 'KLINIK PRATAMA PUSDIKZI - Sistem Informasi Klinik Modern 2026'; ?></title>
  <meta name="description" content="Sistem Informasi KLINIK PRATAMA PUSDIKZI: Layanan kesehatan terpadu, Health Passport, EMR digital, antrean real-time, dan integrasi SATUSEHAT Kemenkes." />
  
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

  <!-- CSS Stylesheets (Modular Architecture) -->
  <link rel="stylesheet" href="css/style.css?v=2026.30" />
  
  <!-- Third-party Libraries -->
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>

  <!-- Sticky Global Navigation Header -->
  <header class="header-nav" id="main-header-nav">
    <div class="container flex items-center justify-between">
      <div class="flex items-center gap-2">
        <!-- Brand Logo -->
        <a href="index.php" class="nav-brand" style="text-decoration: none; display: flex; align-items: center; gap: 0.75rem;">
          <div class="brand-icon-box" style="width: 40px; height: 40px; border-radius: 10px; background: var(--primary); color: #FFF; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 8px rgba(30,57,38,0.25);">
            <i data-lucide="cross" style="width: 22px; height: 22px;"></i>
          </div>
          <div style="display: flex; flex-direction: column;">
            <span class="brand-text" style="font-size: 1.15rem; font-weight: 900; line-height: 1.1; color: var(--primary); letter-spacing: -0.01em;">KLINIK PRATAMA PUSDIKZI</span>
            <small style="font-size: 0.72rem; font-weight: 800; color: var(--text-muted); letter-spacing: 0.08em;">KORPS ZENI TNI ANGKATAN DARAT</small>
          </div>
        </a>
      </div>

      <!-- Header Search & Actions -->
      <div class="header-actions">
        <!-- Global Command Palette Shortcut -->
        <button class="btn btn-outline btn-sm flex items-center gap-2 header-search-btn" onclick="toggleCommandPalette()" title="Command Palette (Ctrl+K)">
          <i data-lucide="search" style="width: 16px;"></i>
          <span class="search-btn-label">Cari (Ctrl+K)</span>
        </button>

        <!-- TV Antrean Link -->
        <a href="antrian-tv.php" target="_blank" class="btn btn-outline btn-sm flex items-center gap-1">
          <i data-lucide="tv" style="width: 16px;"></i> Display TV
        </a>

        <!-- Login / Portal Entry Button -->
        <a href="login.php" class="btn btn-primary btn-sm flex items-center gap-2">
          <i data-lucide="log-in" style="width: 16px;"></i>
          <span>Portal Login</span>
        </a>
      </div>
    </div>
  </header>
