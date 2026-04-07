@extends('layouts.patient')
@section('content')
<section class="patient-profile">
    <div class="container py-5">
        <div class="text-center mb-4">
            <h2 class="fw-bold">{{ $patient ? 'تعديل الملف الشخصي' : 'إنشاء الملف الشخصي' }}</h2>
            <p class="text-muted">
                {{ $patient ? 'قم بتحديث بياناتك الشخصية أدناه' : 'أدخل بياناتك الشخصية لإنشاء الملف الشخصي' }}
            </p>
        </div>

        <div class="profile-card p-4 shadow rounded mx-auto" style="max-width: 600px;">
            <form action="{{ $patient ? route('patient.update') : route('patient.store') }}" method="POST">
                @csrf
                @if($patient)
                    @method('PUT')
                @endif

                {{-- الاسم --}}
                <div class="form-group mb-3">
                    <label for="name">الاسم</label>
                    <input type="text" name="name" id="name" class="form-control" 
                           value="{{ $patient->user->name ?? '' }}" required>
                </div>

                {{-- البريد الإلكتروني --}}
                <div class="form-group mb-3">
                    <label for="email">البريد الإلكتروني</label>
                    <input type="email" name="email" id="email" class="form-control" 
                           value="{{ $patient->user->email ?? '' }}" required>
                </div>

                {{-- رقم الهاتف --}}
                <div class="form-group mb-3">
                    <label for="phone">رقم الهاتف</label>
                    <input type="text" name="phone" id="phone" class="form-control" 
                           value="{{ $patient->phone ?? '' }}" required>
                </div>

                {{-- العنوان --}}
                <div class="form-group mb-3">
                    <label for="address">العنوان</label>
                    <input type="text" name="address" id="address" class="form-control" 
                           value="{{ $patient->address ?? '' }}">
                </div>

                {{-- كلمة المرور --}}
                <div class="form-group mb-3">
                    <label for="password">كلمة المرور الجديدة</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="********">
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success">
                        {{ $patient ? 'حفظ التعديلات' : 'إنشاء الملف الشخصي' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection