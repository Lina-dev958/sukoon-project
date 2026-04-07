@extends('layouts.home')

@section('title', 'SUKOON - الرئيسية')

@section('content')
    @include('home.hero')  
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>تسجيل الدخول</h2>
            <p>اختر نوع حسابك:</p>
            <div class="login-options">
                <a href="{{route('patient.login')}}" class="option-btn">مستفيد</a>
                <a href="{{route('therapist.login')}}" class="option-btn">معالج</a>
                <a href="{{route('admin.login')}}" class="option-btn">آدمن</a>
            </div>
        </div>
    </div>
    <div id="signupModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>إنشاء حساب</h2>
            <p>اختر نوع الحساب الذي تريد إنشاؤه:</p>
            <div class="login-options">
                <a href="{{route('patient.register')}}" class="option-btn">مستفيد</a>
                <a href="{{route('therapist.register')}}" class="option-btn">معالج</a>                
            </div>
        </div>
    </div>       
    @include('home.about')          
    @include('home.therapy')      
    @include('home.articles')      
    @include('home.success')      
@endsection

@push('scripts')
<script>
    const loginBtn = document.getElementById('loginBtn');
    const loginModal = document.getElementById('loginModal');
    const closeModal = document.querySelector('.modal .close');

    loginBtn.addEventListener('click', function (e) {
        e.preventDefault();
        loginModal.style.display = 'block';
    });

    closeModal.addEventListener('click', function () {
        loginModal.style.display = 'none';
    });

    window.addEventListener('click', function (e) {
        if (e.target == loginModal) {
            loginModal.style.display = 'none';
        }
    });
</script>

<script>
    const signupBtn = document.getElementById('signupBtn');
    const signupModal = document.getElementById('signupModal');
    const signupClose = signupModal.querySelector('.close');

    signupBtn.addEventListener('click', function (e) {
        e.preventDefault();
        signupModal.style.display = 'block';
    });

    signupClose.addEventListener('click', function () {
        signupModal.style.display = 'none';
    });

    window.addEventListener('click', function (e) {
        if (e.target == signupModal) {
            signupModal.style.display = 'none';
        }
    });
</script>

<script>
    var swiper = new Swiper(".mySwiper", {
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
</script>

<script>
    const testimonials = document.querySelectorAll('.testimonial');
    const dots = document.querySelectorAll('.dot');
    const nextBtn = document.querySelector('.next');
    const prevBtn = document.querySelector('.prev');

    let index = 0;

    function showSlide(i) {
        testimonials.forEach(t => t.classList.remove('active'));
        dots.forEach(d => d.classList.remove('active'));

        testimonials[i].classList.add('active');
        dots[i].classList.add('active');
    }

    nextBtn.onclick = () => {
        index = (index + 1) % testimonials.length;
        showSlide(index);
    }

    prevBtn.onclick = () => {
        index = (index - 1 + testimonials.length) % testimonials.length;
        showSlide(index);
    }

    dots.forEach((dot, i) => {
        dot.onclick = () => {
            index = i;
            showSlide(index);
        }
    });
</script>
@endpush