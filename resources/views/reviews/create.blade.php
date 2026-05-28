<h1>Buat Review Baru</h1>
<form method="POST" action="{{ route('reviews.store') }}">
    @csrf
    Rating:
    <br>
    <input type="number" name="rating" min="1" max="5">
    <br>
    <br>
    Ulasan:
    <br>
    <textarea name="review_driver" rows="8" required></textarea>
    <br>
    <br>
    <button type="submit">Simpan</button>
</form>