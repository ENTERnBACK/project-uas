<h1>Tambah Driver Location</h1>

<form action="/driver-locations" method="POST">
    @csrf

    <label>Driver</label>

    <select name="user_id" required>
    @foreach($users as $user)
        <option value="{{ $user->id }}">
            {{ $user->name }}
        </option>
    @endforeach
    </select>

    <br><br>

    <label>Latitude</label>
    <input type="text" name="latitude">

    <br><br>

    <label>Longitude</label>
    <input type="text" name="longitude">

    <br><br>

    <button type="submit">Simpan</button>
</form>