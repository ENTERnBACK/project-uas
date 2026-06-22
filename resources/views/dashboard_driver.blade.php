<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Driver</title>

    <style>

        body{
            margin:0;
            padding:0;
            font-family:Arial,sans-serif;
            background:#f3f4f6;
        }

        a{
            text-decoration:none;
        }

        .navbar{
            background:#2563eb;
            color:white;
            padding:20px 40px;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .logo{
            font-size:24px;
            font-weight:bold;
        }

        .profile{
            display:flex;
            align-items:center;
            gap:12px;
            padding:10px 15px;
            border-radius:30px;
            background:rgba(255,255,255,.15);
            transition:.3s;
        }

        .profile:hover{
            background:rgba(255,255,255,.25);
        }

        .profile span{
            color:white;
            font-weight:bold;
        }

        .profile img{
            width:45px;
            height:45px;
            border-radius:50%;
            border:2px solid white;
        }
        .container{
            padding:30px;
        }

        .card{
            background:white;
            padding:30px;
            border-radius:20px;
            margin-bottom:30px;
            box-shadow:0 4px 15px rgba(0,0,0,.08);
        }

        .welcome{
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .status{
            color:#22c55e;
            font-weight:bold;
        }

        .stats{
            display:flex;
            gap:20px;
            margin-top:25px;
        }

        .small-card{
            background:#f8fafc;
            padding:20px;
            border-radius:15px;
            min-width:200px;
        }

        .btn{
            border:none;
            padding:14px 22px;
            border-radius:12px;
            color:white;
            font-weight:bold;
            cursor:pointer;
            font-size:15px;
        }

        .blue{
            background:#2563eb;
        }

        .green{
            background:#22c55e;
        }

        .red{
            background:#ef4444;
        }

        .gray{
            background:#4b5563;
        }

        .table{
            width:100%;
            margin-top:20px;
            border-collapse:collapse;
        }

        .table th{
            background:#f3f4f6;
            padding:15px;
            text-align:left;
        }

        .table td{
            padding:15px;
            border-bottom:1px solid #eee;
        }

        .footer-buttons{
            display:flex;
            gap:15px;
        }
        .empty{
            color:gray;
            font-style:italic;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="logo">
            🚕 Ride Hailing Driver
        </div>

        <a href="{{ route('drivers.create') }}" class="profile">
            <span>
                {{ auth()->user()->name }}
            </span>
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0D8ABC&color=fff">
        </a>
    </div>

    <div class="container">
        <div class="card">
            <div class="welcome">
                <div>
                    <h1>
                        Selamat Datang Driver, {{ auth()->user()->name }} 👋
                    </h1>

                    <p>
                        Status Akun :
                        <span id="text-status" class="status">
                            Aktif
                        </span>
                    </p>
                </div>

                <button id="btn-toggle" onclick="toggleDriverStatus()" class="btn red">
                    Matikan untuk istirahat
                </button>
            </div>

            <div class="stats">
                <div class="small-card">
                    <p>Pendapatan Hari Ini</p>
                    <h2 style="color:#22c55e;">
                        Rp 0
                    </h2>
                </div>

                <div class="small-card">
                    <p>Rating Driver</p>
                    <a href="{{ route('reviews.index') }}" style=" color:#f5b301;font-size:25px;font-weight:bold;">
                        ⭐ {{ $averageRating }}
                    </a>
                </div>
            </div>
        </div>

        <div class="card">
            <h2>Pesanan Masuk</h2>
            <br>

            <a href="{{ url('driver-locations') }}">
                <button class="btn blue">
                    📍 Kelola Lokasi Saya
                </button>
            </a>

            <br><br>

            <p id="pesanan-off-text" class="empty" style="display:none;">
                Status akun Anda sedang off
            </p>

            @if($availableTrips->isEmpty())

                <p id="pesanan-kosong-text" class="empty">
                    Belum ada pesanan masuk dari penumpang sekitar Anda.
                </p>
            @else
                <table id="tabel-pesanan" class="table">
                    <thead>
                        <tr>
                            <th>Pick Up</th>
                            <th>Drop Off</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($availableTrips as $trip)
                            <tr>
                                <td>
                                    {{ $trip->pickup_point }}
                                </td>

                                <td>
                                    {{ $trip->dropoff_point }}
                                </td>

                                <td>
                                    <form action="{{ route('driver-trips.update',$trip->id) }}"method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"class="btn green">
                                            Ambil Orderan
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <div class="footer-buttons">
            <form action="{{ route('logout') }}"method="POST">
                @csrf
                <button type="submit"class="btn red">
                    Logout
                </button>
            </form>

            <a href="{{ route('support-tickets.create') }}">
                <button class="btn gray">
                    📞 Halo Center
                </button>
            </a>

            <a href="{{ route('chat-messages.index') }}">
                <button class="btn blue">
                    💬 Chat
                </button>
            </a>
        </div>
    </div>
<script>

let isDriverActive=true;

function toggleDriverStatus(){

    const btn=document.getElementById('btn-toggle');
    const status=document.getElementById('text-status');
    const tabel=document.getElementById('tabel-pesanan');
    const off=document.getElementById('pesanan-off-text');
    const kosong=document.getElementById('pesanan-kosong-text');

    if(isDriverActive){

        isDriverActive=false;

        status.innerText="Off";
        status.style.color="gray";

        btn.innerText="Aktifkan untuk menerima order";
        btn.classList.remove("red");
        btn.classList.add("green");

        if(tabel){
            tabel.style.display="none";
        }

        if(kosong){
            kosong.style.display="none";
        }

        off.style.display="block";

    }

    else{

        isDriverActive=true;

        status.innerText="Aktif";
        status.style.color="#22c55e";

        btn.innerText="Matikan untuk istirahat";

        btn.classList.remove("green");
        btn.classList.add("red");

        off.style.display="none";

        if(tabel){
            tabel.style.display="table";
        }

        if(kosong){
            kosong.style.display="block";
        }

    }

}

</script>

</body>
</html>