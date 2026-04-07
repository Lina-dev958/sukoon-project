@extends('layouts.patient')
@section('content')
<section class="patient-profile">

    <div class="profile-card">

        {{-- <h2>{{ $user->name }}</h2> 
        <h2>{{ $user->phone }}</h2>  --}}
        <h4 class="fw-bold">{{ $patient->user->name }}</h4>
        <p><span><i class="bi bi-geo-alt "></i> {{ $patient->location ?? 'لم يتم تحديد البلد بعد' }}</span>   ،
            <span><i class="bi bi-phone"></i> {{ $patient->phone ?? 'لا يوجد رقم للتواصل' }}</span></p>


        <a class="edit-profile btn btn-primary " href="{{route('edit-profile')}}">
            تعديل البيانات
        </a>

    </div>

    <div class="stats">
        <div class="stat-card">
            <h3>{{ $sessionsCount }}</h3>
            <p>عدد الجلسات</p>
        </div>

        <div class="stat-card">

            @if($nextSession)
        
                <h5>
                    موعد الجلسة القادمة <br>
                    {{ $nextSession->date }} - {{ $nextSession->time }}
                </h5>
        
                {{-- حالة الجلسة --}}
                @if($nextSession->status == 'pending')
                    <p>بانتظار موافقة الأخصائي</p>
        
                @elseif($nextSession->status == 'approved' && $nextSession->meeting_link)
                    <a class="edit-profile btn" 
                       href="{{ route('session.video', $nextSession->id) }}">
                        بدء الجلسة
                    </a>
        
                @endif
        
            @else
        
                <h5>لا يوجد جلسات حالياً</h5>
        
            @endif
        
        </div>
    </div>

  <section class="services-section" id="services">
    <div class="container">

        <h2 class="services-title text-center">رحلتك الداخلية تبدأ هنا</h2>
        <p class="services-subtitle text-center mb-4">
            نوفر لك أدوات بسيطة وفعّالة لمساعدتك على فهم مشاعرك واستعادة توازنك النفسي
        </p>

        <div class="row g-4 justify-content-center">

            <!-- Card 1 -->
            <div class="col-md-4">
                <div class="service-card text-center">
                    <div class="card-img">
                        <img src="{{asset('assets')}}/img/اختبار التقييم النفسي.png" class="w-100">
                    </div>
                    <div class="card-content p-3">
                        <h3>اختبار التقييم النفسي</h3>
                        <span class="card-small d-block mb-2">تعرّف على مشاعرك</span>
                        <p>
                            أجرِ اختباراً بسيطاً يساعدك على فهم مشاعرك وحالتك النفسية
                            الحالية، ويمنحك نظرة أوضح عن احتياجاتك العاطفية
                        </p>
                        <a href="{{route('test')}}" class="btn btn-success">ابدأ الآن</a>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-4">
                <div class="service-card text-center">
                    <div class="card-img">
                        <img src="{{asset('assets')}}/img/اكتب ما بداخلك.png" class="w-100">
                    </div>
                    <div class="card-content p-3">
                        <h3>اكتب ما بداخلك</h3>
                        <span class="card-small d-block mb-2">كتابة يوميات</span>
                        <p>
                            مساحة آمنة لتدوين أفكارك ومشاعرك بحرية، تساعدك على التفريغ
                            النفسي وفهم ذاتك بشكل أعمق.
                        </p>
                        <a href="{{route('journal.index')}}" class="btn btn-success">ابدأ الآن</a>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-4">
                <div class="service-card text-center">
                    <div class="card-img">
                        <img src="{{asset('assets')}}/img/كيف تشعر الآن.png" class="w-100">
                    </div>
                    <div class="card-content p-3">
                        <h3>كيف تشعر الآن</h3>
                        <span class="card-small d-block mb-2">تتبع حالتك المزاجية</span>
                        <p>
                            حدد شعورك الحالي وسجل مزاجك اليومي بسهولة لتتابع تغير
                            حالتك النفسية مع الوقت وتفهم أكثر ما يؤثر على مشاعرك
                        </p>
                        <a href="{{route('mood.index')}}" class="btn btn-success">ابدأ الآن</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

    <div class="therapists-section">

        <div class="therapists-grid" id="therapists-list">
        </div>
        <table class="sessions-table">
            <thead>
                <tr>
                    <th>رقم الجلسة</th>
                    <th>الأخصائي</th>
                    <th>التاريخ</th>
                    <th>الوقت</th>
                    <th>الحالة</th>
                    <th>الإجراء</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patient->bookings()->with('therapist.user')->get() as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->therapist->user->name }}</td>
                        <td>{{ $booking->date }}</td>
                        <td>{{ $booking->time }}</td>
                        <td>{{ $booking->status }}</td>
                        <td>
                            @if($booking->status == 'approved' && $booking->meeting_link)
                                تم الموافقة
                            @elseif($booking->status == 'pending')
                                في انتظار الموافقة
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</section>
@endsection