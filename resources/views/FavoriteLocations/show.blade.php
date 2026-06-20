</div>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Lokasi: {{ $location->label }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900 min-h-screen p-4">

    <div class="max-w-2xl mx-auto mt-10 bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6 text-white flex justify-between items-center">
            <h1 class="text-xl font-bold tracking-tight">🔍 Detail Lokasi</h1>
            <a href="{{ route('favorite-locations.index') }}" class="text-blue-100 hover:text-white text-sm font-medium transition">
                ← Kembali ke Daftar
            </a>
        </div>

        <div class="p-6 space-y-8">
            <div class="flex items-start justify-between">
                <div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 block">Label Tempat</span>
                    <span class="inline-flex items-center px-4 py-1.5 rounded-full bg-blue-50 text-blue-700 font-bold border border-blue-100 shadow-sm">
                        {{ $location->label }}
                    </span>
                </div>
                
                @if(isset($location->is_default) && $location->is_default)
                    <div class="px-3 py-1 bg-amber-100 text-amber-800 text-[10px] font-black uppercase tracking-wider rounded-lg border border-amber-200">
                        Alamat Utama
                    </div>
                @endif
            </div>

            <div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 block">Alamat Lengkap</span>
                <div class="p-5 bg-gray-50 border border-gray-100 rounded-xl text-gray-700 leading-relaxed italic font-medium">
                    "{{ $location->alamat }}"
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 pt-4 border-t border-gray-100">
                <div class="text-xs">
                    <span class="block font-bold text-gray-400 uppercase text-[9px]">Dibuat Pada</span>
                    <span class="text-gray-600">{{ $location->created_at ? $location->created_at->translatedFormat('d F Y, H:i') : '-' }}</span>
                </div>
                <div class="text-xs">
                    <span class="block font-bold text-gray-400 uppercase text-[9px]">Diperbarui</span>
                    <span class="text-gray-600">{{ $location->updated_at ? $location->updated_at->translatedFormat('d F Y, H:i') : '-' }}</span>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 p-6 flex space-x-4 border-t border-gray-100">
            <a href="{{ route('favorite-locations.edit', $location->id) }}" 
               class="flex-1 text-center bg-white border border-indigo-600 text-indigo-600 hover:bg-indigo-600 hover:text-white py-2.5 rounded-xl font-bold transition-all duration-200">
                Edit Data
            </a>
            <form action="{{ route('favorite-locations.destroy', $location->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus lokasi ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full bg-red-50 text-red-600 hover:bg-red-600 hover:text-white py-2.5 rounded-xl font-bold transition-all duration-200">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</body>
</html>
</div>