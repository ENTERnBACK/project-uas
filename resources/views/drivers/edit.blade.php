<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Driver</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 p-8">

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-blue-100">
        
        <!-- Header Halaman -->
        <div class="mb-6 border-b border-blue-100 pb-4">
            <div class="flex items-center gap-3 mb-2">
                <span class="text-4xl">🚗🏍️</span>
                <h1 class="text-2xl font-bold text-blue-700">Ubah Data Driver</h1>
            </div>
            <p class="text-sm text-gray-500">Perbarui informasi profil atau status operasional dari driver <strong>{{ $driver->nama }}</strong></p>
        </div>

        <form action="/drivers/{{ $driver->id }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Baris 1: Nama Lengkap -->
            <div>
                <label class="block text-sm font-semibold text-blue-700 mb-1">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ $driver->nama }}" required 
                       class="w-full border border-blue-200 p-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>

            <!-- Baris 2: Email & Telepon - Readonly -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 opacity-70">
                <div>
                    <label class="block text-sm font-semibold text-blue-700 mb-1">Alamat Email (Tidak dapat diubah)</label>
                    <input type="email" value="{{ $driver->email }}" readonly 
                           class="w-full bg-blue-50 border border-blue-200 p-2.5 rounded-lg cursor-not-allowed focus:outline-none text-gray-600">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-blue-700 mb-1">Nomor Telepon (Tidak dapat diubah)</label>
                    <input type="text" value="{{ $driver->no_telepon }}" readonly 
                           class="w-full bg-blue-50 border border-blue-200 p-2.5 rounded-lg cursor-not-allowed focus:outline-none text-gray-600">
                </div>
            </div>

            <!-- Baris 3: Kendaraan - Readonly -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 opacity-70">
                <div>
                    <label class="block text-sm font-semibold text-blue-700 mb-1">Jenis Layanan Gojek (Tidak dapat diubah)</label>
                    <input type="text" value="{{ $driver->jenis_kendaraan == 'GoRide' ? '🏍️ GoRide' : '🚗 GoCar' }}" readonly 
                           class="w-full bg-blue-50 border border-blue-200 p-2.5 rounded-lg cursor-not-allowed focus:outline-none text-gray-600">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-blue-700 mb-1">Plate Nomor (Tidak dapat diubah)</label>
                    <input type="text" value="{{ $driver->plate_nomor }}" readonly 
                           class="w-full bg-blue-50 border border-blue-200 p-2.5 rounded-lg cursor-not-allowed focus:outline-none text-gray-600 uppercase">
                </div>
            </div>

            <!-- Baris 4: Status -->
            <div>
                <label class="block text-sm font-semibold text-blue-700 mb-1">Status Kesiapan Operasional</label>
                <select name="status" required 
                        class="w-full border border-blue-200 p-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-white">
                    <option value="aktif" {{ $driver->status == 'aktif' ? 'selected' : '' }}>Aktif (Langsung Bisa Mengambil Orderan)</option>
                    <option value="nonaktif" {{ $driver->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif (Suspended / Libur)</option>
                </select>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end gap-3 pt-4 border-t border-blue-100">
                <a href="/drivers" class="bg-gray-200 text-gray-700 px-5 py-2.5 rounded-lg font-medium hover:bg-gray-300 transition text-sm">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition text-sm shadow">
                    Perbarui Data
                </button>
            </div>
        </form>

    </div>

</body>
</html>