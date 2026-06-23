<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>On Trip - Mengantar Penumpang</title>
</head>
<body style="font-family: sans-serif; padding: 20px; max-width: 600px; margin: 0 auto;">

    <div style="background: #fff3cd; border: 1px solid #ffeeba; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center;">
        <h2 style="margin: 0; color: #856404; font-size: 20px;">🚗 Status: Sedang Mengantar Penumpang</h2>
    </div>

    <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; border: 1px solid #eee; margin-bottom: 25px;">
        <h3 style="margin-top: 0; border-bottom: 2px solid #ddd; padding-bottom: 8px; color: #333;">Detail Perjalanan</h3>
        
        <p style="font-size: 15px; color: #555;">
            👤 <strong>Nama Penumpang:</strong> {{ $trip->user->name ?? 'Pelanggan' }}
        </p>
        
        <p style="font-size: 15px; color: #555;">
            📍 <strong>Titik Jemput:</strong> {{ $trip->pickup_point }}
        </p>
        
        <p style="font-size: 15px; color: #555;">
            🏁 <strong>Titik Tujuan:</strong> {{ $trip->dropoff_point }}
        </p>
    </div>

    <form action="{{ route('driver-trips.complete') }}" method="POST" style="margin: 0;">
        @csrf
        <input type="hidden" name="trip_id" value="{{ $trip->id }}">
    
        <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 12px 20px; border-radius: 6px; cursor: pointer; font-weight: bold; width: 100%;">
            🛑 Menurunkan Penumpang
        </button>
    </form>

</body>
</html>