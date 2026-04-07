@extends('layouts.patient-register')
@section('content')
<div class="login-wrapper d-flex justify-content-center align-items-center">
    <div class="login-card">
        <h6 class="fw-bold mb-2">أنشئ حسابك الآن</h6>
        <p class="small text-muted mb-3">انضم إلى آلاف المستخدمين لمتابعة صحتك النفسية</p>

        <a href="{{ route('patient.login.google') }}" class="btn google-btn mb-3">
            <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google"> التسجيل باستخدام Google
        </a>
        <div class="divider">أو</div>


        <form id="patientRegisterForm" method="POST" action="{{ route('patient.register') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" id="name" name="name" class="form-control custom-input" placeholder="الاسم الكامل"
                        required>
                </div>
                <div class="col-md-6">
                    <input type="email" id="email" name="email" class="form-control custom-input" placeholder="البريد الإلكتروني"
                        required>
                </div>
                <div class="col-md-6">
                    <input type="password" id="password" name="password" class="form-control custom-input" placeholder="كلمة المرور"
                        required>
                </div>
                <div class="col-md-6">
                    <input type="password"  name="password_confirmation" class="form-control custom-input" placeholder="تأكيد كلمة المرور"
                        required>
                </div>
                <div class="col-12">
                    <button type="submit" class="main-btn mt-3">إنشاء الحساب</button>
                </div>
            </div>
        </form>

         <p class="tiny-text mt-3 text-end">
            لديك حساب بالفعل؟ <a href="patient-login.html">تسجيل الدخول</a>
        </p>

    </div>
</div>
@endsection

