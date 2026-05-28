<h1>Review Driver</h1>

<a href="{{ route('reviews.create') }}">Buat Review Baru</a>
<br><br>

@if ($reviews->isEmpty())
    <p>Belum ada review yang tersimpan.</p>
@else
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th style="width: 50px">No</th>
                <th style="width: 150px">Rating</th>
                <th style="width: 300px">Ulasan</th>
                <th style="width: 120px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
                <tr>
                    <td style="text-align: center;">{{ $loop->iteration }}</td>

                    <td style="text-align: center;">
                        <a href="{{ route('reviews.show', $review) }}">
                            {{ $review->rating ?? 'No Rating' }}
                        </a>
                    </td>

                    <td>
                        {{ $review->review_driver ?? '(Tanpa Ulasan)' }}
                    </td>
                    
                    <td style="text-align: center;">
                        <a href="{{ route('reviews.edit', $review }}">Ubah</a>
                        <form action="{{ route('reviews.destroy', $review) }}" method="post" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif