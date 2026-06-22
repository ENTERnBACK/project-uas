<!DOCTYPE html>
<html>
<head>
    <title>Driver Locations</title>

    <style>
        body{
            margin:0;
            font-family:Arial, Helvetica, sans-serif;
            background:#eef5ff;
        }

        .header{
            background:#0d6efd;
            color:white;
            text-align:center;
            padding:20px;
        }

        .container{
            width:90%;
            margin:30px auto;
            background:white;
            padding:25px;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,.2);
        }

        .btn{
            display:inline-block;
            text-decoration:none;
            background:#0d6efd;
            color:white;
            padding:10px 18px;
            border-radius:5px;
            margin-right:10px;
            margin-bottom:15px;
        }

        .btn:hover{
            background:#0b5ed7;
        }

        .btn-delete{
            background:#dc3545;
        }

        .btn-delete:hover{
            background:#bb2d3b;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        table th{
            background:#0d6efd;
            color:white;
            padding:12px;
        }

        table td{
            border:1px solid #ddd;
            padding:10px;
            text-align:center;
        }

        tr:nth-child(even){
            background:#f8fbff;
        }

        .success{
            background:#d1e7dd;
            color:#0f5132;
            padding:15px;
            border-radius:8px;
            margin-bottom:20px;
        }

        button{
            background:#0d6efd;
            color:white;
            border:none;
            padding:8px 15px;
            border-radius:5px;
            cursor:pointer;
        }

        button:hover{
            background:#084298;
        }

        h3{
            color:#0d6efd;
        }
    </style>

</head>

<body>

<div class="header">

    <h1>🚖 Ride Hailing App</h1>

    @if(auth()->user()->role=='driver')
        <h2>Driver Locations</h2>
    @else
        <h2>Pilih Driver</h2>
    @endif

</div>

<div class="container">

@if(session('success'))

<div class="success">
    {{ session('success') }}
</div>

@endif

@if(auth()->user()->role=='driver')

<a href="{{ route('driver-locations.create') }}" class="btn">
    + Tambah Lokasi
</a>

@endif

<a href="{{ route('dashboard') }}" class="btn">
    ← Kembali ke Dashboard
</a>

<table>

<tr>

<th>No</th>
<th>Nama Driver</th>
<th>Latitude</th>
<th>Longitude</th>
<th>Aksi</th>

</tr>

@forelse($driverLocations as $index=>$location)

<tr>

<td>{{ $index+1 }}</td>

<td>{{ $location->user->name }}</td>

<td>{{ $location->latitude }}</td>

<td>{{ $location->longitude }}</td>

<td>

@if(auth()->user()->role=='driver')

<a href="{{ route('driver-locations.show',$location->id) }}">
    <button>Detail</button>
</a>

<a href="{{ route('driver-locations.edit',$location->id) }}">
<button>Edit</button>
</a>

<form action="{{ route('driver-locations.destroy',$location->id) }}"
method="POST"
style="display:inline;">

@csrf
@method('DELETE')

<button class="btn-delete"
onclick="return confirm('Yakin ingin menghapus lokasi?')">

Hapus

</button>

</form>

@else

<a href="{{ route('driver-locations.show',$location->id) }}">
    <button>Detail</button>
</a>

<form action="{{ route('trips.store') }}" method="POST">

@csrf

<input type="hidden"
name="driver_id"
value="{{ $location->user_id }}">

<button>
Pilih Driver
</button>

</form>

@endif

</td>

</tr>

@empty

<tr>

<td colspan="5">

Belum ada data driver.

</td>

</tr>

@endforelse

</table>

<br>

@if(auth()->user()->role=='driver')

<h3>Informasi</h3>

<ul>

<li>Tambah Lokasi untuk memperbarui posisi driver.</li>

<li>Edit untuk mengubah koordinat lokasi.</li>

<li>Hapus jika lokasi sudah tidak digunakan.</li>

</ul>

@else

<h3>Informasi</h3>

<ul>

<li>Pilih salah satu driver untuk melanjutkan pemesanan perjalanan.</li>

<li>Driver yang dipilih akan menerima permintaan perjalanan Anda.</li>

</ul>

@endif

</div>

</body>
</html>