<!DOCTYPE html>
<html>
<head>
    <title>Support Tickets</title>
</head>
<body>

    <h1>Daftar Support Ticket</h1>

    <a href="{{ route('support-tickets.create') }}">
        Tambah Ticket
    </a>

    <br><br>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Subject</th>
            <th>Description</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        @foreach($supportTickets as $ticket)
        <tr>
            <td>{{ $ticket->id }}</td>
            <td>{{ $ticket->user_id }}</td>
            <td>{{ $ticket->subject }}</td>
            <td>{{ $ticket->description }}</td>
            <td>{{ $ticket->status }}</td>

            <td>
                <a href="{{ route('support-tickets.show', $ticket->id) }}">
                    Detail
                </a>

                <a href="{{ route('support-tickets.edit', $ticket->id) }}">
                    Edit
                </a>

                <form action="{{ route('support-tickets.destroy', $ticket->id) }}"
                    method="POST"
                    style="display:inline;">
                    @csrf
                    @method('DELETE')

                    <button type="submit">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>

</body>
</html>