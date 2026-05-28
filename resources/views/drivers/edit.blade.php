<div>
    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Driver</title>
    <!-- Menggunakan Tailwind CSS via CDN -->
    <script src="https://tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md border border-gray-100">
        
        <!-- Header Halaman -->
        <div class="mb-6 border-b border-gray-100 pb-4">
            <h1 class="text-2xl font-bold text-gray-800">Ubah Data Driver</h1>
            <p class="text-sm text-gray-500">Perbarui informasi profil atau status operasional dari driver <strong>{{ $driver->nama }}</strong></p>
        </div>

        <!-- Form Mengarah ke fungsi update() di DriverController -->
        <form action="/drivers/{{ $driver->id }}" method="POST" class="space-y-5">
            @csrf          <!-- Token keamanan Laravel -->
            @method('PUT') <!-- Wajib ada di Laravel untuk proses Update/Edit data -->

            <!-- Baris 1: Nama Lengkap -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ $driver->nama }}" required 
                       class="w-full border border-gray-300 p-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition">
            </div>

            <!-- Catatan: Berdasarkan kode DriverController Anda, fungsi update() hanya memproses perubahan kolom 'nama' dan 'status'. Namun jika di masa depan Anda ingin memperbarui field lain, komponen form-nya sudah siap di bawah ini. -->

            <!-- Baris 2: Kontak (Email dan No. Telepon) - Terkunci (Disabled/Readonly) agar tidak asal diubah -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 opacity-70">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Email (Tidak dapat diubah)</label>
                    <input type="email" value="{{ $driver->email }}" readonly 
                           class="w-full bg-gray-100 border border-gray-300 p-2.5 rounded-lg cursor-not-allowed focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor Telepon (Tidak dapat diubah)</label>
                    <input type="text" value="{{ $driver->no_telepon }}" readonly 
                           class="w-full bg-gray-100 border border-gray-300 p-2.5 rounded-lg cursor-not-allowed focus:outline-none">
                </div>
            </div>

            <!-- Baris 3: Atribut Kendaraan (Layanan & Plat) - Terkunci (Disabled/Readonly) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 opacity-70">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Layanan Gojek (Tidak dapat diubah)</label>
                    <input type="text" value="{{ $driver->jenis_kendaraan }}" readonly 
                           class="w-full bg-gray-100 border border-gray-300 p-2.5 rounded-lg cursor-not-allowed focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Plat Nomor (Tidak dapat diubah)</label>
                    <input type="text" value="{{ $driver->plat_nomor }}" readonly 
                           class="w-full bg-gray-100 border border-gray-300 p-2.5 rounded-lg cursor-not-allowed focus:outline-none uppercase">
                </div>
            </div>

            <!-- Baris 4: Status Operasional (Ini fitur utama yang diproses oleh Controller Anda) -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Status Kesiapan Operasional</label>
                <select name="status" required 
                        class="w-full border border-gray-300 p-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition bg-white">
                    <option value="aktif" {{ $driver->status == 'aktif' ? 'selected' : '' }}>Aktif (Langsung Bisa Mengambil Orderan)</option>
                    <option value="nonaktif" {{ $driver->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif (Suspended / Libur)</option>
                </select>
            </div>

            <!-- Bagian Tombol Aksi -->
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <!-- Tombol Batal kembali ke tabel utama -->
                <a href="/drivers" class="bg-gray-200 text-gray-700 px-5 py-2.5 rounded-lg font-medium hover:bg-gray-300 transition text-sm">
                    Batal
                </a>
                <!-- Tombol Submit untuk menyimpan perubahan -->
                <button type="submit" class="bg-yellow-500 text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-yellow-600 transition text-sm shadow">
                    Perbarui Data
                </button>
            </div>
        </form>

    </div>

</body>
</html>

</div>
