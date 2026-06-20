<body class="bg-gray-100 font-sans antialiased text-gray-900 min-h-screen">

    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md transition duration-300 hover:shadow-xl">
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">📍 Lokasi Favorit Saya</h1>
            <a href="{{ route('favorite-locations.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition duration-200 shadow-md hover:scale-105">
                + Tambah Lokasi
            </a>
        </div>

        @if(session('success'))
            <div id="flash-message" class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded transition-opacity duration-500">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(() => {
                    const msg = document.getElementById('flash-message');
                    msg.style.opacity = '0';
                    setTimeout(() => msg.remove(), 500);
                }, 3000);
            </script>
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
                    @forelse($locations as $index => $location)
                        <tr class="hover:bg-gray-50 transition duration-200">
                            <td class="px-6 py-4 font-medium text-gray-500">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $location->label }}
                                </span>
                                @if($location->is_default)
                                    <span class="ml-2 px-2 py-0.5 text-[10px] font-bold rounded bg-yellow-200 text-yellow-800 uppercase">Utama</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $location->alamat }}</td>
                            <td class="px-6 py-4 text-center space-x-2">
                                <a href="{{ route('favorite-locations.edit', $location->id) }}" class="text-amber-600 hover:text-amber-800 font-medium">Edit</a>
                                
                                <form action="{{ route('favorite-locations.destroy', $location->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lokasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium cursor-pointer">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-500">Belum ada lokasi favorit.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>