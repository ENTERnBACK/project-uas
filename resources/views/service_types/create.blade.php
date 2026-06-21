<form action="/service-types" method=POST>
    @csrf

    <h1>Service Type</h1>
    <input type="radio" 
        name="service_type"     
            value="go_ride"
            onchange ="this.form.submit()">Go Ride

</form>