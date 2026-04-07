@extends('layouts.reset-password')
@section('content')
<div class="confirm-wrapper">
    <div class="confirm-card">
        <h6 class="fw-bold mb-3">تم إرسال رابط استعادة كلمة المرور!</h6>
        <p class="small text-muted mb-4">
            تحقق من بريدك الإلكتروني واتبع الرابط لإعادة تعيين كلمة المرور الخاصة بك.
        </p>
        <a href="{{ route('patient.login') }}" class="btn btn-success main-btn">
            العودة لتسجيل الدخول
            </a>    </div>
</div>
@endsection