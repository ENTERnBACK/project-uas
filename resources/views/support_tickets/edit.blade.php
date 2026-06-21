<!DOCTYPE html>
<html>
<head>
    <title>Edit Ticket</title>
</head>
<body>

<h1>Edit Support Ticket</h1>

<form action="{{ route('support-tickets.update', $supportTicket->id) }}"
    method="POST">

    @csrf
    @method('PUT')

    <p>
        Subject
        <input type="text"
            name="subject"
            value="{{ $supportTicket->subject }}"
            required>
    </p>

    <p>
        Description
        <textarea name="description" required>{{ $supportTicket->description }}</textarea>
    </p>

    <p>
        Status
        <select name="status">
            <option value="open"
                {{ $supportTicket->status == 'open' ? 'selected' : '' }}>
                Open
            </option>

            <option value="closed"
                {{ $supportTicket->status == 'closed' ? 'selected' : '' }}>
                Closed
            </option>
        </select>
    </p>

    <button type="submit">
        Update
    </button>

</form>

<br>

<a href="{{ route('support-tickets.index') }}">
    Kembali
</a>

</body>
</html>