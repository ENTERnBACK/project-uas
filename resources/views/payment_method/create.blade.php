<form action="{{ route('payment_method.store') }}" method="POST">
    @csrf
    
    <label>Pilih Metode:</label>
    <select name="method" id="methodSelect" onchange="toggleFields()">
        <option value="bank">Bank / Debit</option>
        <option value="linkjago">LinkJago</option>
    </select>

    <div id="bank-fields">
        <input type="text" name="bank_name" placeholder="Nama Bank">
        <input type="text" name="card_number" placeholder="Nomor Kartu">
        <input type="text" name="expiry" placeholder="Masa Berlaku (MM/YY)">
    </div>

    <div id="linkjago-fields" style="display:none;">
        <input type="text" name="account_name" placeholder="Nama Akun">
        <input type="password" name="password" placeholder="Password">
    </div>

    <button type="submit">Simpan</button>
</form>

<script>
function toggleFields() {
    let method = document.getElementById('methodSelect').value;
    document.getElementById('bank-fields').style.display = (method === 'bank') ? 'block' : 'none';
    document.getElementById('linkjago-fields').style.display = (method === 'linkjago') ? 'block' : 'none';
}
</script>