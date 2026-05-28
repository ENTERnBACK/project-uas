</div>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Profil Driver</title>
    <!-- Menggunakan Tailwind CSS via CDN -->
    <script src="https://tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md border border-gray-100">
        
        <!-- Header Halaman -->
        <div class="mb-6 border-b border-gray-100 pb-4 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Profil Lengkap Driver</h1>
                <p class="text-sm text-gray-500">Informasi personal dan operasional mitra Gojek</p>
            </div>
            <!-- Badge Status -->
            <span class="px-3 py-1.5 rounded-full text-xs font-bold {{ $driver->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                ID: #{{ $driver->id }} — {{ ucfirst($driver->status) }}
            </span>
        </div>

        <!-- Kartu Informasi Detail -->
        <div class="divide-y divide-gray-100">
            
            <!-- Baris 1: Nama -->
            <div class="py-3.5 grid grid-cols-3 gap-4">
                <span class="text-sm font-semibold text-gray-500">Nama Lengkap</span>
                <span class="text-sm font-medium text-gray-900 col-span-2">{{ $driver->nama }}</span>
            </div>

            <!-- Baris 2: Email -->
            <div class="py-3.5 grid grid-cols-3 gap-4">
                <span class="text-sm font-semibold text-gray-500">Alamat Email</span>
                <span class="text-sm text-gray-800 col-span-2 font-mono">{{ $driver->email }}</span>
            </div>

            <!-- Baris 3: Nomor Telepon -->
            <div class="py-3.5 grid grid-cols-3 gap-4">
                <span class="text-sm font-semibold text-gray-500">Nomor Telepon</span>
                <span class="text-sm text-gray-800 col-span-2">{{ $driver->no_telepon }}</span>
            </div>

            <!-- Baris 4: Layanan Kendaraan -->
            <div class="py-3.5 grid grid-cols-3 gap-4">
                <span class="text-sm font-semibold text-gray-500">Jenis Layanan</span>
                <div class="col-span-2">
                    <span class="px-2.5 py-1 rounded text-xs font-bold {{ $driver->jenis_kendaraan == 'GoRide' ? 'bg-orange-100 text-orange-700' : 'bg-blue-100 text-blue-700' }}">
                        {{ $driver->jenis_kendaraan }}
                    </span>
                </div>
            </div>

            <!-- Baris 5: Plat Nomor -->
            <div class="py-3.5 grid grid-cols-3 gap-4">
                <span class="text-sm font-semibold text-gray-500">Nomor Plat Kendaraan</span>
                <span class="text-sm font-mono font-bold text-gray-800 col-span-2 uppercase">{{ $driver->plat_nomor }}</span>
            </div>

            <!-- Baris 6: Alamat Domisili -->
            <div class="py-3.5 grid grid-cols-3 gap-4">
                <span class="text-sm font-semibold text-gray-500">Alamat Lengkap</span>
                <span class="text-sm text-gray-600 col-span-2 leading-relaxed">{{ $driver->alamat }}</span>
            </div>

            <!-- Baris 7: Tanggal Terdaftar -->
            <div class="py-3.5 grid grid-cols-3 gap-4">
                <span class="text-sm font-semibold text-gray-500">Bergabung Pada</span>
                <span class="text-sm text-gray-400 col-span-2">{{ $driver->created_at->format('d F Y, H:i') }} WIB</span>
            </div>

        </div>

        <!-- Bagian Tombol Aksi Bawah -->
        <div class="flex justify-between items-center pt-6 mt-6 border-t border-gray-100">
            <!-- Kembali ke tabel indeks -->
            <a href="/drivers" class="text-green-600 hover:text-green-700 font-semibold text-sm flex items-center gap-1 transition">
                &larr; Kembali ke Daftar
            </a>
            <!-- Navigasi cepat ke halaman edit -->
            <a href="/drivers/{{ $driver->id }}/edit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-semibold text-sm transition shadow-sm">
                Edit Profil Ini
            </a>
        </div>

    </div>

</body>
</html>
</div>