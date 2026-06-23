<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perjalanan Aktif - On Trip</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col justify-between">
    <nav class="bg-blue-600 shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-white text-2xl font-bold">🚕 Ride Hailing App</h1>
            <span class="text-white font-semibold">{{ auth()->user()->name }}</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto mt-10 mb-auto px-4 w-full">
        <div class="bg-white rounded-xl shadow-lg p-8 border-t-4 border-green-500">
            <div class="text-center border-b pb-6 mb-6">
                <span class="bg-green-100 text-green-700 px-4 py-1.5 rounded-full font-bold text-sm uppercase tracking-wider">
                    On Trip
                </span>
                <h2 class="text-2xl font-bold text-gray-800 mt-4">✨ Semoga selamat sampai tujuan ✨</h2>
                <p class="text-sm text-gray-500 mt-1">Driver Anda sedang mengantar Anda ke lokasi tujuan.</p>
            </div>

            <div class="space-y-4 text-gray-700">
                
                <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg">
                    <span class="text-sm text-gray-500 font-medium">Nama Driver</span>
                    <span class="font-bold text-gray-800">
                        {{ $currentTrip->driver->name ?? $currentTrip->driver_id ?? 'Driver Menuju Lokasi' }}
                    </span>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Pickup Point</p>
                    <p class="font-semibold text-gray-800 mt-1">📍 {{ $currentTrip->pickup_point }}</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Drop off Point</p>
                    <p class="font-semibold text-gray-800 mt-1">🏁 {{ $currentTrip->dropoff_point }}</p>
                </div>

                <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg">
                    <span class="text-sm text-gray-500 font-medium">Harga</span>
                    <span class="font-bold text-xl text-blue-600">
                        Rp {{ number_format($currentTrip->price ?? $currentTrip->fare ?? 0, 0, ',', '.') }}
                    </span>
                </div>

                <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg">
                    <span class="text-sm text-gray-500 font-medium">Metode Pembayaran</span>
                    <span class="font-semibold text-gray-800">
                        💳 {{ $currentTrip->paymentMethod->name ?? $currentTrip->payment_method ?? 'Cash/Wallet' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <footer class="w-full text-center py-6 bg-white border-t mt-10">
        <p class="text-gray-600 text-sm">
            Mengalami masalah? 
            <a href="{{ route('support-tickets.create') }}" class="text-red-500 font-bold hover:underline ml-1">
                Hubungi Halo Center 📞
            </a>
        </p>
    </footer>

    <script>
        setInterval(function() {
            fetch("{{ route('trips.check-status') }}")
                .then(response => response.json())
                .then(data => {
                    // Kalau terdeteksi selesai, langsung lempar ke halaman create review bawa parameter ID trip
                    if (data.status === 'completed' || data.status === 'finished' || data.status === 'none') {
                        window.location.href = "{{ route('reviews.create') }}?trip_id=" + data.last_trip_id;
                    }
                })
                .catch(error => console.error('Error:', error));
        }, 3000);
    </script>
</body>
</html>