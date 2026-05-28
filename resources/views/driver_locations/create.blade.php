<h1>Tambah Driver Location</h1>

<form action="/driver-locations" method="POST">
    @csrf

    <label>User ID</label>
    <input type="number" name="user_id">

    <br><br>

    <label>Latitude</label>
    <input type="text" name="latitude">

    <br><br>

    <label>Longitude</label>
    <input type="text" name="longitude">

    <br><br>

    <button type="submit">Simpan</button>
</form>