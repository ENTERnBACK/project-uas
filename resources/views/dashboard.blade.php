<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>

    <h2>Selamat Datang, {{ Auth::user()->name }}!</h2>

    @if(session('success'))
        <p style="color: green; font-weight: bold;">
            {{ session('success') }}
        </p>
    @endif

    <div style="margin-top: 20px;">
        <a href="{{ route('trips.create') }}" style="text-decoration: none;">
            <button type="button" style="padding: 10px 15px; cursor: pointer; font-weight: bold;">
                Pesan Ride
            </button>
        </a>
    </div>

    <br><br>
    <hr>
    <div style="margin-top: 20px;">
        <h3>Riwayat Perjalanan Kamu</h3>

        @if($trips->isEmpty())
            <p style="color: #6c757d; font-style: italic;">Kamu belum memiliki riwayat perjalanan.</p>
        @else
            <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <thead>
                    <tr style="background-color: #f8f9fa; text-align: left; border-bottom: 2px solid #eee;">
                        <th style="padding: 10px;">Penjemputan (Pick Up)</th>
                        <th style="padding: 10px;">Tujuan (Drop Off)</th>
                        <th style="padding: 10px;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trips as $trip)
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 10px;">{{ $trip->pickup_point }}</td> 

                            <td style="padding: 10px;">{{ $trip->dropoff_point }}</td> 
        
                            <td style="padding: 10px;">
                                <span style="background: #e2e3e5; color: #383d41; padding: 3px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">
                                    {{ ucfirst($trip->status ?? 'Active') }}
                                </span>
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