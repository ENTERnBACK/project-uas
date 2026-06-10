<h2>Register</h2>

@if ($errors->any())
    <div style="color: red; margin-bottom: 15px; font-family: sans-serif;">
        <strong>Somethings wrong:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/register">
    @csrf
    <input type="text" name="name" placeholder="Name"><br>
    <input type="email" name="email" placeholder="Email"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <button type="submit">Register</button>
</form>