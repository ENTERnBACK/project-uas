<h1>Buat Pembayaran Baru</h1>

@if ($errors->any())
    <div style="color: red; margin-bottom: 15px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('payments.store') }}">
    @csrf

    <fieldset>
        <legend>Informasi Perjalanan</legend>

        Trip ID:
        <br>
        <select name="trip_id" required>
            <option value="">Pilih Trip</option>
            @foreach($trips as $trip)
                <option value="{{ $trip->id }}" {{ old('trip_id') == $trip->id ? 'selected' : '' }}>
                    Trip #{{ $trip->id }} - {{ $trip->pickup_location }} → {{ $trip->destination }}
                </option>
            @endforeach
        </select>
        <br><br>

        Passenger Name:
        <br>
        <input name="passenger_name" value="{{ old('passenger_name') }}" required>
        <br><br>
    </fieldset>

    <fieldset>
        <legend>Rincian Pembayaran</legend>

        Harga Perjalanan:
        <br>
        <input name="amount" type="number" id="amount" value="{{ old('amount') }}" required>
        <br><br>

        Tip (opsional):
        <br>
        <input name="tip_amount" type="number" id="tip_amount" value="{{ old('tip_amount', 0) }}">
        <br><br>

        Total + Tip:
        <br>
        <strong>Rp <span id="total_display">0</span></strong>
        <br>
        <input name="total_amount" type="hidden" id="total_amount" value="0">
        <br><br>
    </fieldset>

    <button type="submit">Simpan Pembayaran</button>
</form>

<a href="{{ route('payments.index') }}">Kembali</a>

<script>
    const amountInput = document.getElementById('amount');
    const tipInput = document.getElementById('tip_amount');
    const totalDisplay = document.getElementById('total_display');
    const totalInput = document.getElementById('total_amount');

    function calculateTotal() {
        let amount = parseFloat(amountInput.value) || 0;
        let tip = parseFloat(tipInput.value) || 0;
        let total = amount + tip;
        totalDisplay.innerText = total.toLocaleString('id-ID');
        totalInput.value = total;
    }

    amountInput.addEventListener('input', calculateTotal);
    tipInput.addEventListener('input', calculateTotal);
    calculateTotal();
</script>

<style>
    fieldset { border: 1px solid #ddd; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
    legend { font-weight: bold; padding: 0 10px; }
    input, select { padding: 5px; margin: 5px 0; width: 300px; }
    button { background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
    button:hover { background-color: #45a049; }
</style>