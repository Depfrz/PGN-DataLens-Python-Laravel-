<x-dashboard-layout>
    <div class="p-6">
        <div class="bg-white rounded-[10px] p-6 lg:p-10 min-h-[800px] flex flex-col relative">
            <!-- Back Button and Title -->
            <div class="flex items-center mb-8">
                <a href="{{ route('integrasi-sistem.index') }}" class="mr-4 hover:opacity-75 transition-opacity">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 12H5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 19L5 12L12 5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <h1 class="text-[32px] font-bold text-black">Tambah Modul Aplikasi</h1>
            </div>

            <!-- Form Container -->
            <div class="border border-black rounded-[15px] p-8 lg:p-10 w-full max-w-[1200px] mx-auto">
                <form action="{{ route('integrasi-sistem.store') }}" method="POST" 
                    x-data="{ 
                        categoryOpen: false, 
                        tabTypeOpen: false,
                        selectedCategory: '',
                        selectedTabType: '',
                        isImportant: true,
                        isSubmitting: false,
                        categories: ['Project Management Office', 'City Gas Project', 'Corporate Finance', 'Human Capital Management', 'Procurement', 'Information and Communication Technology'],
                        tabTypes: ['Current Tab', 'New tab (Blank)']
                    }"
                    @submit="isSubmitting = true">
                    @csrf

                    <!-- Nama Modul / Aplikasi -->
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-black mb-2">Nama Modul / Aplikasi</label>
                        <input type="text" name="name" placeholder="Contoh : Buku Saku Digital" 
                            class="w-full h-12 px-4 text-base font-normal border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 transition-all">
                    </div>

                    <!-- Deskripsi Singkat -->
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-black mb-2">Deskripsi Singkat</label>
                        <textarea name="description" rows="4" placeholder='Contoh: "Panduan teknis lapangan untuk QAQC." (Maks 100-150 karakter).'
                            class="w-full p-4 text-base font-normal border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 resize-none transition-all"></textarea>
                    </div>

                    <!-- Kategori -->
                    <div class="mb-6 relative">
                        <label class="block text-sm font-bold text-black mb-2">Kategori</label>
                        <div class="relative">
                            <button type="button" @click="categoryOpen = !categoryOpen" @click.outside="categoryOpen = false"
                                class="w-full h-12 px-4 text-left border border-gray-300 rounded-lg flex items-center justify-between bg-white focus:ring-2 focus:ring-blue-500 transition-all">
                                <span class="text-base font-normal" :class="selectedCategory ? 'text-black' : 'text-gray-400'" x-text="selectedCategory || 'Pilih kategori...'"></span>
                                <svg class="w-5 h-5 transform transition-transform duration-200 text-gray-500" :class="categoryOpen ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div x-show="categoryOpen" 
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute z-10 w-full mt-1 bg-white border border-gray-200 rounded-lg shadow-lg max-h-[300px] overflow-y-auto">
                                <template x-for="category in categories" :key="category">
                                    <div @click="selectedCategory = category; categoryOpen = false" 
                                        class="px-4 py-3 text-sm hover:bg-blue-50 hover:text-blue-600 cursor-pointer transition-colors"
                                        :class="selectedCategory === category ? 'bg-blue-50 text-blue-600' : 'text-gray-700'">
                                        <span x-text="category"></span>
                                    </div>
                                </template>
                            </div>
                            <input type="hidden" name="category" :value="selectedCategory">
                        </div>
                    </div>

                    <!-- Target URL / Endpoint -->
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-black mb-2">Target URL / Endpoint</label>
                        <input type="text" name="url" placeholder="Contoh Internal / Eksternal: /buku-saku atau https://dashboard-pertamina.com" 
                            class="w-full h-12 px-4 text-base font-normal border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 transition-all">
                    </div>

                    <!-- Tipe Tab -->
                    <div class="mb-6 relative">
                        <label class="block text-sm font-bold text-black mb-2">Tipe Tab</label>
                        <div class="relative">
                            <button type="button" @click="tabTypeOpen = !tabTypeOpen" @click.outside="tabTypeOpen = false"
                                class="w-full h-12 px-4 text-left border border-gray-300 rounded-lg flex items-center justify-between bg-white focus:ring-2 focus:ring-blue-500 transition-all">
                                <span class="text-base font-normal" :class="selectedTabType ? 'text-black' : 'text-gray-400'" x-text="selectedTabType || 'Pilih tipe tab...'"></span>
                                <svg class="w-5 h-5 transform transition-transform duration-200 text-gray-500" :class="tabTypeOpen ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div x-show="tabTypeOpen" 
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute z-10 w-full mt-1 bg-white border border-gray-200 rounded-lg shadow-lg">
                                <template x-for="type in tabTypes" :key="type">
                                    <div @click="selectedTabType = type; tabTypeOpen = false" 
                                        class="px-4 py-3 text-sm hover:bg-blue-50 hover:text-blue-600 cursor-pointer transition-colors"
                                        :class="selectedTabType === type ? 'bg-blue-50 text-blue-600' : 'text-gray-700'">
                                        <span x-text="type"></span>
                                    </div>
                                </template>
                            </div>
                            <input type="hidden" name="tab_type" :value="selectedTabType">
                        </div>
                    </div>

                    <!-- Status Modul (Penting) -->
                    <div class="mb-8">
                        <label class="block text-sm font-bold text-gray-700 mb-3">Status Modul</label>
                        <div class="flex items-center cursor-pointer w-fit" @click="isImportant = !isImportant">
                            
                            <!-- Toggle Switch -->
                            <div class="relative w-14 h-8 rounded-full transition-colors duration-300 ease-in-out"
                                 :class="isImportant ? 'bg-green-500' : 'bg-gray-200'"
                                 :style="isImportant ? 'background-color: #22c55e;' : 'background-color: #e5e7eb;'">
                                <div class="absolute top-1 left-1 bg-white w-6 h-6 rounded-full shadow-md transition-all duration-300 ease-in-out"
                                     :style="isImportant ? 'transform: translateX(24px);' : 'transform: translateX(0);'"></div>
                            </div>
                            
                            <!-- Text Label -->
                            <div class="ml-3 select-none">
                                <span class="text-base font-bold transition-colors duration-300" 
                                      :class="isImportant ? 'text-green-600' : 'text-gray-500'"
                                      x-text="isImportant ? 'Penting' : 'Biasa'"></span>
                            </div>
                            
                            <!-- Hidden Input -->
                            <input type="checkbox" name="is_important" class="hidden" x-model="isImportant">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center">
                        <button type="submit" 
                            :disabled="isSubmitting"
                            :class="{'opacity-75 cursor-not-allowed scale-95': isSubmitting, 'hover:bg-green-700 hover:shadow-lg active:scale-95': !isSubmitting}"
                            style="background-color: #16a34a;" 
                            class="text-white text-lg font-bold px-8 py-2.5 rounded-lg transition-all shadow hover:shadow-md focus:ring-4 focus:ring-green-300 w-full sm:w-auto flex items-center justify-center space-x-2">
                            
                            <!-- Icon Plus (Default) -->
                            <svg x-show="!isSubmitting" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            
                            <!-- Loading Spinner -->
                            <svg x-show="isSubmitting" style="display: none;" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>

                            <span x-text="isSubmitting ? 'Menyimpan...' : 'Tambah Modul'"></span>
                        </button>
                    </div>                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>