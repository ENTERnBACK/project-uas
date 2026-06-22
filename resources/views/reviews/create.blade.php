<form action="{{ route('reviews.store') }}" method="POST">
    @csrf
    <input type="hidden" name="trip_id" value="{{ $trip->id }}">

    <h3>Beri Rating Driver Kamu</h3>

    <div class="rating-stars">
        <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 stars">★</label>
        <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 stars">★</label>
        <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 stars">★</label>
        <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 stars">★</label>
        <input type="radio" id="star2" name="rating" value="1" /><label for="star1" title="1 stars">★</label>
    </div>

        <div class="form-group" style="margin-top: 20px;">
            <label>Tulis Ulasan (Opsional):</label>
            <textarea name="review_driver" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary" style="margin-top: 15px;">Kirim Review</button>
    </form>

    <style>
        .rating-stars { display: inline-flex; flex-direction: row-reverse; font-size: 30px; }
        .rating-stars input { display: none; }
        .rating-stars label { color: #ddd; cursor: pointer; padding: 0 5px; }
        .rating-stars input:checked ~ label,
        .rating-stars label:hover,
        .rating-stars label:hover ~ label { color: #f5b301; }
    </style>