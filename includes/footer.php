  <!-- Institutional Military Clinic Footer -->
  <footer class="footer-institutional" style="background: #09150C; border-top: 2px solid #233D2B; color: #CBD5E1; padding: 3.5rem 0 2rem 0; margin-top: 4rem; width: 100%; box-sizing: border-box; overflow: hidden;">
    <div class="container" style="width: 100%; max-width: 100%; padding: 0 2.5rem; box-sizing: border-box;">
      <div style="display: grid; grid-template-columns: 1.4fr 1fr 1.3fr; gap: 2.5rem; margin-bottom: 2.5rem; box-sizing: border-box; width: 100%;">
        
        <!-- Col 1: Unit Brand & Address -->
        <div style="min-width: 0;">
          <div class="flex items-center gap-3" style="margin-bottom: 1.1rem;">
            <div style="width: 46px; height: 46px; border-radius: 10px; background: #1E3926; border: 1.5px solid #4D7C5B; display: flex; align-items: center; justify-content: center; color: #FDE047; box-shadow: 0 4px 10px rgba(0,0,0,0.3); flex-shrink: 0;">
              <i data-lucide="shield" style="width: 24px; height: 24px;"></i>
            </div>
            <div>
              <h4 style="color: #FFFFFF; font-size: 1.2rem; font-weight: 800; margin: 0; letter-spacing: -0.01em;">KLINIK PRATAMA PUSDIKZI</h4>
              <small style="color: #94A3B8; font-weight: 700; letter-spacing: 0.05em;">KORPS ZENI TNI ANGKATAN DARAT</small>
            </div>
          </div>
          <p style="font-size: 0.95rem; line-height: 1.65; color: #94A3B8; margin-bottom: 1.25rem;">
            Fasilitas Kesehatan Tingkat Pertama (FKTP) yang melayani Prajurit Siswa, Personel Organik Pusdikzi Kodiklatad, Persit Kartika Chandra Kirana, dan Masyarakat Umum Peserta BPJS Kesehatan.
          </p>
          <div class="flex items-start gap-2" style="font-size: 0.9rem; color: #E2E8F0; line-height: 1.5;">
            <i data-lucide="map-pin" style="width: 18px; color: #FDE047; flex-shrink: 0; margin-top: 2px;"></i>
            <span>Jl. Jenderal Sudirman No. 35, Pabaton, Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat 16121</span>
          </div>
        </div>
        
        <!-- Col 2: Polyclinic Services -->
        <div style="min-width: 0;">
          <h5 style="color: #FFFFFF; font-size: 1.05rem; font-weight: 800; margin-bottom: 1rem; border-bottom: 2px solid #2E5339; padding-bottom: 0.4rem;">Poliklinik & Layanan</h5>
          <ul style="list-style: none; padding: 0; margin: 0; font-size: 0.92rem; line-height: 2; color: #94A3B8;">
            <li>&bull; Poli Umum & Rikkes Militer</li>
            <li>&bull; Poli Gigi & Mulut</li>
            <li>&bull; Poli KIA / KB & Imunisasi</li>
            <li>&bull; Unit Gawat Darurat (UGD 24 Jam)</li>
            <li>&bull; Instalasi Farmasi & Gudang Bekkes</li>
            <li>&bull; Laboratorium Diagnostik Sederhana</li>
          </ul>
        </div>
        
        <!-- Col 3: Accreditation & Referral -->
        <div style="min-width: 0;">
          <h5 style="color: #FFFFFF; font-size: 1.05rem; font-weight: 800; margin-bottom: 1rem; border-bottom: 2px solid #2E5339; padding-bottom: 0.4rem;">Akreditasi & Integrasi</h5>
          <div style="display: flex; flex-direction: column; gap: 0.75rem; font-size: 0.9rem;">
            <div style="background: rgba(255,255,255,0.04); padding: 0.75rem 1rem; border-radius: 8px; border: 1px solid rgba(255,255,255,0.08); box-sizing: border-box;">
              <strong style="color: #FFFFFF; display: block;">Kode Faskes BPJS: 0115B001</strong>
              <small style="color: #94A3B8;">Terdaftar di BPJS Kesehatan KC Kota Bogor</small>
            </div>
            <div style="background: rgba(255,255,255,0.04); padding: 0.75rem 1rem; border-radius: 8px; border: 1px solid rgba(255,255,255,0.08); box-sizing: border-box;">
              <strong style="color: #FFFFFF; display: block;">Faskes Rujukan Utama:</strong>
              <small style="color: #94A3B8; display: block; line-height: 1.4;">Rumah Sakit Tk. IV 03.04.02 Salak Bogor (RST Salak)</small>
            </div>
            <div style="background: rgba(255,255,255,0.04); padding: 0.75rem 1rem; border-radius: 8px; border: 1px solid rgba(255,255,255,0.08); box-sizing: border-box;">
              <strong style="color: #FFFFFF; display: block;">SATUSEHAT Kemenkes RI:</strong>
              <small style="color: #86EFAC;">Terverifikasi & Terintegrasi Interoperabilitas</small>
            </div>
          </div>
        </div>

      </div>
      
      <div style="border-top: 1px solid #1E3926; padding-top: 1.5rem; text-align: center; font-size: 0.88rem; color: #64748B; width: 100%; box-sizing: border-box;">
        &copy; 2026 KLINIK PRATAMA PUSDIKZI &bull; PUSAT PENDIDIKAN ZENI KODIKLAT TNI-AD &bull; HAK CIPTA DILINDUNGI
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="js/data.js?v=2026.35"></script>
  <script src="js/shared.js?v=2026.35"></script>
  <script>
    function handleQuickQueueSubmit(e) {
      e.preventDefault();
      const nama = document.getElementById('quick-nama').value;
      const poli = document.getElementById('quick-poli').value;
      showToast(`Nomor antrean berhasil dibuat: A-004 (${poli} - ${nama})`, "success");
      setTimeout(() => {
        alert(`Nomor Antrean: A-004\nNama: ${nama}\nTujuan: ${poli}\n\nSilakan menuju ke ruang tunggu poliklinik. Posisi antrean dapat dipantau pada layar monitor TV.`);
      }, 500);
    }
  </script>
</body>
</html>
