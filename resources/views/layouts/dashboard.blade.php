<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PGN One Portal') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="font-sans antialiased bg-[#d9d9d9]">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">
        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden" style="display: none;"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-[280px] bg-[#439df1] flex flex-col transition-transform duration-300 lg:static lg:translate-x-0">
            <!-- Logo -->
            <div class="p-6 flex items-center justify-center">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('images/pgn-logo.png') }}" alt="PGN Logo" class="w-[180px] h-auto object-contain">
                </a>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 space-y-4 mt-4">
                <!-- Beranda -->
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 rounded-xl transition-colors group {{ request()->routeIs('dashboard') ? 'bg-white shadow-sm' : 'hover:bg-white/20' }}">
                    <div class="w-8 h-8 flex items-center justify-center mr-4">
                        <!-- Home Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-black">
                            <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                            <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                        </svg>
                    </div>
                    <span class="text-sm font-bold text-black">Beranda</span>
                </a>

                <!-- History -->
                @can('view module history')
                <a href="{{ route('history') }}" class="flex items-center px-4 py-3 rounded-xl transition-colors group {{ request()->routeIs('history') ? 'bg-white shadow-sm' : 'hover:bg-white/20' }}">
                    <div class="w-8 h-8 flex items-center justify-center mr-4">
                        <!-- History Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-black">
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="text-sm font-bold text-black">History</span>
                </a>
                @endcan

                <!-- Management User -->
                @can('view module management-user')
                <a href="{{ route('management-user.index') }}" class="flex items-center px-4 py-3 rounded-xl transition-colors group {{ request()->routeIs('management-user.*') ? 'bg-white shadow-sm' : 'hover:bg-white/20' }}">
                    <div class="w-8 h-8 flex items-center justify-center mr-4">
                        <!-- User Group Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-black">
                            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="text-sm font-bold text-black leading-tight">Management<br>User</span>
                </a>
                @endcan

                <!-- Integrasi Sistem -->
                @can('view module integrasi-sistem')
                <a href="{{ route('integrasi-sistem.index') }}" class="flex items-center px-4 py-3 rounded-xl transition-colors group {{ request()->routeIs('integrasi-sistem*') ? 'bg-white shadow-sm' : 'hover:bg-white/20' }}">
                    <div class="w-8 h-8 flex items-center justify-center mr-4">
                        <svg viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6">
                            <path d="M8.33333 45.8333H37.5M14.0771 9.91042L18.4979 14.3312M18.4979 14.3312C19.67 13.1591 21.2591 12.5 22.9167 12.5M18.4979 14.3312C17.3258 15.5034 16.6667 17.0924 16.6667 18.75M16.6667 18.75H10.4167M16.6667 18.75C16.6667 20.4076 17.3258 21.9966 18.4979 23.1687M18.4979 23.1687L14.0771 27.5896M18.4979 23.1687C19.67 24.3409 21.2591 25 22.9167 25M22.9167 25V31.25M22.9167 25C24.5743 25 26.1633 24.3409 27.3354 23.1687M27.3354 23.1687L31.7562 27.5896M27.3354 23.1687C28.5075 21.9966 29.1667 20.4076 29.1667 18.75M35.4167 18.75H29.1667M29.1667 18.75C29.1667 17.0924 28.5075 15.5034 27.3354 14.3312M31.7562 9.91042L27.3354 14.3312M27.3354 14.3312C26.1633 13.1591 24.5743 12.5 22.9167 12.5M22.9167 12.5V6.25M0 37.5H45.8333V0H0V37.5ZM14.5833 45.8333H31.25V37.5H14.5833V45.8333Z" stroke="black" stroke-width="2" />
                        </svg>
                    </div>
                    <span class="text-sm font-bold text-black leading-tight">Integrasi<br>Sistem</span>
                </a>
                @endcan
            </nav>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="bg-white h-[80px] shadow-sm flex items-center justify-between px-4 lg:px-8 z-20">
                <!-- Mobile Menu Button -->
                <button @click="sidebarOpen = true" class="lg:hidden p-2 -ml-2 mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <!-- Breadcrumbs (Removed) -->
                <div></div>

                <!-- Right Actions -->
                <div class="flex items-center space-x-6">
                    <!-- Notification -->
                    <div x-data="{ 
                        open: false, 
                        notifications: [], 
                        unreadCount: 0,
                        async fetchNotifications() {
                            try {
                                const res = await fetch('{{ route('notifications.index') }}');
                                const data = await res.json();
                                this.notifications = data.notifications;
                                this.unreadCount = data.unread_count;
                            } catch (e) {
                                console.error('Error fetching notifications:', e);
                            }
                        },
                        async markAsRead(id) {
                            await fetch('/notifications/mark-read/' + id, { 
                                method: 'POST', 
                                headers: { 
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json'
                                } 
                            });
                            this.fetchNotifications();
                        },
                        async markAllRead() {
                            await fetch('{{ route('notifications.mark-all-read') }}', { 
                                method: 'POST', 
                                headers: { 
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json'
                                } 
                            });
                            this.fetchNotifications();
                        }
                    }" 
                    x-init="fetchNotifications(); setInterval(() => fetchNotifications(), 30000)" 
                    class="relative">
                        <button @click="open = !open" class="relative p-2 hover:bg-gray-100 rounded-full transition-colors duration-200 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-black">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                            </svg>
                            <span x-show="unreadCount > 0" class="absolute top-2 right-2.5 w-2 h-2 bg-red-500 rounded-full ring-2 ring-white"></span>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="open" 
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             style="display: none;" 
                             class="absolute right-0 mt-3 w-[450px] bg-white rounded-xl shadow-2xl z-50 border border-gray-100 overflow-hidden ring-1 ring-black ring-opacity-5">
                            
                            <!-- Header -->
                            <div class="px-5 py-4 border-b border-gray-100 flex justify-between items-center bg-white">
                                <h3 class="text-lg font-bold text-gray-900">Notifikasi</h3>
                                <button @click="markAllRead()" class="text-xs text-blue-600 hover:text-blue-700 font-semibold hover:bg-blue-50 px-3 py-1.5 rounded-lg transition-all whitespace-nowrap">
                                    Tandai semua dibaca
                                </button>
                            </div>

                            <!-- Notification List -->
                            <div class="max-h-[400px] overflow-y-auto custom-scrollbar">
                                <template x-for="notification in notifications" :key="notification.id">
                                    <div @click="markAsRead(notification.id)" 
                                         :class="{'bg-blue-50/60': !notification.read_at, 'bg-white': notification.read_at}" 
                                         class="px-5 py-4 hover:bg-gray-50 cursor-pointer border-b border-gray-100 last:border-0 transition-colors group relative">
                                        
                                        <!-- Unread Indicator Dot -->
                                        <div x-show="!notification.read_at" class="absolute left-2 top-5 w-2 h-2 bg-blue-500 rounded-full"></div>

                                        <div class="flex justify-between items-start mb-1">
                                            <p class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition-colors truncate pr-2" x-text="notification.data.module"></p>
                                            <span class="text-[10px] font-medium text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full whitespace-nowrap" x-text="notification.created_at"></span>
                                        </div>
                                        
                                        <p class="text-sm text-gray-600 leading-relaxed break-words" x-text="notification.data.description"></p>
                                        
                                        <div class="mt-2 flex items-center gap-2">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium"
                                                  :class="{
                                                      'bg-green-100 text-green-700': notification.data.action === 'create',
                                                      'bg-red-100 text-red-700': notification.data.action === 'delete',
                                                      'bg-yellow-100 text-yellow-700': notification.data.action === 'update',
                                                      'bg-blue-100 text-blue-700': notification.data.action === 'login',
                                                      'bg-gray-100 text-gray-700': notification.data.action === 'logout'
                                                  }"
                                                  x-text="notification.data.action">
                                            </span>
                                            <span class="text-[11px] text-gray-400" x-text="'• ' + notification.data.actor_name"></span>
                                        </div>
                                    </div>
                                </template>

                                <!-- Empty State -->
                                <div x-show="notifications.length === 0" class="px-6 py-10 text-center flex flex-col items-center justify-center">
                                    <div class="bg-gray-50 p-4 rounded-full mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-400">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                        </svg>
                                    </div>
                                    <p class="text-gray-900 font-medium text-sm">Tidak ada notifikasi</p>
                                    <p class="text-gray-500 text-xs mt-1">Kami akan memberi tahu Anda jika ada pembaruan.</p>
                                </div>
                            </div>

                            <!-- Footer -->
                            <a href="{{ route('history') }}" class="block w-full py-3 text-center text-xs font-semibold text-gray-500 hover:text-blue-600 hover:bg-gray-50 border-t border-gray-100 transition-colors">
                                Lihat Semua History
                            </a>
                        </div>
                    </div>

                    <!-- User Profile -->
                    <div x-data="{ open: false, logoutConfirmOpen: false }" class="relative">
                        <div @click="open = !open" class="flex items-center space-x-4 cursor-pointer select-none">
                            <span class="text-sm font-normal text-black">{{ Auth::user()->name ?? 'Admin' }}</span>
                            <div class="w-8 h-8 rounded-full border-2 border-black flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-black">
                                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>

                        <!-- Dropdown Menu -->
                        <div x-show="open" 
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 top-full mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 ring-1 ring-black ring-opacity-5"
                             style="display: none;">
                            
                            <!-- Settings -->
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150">
                                Settings
                            </a>
                            
                            <!-- Logout -->
                            <button type="button" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150" @click="open = false; logoutConfirmOpen = true">
                                Logout
                            </button>
                        </div>

                        <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                            @csrf
                        </form>

                        <div x-show="logoutConfirmOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center" style="display: none;">
                            <div class="absolute inset-0 bg-black/0" @click="logoutConfirmOpen = false"></div>

                            <div role="dialog" aria-modal="true" class="relative mx-4 w-full max-w-md rounded-2xl bg-[#f1f1f1] px-8 py-10 text-center">
                                <p class="text-3xl font-bold leading-snug text-black">
                                    Apakah Anda Yakin
                                    <br>
                                    Ingin Logout?
                                </p>

                                <div class="mt-10 flex items-center justify-between px-6">
                                    <button
                                        type="button"
                                        class="min-w-36 rounded-3xl bg-[#9CFB56] px-8 py-2.5 text-xl font-semibold text-white"
                                        @click="logoutConfirmOpen = false; document.getElementById('logout-form').submit()"
                                    >
                                        Ya
                                    </button>

                                    <a
                                        href="{{ route('dashboard') }}"
                                        class="min-w-36 rounded-3xl bg-[#B24B33] px-8 py-2.5 text-xl font-semibold text-white"
                                        @click="logoutConfirmOpen = false"
                                    >
                                        Tidak
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Scroll Area -->
            <main class="flex-1 overflow-y-auto p-8">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
