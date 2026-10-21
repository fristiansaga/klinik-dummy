<?php
/* ==========================================================================
   KLINIK PRATAMA PUSDIKZI - Login Portal (Ultra Slim & Sliced)
   ========================================================================== */

$title = "Portal Login Multi-Role - KLINIK PRATAMA PUSDIKZI";
require_once __DIR__ . '/includes/header.php';
?>

<main class="container flex items-center justify-center" style="flex: 1; padding: 2.5rem 1rem;">
  <?php require __DIR__ . '/includes/auth/form-login.php'; ?>
</main>

<?php
require_once __DIR__ . '/includes/chatbot.php';
require_once __DIR__ . '/includes/command-palette.php';
require_once __DIR__ . '/includes/footer.php';
?>
