<h2>Register</h2>

@if ($errors->any())
    <div style="color: red; font-weight: bold; margin-bottom: 20px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/register">
    @csrf

    <label>Daftar sebagai</label>
    <select name="role" required>
        <option value="user">User</option>
        <option value="driver">Driver</option>
    </select>
    <br><br>

    <input type="text" name="name" placeholder="Nama" required>
    <br><br>

    <input type="email" name="email" placeholder="Email" required>
    <br><br>

    <input type="password" name="password" placeholder="Password" required>
    <br><br>

    <button type="submit">Register</button>
</form> 
<p>Sudah punya akun? <a href="/login">Login di sini</a></p>