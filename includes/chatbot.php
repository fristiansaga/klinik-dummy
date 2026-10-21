<!-- Floating Helpdesk Chatbot Widget -->
<div class="chatbot-widget">
  <div class="chatbot-trigger" id="chatbot-trigger" title="Pusat Bantuan & FAQ">
    <i data-lucide="help-circle" style="width: 28px; height: 28px;"></i>
  </div>

  <div class="chatbot-panel" id="chatbot-panel">
    <div class="chatbot-header">
      <div class="flex items-center gap-2">
        <div class="brand-icon-box" style="width: 32px; height: 32px;"><i data-lucide="life-buoy"></i></div>
        <div>
          <h4 style="color:#FFF; font-size:0.95rem; margin:0;">Pusat Bantuan & FAQ</h4>
          <span style="font-size:0.75rem; opacity:0.8;">Layanan Informasi 24 Jam</span>
        </div>
      </div>
      <button style="background:transparent; border:none; color:#FFF; cursor:pointer;" onclick="document.getElementById('chatbot-panel').classList.remove('open')">
        <i data-lucide="x"></i>
      </button>
    </div>

    <div class="chatbot-body" id="chatbot-body">
      <div class="chat-bubble chat-bubble-bot">
        Halo! Selamat datang di <strong>KLINIK PRATAMA PUSDIKZI</strong>. Ada yang bisa kami bantu seputar jadwal poli, antrean, atau BPJS?
      </div>
      <div class="chatbot-quick-chips">
        <button class="chip-btn" data-key="jadwal">🕒 Jam Buka</button>
        <button class="chip-btn" data-key="bpjs">💳 Terima BPJS?</button>
        <button class="chip-btn" data-key="booking">📅 Cara Booking</button>
        <button class="chip-btn" data-key="lokasi">📍 Lokasi PUSDIKZI</button>
      </div>
    </div>

    <div class="chatbot-footer">
      <input type="text" class="chatbot-input" id="chatbot-input" placeholder="Tulis pertanyaan Anda di sini..." />
      <button class="btn btn-primary btn-sm" onclick="handleChatbotQuery('custom', document.getElementById('chatbot-input').value)">
        <i data-lucide="send" style="width: 16px;"></i>
      </button>
    </div>
  </div>
</div>
