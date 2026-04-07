@extends('layouts.patient')
@section('content')
<section class="edit-patient-profile py-5">
    <div class="container">
        <h2 class="mb-4 text-center">تعديل البيانات الشخصية</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('patient.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- الاسم -->
            <input type="text" name="name" class="form-control mb-3" value="{{ auth()->user()->name }}" placeholder="الاسم">

            <!-- الإيميل -->
            <input type="email" name="email" class="form-control mb-3" value="{{ auth()->user()->email }}" placeholder="الإيميل">

            <!-- الباسورد -->
            <input type="password" name="password" class="form-control mb-3" placeholder="كلمة مرور جديدة">

            <!-- بيانات -->
            <input type="text" name="phone" class="form-control mb-3" 
            value="{{ $patient->phone ?? '' }}" placeholder="الهاتف">
            <input type="text" name="location" class="form-control mb-3" 
            value="{{ $patient->location ?? '' }}" placeholder="العنوان">
                        <br><br>
            <button class="btn btn-success">حفظ</button>
        </form>
    </div>
</section>
    
@endsection