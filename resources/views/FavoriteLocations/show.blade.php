<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Lokasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900 min-h-screen">

    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">🔍 Detail Lokasi</h1>
            <a href="{{ route('favorite-locations.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                ← Kembali ke Daftar
            </a>
        </div>

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
                    <span>{{ $location->created_at ? $location->created_at->translatedFormat('d F Y, H:i') : '-' }}</span>
                </div>
                <div class="pt-2">
                    <span class="block font-medium">Terakhir Diperbarui:</span>
                    <span>{{ $location->updated_at ? $location->updated_at->translatedFormat('d F Y, H:i') : '-' }}</span>
                </div>
            </div>
        </div>

        <div class="mt-8 flex space-x-3">
            <a href="{{ route('favorite-locations.edit', $location->id) }}" class="flex-1 text-center bg-amber-500 hover:bg-amber-600 text-white py-2 px-4 rounded-md font-semibold transition">
                Edit Data
            </a>
            <form action="{{ route('favorite-locations.destroy', $location->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus lokasi ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md font-semibold transition">
                    Hapus
                </button>
            </form>
        </div>
    </div>

</body>
</html>