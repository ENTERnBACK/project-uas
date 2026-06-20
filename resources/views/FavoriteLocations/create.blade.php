</div>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Lokasi Favorit</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900 min-h-screen p-4">
    <div class="max-w-2xl mx-auto space-y-8">
        
        <div class="bg-white p-6 rounded-lg shadow-md transition duration-300 hover:shadow-xl">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">➕ Tambah Lokasi Favorit</h1>
            <p class="text-gray-500 text-sm mb-6">Simpan tempat yang sering Anda kunjungi.</p>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('favorite-locations.store') }}" method="POST">
                @csrf 
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Label Tempat</label>
                    <input type="text" name="label" value="{{ old('label') }}" class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Rumah, Kantor" required>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Lengkap</label>
                    <textarea name="alamat" rows="4" class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" required>{{ old('alamat') }}</textarea>
                </div>
                <div class="flex justify-end gap-3">
                    <a href="{{ route('favorite-locations.index') }}" class="px-4 py-2 border rounded-md text-gray-700 hover:bg-gray-50">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan Lokasi</button>
                </div>
            </form>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Daftar Lokasi Tersimpan</h2>
            <table class="w-full text-left border-collapse border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 border">No</th>
                        <th class="p-3 border">Label</th>
                        <th class="p-3 border">Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($locations as $index => $loc)
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 border text-center">{{ $index + 1 }}</td>
                        <td class="p-3 border font-medium">{{ $loc->label }}</td>
                        <td class="p-3 border">{{ $loc->alamat }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-500">Belum ada lokasi tersimpan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
</div>