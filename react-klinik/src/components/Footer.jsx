import React from 'react';
import { Shield, Phone, Mail, MapPin, CheckCircle2 } from 'lucide-react';
import { Link } from 'react-router-dom';

export default function Footer() {
  return (
    <footer className="w-full bg-slate-100 dark:bg-slate-950 border-t border-slate-200 dark:border-slate-900 text-slate-600 dark:text-slate-400 text-xs py-12 transition-colors duration-300">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8">
        
        {/* Col 1 */}
        <div className="space-y-3">
          <div className="flex items-center gap-2">
            <div className="w-8 h-8 rounded-lg bg-emerald-700 text-white flex items-center justify-center">
              <Shield className="w-4 h-4" />
            </div>
            <div>
              <h4 className="text-slate-900 dark:text-white font-bold text-sm">KLINIK PRATAMA PUSDIKZI</h4>
              <span className="text-[10px] text-slate-500">KODIKLAT TNI-AD</span>
            </div>
          </div>
          <p className="text-[11px] leading-relaxed text-slate-600 dark:text-slate-400">
            Pusat Pendidikan Zeni TNI-AD menyelenggarakan pelayanan kesehatan terpadu bagi prajurit, PNS, keluarga besar, dan masyarakat umum.
          </p>
        </div>

        {/* Col 2 */}
        <div>
          <h4 className="text-slate-900 dark:text-white font-bold text-xs uppercase tracking-wider mb-3">Layanan Poliklinik</h4>
          <ul className="space-y-1.5 text-[11px]">
            <li>• Poli Umum & Medical Check Up</li>
            <li>• Poli Spesialis Penyakit Dalam</li>
            <li>• Poli Gigi & Mulut</li>
            <li>• Poli Ibu & Anak (KIA / KB)</li>
            <li>• Instalasi Farmasi Siaga 24 Jam</li>
          </ul>
        </div>

        {/* Col 3 */}
        <div>
          <h4 className="text-slate-900 dark:text-white font-bold text-xs uppercase tracking-wider mb-3">Pintu Akses Portal</h4>
          <ul className="space-y-1.5 text-[11px]">
            <li><Link to="/pasien" className="hover:text-emerald-600 dark:hover:text-emerald-400 transition">• Digital Health Passport</Link></li>
            <li><Link to="/dokter" className="hover:text-emerald-600 dark:hover:text-emerald-400 transition">• Clinical Workspace Dokter</Link></li>
            <li><Link to="/apotek" className="hover:text-emerald-600 dark:hover:text-emerald-400 transition">• Farmasi & Stock Opname FEFO</Link></li>
            <li><Link to="/kasir" className="hover:text-emerald-600 dark:hover:text-emerald-400 transition">• Kasir & Smart Billing</Link></li>
            <li><Link to="/admin" className="hover:text-emerald-600 dark:hover:text-emerald-400 transition">• Admin Executive Command</Link></li>
          </ul>
        </div>

        {/* Col 4 */}
        <div className="space-y-2">
          <h4 className="text-slate-900 dark:text-white font-bold text-xs uppercase tracking-wider mb-3">Kontak & Lokasi</h4>
          <p className="flex items-start gap-2 text-[11px]">
            <MapPin className="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400 mt-0.5 flex-shrink-0" />
            <span>Jl. Jenderal Sudirman No. 45, Bogor Tengah, Kota Bogor, Jawa Barat 16121.</span>
          </p>
          <p className="flex items-center gap-2 text-[11px]">
            <Phone className="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400 flex-shrink-0" />
            <strong>(0251) 832-1234</strong>
          </p>
          <p className="flex items-center gap-2 text-[11px]">
            <Mail className="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400 flex-shrink-0" />
            <span>klinik.pratama@pusdikzi.mil.id</span>
          </p>
        </div>

      </div>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 pt-6 border-t border-slate-200 dark:border-slate-900 flex flex-col sm:flex-row items-center justify-between gap-3 text-[11px] text-slate-500">
        <p>&copy; 2026 <strong>KLINIK PRATAMA PUSDIKZI</strong> • KODIKLAT TNI-AD. All rights reserved.</p>
        <div className="flex items-center gap-4">
          <span className="flex items-center gap-1 text-emerald-600 dark:text-emerald-400">
            <CheckCircle2 className="w-3.5 h-3.5" /> SATUSEHAT Ready
          </span>
          <span>Permenkes No. 24 / 2022 (RME)</span>
        </div>
      </div>
    </footer>
  );
}
