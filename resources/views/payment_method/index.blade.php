<form action="/payment-methods" method="POST">
    @csrf

    <h1> Payment Methods</h1>

    <input type="hidden" 
        name="trip_id" 
         value="1">

        <input type="radio" 
         name="method"     
            value="cash"> Cash <br><br>

             <input type="radio" 
                        name="method"     
                            value="qris"> Qris <br><br>

                 <input type="radio" 
                    name="method"     
                     value="bca"> BCA Virtual Account <br><br>
            
                       <button type="submit">Pilih</button>
</form>