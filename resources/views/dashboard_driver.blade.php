<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Driver</title>
</head>
<body>

    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; padding-bottom: 15px; border-bottom: 1px solid #eee; margin-bottom: 20px;">
        <div>
            <h1 style="margin: 0; font-size: 28px; font-weight: bold; color: #000;">Selamat Datang Driver, {{ auth()->user()->name }}!</h1>
            <p style="margin: 5px 0 0 0; font-weight: bold;">Status Akun: <span style="color: #28a745;">Aktif</span></p>
        </div>

        <div style="z-index: 999;">
            <a href="{{ route('drivers.index') }}" style="display: flex; align-items: center; gap: 10px; text-decoration: none; padding: 6px 12px; border-radius: 25px; background-color: #f8f9fa; border: 1px solid #e2e8f0; transition: all 0.2s;" onmouseover="this.style.background='#edf2f7'" onmouseout="this.style.background='#f8f9fa'">
                <span style="font-weight: 500; color: #333; font-family: sans-serif; font-size: 14px;">
                    {{ auth()->user()->name }}
                </span>
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0D8ABC&color=fff" 
                    alt="Profile" 
                    style="width: 38px; height: 38px; border-radius: 50%; object-fit: cover; border: 2px solid #ccc;">
            </a>
        </div>
    </div>

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