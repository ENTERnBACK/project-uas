<!DOCTYPE html>
<html>
<head>
    <title>Detail Ticket</title>
</head>
<body>

<h1>Detail Support Ticket</h1>

<p>
    <strong>ID:</strong>
    {{ $supportTicket->id }}
</p>

<p>
    <strong>User ID:</strong>
    {{ $supportTicket->user_id }}
</p>

<p>
    <strong>Subject:</strong>
    {{ $supportTicket->subject }}
</p>

<p>
    <strong>Description:</strong>
    {{ $supportTicket->description }}
</p>

<p>
    <strong>Status:</strong>
    {{ $supportTicket->status }}
</p>

<a href="{{ route('support-tickets.index') }}">
    Kembali
</a>

</body>
</html>