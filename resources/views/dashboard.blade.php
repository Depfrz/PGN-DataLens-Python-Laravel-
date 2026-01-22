<x-dashboard-layout>
    <div class="min-h-screen p-4 lg:p-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-6">
            <div>
                 <h1 class="text-3xl font-bold text-gray-900 dark:text-white tracking-tight">Dashboard</h1>
                 <p class="text-gray-500 dark:text-gray-400 text-sm mt-2">Selamat Datang kembali, <span class="font-semibold text-blue-600 dark:text-blue-400">{{ Auth::user()->name ?? 'Admin' }}</span></p>
            </div>
            
            <!-- Search Bar -->
            <form action="{{ route('dashboard') }}" method="GET" class="relative w-full md:w-96 group">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none transition-colors group-focus-within:text-blue-500 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        class="w-full py-3 pl-12 pr-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 dark:text-white placeholder-gray-400 transition-all shadow-sm hover:border-gray-300 dark:hover:border-gray-600" 
                        placeholder="Cari modul atau sistem..."
                        autocomplete="off"
                    >
                </div>
            </form>
        </div>

        <!-- Modules Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($modules as $module)
                @if($module->name === 'Buku Saku')
                    <!-- Special Layout for Buku Saku -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm hover:shadow-xl border border-gray-100 dark:border-gray-700 transition-all duration-300 flex flex-col h-full overflow-hidden">
                        <div class="flex items-center gap-4 mb-4 pb-4 border-b border-gray-100 dark:border-gray-700">
                            <div class="w-12 h-12 bg-blue-50 dark:bg-gray-700/50 rounded-xl flex items-center justify-center text-blue-600 dark:text-blue-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ $module->name }}</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Akses Cepat</p>
                            </div>
                        </div>
                        
                        <div class="flex-1 flex flex-col gap-2 overflow-y-auto">
                            @if(auth()->user()->hasModuleAccess('Beranda'))
                            <a href="{{ route('buku-saku.index') }}" class="flex items-center gap-3 p-2 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors group/item">
                                <div class="text-gray-400 group-hover/item:text-blue-500 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover/item:text-blue-700 dark:group-hover/item:text-blue-300">Beranda</span>
                            </a>
                            @endif

                            @if(auth()->user()->hasModuleAccess('Dokumen Favorit'))
                            <a href="{{ route('buku-saku.favorites') }}" class="flex items-center gap-3 p-2 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors group/item">
                                <div class="text-gray-400 group-hover/item:text-blue-500 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover/item:text-blue-700 dark:group-hover/item:text-blue-300">Dokumen Favorit</span>
                            </a>
                            @endif

                            @if(auth()->user()->hasModuleAccess('Riwayat Dokumen'))
                            <a href="{{ route('buku-saku.history') }}" class="flex items-center gap-3 p-2 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors group/item">
                                <div class="text-gray-400 group-hover/item:text-blue-500 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover/item:text-blue-700 dark:group-hover/item:text-blue-300">Riwayat Dokumen</span>
                            </a>
                            @endif

                            @if(auth()->user()->hasModuleAccess('Pengecekan File'))
                            <a href="{{ route('buku-saku.approval') }}" class="flex items-center gap-3 p-2 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors group/item">
                                <div class="text-gray-400 group-hover/item:text-blue-500 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover/item:text-blue-700 dark:group-hover/item:text-blue-300">Pengecekan File</span>
                            </a>
                            @endif

                            @if(auth()->user()->hasModuleAccess('Upload Dokumen'))
                            <a href="{{ route('buku-saku.upload') }}" class="flex items-center gap-3 p-2 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors group/item">
                                <div class="text-gray-400 group-hover/item:text-blue-500 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover/item:text-blue-700 dark:group-hover/item:text-blue-300">Upload Dokumen</span>
                            </a>
                            @endif
                        </div>
                    </div>
                @else
                    @php
                        // Logic for Icon/Preview
                        $previewUrl = null;
                        $initials = collect(preg_split('/\s+/', trim((string) $module->name)))
                        ->filter()
                        ->take(2)
                        ->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))
                        ->implode('');
                    
                    if ($initials === '') {
                        $initials = mb_strtoupper(mb_substr((string) $module->name, 0, 2));
                    }

                    // Generate SVG Placeholder
                    $placeholderSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" rx="20" fill="#e0e7ff"/><text x="50" y="55" text-anchor="middle" dominant-baseline="middle" font-family="sans-serif" font-size="40" font-weight="bold" fill="#3b82f6">' . e($initials) . '</text></svg>';
                    $placeholderDataUri = 'data:image/svg+xml;charset=UTF-8,' . rawurlencode($placeholderSvg);

                    if ($module->icon && (Str::contains($module->icon, ['/', '\\']) || Str::contains(Str::lower($module->icon), ['.png', '.jpg', '.jpeg', '.webp', '.svg']))) {
                        $previewUrl = asset('storage/' . $module->icon);
                    } elseif (!empty($module->url) && $module->url !== '#') {
                        // Fallback to favicon service if external URL
                        $absoluteUrl = Str::startsWith($module->url, ['http://', 'https://']) ? $module->url : url($module->url);
                        // Only use favicon if no specific icon is set, otherwise we use SVG/Initials
                         if (!$module->icon) {
                            $previewUrl = 'https://www.google.com/s2/favicons?sz=128&domain_url=' . urlencode($absoluteUrl);
                         }
                    }
                @endphp

                <a href="{{ $module->url }}" 
                   target="{{ ($module->tab_type === 'new' || Str::startsWith($module->url, ['http://', 'https://'])) ? '_blank' : '_self' }}"
                   rel="{{ ($module->tab_type === 'new' || Str::startsWith($module->url, ['http://', 'https://'])) ? 'noopener noreferrer' : '' }}"
                   class="group relative bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-sm hover:shadow-xl border border-gray-100 dark:border-gray-700 transition-all duration-300 hover:-translate-y-1 flex flex-col items-center text-center h-full overflow-hidden cursor-pointer">
                    
                    <!-- Hover Background Gradient Effect -->
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-transparent dark:from-blue-900/10 dark:to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <!-- Icon Container (100x100px) -->
                    <div class="relative w-[100px] h-[100px] mb-6 rounded-2xl bg-gray-50 dark:bg-gray-700/50 flex items-center justify-center p-4 shadow-inner group-hover:scale-105 transition-transform duration-300 group-hover:bg-white dark:group-hover:bg-gray-700">
                        @if($previewUrl)
                            <img src="{{ $previewUrl }}" 
                                 alt="{{ $module->name }}" 
                                 class="w-full h-full object-contain drop-shadow-sm transition-all duration-300" 
                                 onerror="this.onerror=null;this.src='{{ $placeholderDataUri }}';">
                        @elseif($module->icon && !Str::contains($module->icon, ['/', '\\']))
                            <!-- Dynamic SVG Icons for 'home', 'database', etc. -->
                            <div class="w-12 h-12 text-blue-600 dark:text-blue-400">
                                @if($module->icon === 'home')
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>
                                @elseif($module->icon === 'database')
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" /></svg>
                                @elseif($module->icon === 'users')
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                                @else
                                    <!-- Generic Fallback Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                                @endif
                            </div>
                        @else
                            <img src="{{ $placeholderDataUri }}" alt="Placeholder" class="w-full h-full object-contain">
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="relative z-10 w-full">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors line-clamp-2">
                            {{ $module->name }}
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-3 leading-relaxed px-2">
                            {{ $module->description ?? 'Tidak ada deskripsi tersedia untuk modul ini.' }}
                        </p>
                    </div>

                    <!-- External Link Indicator (Optional, subtle) -->
                    @if($module->tab_type === 'new' || Str::startsWith($module->url, ['http://', 'https://']))
                    <div class="absolute top-4 right-4 text-gray-300 dark:text-gray-600 group-hover:text-blue-500 dark:group-hover:text-blue-400 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </div>
                    @endif
                </a>
            @endif
            @empty
                <div class="col-span-full flex flex-col items-center justify-center py-20 text-center">
                    <div class="w-24 h-24 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-10 h-10 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tidak ada modul ditemukan</h3>
                    <p class="text-gray-500 dark:text-gray-400 mt-2 max-w-sm">Coba sesuaikan kata kunci pencarian Anda atau hubungi administrator untuk akses modul.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-dashboard-layout>