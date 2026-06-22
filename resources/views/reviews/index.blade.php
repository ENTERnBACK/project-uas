<div class="container" style="padding: 20px;">
    <h2>📜 Riwayat Ulasan Anda</h2>
    <a href="{{ route('dashboard.driver') }}" class="btn btn-secondary" style="margin-bottom: 20px; display: inline-block;">⬅️ Kembali ke Dashboard</a>

    @if($reviews->isEmpty())
        <p>Belum ada ulasan dari penumpang untuk Anda saat ini.</p>
    @else
        @foreach($reviews as $review)
            <div style="border: 1px solid #ddd; padding: 15px; margin-bottom: 10px; border-radius: 8px;">
                <strong style="color: #f5b301;">⭐ {{ $review->rating }}/5</strong>
                <p style="margin: 5px 0 0 0; font-style: italic;">"{{ $review->review_driver ?? 'Tidak ada ulasan tertulis' }}"</p>
                <small style="color: #888;">Diterima pada: {{ $review->created_at->format('d M Y') }}</small>
            </div>
        @endforeach
    @endif
</div>