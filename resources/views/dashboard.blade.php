<x-dashboard-layout>
    <div class="bg-white rounded-[10px] p-8 min-h-[800px]">
        <!-- Welcome Message -->
        <h1 class="text-[32px] lg:text-[36px] font-semibold text-black mb-12">Selamat Datang, {{ Auth::user()->name ?? 'Admin' }}.</h1>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Card 1: Buku Saku -->
            <div class="flex flex-col items-center text-center">
                <!-- Badge -->
                <div class="bg-[#0643fb] text-white rounded-[15px] px-8 py-3 mb-4 flex items-center shadow-md min-w-[200px] justify-center z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                    <span class="font-bold text-[20px]">Buku Saku</span>
                </div>
                <!-- Content Box -->
                <div class="bg-[#fcf9f9] rounded-[10px] p-8 w-full h-[500px] flex items-start justify-center pt-12">
                    <p class="text-[24px] font-bold text-black max-w-[260px] leading-relaxed">
                        Penjelasan Detail Mengenai Buku Saku
                    </p>
                </div>
            </div>

            <!-- Card 2: List Pengawas -->
            <div class="flex flex-col items-center text-center">
                <!-- Badge -->
                <div class="bg-[#fb060a] text-white rounded-[15px] px-8 py-3 mb-4 flex items-center shadow-md min-w-[200px] justify-center z-10">
                    <span class="font-bold text-[20px]">List Pengawas</span>
                </div>
                <!-- Content Box -->
                <div class="bg-[#fcf9f9] rounded-[10px] p-8 w-full h-[500px] flex items-start justify-center pt-12">
                    <p class="text-[24px] font-bold text-black max-w-[260px] leading-relaxed">
                        List Pengawas yang sedang aktif
                    </p>
                </div>
            </div>

            <!-- Card 3: Riwayat Terbaru -->
            <div class="flex flex-col items-center text-center">
                <!-- Badge -->
                <div class="bg-[#30ff07] text-white rounded-[15px] px-8 py-3 mb-4 flex items-center shadow-md min-w-[200px] justify-center z-10">
                    <span class="font-bold text-[20px]">Riwayat Terbaru</span>
                </div>
                <!-- Content Box -->
                <div class="bg-[#fcf9f9] rounded-[10px] p-8 w-full h-[500px] flex items-start justify-center pt-12">
                    <p class="text-[24px] font-bold text-black max-w-[300px] leading-relaxed">
                        Riwayat Terbaru Mengenai Tambahan Model/Edit/Hapus Beserta informasi waktu
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
