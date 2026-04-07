@extends('layouts.patient-login')
@section('content')
<div class="login-wrapper d-flex justify-content-center align-items-center">
    <div class="login-card text-center">
        <h6 class="fw-bold mb-2">مرحبًا بك في سكون!</h6>
        <p class="small text-muted mb-3">سجّل دخولك لمتابعة رحلتك الصحية.</p>

        <a href="{{ route('patient.login.google') }}" class="btn google-btn mb-3">
            <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google">
            تسجيل الدخول باستخدام Google
        </a>

        <div class="divider">أو</div>
        <form method="POST" action="{{ route('patient.login') }}">
            @csrf
        <div class="form-group mb-3">
            <label class="form-label small">البريد الإلكتروني</label>
            <input type="email" name="email" class="form-control custom-input" placeholder="أدخل البريد الإلكتروني">        
        </div>
        <div class="form-group mb-3">
            <label class="form-label small">كلمة المرور</label>
            <input type="password" name="password" class="form-control custom-input" placeholder="أدخل كلمة المرور">            <div class="text-end mt-1">
                <div class="text-end mt-1">
                    <a href="{{ route('password.request') }}" class="tiny-text">نسيت كلمة المرور؟</a>
                </div>
            </div>

        </div>

        <button type="submit" class="main-btn mb-3">تسجيل الدخول</button>
        </form>

        <p class="tiny-text mt-3">
            إذا لم يكن لديك حساب،
            <a href="{{ route('patient.register') }}">سجّل الآن</a>
        </p>
    </div>
</div>
@endsection
