</div>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Lokasi Favorit</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900 min-h-screen">
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md transition duration-300 hover:shadow-xl">
        <div class="flex justify-between items-center mb-6 border-b border-gray-100 pb-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">🔍 Detail Lokasi</h1>
                <p class="text-gray-500 text-sm">Informasi lengkap mengenai lokasi favorit Anda.</p>
            </div>
            <a href="{{ route('favorite-locations.index') }}" class="text-gray-500 hover:text-gray-700 text-sm font-medium transition duration-200 hover:underline">
                &larr; Kembali
            </a>
        </div>

        <div class="space-y-4">
            <div>
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-1">Nama / Label Tempat</span>
                <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800 shadow-sm">
                    {{ $favoriteLocation->label }}
                </span>
            </div>
            <div>
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-1">Alamat Lengkap</span>
                <div class="p-4 bg-gray-50 border border-gray-200 rounded-md text-gray-700 leading-relaxed whitespace-pre-line break-words">
                    {{ $favoriteLocation->alamat }}
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 text-xs text-gray-400 pt-2">
                <div>
                    <span class="block font-medium">Disimpan Pada:</span>
                    <span>{{ $favoriteLocation->created_at->translatedFormat('d F Y, H:i') }}</span>
                </div>
                <div>
                    <span class="block font-medium">Terakhir Diperbarui:</span>
                    <span>{{ $favoriteLocation->updated_at->translatedFormat('d F Y, H:i') }}</span>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between border-t border-gray-100 mt-6 pt-4">
            <a href="{{ route('favorite-locations.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md text-sm font-medium transition duration-150 shadow-sm">
                Kembali ke Daftar
            </a>
            <div class="flex items-center space-x-3">
                <a href="{{ route('favorite-locations.edit', $favoriteLocation->id) }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-md text-sm font-medium transition duration-150 hover:scale-105 shadow-sm">
                    Ubah Data
                </a>
                <form action="{{ route('favorite-locations.destroy', $favoriteLocation->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lokasi ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md text-sm font-medium cursor-pointer transition duration-150 hover:scale-105 shadow-sm">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
</div>