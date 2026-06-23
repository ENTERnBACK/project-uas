<div style="font-family: Arial, sans-serif; background: #f3f4f6; min-height: 100vh; padding: 30px;">
    <div style="background: white; padding: 30px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,.08); max-width: 800px; margin: 0 auto;">       
        <h2 style="margin-top: 0; margin-bottom: 20px; font-size: 24px; color: #1f2937;">📜 Riwayat Ulasan Anda</h2>
        <a href="{{ route('dashboard.driver') }}" style="text-decoration: none; background: #4b5563; color: white; padding: 12px 20px; border-radius: 12px; font-weight: bold; font-size: 14px; display: inline-block; margin-bottom: 25px; transition: .3s;">
            ⬅️ Kembali ke Dashboard
        </a>
        @if($reviews->isEmpty())
            <p style="color: gray; font-style: italic; margin: 0;">Belum ada ulasan dari penumpang untuk Anda saat ini.</p>
        @else
            <div style="display: flex; flex-direction: column; gap: 15px;">
                @foreach($reviews as $review)
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 20px; border-radius: 15px; box-shadow: 0 2px 5px rgba(0,0,0,.02);">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <strong style="color: #f5b301; font-size: 18px;">⭐ {{ $review->rating }}/5</strong>
                            <small style="color: #94a3b8; font-size: 12px;">Diterima pada: {{ $review->created_at->format('d M Y') }}</small>
                        </div>
                        <p style="margin: 0; color: #334155; font-style: italic; line-height: 1.5; font-size: 15px;">
                            "{{ $review->review_driver ?? 'Belum ada ulasan.' }}"
                        </p>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>