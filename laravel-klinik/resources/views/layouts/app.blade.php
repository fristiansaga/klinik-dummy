<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Sistem Informasi Klinik Pratama PUSDIKZI' }}</title>
    
    <!-- Google Fonts & Lucide Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            900: '#064e3b',
                        },
                        military: {
                            800: '#1c2d20',
                            900: '#111e14',
                        }
                    }
                }
            }
        }
    </script>

    <!-- AlpineJS CDN -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        
        @media print {
            body {
                background: white !important;
                color: black !important;
            }
            aside, header, .no-print, nav, button.no-print {
                display: none !important;
            }
            main {
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
                background: white !important;
            }
            .printable-receipt {
                box-shadow: none !important;
                border: 1px solid #000 !important;
                color: black !important;
                background: white !important;
                margin: 0 auto !important;
                max-width: 100% !important;
            }
        }
    </style>

    @livewireStyles
</head>
<body x-data="{ sidebarOpen: false }" class="bg-slate-900 text-slate-100 min-h-screen flex flex-col lg:flex-row font-sans antialiased selection:bg-emerald-500 selection:text-white">

    <!-- Mobile Backdrop Overlay -->
    <div x-show="sidebarOpen" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false" 
         class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 lg:hidden" 
         x-cloak>
    </div>

    <!-- Mobile Sidebar Drawer -->
    <aside x-show="sidebarOpen" 
           x-transition:enter="transition ease-out duration-300 transform"
           x-transition:enter-start="-translate-x-full"
           x-transition:enter-end="translate-x-0"
           x-transition:leave="transition ease-in duration-200 transform"
           x-transition:leave-start="translate-x-0"
           x-transition:leave-end="-translate-x-full"
           class="w-72 bg-slate-950 border-r border-slate-800 flex flex-col fixed inset-y-0 left-0 z-50 lg:hidden shadow-2xl" 
           x-cloak>
        <!-- Logo & Header -->
        <div class="p-5 border-b border-slate-800 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-400 flex items-center justify-center text-white font-bold shadow-lg shadow-emerald-500/20">
                    <i data-lucide="cross" class="w-6 h-6"></i>
                </div>
                <div>
                    <h1 class="font-bold text-sm leading-tight text-white tracking-wide">KLINIK PUSDIKZI</h1>
                    <p class="text-[11px] text-emerald-400 font-medium">Sistem Terpadu Zeni TNI AD</p>
                </div>
            </div>
            <button @click="sidebarOpen = false" class="p-2 rounded-lg bg-slate-900 text-slate-400 hover:text-white hover:bg-slate-800">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Mobile Menu Links -->
        <nav class="flex-1 px-3 py-4 space-y-1.5 overflow-y-auto">
            <a href="/" @click="sidebarOpen = false" class="flex items-center space-x-3 px-3.5 py-3 rounded-xl text-sm font-medium transition {{ request()->is('/') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/30' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/50' }}">
                <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                <span>Dashboard</span>
            </a>

            <a href="/pasien" @click="sidebarOpen = false" class="flex items-center space-x-3 px-3.5 py-3 rounded-xl text-sm font-medium transition {{ request()->is('pasien*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/30' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/50' }}">
                <i data-lucide="activity" class="w-4 h-4"></i>
                <span>Portal & Passport</span>
            </a>

            <a href="/pendaftaran" @click="sidebarOpen = false" class="flex items-center space-x-3 px-3.5 py-3 rounded-xl text-sm font-medium transition {{ request()->is('pendaftaran*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/30' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/50' }}">
                <i data-lucide="user-plus" class="w-4 h-4"></i>
                <span>Pendaftaran Pasien</span>
            </a>

            <a href="/antrian" @click="sidebarOpen = false" class="flex items-center space-x-3 px-3.5 py-3 rounded-xl text-sm font-medium transition {{ request()->is('antrian*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/30' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/50' }}">
                <i data-lucide="monitor" class="w-4 h-4"></i>
                <span>Layar Antrian</span>
            </a>

            <a href="/pemeriksaan" @click="sidebarOpen = false" class="flex items-center space-x-3 px-3.5 py-3 rounded-xl text-sm font-medium transition {{ request()->is('pemeriksaan*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/30' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/50' }}">
                <i data-lucide="stethoscope" class="w-4 h-4"></i>
                <span>Pemeriksaan Dokter</span>
            </a>

            <a href="/farmasi" @click="sidebarOpen = false" class="flex items-center space-x-3 px-3.5 py-3 rounded-xl text-sm font-medium transition {{ request()->is('farmasi*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/30' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/50' }}">
                <i data-lucide="pill" class="w-4 h-4"></i>
                <span>Apotek & Farmasi</span>
            </a>

            <a href="/kasir" @click="sidebarOpen = false" class="flex items-center space-x-3 px-3.5 py-3 rounded-xl text-sm font-medium transition {{ request()->is('kasir*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/30' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/50' }}">
                <i data-lucide="receipt" class="w-4 h-4"></i>
                <span>Kasir & Cetak Struk</span>
            </a>
        </nav>

        <!-- User Profile Card -->
        <div class="p-4 border-t border-slate-800 bg-slate-900/50">
            <div class="flex items-center space-x-3">
                <div class="w-9 h-9 rounded-full bg-emerald-500/20 border border-emerald-500/40 flex items-center justify-center text-emerald-400 font-bold text-xs">
                    PZ
                </div>
                <div class="flex-1 overflow-hidden">
                    <p class="text-xs font-semibold text-white truncate">Petugas Medis PUSDIKZI</p>
                    <p class="text-[10px] text-slate-400">Livewire v3 Connected</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Desktop Sidebar Navigation -->
    <aside class="hidden lg:flex lg:w-64 bg-slate-950/80 backdrop-blur-xl border-r border-slate-800/80 flex-col fixed inset-y-0 left-0 z-40">
        <!-- Logo & Header -->
        <div class="p-5 border-b border-slate-800 flex items-center space-x-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-400 flex items-center justify-center text-white font-bold shadow-lg shadow-emerald-500/20">
                <i data-lucide="cross" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="font-bold text-sm leading-tight text-white tracking-wide">KLINIK PUSDIKZI</h1>
                <p class="text-[11px] text-emerald-400 font-medium">Sistem Terpadu Zeni TNI AD</p>
            </div>
        </div>

        <!-- Menu Links -->
        <nav class="flex-1 px-3 py-4 space-y-1.5 overflow-y-auto">
            <a href="/" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->is('/') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/30' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/50' }}">
                <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                <span>Dashboard</span>
            </a>

            <a href="/pasien" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->is('pasien*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/30' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/50' }}">
                <i data-lucide="activity" class="w-4 h-4"></i>
                <span>Portal & Passport</span>
            </a>

            <a href="/pendaftaran" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->is('pendaftaran*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/30' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/50' }}">
                <i data-lucide="user-plus" class="w-4 h-4"></i>
                <span>Pendaftaran Pasien</span>
            </a>

            <a href="/antrian" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->is('antrian*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/30' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/50' }}">
                <i data-lucide="monitor" class="w-4 h-4"></i>
                <span>Layar Antrian</span>
            </a>

            <a href="/pemeriksaan" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->is('pemeriksaan*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/30' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/50' }}">
                <i data-lucide="stethoscope" class="w-4 h-4"></i>
                <span>Pemeriksaan Dokter</span>
            </a>

            <a href="/farmasi" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->is('farmasi*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/30' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/50' }}">
                <i data-lucide="pill" class="w-4 h-4"></i>
                <span>Apotek & Farmasi</span>
            </a>

            <a href="/kasir" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->is('kasir*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/30' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/50' }}">
                <i data-lucide="receipt" class="w-4 h-4"></i>
                <span>Kasir & Cetak Struk</span>
            </a>
        </nav>

        <!-- User Profile Card -->
        <div class="p-4 border-t border-slate-800/80 bg-slate-900/50">
            <div class="flex items-center space-x-3">
                <div class="w-9 h-9 rounded-full bg-emerald-500/20 border border-emerald-500/40 flex items-center justify-center text-emerald-400 font-bold text-xs">
                    PZ
                </div>
                <div class="flex-1 overflow-hidden">
                    <p class="text-xs font-semibold text-white truncate">Petugas Medis PUSDIKZI</p>
                    <p class="text-[10px] text-slate-400">Livewire v3 Connected</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 lg:pl-64 flex flex-col min-h-screen w-full overflow-x-hidden">
        <!-- Top Navbar -->
        <header class="h-16 border-b border-slate-800/80 bg-slate-950/80 backdrop-blur-md px-4 sm:px-6 lg:px-8 flex items-center justify-between sticky top-0 z-30">
            <div class="flex items-center space-x-3">
                <!-- Hamburger Button for Mobile -->
                <button @click="sidebarOpen = true" type="button" class="lg:hidden p-2 rounded-xl bg-slate-800/80 hover:bg-slate-700 text-slate-200 border border-slate-700/50 flex items-center justify-center transition focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>

                <div class="flex items-center space-x-2">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse mr-1.5"></span>
                        <span class="hidden sm:inline">Sistem Aktif & Terintegrasi</span>
                        <span class="sm:hidden">Online</span>
                    </span>
                    <span class="text-xs text-slate-400 hidden md:inline">| {{ date('d F Y') }}</span>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <span class="text-xs text-slate-300 bg-slate-800/70 px-3 py-1.5 rounded-lg border border-slate-700/50 truncate max-w-[200px] sm:max-w-none">
                    <i data-lucide="shield" class="w-3.5 h-3.5 inline text-emerald-400 mr-1"></i>
                    <span class="hidden sm:inline">Klinik Pratama PUSDIKZI TNI AD</span>
                    <span class="sm:hidden">PUSDIKZI TNI AD</span>
                </span>
            </div>
        </header>

        <!-- Livewire Dynamic Content Slot -->
        <div class="p-4 sm:p-6 lg:p-8 flex-1 w-full max-w-7xl mx-auto">
            {{ $slot ?? '' }}
            @yield('content')
        </div>
    </main>

    @livewireScripts
    <script>
        lucide.createIcons();
        document.addEventListener('livewire:navigated', () => {
            lucide.createIcons();
        });
        document.addEventListener('livewire:load', () => {
            lucide.createIcons();
        });
        document.addEventListener('livewire:initialized', () => {
            Livewire.hook('morph.updated', () => {
                lucide.createIcons();
            });
        });
        window.addEventListener('open-struk', () => {
            setTimeout(() => { lucide.createIcons(); }, 50);
        });
    </script>
</body>
</html>
