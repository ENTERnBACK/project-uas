<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Driver</title>
</head>
<body>

    <h2>Selamat Datang Driver, {{ Auth::user()->name }}!</h2>
    <p>Status Akun: <span style="color: green; font-weight: bold;">Aktif</span></p>

    @if(session('success'))
        <p style="color: green; font-weight: bold;">{{ session('success') }}</p>
    @endif

    <div style="background: #e9ecef; padding: 15px; border-radius: 8px; margin-bottom: 20px; display: flex; gap: 20px;">
        <div>
            <p style="margin: 0; color: #6c757d; font-size: 14px;">Pendapatan Hari Ini</p>
            <h3 style="margin: 5px 0 0 0; color: #28a745;">Rp 0</h3>
        </div>
        <div>
            <p style="margin: 0; color: #6c757d; font-size: 14px;">Rating Driver</p>
            <h3 style="margin: 5px 0 0 0; color: #ffc107;">⭐ 5.0</h3>
        </div>
    </div>

    <hr>
    <div style="margin-top: 20px;">
        <h3>Pesanan Masuk</h3>
        
        @if($availableTrips->isEmpty())
            <p style="color: #6c757d; font-style: italic;">Belum ada pesanan masuk dari penumpang di sekitar Anda.</p>
        @else
            <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <thead>
                    <tr style="background-color: #f8f9fa; text-align: left; border-bottom: 2px solid #eee;">
                        <th style="padding: 10px;">Titik Jemput</th>
                        <th style="padding: 10px;">Titik Tujuan</th>
                        <th style="padding: 10px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($availableTrips as $trip)
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 10px;">{{ $trip->pickup_point }}</td>
                            <td style="padding: 10px;">{{ $trip->dropoff_point }}</td>
                            <td style="padding: 10px;">
                                <button type="button" style="background-color: #28a745; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; font-weight: bold;">
                                    Ambil Orderan
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <br><br>
    <hr>

    <div style="display: flex; gap: 10px; margin-top: 20px;">
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 6px 12px; border-radius: 4px; font-size: 14px; cursor: pointer;">
                Logout
            </button>
        </form>

        <a href="{{ route('support-tickets.create') }}" style="text-decoration: none;">
            <button type="button" style="background-color: #6c757d; color: white; border: none; padding: 6px 12px; border-radius: 4px; font-size: 14px; cursor: pointer;">
                📞 Halo Center
            </button>
        </a>
    </div>

</body>
</html>