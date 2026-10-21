<!-- Tab 4: Integrasi SATUSEHAT -->
<div id="tab-integrasi" class="tab-pane" style="display: none;">
  <div class="flex justify-between items-center" style="margin-bottom: 1.5rem;">
    <div>
      <h2 style="font-size: 1.75rem; color: var(--primary);">Integrasi SATUSEHAT & Catatan Log Sistem</h2>
      <p style="color: var(--text-light);">Monitoring interoperabilitas HL7 FHIR API Kemenkes dan log enkripsi data RME.</p>
    </div>
  </div>

  <div class="card" style="padding: 1.5rem;">
    <?php require __DIR__ . '/tabel-audit-satusehat.php'; ?>
  </div>
</div>
