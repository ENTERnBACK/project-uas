<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Perjalanan (Trips)</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { padding: 8px 12px; color: white; text-decoration: none; border-radius: 4px; display: inline-block; }
        .btn-create { background-color: #28a745; }
        .btn-edit { background-color: #007bff; font-size: 13px; }
        .btn-delete { background-color: #dc3545; font-size: 13px; border: none; cursor: pointer; padding: 6px 10px; border-radius: 4px; color: white; }
        .status { font-weight: bold; text-transform: uppercase; padding: 3px 7px; border-radius: 3px; font-size: 12px; }
        .status-pending { background-color: #ffc107; color: #000; }
        .status-on_trip { background-color: #17a2b8; color: #fff; }
        .status-completed { background-color: #28a745; color: #fff; }
        .status-cancelled { background-color: #dc3545; color: #fff; }
    </style>
</head>
<body>

    <h2>Daftar Perjalanan (Trip Logs)</h2>

    <a href="{{ route('trips.create') }}" class="btn btn-create">+ Buat Trip Baru</a>

    @if(session('success'))
        <p style="color: green; margin-top: 15px; font-weight: bold;">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Lokasi Jemput (Pickup)</th>
                <th>Lokasi Tujuan (Dropoff)</th>
                <th>Status</th>
                <th>Waktu Perubahan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($trips as $trip)
                <tr>
                    <td>{{ $trip->id }}</td>
                    <td>{{ $trip->pickup_point }}</td>
                    <td>{{ $trip->dropoff_point }}</td>
                    <td>
                        <span class="status status-{{ $trip->status }}">{{ $trip->status }}</span>
                    </td>
                    <td>{{ $trip->updated_at->format('d M Y, H:i') }} WIB</td>
                    <td>
                        <a href="{{ route('trips.edit', $trip->id) }}" class="btn btn-edit">Edit</a>

                        <form action="{{ route('trips.destroy', $trip->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus trip ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #888;">Belum ada riwayat perjalanan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>