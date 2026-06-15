<!DOCTYPE html>
<html>
<head>
    <title>Tambah Ticket</title>
</head>
<body>

<h1>Tambah Support Ticket</h1>

<form action="{{ route('support-tickets.store') }}" method="POST">
    @csrf

    <p>
        User ID
        <input type="number" name="user_id" required>
    </p>

    <p>
        Subject
        <input type="text" name="subject" required>
    </p>

    <p>
        Description
        <textarea name="description" required></textarea>
    </p>

    <button type="submit">
        Simpan
    </button>
</form>

<br>

<a href="{{ route('support-tickets.index') }}">
    Kembali
</a>

</body>
</html>