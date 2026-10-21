<?php
/* ==========================================================================
   KLINIK PRATAMA PUSDIKZI - Apotek & Farmasi (Ultra Slim & Sliced)
   ========================================================================== */

$title = "Farmasi & Stock Opname FEFO - KLINIK PRATAMA PUSDIKZI";
require_once __DIR__ . '/includes/dashboard-header.php';
require_once __DIR__ . '/includes/dashboard-layout-open.php';
require_once __DIR__ . '/includes/sidebars/apotek.php';
?>

<!-- Main Workspace Content -->
<section class="main-content" id="dashboard-main-content">
  <?php 
  require __DIR__ . '/includes/pharmacy/tab-beranda.php'; 
  require __DIR__ . '/includes/pharmacy/tab-resep-masuk.php'; 
  require __DIR__ . '/includes/pharmacy/tab-stok-obat.php'; 
  require __DIR__ . '/includes/pharmacy/tab-stock-opname.php'; 
  require __DIR__ . '/includes/pharmacy/tab-tambah-obat.php'; 
  ?>
</section>

<?php
// Layout Wrapper, Modals & Scripts
require_once __DIR__ . '/includes/dashboard-layout-close.php';
require_once __DIR__ . '/includes/chatbot.php';
require_once __DIR__ . '/includes/command-palette.php';
require_once __DIR__ . '/includes/footer.php';
?>
