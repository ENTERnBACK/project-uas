</div>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Profil Driver</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 p-8">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-blue-100">
        <div class="mb-6 border-b border-blue-100 pb-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <span class="text-4xl">{{ $driver->jenis_kendaraan == 'GoRide' ? '🏍️' : '🚗' }}</span>
                <div>
                    <h1 class="text-2xl font-bold text-blue-700">Profil Lengkap Driver</h1>
                    <p class="text-sm text-gray-500">Informasi personal dan operasional mitra</p>
                </div>
            </div>
        </div>
  <div class="divide-y divide-blue-50">
            
            <div class="py-3.5 grid grid-cols-3 gap-4">
                <span class="text-sm font-semibold text-blue-600">Nama Lengkap</span>
                <span class="text-sm font-medium text-gray-900 col-span-2">{{ $driver->nama }}</span>
            </div>

            <div class="py-3.5 grid grid-cols-3 gap-4">
                <span class="text-sm font-semibold text-blue-600">Alamat Email</span>
                <span class="text-sm text-gray-800 col-span-2 font-mono">{{ $driver->email }}</span>
            </div>

            <div class="py-3.5 grid grid-cols-3 gap-4">
                <span class="text-sm font-semibold text-blue-600">Nomor Telepon</span>
                <span class="text-sm text-gray-800 col-span-2">{{ $driver->no_telepon }}</span>
            </div>

            <div class="py-3.5 grid grid-cols-3 gap-4">
                <span class="text-sm font-semibold text-blue-600">Jenis Layanan</span>
                <div class="col-span-2">
                    <span class="px-2.5 py-1 rounded text-xs font-bold {{ $driver->jenis_kendaraan == 'GoRide' ? 'bg-orange-100 text-orange-700' : 'bg-blue-100 text-blue-700' }}">
                        {{ $driver->jenis_kendaraan == 'GoRide' ? '🏍️' : '🚗' }} {{ $driver->jenis_kendaraan }}
                    </span>
                </div>
            </div>

            <div class="py-3.5 grid grid-cols-3 gap-4">
                <span class="text-sm font-semibold text-blue-600">Nomor Plate</span>
                <span class="text-sm font-mono font-bold text-gray-800 col-span-2 uppercase">{{ $driver->plate_nomor }}</span>
            </div>

            <div class="py-3.5 grid grid-cols-3 gap-4">
                <span class="text-sm font-semibold text-blue-600">Alamat Lengkap</span>
                <span class="text-sm text-gray-600 col-span-2 leading-relaxed">{{ $driver->alamat }}</span>
            </div>

            <div class="py-3.5 grid grid-cols-3 gap-4">
                <span class="text-sm font-semibold text-blue-600">Bergabung Pada</span>
                <span class="text-sm text-gray-400 col-span-2">{{ $driver->created_at->format('d F Y, H:i') }} WIB</span>
            </div>

        </div>

        <div class="flex justify-between items-center pt-6 mt-6 border-t border-blue-100">
            <a href="{{ route('dashboard.driver') }}" class="text-blue-600 hover:text-blue-700 font-semibold text-sm flex items-center gap-1 transition">
                &larr; Kembali ke Dashboard
            </a>
            <a href="{{ route('drivers.edit', $driver->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold text-sm transition shadow-sm">
                Edit Profil Ini
            </a>
        </div>

    </div>

</body>
</html>
</div>