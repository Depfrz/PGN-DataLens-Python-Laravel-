<x-buku-saku-layout>
    <div class="mb-4">
        <h2 class="text-lg font-bold text-gray-800">Riwayat Dokumen</h2>
        <p class="text-gray-500 text-xs">Daftar dokumen yang telah Anda unggah.</p>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3 text-left text-sm font-bold text-gray-500 uppercase tracking-wider">
                            JUDUL DOKUMEN
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-sm font-bold text-gray-500 uppercase tracking-wider">
                            MASA BERLAKU
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-sm font-bold text-gray-500 uppercase tracking-wider">
                            TANGGAL UPLOAD
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($documents as $doc)
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="ml-2">
                                    <div class="text-base font-bold text-gray-900">
                                        <a href="{{ route('buku-saku.preview', $doc->id) }}" target="_blank" class="hover:text-blue-600 hover:underline">
                                            {{ $doc->title }}
                                        </a>
                                    </div>
                                    <div class="text-sm text-gray-500 truncate max-w-xs">{{ $doc->description }}</div>
                                </div>
                            </div>
                        </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                        @if($doc->valid_until)
                                            @php
                                                $now = \Carbon\Carbon::now();
                                                $diffInYears = $now->floatDiffInYears($doc->valid_until, false);
                                            @endphp
                                            
                                            @if($diffInYears < 0)
                                                <span class="text-red-600">
                                                    Status: Expired ({{ $doc->valid_until->format('d M Y') }})
                                                </span>
                                            @elseif($diffInYears <= 1)
                                                <span class="text-red-600">
                                                    Status: <span class="countdown-timer" data-target="{{ $doc->valid_until->toIso8601String() }}">Hitung mundur...</span>
                                                </span>
                                            @else
                                                <span class="text-green-600">
                                                    Status: Masih Berlaku ({{ $doc->valid_until->format('d M Y') }})
                                                </span>
                                            @endif
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 font-semibold">
                            {{ $doc->created_at->format('d/m/Y') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @if($documents->isEmpty())
        <div class="text-center py-10 text-gray-500">
            Anda belum mengunggah dokumen apapun.
        </div>
        @endif
    </div>
</x-buku-saku-layout>