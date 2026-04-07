@extends('layouts.admin-login')
@section('content')
<div class="admin-login-card justify-content-center align-items-center">

    <h2>تسجيل دخول الأدمن</h2>
    <p>ادخل بياناتك للوصول إلى لوحة التحكم</p>

    <form id="admin-login-form" action="{{route('admin.login.submit')}}" method="POST">
        @csrf

        <div class="form-group">
            <label>البريد الإلكتروني</label>
            <input type="email" name="email" placeholder="example@email.com" required>
        </div>

        <div class="form-group">
            <label>كلمة المرور</label>
            <input type="password" name="password" placeholder="********" required>
            
        </div>

        <button type="submit" class="btn-login">تسجيل الدخول</button>
    </form>
</div>
@endsection
