<div class="space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-1">Nama / Label Tempat</span>
                    <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800 shadow-sm">
                        {{ $location->label }}
                    </span>
                </div>
                
                @if($location->is_default)
                    <div class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-bold uppercase rounded-full border border-yellow-200">
                        Alamat Utama
                    </div>
                @endif
            </div>

            <div>
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-1">Alamat Lengkap</span>
                <div class="p-4 bg-gray-50 border border-gray-200 rounded-md text-gray-700 leading-relaxed whitespace-pre-line">
                    {{ $location->alamat }}
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 text-xs text-gray-400 pt-2 border-t border-gray-100 mt-4">
                <div class="pt-2">
                    <span class="block font-medium">Disimpan Pada:</span>
                    <span>{{ $location->created_at->translatedFormat('d F Y, H:i') }}</span>
                </div>
                <div class="pt-2">
                    <span class="block font-medium">Terakhir Diperbarui:</span>
                    <span>{{ $location->updated_at->translatedFormat('d F Y, H:i') }}</span>
                </div>
            </div>
        </div>