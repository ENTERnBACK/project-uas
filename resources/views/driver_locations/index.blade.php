<h1>Data Driver Location</h1>

<a href="/driver-locations/create">Tambah Data</a>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>User ID</th>
        <th>Latitude</th>
        <th>Longitude</th>
        <th>Aksi</th>
    </tr>

    @foreach($driverLocations as $location)
    <tr>
        <td>{{ $location->id }}</td>
        <td>{{ $location->user_id }}</td>
        <td>{{ $location->latitude }}</td>
        <td>{{ $location->longitude }}</td>
        <td>
            <a href="/driver-locations/{{ $location->id }}/edit">Edit</a>

            <form action="/driver-locations/{{ $location->id }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>