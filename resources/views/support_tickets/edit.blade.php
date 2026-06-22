<!DOCTYPE html>
<html>
<head>
    <title>Edit Support Ticket</title>

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
            box-shadow:0 0 10px rgba(0,0,0,0.2);
        }

        h2{
            text-align:center;
            color:#0d6efd;
            margin-bottom:20px;
        }

        label{
            font-weight:bold;
            display:block;
            margin-top:10px;
        }

        input,
        textarea,
        select{
            width:100%;
            padding:10px;
            margin-top:5px;
            margin-bottom:15px;
            border:1px solid #ccc;
            border-radius:5px;
            box-sizing:border-box;
            font-size:14px;
        }

        textarea{
            resize:vertical;
        }

        .btn{
            background:#0d6efd;
            color:white;
            border:none;
            padding:10px 20px;
            border-radius:5px;
            cursor:pointer;
            text-decoration:none;
            font-size:15px;
        }

        .btn:hover{
            background:#0b5ed7;
        }

        .btn-back{
            background:#6c757d;
            color:white;
            text-decoration:none;
            padding:10px 20px;
            border-radius:5px;
            margin-left:10px;
        }

        .btn-back:hover{
            background:#5c636a;
        }

        .error{
            background:#f8d7da;
            color:#842029;
            padding:10px;
            border-radius:5px;
            margin-bottom:20px;
        }
    </style>

</head>
<body>

<div class="header">
    <h1>🚖 Ride Hailing App</h1>
    <h3>Edit Support Ticket</h3>
</div>

<div class="container">

    <h2>Edit Pengaduan</h2>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('support-tickets.update', $supportTicket->id) }}" method="POST">

        @csrf
        @method('PUT')

        <label>User ID</label>
        <input
            type="number"
            name="user_id"
            value="{{ old('user_id', $supportTicket->user_id) }}"
            required>

        <label>Subject</label>
        <input
            type="text"
            name="subject"
            value="{{ old('subject', $supportTicket->subject) }}"
            required>

        <label>Description</label>
        <textarea
            name="description"
            rows="5"
            required>{{ old('description', $supportTicket->description) }}</textarea>

        <label>Status</label>
        <select name="status">

            <option value="open"
                {{ $supportTicket->status == 'open' ? 'selected' : '' }}>
                Open
            </option>

            <option value="pending"
                {{ $supportTicket->status == 'pending' ? 'selected' : '' }}>
                Pending
            </option>

            <option value="resolved"
                {{ $supportTicket->status == 'resolved' ? 'selected' : '' }}>
                Resolved
            </option>

        </select>

        <button type="submit" class="btn">
            💾 Simpan Perubahan
        </button>

        <a href="{{ route('support-tickets.index') }}" class="btn-back">
            ← Kembali
        </a>

    </form>

</div>

</body>
</html>