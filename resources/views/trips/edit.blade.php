<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Perjalanan</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { width: 300px; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .btn-back { background-color: #6c757d; text-decoration: none; padding: 9px 15px; color: white; border-radius: 4px; display: inline-block; margin-left: 10px; }
        .error { color: red; }
    </style>
</head>
<body>

    <h2>Edit Detail Perjalanan (Trip #{{ $trip->id }})</h2>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('trips.update', $trip->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="pickup_point">Lokasi Jemput (Pickup Point)</label>
            <input type="text" id="pickup_point" name="pickup_point" value="{{ old('pickup_point', $trip->pickup_point) }}">
        </div>

        <div class="form-group">
            <label for="dropoff_point">Lokasi Tujuan (Dropoff Point)</label>
            <input type="text" id="dropoff_point" name="dropoff_point" value="{{ old('dropoff_point', $trip->dropoff_point) }}">
        </div>

        <div class="form-group">
            <label for="status">Status Perjalanan</label>
            <select id="status" name="status">
                <option value="pending" {{ $trip->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="on_trip" {{ $trip->status == 'on_trip' ? 'selected' : '' }}>On Trip</option>
                <option value="completed" {{ $trip->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $trip->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <button type="submit">Update Perjalanan</button>
        <a href="{{ route('trips.index') }}" class="btn btn-back">Batal</a>
    </form>

</body>
</html>