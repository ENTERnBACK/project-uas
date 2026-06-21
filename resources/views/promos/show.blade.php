<h1>Detail Promo</h1>

<p><strong>ID:</strong> {{ $promo->id }}</p>
<p><strong>Kode:</strong> <strong style="font-size: 1.2em;">{{ $promo->code }}</strong></p>
<p><strong>Nama:</strong> {{ $promo->name }}</p>
<p><strong>Deskripsi:</strong> {{ $promo->description ?? '-' }}</p>

<hr>

<h3>Rincian Diskon</h3>
<p><strong>Tipe:</strong> {{ $promo->discount_type == 'percentage' ? 'Persen (%)' : 'Nominal (Rp)' }}</p>
<p><strong>Nilai:</strong>
    @if($promo->discount_type == 'percentage')
        {{ $promo->discount_value }}%
        @if($promo->max_discount)
            <br><small>(max Rp {{ number_format($promo->max_discount, 0, ',', '.') }})</small>
        @endif
    @else
        Rp {{ number_format($promo->discount_value, 0, ',', '.') }}
    @endif
</p>
<p><strong>Min Transaksi:</strong> Rp {{ number_format($promo->min_transaction, 0, ',', '.') }}</p>

<hr>

<h3>Penggunaan</h3>
<p><strong>Dipakai:</strong> {{ $promo->usage_count }} / {{ $promo->usage_limit ?? '∞' }}</p>

<hr>

<h3>Masa Berlaku</h3>
<p><strong>Status:</strong>
    @if($promo->status == 'active') ✅ Active
    @elseif($promo->status == 'expired') ⏳ Expired
    @else ❌ Disabled @endif
</p>
<p><strong>Berlaku Dari:</strong> {{ $promo->valid_from ?? '-' }}</p>
<p><strong>Berlaku Sampai:</strong> {{ $promo->valid_until ?? '-' }}</p>

<p><strong>Dibuat pada:</strong> {{ $promo->created_at }}</p>
<p><strong>Terakhir diupdate:</strong> {{ $promo->updated_at }}</p>

<br>
<a href="{{ route('promos.index') }}">Kembali</a>
<a href="{{ route('promos.edit', $promo) }}">Ubah</a>

<form action="{{ route('promos.destroy', $promo) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Hapus promo {{ $promo->code }}?')">Hapus</button>
</form>