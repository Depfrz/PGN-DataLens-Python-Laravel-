<x-dashboard-layout>
    <div class="bg-white rounded-[10px] p-4 lg:p-8 min-h-[800px] flex flex-col">
        <!-- Page Title -->
        <h1 class="text-[24px] lg:text-[32px] font-bold text-black mb-6">Manajemen Modul Aplikasi</h1>

        <!-- Action Bar -->
        <div class="flex flex-col lg:flex-row items-center justify-between mb-8 gap-4">
            <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-4 w-full lg:w-auto">
                <!-- Delete Module Button -->
                <button class="w-full sm:w-auto bg-[#cd0d10] text-white text-[18px] lg:text-[20px] font-bold px-8 py-3 rounded-[15px] hover:bg-red-700 transition-colors">
                    Hapus Modul
                </button>
                
                <!-- Add Module Button -->
                <button class="w-full sm:w-auto bg-[#0dcd4d] text-white text-[18px] lg:text-[20px] font-bold px-8 py-3 rounded-[15px] hover:bg-green-600 transition-colors">
                    Tambah Modul
                </button>
            </div>

            <!-- Search Bar -->
            <div class="relative w-full lg:w-[420px]">
                <input type="text" 
                       placeholder="Cari Modul..." 
                       class="w-full bg-[#d9d9d9] text-black text-[18px] lg:text-[20px] font-bold placeholder-black px-6 py-3 rounded-[15px] border-none focus:ring-2 focus:ring-blue-500 pr-12">
                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 text-black">
                        <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Empty State Container -->
        <div class="flex-1 border border-black rounded-[15px] flex flex-col items-center justify-center p-4 lg:p-12 text-center min-h-[500px]">
            <!-- Database Error Illustration -->
            <div class="mb-8 relative w-[150px] h-[150px] lg:w-[200px] lg:h-[200px]">
                <!-- Cylinder Top -->
                <svg width="100%" height="100%" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Database Shape -->
                    <path d="M100 40C144.183 40 180 53.4315 180 70C180 86.5685 144.183 100 100 100C55.8172 100 20 86.5685 20 70C20 53.4315 55.8172 40 100 40Z" stroke="black" stroke-width="3"/>
                    <path d="M20 70V130C20 146.569 55.8172 160 100 160C115.65 160 130.245 158.33 142.866 155.378" stroke="black" stroke-width="3"/>
                    <path d="M180 70V114.45" stroke="black" stroke-width="3"/>
                    <path d="M20 100C20 100 55.8172 130 100 130C125.795 130 148.749 125.178 164.711 117.43" stroke="black" stroke-width="3"/>
                    
                    <!-- X Mark -->
                    <line x1="140" y1="140" x2="190" y2="190" stroke="black" stroke-width="3" stroke-linecap="round"/>
                    <line x1="190" y1="140" x2="140" y2="190" stroke="black" stroke-width="3" stroke-linecap="round"/>
                </svg>
            </div>

            <!-- Empty Text -->
            <h2 class="text-[20px] lg:text-[32px] font-bold text-black max-w-4xl leading-tight">
                Daftar aplikasi PGN One Portal masih kosong. Yuk, tambahkan modul atau sistem pertama Anda agar bisa diakses oleh pengguna.
            </h2>
        </div>
    </div>
</x-dashboard-layout>
