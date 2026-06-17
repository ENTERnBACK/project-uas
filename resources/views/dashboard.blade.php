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

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" style="background-color: #ff4d4d; color: white; padding: 5px 10px; border: none; cursor: pointer;">
            Logout
        </button>
    </form>

</body>
</html>