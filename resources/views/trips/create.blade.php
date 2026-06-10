<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buat Perjalanan Baru</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input { width: 300px; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 10px 15px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .error { color: red; }
    </style>
</head>
<body>

    <h2>Pesan Perjalanan (Trip)</h2>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('trips.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="pickup_point">Lokasi Jemput (Pickup Point)</label>
            <input type="text" id="pickup_point" name="pickup_point" placeholder="Masukkan lokasi jemput..." value="{{ old('pickup_point') }}">
        </div>

        <div class="form-group">
            <label for="dropoff_point">Lokasi Tujuan (Dropoff Point)</label>
            <input type="text" id="dropoff_point" name="dropoff_point" placeholder="Masukkan lokasi tujuan..." value="{{ old('dropoff_point') }}">
        </div>

        <button type="submit">Konfirmasi Trip</button>
    </form>

</body>
</html>