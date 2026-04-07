@extends('layouts.forgot-password')
@section('content')
<div class="reset-wrapper">
    <div class="reset-card">
        <h6 class="fw-bold mb-2">استعادة كلمة المرور</h6>
        <p class="small text-muted mb-3">أدخل بريدك الإلكتروني لاستلام رابط إعادة تعيين كلمة المرور.</p>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group mb-3">
                <label class="form-label small">البريد الإلكتروني</label>
                <input type="email" class="form-control custom-input" placeholder="أدخل بريدك الإلكتروني" required>
            </div>
            <button type="submit" class="main-btn mb-3">إرسال رابط الاستعادة</button>
        </form>
    </div>
</div>
@endsection