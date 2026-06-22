<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Driver Gojek</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 p-8">

    <div class="max-w-6xl mx-auto bg-white p-6 rounded-2xl shadow-lg border border-blue-100">
        
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center gap-3">
                <span class="text-4xl">🚗🏍️</span>
                <div>
                    <h1 class="text-2xl font-bold text-blue-700">Driver Gojek</h1>
                    <p class="text-sm text-gray-500">Kelola data, akun, dan status operasional driver</p>
                </div>
            </div>
            <a href="/drivers/create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold text-sm transition shadow">
                + Tambah Driver Baru
            </a>
        </div>

        <!-- Tabel Data Driver -->
        <div class="overflow-x-auto rounded-lg border border-blue-100">
            <table class="w-full text-left border-collapse bg-white">
                <thead>
                    <tr class="bg-blue-600 text-white uppercase text-xs font-bold">
                        <th class="p-4">Nama Lengkap</th>
                        <th class="p-4">Kontak / Email</th>
                        <th class="p-4">Alamat</th>
                        <th class="p-4">Layanan</th>
                        <th class="p-4">Plate Nomor</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm divide-y divide-blue-50">
                    @forelse($drivers as $driver)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="p-4 font-semibold text-gray-900">{{ $driver->nama }}</td>
                        
                        <td class="p-4">
                            <div class="font-medium text-gray-800">{{ $driver->no_telepon }}</div>
                            <div class="text-xs text-gray-400">{{ $driver->email }}</div>
                        </td>
                        
                        <td class="p-4 text-gray-500 max-w-xs truncate" title="{{ $driver->alamat }}">
                            {{ $driver->alamat }}
                        </td>
                        
                        <td class="p-4">
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $driver->jenis_kendaraan == 'GoRide' ? 'bg-orange-100 text-orange-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ $driver->jenis_kendaraan == 'GoRide' ? '🏍️' : '🚗' }} {{ $driver->jenis_kendaraan }}
                            </span>
                        </td>
                        
                        <td class="p-4 font-mono font-semibold text-gray-700 uppercase">{{ $driver->plate_nomor }}</td>
                        
                        <td class="p-4">
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $driver->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($driver->status) }}
                            </span>
                        </td>
                        
                        <td class="p-4">
                            <div class="flex justify-center items-center gap-2">
                                <a href="/drivers/{{ $driver->id }}" class="bg-gray-100 text-gray-700 px-3 py-1.5 rounded-md hover:bg-gray-200 text-xs font-medium transition">
                                    Detail
                                </a>
                                <a href="/drivers/{{ $driver->id }}/edit" class="bg-yellow-500 text-white px-3 py-1.5 rounded-md hover:bg-yellow-600 text-xs font-medium transition shadow-sm">
                                    Edit
                                </a>
                                <form action="/drivers/{{ $driver->id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun driver {{ $driver->nama }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1.5 rounded-md hover:bg-red-600 text-xs font-medium transition shadow-sm">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center text-blue-300 bg-blue-50 italic">
                            🚗🏍️ Belum ada data driver yang terdaftar di sistem.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>