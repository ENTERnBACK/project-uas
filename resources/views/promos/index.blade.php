<h1>Daftar Promo</h1>

<a href="{{ route('promos.create') }}">Buat Promo Baru</a>
<br><br>

@if ($promos->isEmpty())
    <p>Belum ada promo.</p>
@else
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Diskon</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($promos as $promo)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><strong>{{ $promo->code }}</strong></td>
                <td>{{ $promo->name }}</td>
                <td>
                    @if($promo->discount_type == 'percentage')
                        {{ $promo->discount_value }}%
                    @else
                        Rp {{ number_format($promo->discount_value, 0, ',', '.') }}
                    @endif
                </td>
                <td>
                    @if($promo->status == 'active') ✅ Active
                    @elseif($promo->status == 'expired') ⏳ Expired
                    @else ❌ Disabled @endif
                </td>
                <td>
                    <a href="{{ route('promos.show', $promo) }}">Lihat</a>
                    <a href="{{ route('promos.edit', $promo) }}">Ubah</a>
                    <form action="{{ route('promos.destroy', $promo) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus promo?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $promos->links() }}
@endif