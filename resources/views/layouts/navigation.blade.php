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
</nav>
