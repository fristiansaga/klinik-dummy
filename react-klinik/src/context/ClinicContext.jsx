import React, { createContext, useContext, useState, useEffect } from 'react';
import { mockPatientsQueue, mockPoliklinik, mockMedicinesStock } from '../data/mockData';

const ClinicContext = createContext();

export const ClinicProvider = ({ children }) => {
  const [theme, setTheme] = useState('dark');
  const [queues, setQueues] = useState(mockPatientsQueue);
  const [currentCalling, setCurrentCalling] = useState({ no: 'A-003', name: 'Sertu Wahyu Hidayat', poli: 'Poli Penyakit Dalam' });
  const [medicines, setMedicines] = useState(mockMedicinesStock);
  const [toast, setToast] = useState(null);
  const [waModalOpen, setWaModalOpen] = useState(false);
  const [waType, setWaType] = useState('antrean');
  const [cmdOpen, setCmdOpen] = useState(false);

  // Show Toast
  const showToast = (message, type = 'success') => {
    setToast({ message, type });
    setTimeout(() => setToast(null), 3500);
  };

  // Text-To-Speech Queue Announcer
  const speakQueue = (queueNo, name, poli) => {
    if ('speechSynthesis' in window) {
      const text = `Nomor Antrean, ${queueNo.split('').join(' ')}, atas nama ${name}, silakan menuju ${poli}`;
      const utterance = new SpeechSynthesisUtterance(text);
      utterance.lang = 'id-ID';
      utterance.rate = 0.9;
      window.speechSynthesis.speak(utterance);
    }
  };

  // Call Patient
  const callPatient = (queueItem) => {
    setCurrentCalling(queueItem);
    speakQueue(queueItem.no, queueItem.name, queueItem.poli);
    showToast(`Memanggil Antrean ${queueItem.no} (${queueItem.name})`, 'success');
  };

  // Add Booking
  const addBooking = (name, poli, keluhan) => {
    const newNo = `A-00${queues.length + 1}`;
    const newQueue = {
      no: newNo,
      rm: `RM-2026-${Math.floor(1000 + Math.random() * 9000)}`,
      name,
      poli,
      status: 'Menunggu',
      type: 'Umum / BPJS',
      time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
    };
    setQueues([...queues, newQueue]);
    showToast(`Booking Berhasil! Nomor Antrean Anda: ${newNo}`, 'success');
    return newNo;
  };

  // Open WA Modal
  const openWaSimulator = (type = 'antrean') => {
    setWaType(type);
    setWaModalOpen(true);
  };

  // Dark Mode Class Sync
  useEffect(() => {
    if (theme === 'dark') {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  }, [theme]);

  // Global Ctrl+K shortcut
  useEffect(() => {
    const handleKeyDown = (e) => {
      if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
        e.preventDefault();
        setCmdOpen(prev => !prev);
      }
    };
    window.addEventListener('keydown', handleKeyDown);
    return () => window.removeEventListener('keydown', handleKeyDown);
  }, []);

  return (
    <ClinicContext.Provider value={{
      theme, setTheme,
      queues, setQueues,
      currentCalling, callPatient,
      medicines, setMedicines,
      toast, showToast,
      waModalOpen, setWaModalOpen, waType, openWaSimulator,
      cmdOpen, setCmdOpen,
      addBooking
    }}>
      {children}
      
      {/* Toast Notification Container */}
      {toast && (
        <div className="fixed top-6 right-6 z-50 flex items-center gap-3 bg-slate-900 border-l-4 border-emerald-500 text-white px-5 py-3.5 rounded-xl shadow-2xl animate-bounce">
          <span className="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-ping"></span>
          <p className="text-sm font-semibold">{toast.message}</p>
        </div>
      )}
    </ClinicContext.Provider>
  );
};

export const useClinic = () => useContext(ClinicContext);
