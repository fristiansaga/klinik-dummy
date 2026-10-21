<?php
/* ==========================================================================
   KLINIK PRATAMA PUSDIKZI - Admin Command Center (Ultra Slim & Sliced)
   ========================================================================== */

$title = "Admin Command Center - KLINIK PRATAMA PUSDIKZI";
require_once __DIR__ . '/includes/dashboard-header.php';
require_once __DIR__ . '/includes/dashboard-layout-open.php';
require_once __DIR__ . '/includes/sidebars/admin.php';
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Main Workspace Content -->
<section class="main-content" id="dashboard-main-content">
  <?php 
  require __DIR__ . '/includes/admin/tab-beranda.php'; 
  require __DIR__ . '/includes/admin/tab-rbac.php'; 
  require __DIR__ . '/includes/admin/tab-master-data.php'; 
  require __DIR__ . '/includes/admin/tab-integrasi.php'; 
  ?>
</section>

<?php
// Layout Wrapper, Modals & Scripts
require_once __DIR__ . '/includes/dashboard-layout-close.php';
require_once __DIR__ . '/includes/chatbot.php';
require_once __DIR__ . '/includes/command-palette.php';
require_once __DIR__ . '/includes/footer.php';
?>
