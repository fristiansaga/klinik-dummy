<?php
/* ==========================================================================
   KLINIK PRATAMA PUSDIKZI - Pendaftaran Pasien Baru Mandiri (Ultra Slim)
   ========================================================================== */

$title = "Pendaftaran Pasien Baru Mandiri - KLINIK PRATAMA PUSDIKZI";
require_once __DIR__ . '/includes/header.php';
?>

<main class="container flex items-center justify-center" style="flex: 1; padding: 2.5rem 1rem;">
  <?php require __DIR__ . '/includes/auth/form-daftar.php'; ?>
</main>

<?php
require_once __DIR__ . '/includes/chatbot.php';
require_once __DIR__ . '/includes/command-palette.php';
require_once __DIR__ . '/includes/footer.php';
?>
