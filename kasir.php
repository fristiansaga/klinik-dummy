<?php
/* ==========================================================================
   KLINIK PRATAMA PUSDIKZI - Kasir & Smart Billing (Ultra Slim & Sliced)
   ========================================================================== */

$title = "Kasir & Smart Billing - KLINIK PRATAMA PUSDIKZI";
require_once __DIR__ . '/includes/dashboard-header.php';
require_once __DIR__ . '/includes/dashboard-layout-open.php';
require_once __DIR__ . '/includes/sidebars/kasir.php';
?>

<!-- Main Workspace Content -->
<section class="main-content" id="dashboard-main-content">
  <?php 
  require __DIR__ . '/includes/cashier/tab-beranda.php'; 
  require __DIR__ . '/includes/cashier/tab-antrean-bayar.php'; 
  require __DIR__ . '/includes/cashier/tab-rekap-kas.php'; 
  ?>
</section>

<?php
// Modals, Layout Wrapper & Scripts
require __DIR__ . '/includes/cashier/modal-struk-kuitansi.php';
require_once __DIR__ . '/includes/dashboard-layout-close.php';
require_once __DIR__ . '/includes/chatbot.php';
require_once __DIR__ . '/includes/command-palette.php';
require_once __DIR__ . '/includes/footer.php';
?>
