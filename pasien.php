<?php
/* ==========================================================================
   KLINIK PRATAMA PUSDIKZI - Portal Pasien & Health Passport (Ultra Slim & Sliced)
   ========================================================================== */

$title = "Portal Pasien - KLINIK PRATAMA PUSDIKZI";
require_once __DIR__ . '/includes/dashboard-header.php';
require_once __DIR__ . '/includes/dashboard-layout-open.php';
require_once __DIR__ . '/includes/sidebars/pasien.php';
?>

<!-- Main Workspace Content -->
<section class="main-content" id="dashboard-main-content">
  <?php 
  require __DIR__ . '/includes/patient/tab-passport.php'; 
  require __DIR__ . '/includes/patient/tab-booking.php'; 
  require __DIR__ . '/includes/patient/tab-antrean.php'; 
  require __DIR__ . '/includes/patient/tab-resep.php'; 
  require __DIR__ . '/includes/patient/tab-riwayat.php'; 
  require __DIR__ . '/includes/patient/tab-rujukan.php'; 
  ?>
</section>

<?php
// Layout Wrapper, Modals & Scripts
require_once __DIR__ . '/includes/patient/modals-riwayat-rujukan.php';
require_once __DIR__ . '/includes/dashboard-layout-close.php';
require_once __DIR__ . '/includes/chatbot.php';
require_once __DIR__ . '/includes/command-palette.php';
require_once __DIR__ . '/includes/footer.php';
?>
