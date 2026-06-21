
    <h1>Payment Method</h1>
    <form action="/payment-methods/{{ $payment_method->id}}" method=POST>
    @csrf
    @method('PUT')

    <input type="radio" 
        name="method"     
            value="cash"
           {{$payment_method->method == 'cash' ? 'checked' : ''}}> Cash

           <input type="radio" 
                    name="method"
                     value="qris"
                        {{$payment_method->method== 'qris' ? 'checked' : ''}}> Qris

                     <input type="radio" 
                         name="method"
                            value="bca"
                            {{$payment_method->method== 'bca' ? 'checked' : ''}}> Bca Virtual Account

                <button type="submit">Bayar</button>
</form>


            

        
