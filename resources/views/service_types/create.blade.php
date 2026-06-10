<form action="/service-types" method="POST">
    @csrf

    <h1> Order Baru</h1>

    <div>
        <label for="service_type">Pesanan Baru:</label><br>
        <br><input type="radio" 
        name="service_type"     
            value="go_ride"
            onchange ="this.form.submit()">Go Ride

        <input type="radio" 
            name="service_type"
                value="go_car"
                onchange ="this.form.submit()">Go Car
</form>