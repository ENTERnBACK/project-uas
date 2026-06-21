<h1>Buat Promo Baru</h1>

@if ($errors->any())
    <div style="color: red; margin-bottom: 15px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('promos.store') }}">
    @csrf

    <fieldset>
        <legend>Informasi Promo</legend>

        Kode Promo:
        <br>
        <input name="code" value="{{ old('code') }}" placeholder="contoh: HEMAT10" required>
        <br><br>

        Nama Promo:
        <br>
        <input name="name" value="{{ old('name') }}" placeholder="contoh: Diskon 10%" required>
        <br><br>

        Deskripsi:
        <br>
        <textarea name="description" rows="3">{{ old('description') }}</textarea>
        <br><br>
    </fieldset>

    <fieldset>
        <legend>Rincian Diskon</legend>

        Tipe Diskon:
        <br>
        <select name="discount_type" id="discount_type">
            <option value="percentage">Persen (%)</option>
            <option value="fixed">Nominal (Rp)</option>
        </select>
        <br><br>

        <div id="percentage_fields">
            Nilai Diskon (%):
            <br>
            <input name="discount_value" type="number" step="0.01" placeholder="contoh: 10">
            <br><br>

            Maksimal Diskon (opsional):
            <br>
            <input name="max_discount" type="number" placeholder="contoh: 50000">
            <br><br>
        </div>

        <div id="fixed_fields" style="display: none;">
            Nilai Diskon (Rp):
            <br>
            <input name="discount_value_fixed" type="number" placeholder="contoh: 10000">
            <br><br>
        </div>

        Minimal Transaksi:
        <br>
        <input name="min_transaction" type="number" value="0">
        <br><br>
    </fieldset>

    <fieldset>
        <legend>Batas Penggunaan</legend>

        Batas Penggunaan Total (opsional):
        <br>
        <input name="usage_limit" type="number" placeholder="Kosongkan jika tidak terbatas">
        <br><br>
    </fieldset>

    <fieldset>
        <legend>Masa Berlaku</legend>

        Status:
        <br>
        <select name="status">
            <option value="active">Active</option>
            <option value="expired">Expired</option>
            <option value="disabled">Disabled</option>
        </select>
        <br><br>

        Berlaku Dari (opsional):
        <br>
        <input name="valid_from" type="datetime-local">
        <br><br>

        Berlaku Sampai (opsional):
        <br>
        <input name="valid_until" type="datetime-local">
        <br><br>
    </fieldset>

    <button type="submit">Simpan Promo</button>
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
    toggleFields();
</script>

<style>
    fieldset { border: 1px solid #ddd; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
    legend { font-weight: bold; padding: 0 10px; }
    input, select, textarea { padding: 5px; margin: 5px 0; width: 300px; }
    button { background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
    button:hover { background-color: #45a049; }
</style>