<form action="/service-types/{{ $service_type->id}}" method=POST>
    @csrf
    @method('PASSWORD_DEFAULT')

    <input type="radio" 
        name="service_type"     
            value="go_ride"
           {{$service_type->service_type == 'go_ride' ? 'checked' ; ''}}> Go Ride

        <input type="radio" 
            name="service_type"
                value="go_car"
                {{$service_type->service_type == 'go_car' ? 'checked' ; ''}}> Go Car

                <button type="submit">Update</button>
</form>
