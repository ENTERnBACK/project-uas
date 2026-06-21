<form action="/payment-method" method="POST">
    @csrf

    <h1> Payment Methods</h1>

        <input type="radio" 
         name="method"     
            value="cash" checked> Cash <br><br>


             <input type="radio" 
                        name="method"     
                            value="qris"> Qris <br><br>

                 <input type="radio" 
                    name="method"     
                     value="bca"> BCA Virtual Account <br><br>
            
                       <button type="submit">Bayar</button>
</form>