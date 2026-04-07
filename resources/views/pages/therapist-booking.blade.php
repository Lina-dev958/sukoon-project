@extends('layouts.therapist-booking')

@section('content')
<section class="booking-page py-5">

    <div class="booking-header text-center mb-5">
        <p class="small text-muted">
            <a href="#" class="text-muted text-decoration-none">
                قائمة المعالجين
            </a>
            /
            <span class="text-black fw-bold">
                د. {{ $therapist->user->name }}
            </span>
            /
            <span class="text-black fw-bold">
                حجز الجلسة
            </span>
        </p>

        <p class="text-black fw-bold">احجز موعدك واحصل على مساعدتك</p>
    </div>

    <div class="container">
        <div class="row g-4">

            <!-- معلومات الأخصائي -->
            <div class="col-lg-5">

                <div class="info-box mb-3 d-flex align-items-center gap-3">


                    <img src="{{ asset('storage/' . $therapist->image) }}" 
                    class="profile-img therapist-img rounded-circle mb-3"
                    alt="{{ $therapist->user->name }}">
                    <div>
                        <h6 class="fw-bold mb-1">أ.د/{{ $therapist->user->name }}</h6>
                        <p class="text-muted">{{ $therapist->job_title ?? '—' }}</p>
                        <div class="stars">★★★★★</div>
                    </div>
                </div>

                <div class="info-box mb-3">
                    <h6 class="fw-bold mb-3">مدة الجلسة</h6>
                    <div class="d-flex gap-2">
                        <button class="duration-btn active" onclick="setDuration(30)">30 دقيقة</button>
                        <button class="duration-btn" onclick="setDuration(60)">60 دقيقة</button>
                    </div>
                </div>

                <div class="info-box mb-4">
                    <h6 class="fw-bold mb-2">الفترة والتكلفة</h6>
                    <p class="mb-1">مدة الجلسة: <strong id="durationText">30 دقيقة</strong></p>
                    <p class="mb-0">السعر: <strong id="priceText">45 دولار</strong></p>
                </div>
                
                {{-- <a href="{{route('payment-index')}}" class="btn btn-success w-100">
                    بوابة الدفع
                </a> --}}
                @auth
                <form method="POST" action="{{ route('book.session') }}">    @csrf
                    <a href="{{route('payment-index')}}" class="btn btn-success w-100">
                        بوابة الدفع
                    </a>
                </form>
                 @endauth

                 @guest
                 <a href="{{route('patient.login')}}">لازم تسجل دخول اولا </a>
                  @endguest

            </div>




            {{-- <div class="col-lg-7">
                <div class="calendar-box">
                    <h6 class="fw-bold mb-3">اختر الموعد</h6>

                    <div id="calendar"></div>

                    <div id="bookingBox" style="display:none" class="mt-3">
                        <h4 id="selectedDateText"></h4>
                        <p>اختر وقت الجلسة:</p>

                        <div class="d-flex gap-2 flex-wrap">
                            <button class="time-btn" onclick="setTime('10:00')">10:00</button>
                            <button class="time-btn" onclick="setTime('11:00')">11:00</button>
                            <button class="time-btn" onclick="setTime('12:00')">12:00</button>
                        </div>
                    </div>

                </div>
            </div> --}}


            <!-- الكالندر -->
            <div class="col-lg-7">
                <div class="calendar-box">
                    <h6 class="fw-bold mb-3">اختر الموعد</h6>

                    <div id="calendar"></div>

                    <div id="bookingBox" style="display:none; margin-top:20px;">
                        <h5 id="selectedDateText"></h5>
                        <p>اختر الوقت:</p>

                        <button onclick="bookSession('10:00')" class="btn btn-outline-primary btn-sm">10:00</button>
                        <button onclick="bookSession('11:00')" class="btn btn-outline-primary btn-sm">11:00</button>
                        <button onclick="bookSession('12:00')" class="btn btn-outline-primary btn-sm">12:00</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection


{{-- 🔥 أهم تعديل هون --}}
@push('scripts')
<script>

let calendar;
let selectedDate = null;
let therapist_id = {{ $therapist->id }};

document.addEventListener('DOMContentLoaded', function () {

    const calendarEl = document.getElementById('calendar');

    calendar = new FullCalendar.Calendar(calendarEl,{

        initialView:'dayGridMonth',
        locale:'ar',

        // تحميل الحجوزات
        events:function(fetchInfo,successCallback){

            fetch('/bookings')
            .then(res=>res.json())
            .then(data=>{

                let events = data
                .filter(b=>b.therapist_id==therapist_id)
                .map(b=>({
                    id:b.id,
                    title:'محجوز '+b.time,
                    start:b.date,
                    backgroundColor:'#ff9f89'
                }));

                successCallback(events);
            });
        },

        // عند اختيار يوم
        dateClick:function(info){

            selectedDate = info.dateStr;

            document.getElementById('selectedDateText').innerText =
            'حجز بتاريخ: ' + selectedDate;

            document.getElementById('bookingBox').style.display = 'block';
        },

        // حذف حجز
        eventClick:function(info){

            if(!confirm("إلغاء الحجز؟")) return;

            fetch('/bookings/'+info.event.id,{

                method:'DELETE',
                headers:{
                    'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content
                }

            })
            .then(()=>{
                info.event.remove();
                alert("تم الإلغاء");
            });
        }

    });

    calendar.render();
});


// 🔥 دالة الحجز
function bookSession(time){

    if(!selectedDate) return;

    fetch('/book-session',{

method:'POST',
credentials:'same-origin', // 🔥 هذا أهم سطر

headers:{
    'Content-Type':'application/json',
    'Accept':'application/json',
    'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content
},

body:JSON.stringify({
    therapist_id: therapist_id,
    date: selectedDate,
    time: time
})

})

.then(async res => {

let data = await res.json();

if(!res.ok){
    throw new Error(data.message || "خطأ");
}

return data;
})
    .then(data => {

        calendar.addEvent({
            id: data.id,
            title: 'محجوز ' + time,
            start: selectedDate,
            backgroundColor:'#ff9f89'
        });

        document.getElementById('bookingBox').style.display='none';
        selectedDate=null;

        alert("تم الحجز بنجاح 🎉");

    })

    .catch(err => {
        alert(err.message || "هذا الموعد محجوز");
    });
}

</script>
@endpush