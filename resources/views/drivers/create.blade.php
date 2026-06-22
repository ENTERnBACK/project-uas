</div>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Driver Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 p-8">

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-blue-100">
        
        <div class="mb-6 border-b border-blue-100 pb-4">
            <div class="flex items-center gap-3 mb-2">
                <span class="text-4xl">🚗🏍️</span>
                <h1 class="text-2xl font-bold text-blue-700">Formulir Pendaftaran Driver</h1>
            </div>
            <p class="text-sm text-gray-500">Masukkan informasi lengkap calon driver untuk disimpan ke dalam pangkalan data</p>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-700 p-3 rounded-lg text-sm mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 p-3 rounded-lg text-sm mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="/drivers" method="POST" class="space-y-5">
            @csrf

            {{-- Nama: hidden untuk POST, readonly untuk tampilan --}}
            <div>
                <label class="block text-sm font-semibold text-blue-700 mb-1">Nama Lengkap</label>
                <input type="hidden" name="nama" value="{{ auth()->user()->name }}">
                <input type="text" value="{{ auth()->user()->name }}" readonly
                       class="w-full bg-blue-50 border border-blue-200 p-2.5 rounded-lg cursor-not-allowed focus:outline-none text-gray-600">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Email: hidden untuk POST, readonly untuk tampilan --}}
                <div>
                    <label class="block text-sm font-semibold text-blue-700 mb-1">Alamat Email</label>
                    <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                    <input type="text" value="{{ auth()->user()->email }}" readonly
                           class="w-full bg-blue-50 border border-blue-200 p-2.5 rounded-lg cursor-not-allowed focus:outline-none text-gray-600">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-blue-700 mb-1">Nomor Telepon</label>
                    <input type="text" name="no_telepon" value="{{ old('no_telepon') }}" required placeholder="Contoh: 081234567XXX" 
                           class="w-full border border-blue-200 p-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-blue-700 mb-1">Alamat Domisili Sekarang</label>
                <textarea name="alamat" required rows="3" placeholder="Tuliskan alamat lengkap beserta kota asal" 
                          class="w-full border border-blue-200 p-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">{{ old('alamat') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-blue-700 mb-1">Jenis Layanan Gojek</label>
                    <select name="jenis_kendaraan" required 
                            class="w-full border border-blue-200 p-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-white">
                        <option value="GoRide" {{ old('jenis_kendaraan') == 'GoRide' ? 'selected' : '' }}>🏍️ GoRide (Sepeda Motor)</option>
                        <option value="GoCar" {{ old('jenis_kendaraan') == 'GoCar' ? 'selected' : '' }}>🚗 GoCar (Mobil Penumpang)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-blue-700 mb-1">Nomor Registrasi Kendaraan (Plate Nomor)</label>
                    <input type="text" name="plate_nomor" value="{{ old('plate_nomor') }}" required placeholder="Contoh: B 1234 ABC" 
                           class="w-full border border-blue-200 p-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition uppercase">
                </div>
            </div>

            {{-- Status otomatis nonaktif, tidak perlu dipilih driver --}}
            <input type="hidden" name="status" value="nonaktif">

            <div class="flex justify-between gap-3 pt-4 border-t border-blue-100">
                <a href="{{ route('dashboard.driver') }}" class="bg-gray-200 text-gray-700 px-5 py-2.5 rounded-lg font-medium hover:bg-gray-300 transition text-sm">
                    ← Dashboard
                </a>
                <div class="flex gap-3">
                    <a href="/drivers" class="bg-gray-200 text-gray-700 px-5 py-2.5 rounded-lg font-medium hover:bg-gray-300 transition text-sm">
                        Batal
                    </a>
                    <button type="submit" class="bg-blue-600 text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition text-sm shadow">
                        Simpan Data Driver
                    </button>
                </div>
            </div>
        </form>

    </div>

</body>
</html>
</div>