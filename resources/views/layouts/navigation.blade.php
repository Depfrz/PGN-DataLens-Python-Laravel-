<nav x-data="{ open: false, logoutConfirmOpen: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-xs">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-xs leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <x-dropdown-link href="#" @click.prevent="logoutConfirmOpen = true">
                            {{ __('Logout') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @can('view module integrasi-sistem')
            <x-responsive-nav-link :href="route('integrasi-sistem.index')" :active="request()->routeIs('integrasi-sistem.*')">
                {{ __('Integrasi Sistem') }}
            </x-responsive-nav-link>
            @endcan

            @can('view module management-user')
            <x-responsive-nav-link :href="route('management-user.index')" :active="request()->routeIs('management-user')">
                {{ __('Management User') }}
            </x-responsive-nav-link>
            @endcan

            @can('view module history')
            <x-responsive-nav-link :href="route('history.index')" :active="request()->routeIs('history.*')">
                {{ __('Data History') }}
            </x-responsive-nav-link>
            @endcan
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-sm text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-xs text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="#" @click.prevent="logoutConfirmOpen = true">
                    {{ __('Logout') }}
                </x-responsive-nav-link>
            </div>
        </div>
    </div>

    <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
        @csrf
    </form>

    <div x-show="logoutConfirmOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-cloak 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0" 
         style="display: none;">
        
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" @click="logoutConfirmOpen = false"></div>

        <!-- Modal Panel -->
        <div x-show="logoutConfirmOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             role="dialog" 
             aria-modal="true" 
             class="relative transform overflow-hidden rounded-2xl bg-white px-4 pb-4 pt-5 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md sm:p-6 ring-1 ring-black/5">
            
            <div class="flex flex-col items-center justify-center text-center p-4">
                <h3 class="text-2xl font-black text-gray-900 mb-8" id="modal-title">
                    Apakah Anda Yakin<br>Ingin Logout?
                </h3>
                
                <div class="flex gap-6 w-full justify-center">
                    <button type="button" 
                            class="inline-flex w-32 justify-center items-center rounded-full bg-[#84cc16] px-6 py-3 text-lg font-bold text-white shadow-md hover:bg-[#65a30d] transition-transform transform hover:scale-105 focus:outline-none"
                            @click="logoutConfirmOpen = false; document.getElementById('logout-form').submit()">
                        Ya
                    </button>
                    <button type="button" 
                            class="inline-flex w-32 justify-center items-center rounded-full bg-[#A0522D] px-6 py-3 text-lg font-bold text-white shadow-md hover:bg-[#8B4513] transition-transform transform hover:scale-105 focus:outline-none"
                            @click="logoutConfirmOpen = false">
                        Tidak
                    </button>
                </div>
            </div>
        </div>
    </div>
</nav>
