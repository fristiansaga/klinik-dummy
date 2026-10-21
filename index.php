<?php
/* ==========================================================================
   KLINIK PRATAMA PUSDIKZI - Main Landing Page (Clean Sliced PHP Architecture)
   ========================================================================== */

$title = "KLINIK PRATAMA PUSDIKZI - Layanan Kesehatan Terpadu Zeni TNI-AD";

// 1. Header & Navigation Partial
require_once __DIR__ . '/includes/header.php';
?>

<!-- Main Application Content Container -->
<main class="container main-app-container" style="padding-top: 1.5rem; padding-bottom: 3rem;">
  <?php 
  // 2. Hero Banner Partial
  require_once __DIR__ . '/includes/hero.php'; 

  // 3. Quick Queue Generator Partial
  require_once __DIR__ . '/includes/quick-queue.php'; 

  // 4. Clinical Operational Modules Grid Partial
  require_once __DIR__ . '/includes/modules.php'; 

  // 5. Doctor Roster & Shift Schedule Partial
  require_once __DIR__ . '/includes/roster.php'; 
  ?>
</main>

<?php
// 6. Floating FAQ Chatbot Widget Partial
require_once __DIR__ . '/includes/chatbot.php';

// 7. Global Command Palette Modal Partial
require_once __DIR__ . '/includes/command-palette.php';

// 8. Main Footer & Scripts Partial
require_once __DIR__ . '/includes/footer.php';
?>
