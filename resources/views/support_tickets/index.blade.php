<!DOCTYPE html>
<html>
<head>
    <title>Support Ticket</title>

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
            padding:20px;
            border-radius:10px;
            box-shadow:0px 0px 10px rgba(0,0,0,.2);
        }

        .btn{
            text-decoration:none;
            background:#0d6efd;
            color:white;
            padding:10px 15px;
            border-radius:5px;
            margin-right:8px;
        }

        .btn:hover{
            background:#0b5ed7;
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
            padding:10px;
            border:1px solid #ddd;
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

        .status-open{
            color:orange;
            font-weight:bold;
        }

        .status-pending{
            color:blue;
            font-weight:bold;
        }

        .status-resolved{
            color:green;
            font-weight:bold;
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
    </style>

</head>

<body>

<div class="header">

<h1>🚖 Ride Hailing App</h1>

<h3>Support Ticket</h3>

</div>

<div class="container">

@if(session('success'))

<div class="success">

<h3>✅ Pengaduan Berhasil Dikirim</h3>

Terima kasih.

Pengaduan Anda telah diterima dan akan segera diproses oleh tim kami.

</div>

@endif

<a class="btn" href="{{ route('support-tickets.create') }}">
+ Buat Pengaduan
</a>

<a class="btn" href="{{ route('dashboard') }}">
← Kembali ke Dashboard
</a>

<table>

<tr>

<th>No</th>

<th>User ID</th>

<th>Subject</th>

<th>Description</th>

<th>Status</th>

<th>Aksi</th>

</tr>

@forelse($supportTickets as $index=>$ticket)

<tr>

<td>{{ $index+1 }}</td>

<td>{{ $ticket->user_id }}</td>

<td>{{ $ticket->subject }}</td>

<td>{{ $ticket->description }}</td>

<td>

@if($ticket->status=="open")

<span class="status-open">
🟠 Open
</span>

@elseif($ticket->status=="pending")

<span class="status-pending">
🔵 Pending
</span>

@else

<span class="status-resolved">
🟢 Resolved
</span>

@endif

</td>

<td>

<a href="{{ route('support-tickets.edit',$ticket->id) }}">
<button>Edit</button>
</a>

<form action="{{ route('support-tickets.destroy',$ticket->id) }}"
method="POST"
style="display:inline;">

@csrf
@method('DELETE')

<button onclick="return confirm('Yakin ingin menghapus?')">
Hapus
</button>

</form>

</td>

</tr>

@empty

<tr>

<td colspan="6">

Belum ada pengaduan.

</td>

</tr>

@endforelse

</table>

</div>

</body>
</html>