<!DOCTYPE html>
<html>

<head>

    <title>Detail Driver Location</title>

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
            width:50%;
            margin:40px auto;
            background:white;
            padding:30px;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,.2);
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        td{
            padding:12px;
            border-bottom:1px solid #ddd;
        }

        .title{
            font-weight:bold;
            width:35%;
        }

        .btn{

            display:inline-block;
            margin-top:20px;
            text-decoration:none;
            background:#0d6efd;
            color:white;
            padding:10px 20px;
            border-radius:5px;

        }

        .btn:hover{

            background:#084298;

        }

    </style>

</head>

<body>

<div class="header">

<h1>🚖 Ride Hailing App</h1>

<h2>Detail Driver Location</h2>

</div>

<div class="container">

<table>

<tr>

<td class="title">

Nama Driver

</td>

<td>

{{ $driverLocation->user->name }}

</td>

</tr>

<tr>

<td class="title">

User ID

</td>

<td>

{{ $driverLocation->user_id }}

</td>

</tr>

<tr>

<td class="title">

Latitude

</td>

<td>

{{ $driverLocation->latitude }}

</td>

</tr>

<tr>

<td class="title">

Longitude

</td>

<td>

{{ $driverLocation->longitude }}

</td>

</tr>

<tr>

<td class="title">

Dibuat

</td>

<td>

{{ $driverLocation->created_at }}

</td>

</tr>

<tr>

<td class="title">

Terakhir Diubah

</td>

<td>

{{ $driverLocation->updated_at }}

</td>

</tr>

</table>

@if(auth()->user()->role=='driver')

<a href="{{ route('driver-locations.edit',$driverLocation->id) }}"
class="btn">

Edit Lokasi

</a>

@endif

<a href="{{ route('driver-locations.index') }}"
class="btn">

Kembali

</a>

</div>

</body>

</html>