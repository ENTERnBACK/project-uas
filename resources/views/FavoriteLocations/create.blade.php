<div>
    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Lokasi Favorit</title>
    <!-- Tailwind CSS untuk styling cepat dan modern -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900 min-h-screen">
<div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md transition duration-300 hover:shadow-xl">
        
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">➕ Tambah Lokasi Favorit</h1>
            <p class="text-gray-500 text-sm">Simpan tempat yang sering Anda kunjungi untuk mempermudah akses.</p>
        </div>

        <!-- Form Tambah Data -->
        <!-- Action diarahkan ke fungsi store() di Controller -->
        <form action="{{ route('favorite-locations.store') }}" method="POST">
            @csrf <!-- Token keamanan wajib Laravel -->

            <!-- Input Label Tempat -->
            <div class="mb-4">
                <label for="label" class="block text-sm font-semibold text-gray-700 mb-1">Label Tempat</label>
                <input 
                    type="text" 
                    name="label" 
                    id="label" 
                    value="{{ old('label') }}"
                    class="w-full px-3 py-2 border @error('label') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm" 
                    placeholder="Contoh: Rumah, Kosan, Kantor"
                    required
                >
                <!-- Menampilkan pesan error validasi jika input tidak sesuai -->
                @error('label')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input Alamat Lengkap -->
            <div class="mb-6">
                <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-1">Alamat Lengkap</label>
                <textarea 
                    name="alamat" 
                    id="alamat" 
                    rows="4"
                    class="w-full px-3 py-2 border @error('alamat') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm" 
                    placeholder="Tuliskan nama jalan, nomor rumah, RT/RW, dan kecamatan..."
                    required
                >{{ old('alamat') }}</textarea>
                <!-- Menampilkan pesan error validasi jika input tidak sesuai -->
                @error('alamat')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center justify-end space-x-3 border-t border-gray-100 pt-4">
                <!-- Tombol Batal -->
                <a href="{{ route('favorite-locations.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition duration-150">
                    Batal
                </a>
                <!-- Tombol Simpan -->
                <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 cursor-pointer transition duration-150 hover:scale-105">
                    Simpan Lokasi
                </button>
            </div>

        </form>

    </div>

</body>
</html>

</div>
