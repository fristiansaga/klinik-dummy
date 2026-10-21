import React from 'react';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import { ClinicProvider } from './context/ClinicContext';
import Header from './components/Header';
import Footer from './components/Footer';
import ChatbotWidget from './components/ChatbotWidget';
import CommandPalette from './components/CommandPalette';
import WhatsAppModal from './components/WhatsAppModal';

import LandingPage from './pages/LandingPage';
import PasienPortal from './pages/PasienPortal';
import DokterWorkspace from './pages/DokterWorkspace';
import ApotekFarmasi from './pages/ApotekFarmasi';
import KasirBilling from './pages/KasirBilling';
import AdminCenter from './pages/AdminCenter';
import AntrianTV from './pages/AntrianTV';
import AuthDaftar from './pages/AuthDaftar';
import AuthLogin from './pages/AuthLogin';

export default function App() {
  return (
    <ClinicProvider>
      <BrowserRouter>
        <div className="min-h-screen flex flex-col bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100 transition-colors duration-300">
          <Header />
          
          <div className="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8">
            <Routes>
              <Route path="/" element={<LandingPage />} />
              <Route path="/pasien" element={<PasienPortal />} />
              <Route path="/dokter" element={<DokterWorkspace />} />
              <Route path="/apotek" element={<ApotekFarmasi />} />
              <Route path="/kasir" element={<KasirBilling />} />
              <Route path="/admin" element={<AdminCenter />} />
              <Route path="/antrian-tv" element={<AntrianTV />} />
              <Route path="/daftar" element={<AuthDaftar />} />
              <Route path="/login" element={<AuthLogin />} />
            </Routes>
          </div>

          <Footer />

          {/* Interactive Global Overlays */}
          <ChatbotWidget />
          <CommandPalette />
          <WhatsAppModal />
        </div>
      </BrowserRouter>
    </ClinicProvider>
  );
}
