<h1>Edit Driver Location</h1>

<form action="/driver-locations/{{ $driverLocation->id }}" method="POST">
    @csrf
    @method('PUT')

    <label>User ID</label>
    <input type="number" name="user_id" value="{{ $driverLocation->user_id }}">

    <br><br>

    <label>Latitude</label>
    <input type="text" name="latitude" value="{{ $driverLocation->latitude }}">

    <br><br>

    <label>Longitude</label>
    <input type="text" name="longitude" value="{{ $driverLocation->longitude }}">

    <br><br>

    <button type="submit">Update</button>
</form>