</div>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Lokasi Favorit</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900 min-h-screen">

    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-xl shadow-lg">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div class="bg-blue-50 px-4 py-2 rounded-lg border border-blue-100">
                <h2 class="text-blue-800 font-semibold text-sm">Total Lokasi: {{ $locations->count() }}</h2>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">📍 Lokasi Favorit Saya</h1>
            <a href="{{ route('favorite-locations.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg active:scale-95">
                + Tambah Lokasi
            </a>
        </div>

        @if(session('success'))
            <div id="flash-message" class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center shadow-sm">
                <span class="mr-2">✅</span> {{ session('success') }}
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const msg = document.getElementById('flash-message');
                    setTimeout(() => {
                        msg.style.opacity = '0';
                        msg.style.transition = 'opacity 0.5s';
                        setTimeout(() => msg.remove(), 500);
                    }, 3000);
                });
            </script>
        @endif

        <div class="overflow-x-auto border border-gray-200 rounded-lg">
            <table class="min-w-full bg-white text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr class="text-left text-gray-600 uppercase tracking-wider font-semibold">
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Label</th>
                        <th class="px-6 py-4">Alamat Lengkap</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($locations as $index => $location)
                        <tr class="hover:bg-blue-50/50 transition-colors duration-150">
                            <td class="px-6 py-4 text-gray-500 font-medium">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-blue-100 text-blue-700">
                                    {{ $location->label }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600 truncate max-w-xs">{{ $location->alamat }}</td>
                            <td class="px-6 py-4 text-center space-x-4">
                                <a href="{{ route('favorite-locations.edit', $location->id) }}" 
                                   aria-label="Edit {{ $location->label }}"
                                   class="text-blue-600 hover:text-blue-900 font-semibold transition">Edit</a>
                                
                                <form action="{{ route('favorite-locations.destroy', $location->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus {{ $location->label }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            aria-label="Hapus {{ $location->label }}"
                                            class="text-red-500 hover:text-red-700 font-semibold transition">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center text-gray-400">
                                <p class="text-lg">Belum ada lokasi tersimpan.</p>
                                <a href="{{ route('favorite-locations.create') }}" class="text-blue-600 hover:underline">Yuk, tambah sekarang!</a>
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