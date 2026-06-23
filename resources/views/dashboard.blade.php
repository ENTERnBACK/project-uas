<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <nav class="bg-blue-600 shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <h1 class="text-white text-2xl font-bold">
                🚕 Ride Hailing App
            </h1>

            <div class="flex items-center gap-4">

                <a href="{{ route('notifications.index') }}" class="text-white hover:text-gray-200 transition relative p-2" title="Notifikasi">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                    <span class="absolute top-1.5 right-1.5 flex h-2 w-2 rounded-full bg-red-500"></span>
                </a>

            <a href="{{ route('user_profile.index') }}" style="text-decoration: none; display: flex; align-items: center; gap: 8px; background-color: rgba(255,255,255,0.2); padding: 5px 12px; border-radius: 50px; transition: 0.3s;">
                <span style="color: white; font-size: 14px; font-weight: bold;">{{ auth()->user()->name }}</span>
        
            <div style="width: 35px; height: 35px; background-color: #007bff; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 14px; border: 2px solid white;">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>
    </a>

        </div>
    </nav>

    <div class="max-w-6xl mx-auto mt-10 px-4">

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-md p-8">

            <h2 class="text-4xl font-bold text-gray-800">
                Selamat Datang, {{ Auth::user()->name }} 👋
            </h2>

            <p class="text-gray-500 mt-3">
                Kelola perjalanan dan lokasi favorit Anda dengan mudah.
            </p>

            <div class="flex gap-4 mt-6">

                <a href="{{ route('trips.create') }}">
                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg font-semibold transition">
                        🚕 Pesan Ride
                    </button>
                </a>

                <a href="{{ route('favorite-locations.index') }}">
                    <button
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-3 rounded-lg font-semibold transition">
                        ⭐ Lokasi Favorit
                    </button>
                </a>

                <a href="{{ route('promos.user') }}">
                    <button class="bg-yellow-500 hover:bg-yellow-600 text-black px-5 py-3 rounded-lg font-semibold transition">
                        Promo
                    </button>
                </a>
            </div>
        </div>


        <div class="bg-white rounded-xl shadow-md p-8 mt-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-5">
                Riwayat Perjalanan Kamu
            </h3>
            @if($trips->isEmpty())
                <div class="text-center py-10">
                    <p class="text-gray-500 italic">
                        Kamu belum memiliki riwayat perjalanan.
                    </p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-3 text-left">
                                    Pick Up
                                </th>
                                <th class="p-3 text-left">
                                    Drop Off
                                </th>
                                <th class="p-3 text-left">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($trips as $trip)
                                <tr class="border-b">
                                    <td class="p-3">
                                        {{ $trip->pickup_point }}
                                    </td>

                                    <td class="p-3">
                                        {{ $trip->dropoff_point }}
                                    </td>
                                    <td class="p-3">
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                                            {{ ucfirst($trip->status ?? 'Active') }}
                                        </span>
                                    </td>
                                    </td>
                                    <td class="p-3 text-center">
                                        @if(in_array($trip->status, ['pending', 'on_trip']))
                                            <a href="{{ route('trips.chat', $trip->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-md text-sm font-semibold transition shadow-sm">
                                                💬 Chat Driver
                                            </a>
                                        @else
                                            <span class="text-xs text-gray-400">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="flex gap-4 mt-8 mb-10">

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button
                    type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white px-5 py-3 rounded-lg font-semibold transition">
                    Logout
                </button>
            </form>

            <a href="{{ route('support-tickets.create') }}">
                <button
                    class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-3 rounded-lg font-semibold transition">
                    📞 Halo Center
                </button>
            </a>
        </div>
    </div>
</body>
</html>