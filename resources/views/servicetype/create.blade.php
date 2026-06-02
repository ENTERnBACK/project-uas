<form action="/service-types" method=POST>
    @csrf

    <h1>Service Type</h1>
    <label>Pilih Service</label>

    <select name="service_type" onchange="this.form.submit()">
        <option value ="gor">Go Ride</option>
        <option value="goc">Go Car</option>
</select>
</form>
