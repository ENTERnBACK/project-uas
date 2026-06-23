@php
    use Illuminate\Support\Facades\Storage;
@endphp

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
        {{-- Foto Profil --}}
        <div class="flex flex-col items-center py-5 border-b border-blue-100">
            @if($driver->foto_profil)
                <img src="{{ Storage::url($driver->foto_profil) }}"
                     alt="Foto Profil"
                     class="w-28 h-28 rounded-full object-cover border-4 border-blue-300 shadow-md"
                     onerror="this.style.display='none'; document.getElementById('avatar-fallback').style.display='flex';">
                
                <div id="avatar-fallback" style="display:none;"
                     class="w-28 h-28 rounded-full border-4 border-blue-300 shadow-md bg-blue-500 flex items-center justify-center">
                    <span class="text-white text-3xl font-bold">{{ strtoupper(substr($driver->nama, 0, 2)) }}</span>
                </div>
            @else
                <div class="w-28 h-28 rounded-full border-4 border-blue-300 shadow-md bg-blue-500 flex items-center justify-center">
                    <span class="text-white text-3xl font-bold">{{ strtoupper(substr($driver->nama, 0, 2)) }}</span>
                </div>
            @endif
        </div>

        {{-- Informasi Driver (Data yang tersimpan) --}}
        <div class="mt-6 space-y-4">
            <h2 class="text-lg font-bold text-blue-900 border-b pb-2">Informasi Profil</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs text-gray-500 uppercase">Nama Lengkap</label>
                    <p class="font-semibold text-gray-800">{{ $driver->nama }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500 uppercase">Email</label>
                    <p class="font-semibold text-gray-800">{{ $driver->email }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500 uppercase">No. Telepon</label>
                    <p class="font-semibold text-gray-800">{{ $driver->no_telepon }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500 uppercase">Jenis Kendaraan</label>
                    <p class="font-semibold text-gray-800">{{ $driver->jenis_kendaraan }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500 uppercase">Plat Nomor</label>
                    <p class="font-semibold text-gray-800">{{ $driver->plate_nomor }}</p>
                </div>
                
                </div>
            </div>
            <div>
                <label class="text-xs text-gray-500 uppercase">Alamat</label>
                <p class="font-semibold text-gray-800">{{ $driver->alamat }}</p>
            </div>
        </div>

        {{-- Tombol Navigasi Edit --}}
        <div class="mt-8 pt-6 border-t border-blue-100 flex gap-3">
            <a href="{{ route('drivers.edit', $driver->id) }}" 
               class="flex-1 text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition font-medium">
               Edit Profil
            </a>
            <a href="{{ url('/drivers') }}" 
               class="flex-1 text-center bg-gray-100 text-gray-600 py-2 rounded-lg hover:bg-gray-200 transition font-medium">
               Kembali
            </a>
        </div>
    </div>
</body>
</html>