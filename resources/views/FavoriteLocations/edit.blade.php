</div>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lokasi Favorit</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900 min-h-screen p-4">
    
    <div class="max-w-xl mx-auto space-y-8">
        
        <div class="bg-white p-6 rounded-lg shadow-md transition duration-300 hover:shadow-xl">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">✏️ Edit Lokasi Favorit</h1>
                <p class="text-gray-500 text-sm">Ubah informasi label atau alamat lengkap lokasi Anda.</p>
            </div>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('favorite-locations.update', $favoriteLocation->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="label" class="block text-sm font-semibold text-gray-700 mb-1">Label Tempat</label>
                    <input type="text" name="label" id="label" value="{{ old('label', $favoriteLocation->label) }}"
                        class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="mb-6">
                    <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-1">Alamat Lengkap</label>
                    <textarea name="alamat" id="alamat" rows="4"
                        class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" required>{{ old('alamat', $favoriteLocation->alamat) }}</textarea>
                </div>

                <div class="flex items-center justify-end space-x-3 border-t border-gray-100 pt-4">
                    <a href="{{ route('favorite-locations.index') }}" class="px-4 py-2 border rounded-md text-sm text-gray-700 hover:bg-gray-50">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan Perubahan</button>
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
                    <tr class="{{ $loc->id == $favoriteLocation->id ? 'bg-blue-50 font-semibold' : '' }} hover:bg-gray-50">
                        <td class="p-3 border text-center">{{ $index + 1 }}</td>
                        <td class="p-3 border">{{ $loc->label }}</td>
                        <td class="p-3 border">{{ $loc->alamat }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="p-4 text-center text-gray-500">Belum ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
</div>