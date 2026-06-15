<h2>Register</h2>

<label>Daftar sebagai</label>

<select name="role">
    <option value="user">User</option>
    <option value="driver">Driver</option>
</select>

<form method="POST" action="/register">
    @csrf

    <input type="text" name="name" placeholder="Nama" required>
    <br><br>

    <input type="email" name="email" placeholder="Email" required>
    <br><br>

    <input type="password" name="password" placeholder="Password" required>
    <br><br>

    <button type="submit">Register</button>
</form>

<p>
    Sudah punya akun?
    <a href="/login">Login di sini</a>
</p>

