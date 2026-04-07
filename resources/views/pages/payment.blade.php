@extends('layouts.payment')
@section('content')

<div class="payment-container">
    <h4 class="payment-title">اختر طريقة الدفع</h4>

    <!-- نوع الدفع -->
    <input type="hidden" id="payment_method">

    <!-- بطاقة -->
    <div class="payment-option" onclick="selectPayment('card')">
        <div class="option-header">
            <h6>بطاقة ائتمان</h6>
        </div>

        <div class="payment-form" id="card" style="display:none;">
            <input type="text" class="form-control mb-2" placeholder="رقم البطاقة">
            <div class="d-flex gap-2 mb-2">
                <input type="text" class="form-control" placeholder="MM/YY">
                <input type="text" class="form-control" placeholder="CVC">
            </div>
            <input type="text" class="form-control" placeholder="اسم حامل البطاقة">
        </div>
    </div>

    <!-- بنك -->
    <div class="payment-option" onclick="selectPayment('bank')">
        <div class="option-header">
            <h6>بنك فلسطين</h6>
        </div>

        <div class="payment-form" id="bank" style="display:none;">
            <input type="text" class="form-control mb-2" placeholder="اسم صاحب الحساب">
            <input type="text" class="form-control" placeholder="رقم الحساب أو رقم الجوال">
        </div>
    </div>

    <!-- PalPay -->
    <div class="payment-option" onclick="selectPayment('palpay')">
        <div class="option-header">
            <h6>محفظة PalPay</h6>
        </div>

        <div class="payment-form" id="palpay" style="display:none;">
            <input type="text" class="form-control mb-2" placeholder="اسم صاحب الحساب">
            <input type="text" class="form-control" placeholder="رقم الجوال">
        </div>
    </div>

    <!-- JawwalPay -->
    <div class="payment-option" onclick="selectPayment('jawwal')">
        <div class="option-header">
            <h6>محفظة JawwalPay</h6>
        </div>

        <div class="payment-form" id="jawwal" style="display:none;">
            <input type="text" class="form-control mb-2" placeholder="اسم صاحب الحساب">
            <input type="text" class="form-control" placeholder="رقم الجوال">
        </div>
    </div>

    <!-- زر الدفع -->
    <button class="main-btn mt-3" onclick="fakePayment()">استمرار</button>
</div>

@endsection


@push('scripts')

<!-- 🔥 SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

// اختيار طريقة الدفع
function selectPayment(type) {
    document.querySelectorAll('.payment-option').forEach(opt => {
        opt.classList.remove('active');
        opt.querySelector('.payment-form').style.display = 'none';
    });

    const selected = document.getElementById(type);
    selected.style.display = 'block';
    selected.parentElement.classList.add('active');

    document.getElementById('payment_method').value = type;
}

// الدفع
function fakePayment() {

    let method = document.getElementById('payment_method').value;

    // ❌ إذا ما اختار
    if (!method) {
        Swal.fire({
            icon: 'warning',
            title: 'اختاري طريقة الدفع أولاً',
            confirmButtonText: 'حسناً'
        });
        return;
    }

    // ⏳ Loading
    Swal.fire({
        title: 'جاري تأكيد الدفع...',
        text: 'يرجى الانتظار',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // بعد 3 ثواني
    setTimeout(() => {

        // ✅ نجاح
        Swal.fire({
            icon: 'success',
            title: 'تم الدفع بنجاح ✅',
            text: 'تم تأكيد حجز الجلسة الخاصة بك',
            confirmButtonText: 'رائع'
        }).then(() => {
            window.location.href = "/patient/dashboard";
        });

    }, 3000);
}

</script>

@endpush