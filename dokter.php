<?php
/* ==========================================================================
   KLINIK PRATAMA PUSDIKZI - Ruang Dokter EMR SOAP (Ultra Slim & Sliced)
   ========================================================================== */

$title = "Ruang Dokter EMR SOAP & Surat Medis - KLINIK PRATAMA PUSDIKZI";
require_once __DIR__ . '/includes/dashboard-header.php';
require_once __DIR__ . '/includes/dashboard-layout-open.php';
require_once __DIR__ . '/includes/sidebars/dokter.php';
?>

<!-- Main Workspace Content -->
<section class="main-content" id="dashboard-main-content">
  <?php 
  require __DIR__ . '/includes/doctor/tab-antrean-periksa.php'; 
  require __DIR__ . '/includes/doctor/tab-ruang-periksa.php'; 
  require __DIR__ . '/includes/doctor/tab-surat-medis.php'; 
  ?>
</section>

<?php
// Layout Wrapper, Modals & Scripts
require_once __DIR__ . '/includes/dashboard-layout-close.php';
require_once __DIR__ . '/includes/chatbot.php';
require_once __DIR__ . '/includes/command-palette.php';
require_once __DIR__ . '/includes/footer.php';
?>
