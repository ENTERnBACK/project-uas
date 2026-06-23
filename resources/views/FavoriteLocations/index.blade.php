</div><!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Lokasi Favorit</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900 min-h-screen">
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md transition duration-300 hover:shadow-xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">📍 Lokasi Favorit Saya</h1>
            
            <div class="space-x-2">
                <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-gray-800 font-medium px-4 py-2 border border-gray-300 rounded hover:bg-gray-50 transition duration-200">
                    Kembali ke Dashboard
                </a>
                <a href="{{ route('favorite-locations.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition duration-200 shadow-md hover:scale-105">
                    + Tambah Lokasi
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Label</th>
                        <th class="px-6 py-3">Alamat Lengkap</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                    @forelse($favoriteLocations as $index => $favoriteLocation)
                        <tr class="hover:bg-gray-50 transition duration-200">
                            <td class="px-6 py-4 font-medium text-gray-500">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $favoriteLocation->label }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $favoriteLocation->alamat }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center space-x-4">
                                    <a href="{{ route('favorite-locations.edit', $favoriteLocation->id) }}" class="text-amber-600 hover:text-amber-800 font-medium hover:underline">
                                        Edit
                                    </a>
                                    <form action="{{ route('favorite-locations.destroy', $favoriteLocation->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lokasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium cursor-pointer hover:underline">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                                Belum ada lokasi favorit yang disimpan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
</div>