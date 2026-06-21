<h1>Ubah Promo</h1>

@if ($errors->any())
    <div style="color: red; margin-bottom: 15px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('promos.update', $promo) }}">
    @csrf
    @method('PUT')

    <fieldset>
        <legend>Informasi Promo</legend>

        Kode Promo:
        <br>
        <input value="{{ $promo->code }}" disabled>
        <small>(Kode tidak bisa diubah)</small>
        <br><br>

        Nama Promo:
        <br>
        <input name="name" value="{{ old('name', $promo->name) }}" required>
        <br><br>

        Deskripsi:
        <br>
        <textarea name="description" rows="3">{{ old('description', $promo->description) }}</textarea>
        <br><br>
    </fieldset>

    <fieldset>
        <legend>Rincian Diskon</legend>

        Tipe Diskon:
        <br>
        <select name="discount_type" id="discount_type">
            <option value="percentage" {{ $promo->discount_type == 'percentage' ? 'selected' : '' }}>Persen (%)</option>
            <option value="fixed" {{ $promo->discount_type == 'fixed' ? 'selected' : '' }}>Nominal (Rp)</option>
        </select>
        <br><br>

        <div id="percentage_fields" style="{{ $promo->discount_type == 'percentage' ? 'display:block' : 'display:none' }}">
            Nilai Diskon (%):
            <br>
            <input name="discount_value" type="number" step="0.01" value="{{ old('discount_value', $promo->discount_value) }}">
            <br><br>

            Maksimal Diskon:
            <br>
            <input name="max_discount" type="number" value="{{ old('max_discount', $promo->max_discount) }}">
            <br><br>
        </div>

        <div id="fixed_fields" style="{{ $promo->discount_type == 'fixed' ? 'display:block' : 'display:none' }}">
            Nilai Diskon (Rp):
            <br>
            <input name="discount_value_fixed" type="number" value="{{ old('discount_value', $promo->discount_value) }}">
            <br><br>
        </div>

        Minimal Transaksi:
        <br>
        <input name="min_transaction" type="number" value="{{ old('min_transaction', $promo->min_transaction) }}">
        <br><br>
    </fieldset>

    <fieldset>
        <legend>Batas Penggunaan</legend>

        Batas Penggunaan Total:
        <br>
        <input name="usage_limit" type="number" value="{{ old('usage_limit', $promo->usage_limit) }}">
        <br><br>
    </fieldset>

    <fieldset>
        <legend>Masa Berlaku</legend>

        Status:
        <br>
        <select name="status">
            <option value="active" {{ $promo->status == 'active' ? 'selected' : '' }}>Active</option>
            <option value="expired" {{ $promo->status == 'expired' ? 'selected' : '' }}>Expired</option>
            <option value="disabled" {{ $promo->status == 'disabled' ? 'selected' : '' }}>Disabled</option>
        </select>
        <br><br>

        Berlaku Dari:
        <br>
        <input name="valid_from" type="datetime-local" value="{{ old('valid_from', $promo->valid_from ? date('Y-m-d\TH:i', strtotime($promo->valid_from)) : '') }}">
        <br><br>

        Berlaku Sampai:
        <br>
        <input name="valid_until" type="datetime-local" value="{{ old('valid_until', $promo->valid_until ? date('Y-m-d\TH:i', strtotime($promo->valid_until)) : '') }}">
        <br><br>
    </fieldset>

    <button type="submit">Update Promo</button>
</form>

<a href="{{ route('promos.index') }}">Kembali</a>

<script>
    const discountType = document.getElementById('discount_type');
    const percentageFields = document.getElementById('percentage_fields');
    const fixedFields = document.getElementById('fixed_fields');

    function toggleFields() {
        if (discountType.value === 'percentage') {
            percentageFields.style.display = 'block';
            fixedFields.style.display = 'none';
        } else {
            percentageFields.style.display = 'none';
            fixedFields.style.display = 'block';
        }
    }

    discountType.addEventListener('change', toggleFields);
</script>

<style>
    fieldset { border: 1px solid #ddd; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
    legend { font-weight: bold; padding: 0 10px; }
    input, select, textarea { padding: 5px; margin: 5px 0; width: 300px; }
    button { background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
    button:hover { background-color: #45a049; }
</style>