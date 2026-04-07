@extends('layouts.therapist-rating')
@section('content')
<div class="rating-wrapper m-5">
    <div class="rating-card">
        <h2>تقييم الأخصائي</h2>
        <p class="text-muted mb-4">شاركنا رأيك حول تجربتك مع الأخصائي.</p>

        <form action="{{ route('therapist.rating', $therapist->id) }}" method="POST">
            @csrf
        
            <input type="hidden" name="rating" id="ratingValue">
        
            <div class="stars">
                <i class="bi bi-star" data-value="1"></i>
                <i class="bi bi-star" data-value="2"></i>
                <i class="bi bi-star" data-value="3"></i>
                <i class="bi bi-star" data-value="4"></i>
                <i class="bi bi-star" data-value="5"></i>
            </div>
        
            <textarea name="comment" class="form-control" rows="5" placeholder="اكتب تقييمك هنا..."></textarea>
        
            <button type="submit" class="btn main-btn">إرسال التقييم</button>
        </form>
        <p class="tiny-text" id="confirmation" style="display:none; color:#14B8A6;">
            شكراً لتقييمك! تم استلامه بنجاح.
        </p>
    </div>
</div>
@endsection

<script>
    let stars = document.querySelectorAll('.stars i');
    let ratingInput = document.getElementById('ratingValue');
    
    stars.forEach(star => {
        star.addEventListener('click', function () {
            let value = this.getAttribute('data-value');
            ratingInput.value = value;
    
            stars.forEach(s => s.classList.remove('active'));
            for (let i = 0; i < value; i++) {
                stars[i].classList.add('active');
            }
        });
    });
    </script>