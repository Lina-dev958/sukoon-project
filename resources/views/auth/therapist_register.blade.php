@extends('layouts.therapist-register')
@section('content')
<div class="login-wrapper d-flex justify-content-center align-items-center">
    <div class="login-card">
        <h6 class="fw-bold mb-2">انضم لفريق سكون كمعالج</h6>
        <p class="small text-muted mb-3">سجل حسابك للوصول إلى لوحة التحكم الخاصة بك.</p>

        <a href="{{ route('therapist.login.google') }}" class="btn google-btn mb-3">
            <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google"> التسجيل باستخدام Google
        </a>

        <div class="divider">أو</div>

        <form id="therapistRegisterForm"  action="{{ route('therapist.register') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" id="name" class="form-control custom-input" name="name" placeholder="الاسم الكامل"
                        required>
                </div>
                <div class="col-md-6">
                    <input type="email" id="email" class="form-control custom-input" name="email" placeholder="البريد الإلكتروني"
                        required>
                </div>
                <div class="col-md-6">
                    <input type="password" class="form-control custom-input" name="password" placeholder="كلمة المرور" required>
                </div>
                <div class="col-md-6">
                    <input type="password" class="form-control custom-input" name="password_confirmation" placeholder="تأكيد كلمة المرور"
                        required>
                </div>
                <div class="col-12">
                    <label class="custom-file-upload">
                        اختر الشهادة
                        <input type="file" name="certificate_file" required>
                      </label>
                </div>
                <div class="col-12">
                    <button  type="submit" class="main-btn mt-3">إنشاء الحساب</button>
                </div>
            </div>
        </form>

        <p class="tiny-text mt-3 text-end">
            لديك حساب بالفعل؟ <a href="therapist-login.html">تسجيل الدخول</a>
        </p>
    </div>
</div>
@endsection
