<div>
   <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Driver Baru</title>
    <!-- Menggunakan Tailwind CSS via CDN -->
    <script src="https://tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md border border-gray-100">
        
        <!-- Header Halaman -->
        <div class="mb-6 border-b border-gray-100 pb-4">
            <h1 class="text-2xl font-bold text-gray-800">Formulir Pendaftaran Driver</h1>
            <p class="text-sm text-gray-500">Masukkan informasi lengkap calon driver untuk disimpan ke dalam pangkalan data</p>
        </div>

        <!-- Form Mengarah ke fungsi store() di DriverController -->
        <form action="/drivers" method="POST" class="space-y-5">
            @csrf <!-- Wajib ada di Laravel untuk keamanan token CSRF -->

            <!-- Baris 1: Nama Lengkap -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="nama" required placeholder="Masukkan nama lengkap driver" 
                       class="w-full border border-gray-300 p-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition">
            </div>

            <!-- Baris 2: Kontak (Email dan No. Telepon) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Email</label>
                    <input type="email" name="email" required placeholder="contoh@gmail.com" 
                           class="w-full border border-gray-300 p-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor Telepon</label>
                    <input type="text" name="no_telepon" required placeholder="Contoh: 081234567XXX" 
                           class="w-full border border-gray-300 p-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition">
                </div>
            </div>

            <!-- Baris 3: Alamat Lengkap -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Domisili Sekarang</label>
                <textarea name="alamat" required rows="3" placeholder="Tuliskan alamat lengkap beserta kota asal" 
                          class="w-full border border-gray-300 p-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"></textarea>
            </div>

            <!-- Baris 4: Atribut Kendaraan (Layanan & Plat) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Layanan Gojek</label>
                    <select name="jenis_kendaraan" required 
                            class="w-full border border-gray-300 p-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition bg-white">
                        <option value="GoRide">GoRide (Sepeda Motor)</option>
                        <option value="GoCar">GoCar (Mobil Penumpang)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor Registrasi Kendaraan (Plat Nomor)</label>
                    <input type="text" name="plat_nomor" required placeholder="Contoh: B 1234 ABC" 
                           class="w-full border border-gray-300 p-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition uppercase">
                </div>
            </div>

            <!-- Baris 5: Status Awal Akun -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Status Kesiapan Operasional</label>
                <select name="status" required 
                        class="w-full border border-gray-300 p-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition bg-white">
                    <option value="nonaktif">Nonaktif (Dalam Proses Verifikasi)</option>
                    <option value="aktif">Aktif (Langsung Bisa Mengambil Orderan)</option>
                </select>
            </div>

            <!-- Bagian Tombol Aksi -->
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <!-- Tombol Batal kembali ke tabel utama -->
                <a href="/drivers" class="bg-gray-200 text-gray-700 px-5 py-2.5 rounded-lg font-medium hover:bg-gray-300 transition text-sm">
                    Batal
                </a>
                <!-- Tombol Submit untuk menyimpan -->
                <button type="submit" class="bg-green-600 text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-green-700 transition text-sm shadow">
                    Daftarkan Driver
                </button>
            </div>
        </form>

    </div>

</body>
</html>
</div>
