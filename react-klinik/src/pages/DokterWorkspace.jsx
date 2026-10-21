import React, { useState } from 'react';
import { Users, Stethoscope, FileText, Play, CheckCircle2, AlertCircle, Save, Printer, ArrowLeft } from 'lucide-react';
import Sidebar from '../components/Sidebar';
import { useClinic } from '../context/ClinicContext';
import { mockIcd10 } from '../data/mockData';

export default function DokterWorkspace() {
  const [activeTab, setActiveTab] = useState('antrean_periksa');
  const { queues, callPatient, showToast } = useClinic();

  // SOAP State
  const [subjective, setSubjective] = useState('Pasien mengeluh pusing di tengkuk leher belakang sejak 3 hari, riwayat tensi tinggi.');
  const [systolic, setSystolic] = useState('140');
  const [diastolic, setDiastolic] = useState('90');
  const [pulse, setPulse] = useState('82');
  const [temp, setTemp] = useState('36.7');
  const [diagnosisCode, setDiagnosisCode] = useState('I10');
  const [plan, setPlan] = useState('Amlodipine 10mg 1x1 tab malam, edukasi kurangi konsumsi garam & olahraga ringan.');

  const user = {
    name: 'dr. Agus Susanto, Sp.PD',
    role: 'Dokter Spesialis',
    initials: 'DA',
    avatarBg: 'bg-amber-600',
    badgeClass: 'bg-amber-500/20 text-amber-400'
  };

  const menuItems = [
    { id: 'antrean_periksa', label: 'Antrean Pasien Poli', icon: Users },
    { id: 'ruang_periksa', label: 'Ruang Periksa (SOAP)', icon: Stethoscope },
    { id: 'surat_medis', label: 'Surat Keterangan Medis', icon: FileText }
  ];

  const handleSaveSoap = (e) => {
    e.preventDefault();
    showToast('Rekam Medis EMR SOAP Berhasil Disimpan & E-Resep Terkirim ke Apotek!', 'success');
  };

  return (
    <div className="flex flex-col md:flex-row gap-6 py-6">
      <Sidebar user={user} menuItems={menuItems} activeTab={activeTab} setActiveTab={setActiveTab} />

      <main className="flex-1 space-y-6">
        
        {/* Tab 1: Antrean Pasien Poli */}
        {activeTab === 'antrean_periksa' && (
          <div className="space-y-6">
            <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
              <div>
                <h2 className="text-2xl font-bold text-white">Daftar Antrean Pasien Menunggu 🩺</h2>
                <p className="text-xs text-slate-400">Poli Spesialis Penyakit Dalam • Ruang Periksa 2</p>
              </div>
              <button
                onClick={() => setActiveTab('ruang_periksa')}
                className="flex items-center gap-1.5 text-xs font-bold bg-emerald-700 hover:bg-emerald-600 text-white px-4 py-2.5 rounded-xl shadow-glow-primary transition"
              >
                <Play className="w-4 h-4" /> Lanjutkan Periksa (A-004)
              </button>
            </div>

            <div className="glass-panel rounded-2xl p-6 border border-slate-800 overflow-x-auto">
              <table className="w-full text-xs text-left">
                <thead>
                  <tr className="border-b border-slate-800 text-slate-400">
                    <th className="pb-3">No. Antrean</th>
                    <th className="pb-3">No. RM</th>
                    <th className="pb-3">Nama Pasien</th>
                    <th className="pb-3">Penjamin</th>
                    <th className="pb-3">Status</th>
                    <th className="pb-3 text-right">Aksi</th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-slate-800/60">
                  {queues.map((q, idx) => (
                    <tr key={idx} className="hover:bg-slate-900/60 transition">
                      <td className="py-3 font-mono font-bold text-emerald-400">{q.no}</td>
                      <td className="py-3 font-mono text-slate-300">{q.rm}</td>
                      <td className="py-3 font-semibold text-white">{q.name}</td>
                      <td className="py-3 text-slate-400">{q.type}</td>
                      <td className="py-3">
                        <span className={`text-[10px] font-bold px-2 py-0.5 rounded ${
                          q.status === 'Selesai' ? 'bg-emerald-500/20 text-emerald-400' :
                          q.status === 'Sedang Diperiksa' ? 'bg-amber-500/20 text-amber-400' : 'bg-slate-800 text-slate-300'
                        }`}>
                          {q.status}
                        </span>
                      </td>
                      <td className="py-3 text-right space-x-2">
                        <button
                          onClick={() => callPatient(q)}
                          className="bg-slate-800 hover:bg-slate-700 text-slate-200 px-2.5 py-1 rounded-lg text-[11px] font-semibold transition"
                        >
                          Panggil
                        </button>
                        <button
                          onClick={() => setActiveTab('ruang_periksa')}
                          className="bg-emerald-700 hover:bg-emerald-600 text-white px-2.5 py-1 rounded-lg text-[11px] font-bold transition"
                        >
                          Periksa
                        </button>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </div>
        )}

        {/* Tab 2: Ruang Periksa SOAP */}
        {activeTab === 'ruang_periksa' && (
          <div className="space-y-6">
            <div className="flex items-center justify-between">
              <div>
                <h2 className="text-2xl font-bold text-white">Rekam Medis Elektronik (SOAP) 📝</h2>
                <p className="text-xs text-slate-400">Standar RME Permenkes No. 24/2022 terintegrasi SATUSEHAT.</p>
              </div>
              <button
                onClick={() => setActiveTab('antrean_periksa')}
                className="flex items-center gap-1 text-xs text-slate-400 hover:text-white bg-slate-900 border border-slate-800 px-3 py-1.5 rounded-xl"
              >
                <ArrowLeft className="w-3.5 h-3.5" /> Kembali
              </button>
            </div>

            {/* Patient Header Banner */}
            <div className="bg-slate-900/90 border border-slate-800 rounded-2xl p-4 flex items-center justify-between flex-wrap gap-4">
              <div className="flex items-center gap-3">
                <div className="w-10 h-10 rounded-xl bg-amber-600 text-white flex items-center justify-center font-bold">
                  AN
                </div>
                <div>
                  <h4 className="font-bold text-sm text-white">Achmad Nurhadi (L / 36 Thn)</h4>
                  <p className="text-[11px] text-slate-400">No. RM: RM-2026-0881 • BPJS Kesehatan (PBI)</p>
                </div>
              </div>
              <span className="text-xs font-bold px-3 py-1 bg-amber-500/20 text-amber-400 rounded-full">
                Antrean: A-004
              </span>
            </div>

            {/* SOAP Form */}
            <form onSubmit={handleSaveSoap} className="glass-panel rounded-2xl p-6 border border-slate-800 space-y-5">
              
              {/* S: Subjective */}
              <div>
                <label className="text-xs font-bold text-amber-400 block mb-1">S (Subjective) - Anamnesa & Keluhan</label>
                <textarea
                  rows={2}
                  value={subjective}
                  onChange={(e) => setSubjective(e.target.value)}
                  className="w-full bg-slate-950 text-white text-xs p-3 rounded-xl border border-slate-800 focus:outline-none focus:border-amber-500"
                />
              </div>

              {/* O: Objective (Vital Signs) */}
              <div>
                <label className="text-xs font-bold text-emerald-400 block mb-1">O (Objective) - Tanda Vital & Fisik</label>
                <div className="grid grid-cols-2 sm:grid-cols-4 gap-3">
                  <div>
                    <span className="text-[10px] text-slate-400 block mb-1">Sistolik (mmHg)</span>
                    <input
                      type="number"
                      value={systolic}
                      onChange={(e) => setSystolic(e.target.value)}
                      className="w-full bg-slate-950 text-white text-xs px-3 py-2 rounded-xl border border-slate-800"
                    />
                  </div>
                  <div>
                    <span className="text-[10px] text-slate-400 block mb-1">Diastolik (mmHg)</span>
                    <input
                      type="number"
                      value={diastolic}
                      onChange={(e) => setDiastolic(e.target.value)}
                      className="w-full bg-slate-950 text-white text-xs px-3 py-2 rounded-xl border border-slate-800"
                    />
                  </div>
                  <div>
                    <span className="text-[10px] text-slate-400 block mb-1">Nadi (x/menit)</span>
                    <input
                      type="number"
                      value={pulse}
                      onChange={(e) => setPulse(e.target.value)}
                      className="w-full bg-slate-950 text-white text-xs px-3 py-2 rounded-xl border border-slate-800"
                    />
                  </div>
                  <div>
                    <span className="text-[10px] text-slate-400 block mb-1">Suhu (°C)</span>
                    <input
                      type="text"
                      value={temp}
                      onChange={(e) => setTemp(e.target.value)}
                      className="w-full bg-slate-950 text-white text-xs px-3 py-2 rounded-xl border border-slate-800"
                    />
                  </div>
                </div>
              </div>

              {/* A: Assessment (ICD-10) */}
              <div>
                <label className="text-xs font-bold text-sky-400 block mb-1">A (Assessment) - Diagnosa ICD-10</label>
                <select
                  value={diagnosisCode}
                  onChange={(e) => setDiagnosisCode(e.target.value)}
                  className="w-full bg-slate-950 text-white text-xs px-3.5 py-2.5 rounded-xl border border-slate-800 focus:outline-none focus:border-sky-500"
                >
                  {mockIcd10.map((d) => (
                    <option key={d.code} value={d.code}>
                      [{d.code}] {d.name}
                    </option>
                  ))}
                </select>
              </div>

              {/* P: Plan (Therapy & Prescription) */}
              <div>
                <label className="text-xs font-bold text-purple-400 block mb-1">P (Plan) - Terapi & Resep Digital</label>
                <textarea
                  rows={2}
                  value={plan}
                  onChange={(e) => setPlan(e.target.value)}
                  className="w-full bg-slate-950 text-white text-xs p-3 rounded-xl border border-slate-800 focus:outline-none focus:border-purple-500"
                />
              </div>

              <div className="pt-2 flex justify-end gap-3">
                <button
                  type="submit"
                  className="flex items-center gap-2 bg-emerald-700 hover:bg-emerald-600 text-white text-xs font-bold px-6 py-3 rounded-xl shadow-glow-primary transition"
                >
                  <Save className="w-4 h-4" /> Simpan EMR & Kirim Resep
                </button>
              </div>
            </form>
          </div>
        )}

        {/* Tab 3: Surat Medis */}
        {activeTab === 'surat_medis' && (
          <div className="space-y-6">
            <div>
              <h2 className="text-2xl font-bold text-white">Penerbitan Surat Medis 📄</h2>
              <p className="text-xs text-slate-400">Penerbitan Surat Keterangan Sakit / SKBS Resmi PUSDIKZI.</p>
            </div>

            <div className="glass-panel rounded-2xl p-6 max-w-xl border border-slate-800 space-y-4">
              <div>
                <label className="text-xs font-semibold text-slate-300 block mb-1">Jenis Surat</label>
                <select className="w-full bg-slate-950 text-white text-xs px-3.5 py-2.5 rounded-xl border border-slate-800">
                  <option>Surat Keterangan Istirahat Sakit</option>
                  <option>Surat Keterangan Berbadan Sehat (SKBS)</option>
                  <option>Surat Rujukan FKTP Lanjut</option>
                </select>
              </div>

              <div>
                <label className="text-xs font-semibold text-slate-300 block mb-1">Jumlah Hari Istirahat</label>
                <input type="number" defaultValue="3" className="w-full bg-slate-950 text-white text-xs px-3.5 py-2.5 rounded-xl border border-slate-800" />
              </div>

              <button
                onClick={() => {
                  alert("Surat Keterangan Medis Terbit!");
                  window.print();
                }}
                className="w-full flex items-center justify-center gap-2 bg-amber-600 hover:bg-amber-500 text-white text-xs font-bold py-3 rounded-xl shadow-glow-accent transition"
              >
                <Printer className="w-4 h-4" /> Terbitkan & Cetak Surat
              </button>
            </div>
          </div>
        )}

      </main>
    </div>
  );
}
