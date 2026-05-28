<h1>Ubah Review</h1>
<form method="POST" action="{{ route('reviews.update', $review) }}">
    @csrf
    @method('PUT')
    Rating:
    <br>
    <input type="number" name="rating" min="1" max="5" value="{{ $review->rating }}">
    <br>
    <br>
    Ulasan:
    <br>
    <textarea name="review_driver" rows="8" required>{{ $review->review_driver }}</textarea>
    <br>
    <br>
    <button type="submit">Simpan</button>
</form>