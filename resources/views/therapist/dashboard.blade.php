@extends('layouts.therapist')
@section('content')
<section class="therapist-profile">

    <div class="profile-card">
        <img src="{{ asset('storage/' . $therapist->image) }}" 
        class="profile-img rounded-circle mb-3"
        alt="{{ $therapist->user->name }}">

        <h4 class="fw-bold">{{ $therapist->user->name }}</h4>
        <p class="text-muted">{{ $therapist->job_title ?? '—' }}</p>
        <p><span><i class="bi bi-geo-alt "></i> {{ $therapist->location ?? 'لم يتم تحديد البلد بعد' }}</span>   ،
            <span><i class="bi bi-briefcase"></i> خبرة {{ $therapist->experience_years ?? 0 }}  سنوات  </span> ،
            <span><i class="bi bi-phone"></i> {{ $therapist->phone ?? 'لا يوجد رقم للتواصل' }}</span></p>
    
        <div class="stats">
            <div class=" info-box mb-4 p-3 shadow rounded">
                <h5 class="fw-bold mb-3">الإهتمامات</h5>
                <div class="d-flex flex-wrap gap-2">
                   

                    @php
                  $interests = is_string($therapist->interests)
                  ? json_decode($therapist->interests, true)
                   : $therapist->interests;
                  @endphp

@foreach($interests ?? [] as $interest)
    <span class="tag">{{ $interest }}</span>
@endforeach

@if(empty($interests))
    <span>لا يوجد اهتمامات </span>
@endif
                </div>           
             </div>
    
            <div class="mb-4 p-3 shadow rounded">
                <h5 class="fw-bold mb-3">مهارات التواصل</h5>
                @forelse($therapist->skills ?? [] as $skill)
               <div class="skill">
                    <span>{{ $skill->skill_name }}</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: {{ $skill->level }}%"></div>
                    </div>
              </div>
              @empty
             <p>لا توجد مهارات مضافة بعد.</p>
             @endforelse
            </div>
        </div>
        <div class="mt-3">
            <a href="{{ route('therapist.profile.edit') }}" class="edit-profile btn btn-primary ">تعديل البيانات</a>
        </div>
    </div>
    

    <div class="stats">
        <div class="stat-card">
            <h3 id="sessions-count">{{ $articlesCount }}</h3>
            <p>عدد المقالات</p>
        </div>

        <div class="stat-card">
            <h3 id="articles-count">{{ $sessionsCount }}</h3>
            <p>عدد الجلسات</p>
        </div>




        
    </div>
<div class="m-5 p-5">
    <table>
        <thead>
            <tr>
                <th>رقم الحجز</th>
                <th>المريض</th>
                <th>التاريخ</th>
                <th>الوقت</th>
                <th>الحالة</th>
                <th>إجراء</th>

            </tr>
        </thead>
        <tbody>
            
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->date }}</td>
                    <td>{{ $booking->time }}</td>
                    <td>{{ $booking->status }}</td>
                    <td>
                        @if($booking->status == 'pending')
                            <form action="{{ route('booking.approve', $booking->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">وافق على الجلسة</button>
                            </form>
                        @elseif($booking->status == 'approved')
                            {{-- <a href="{{ $booking->meeting_link }}" target="_blank" class="btn btn-primary">بدء الجلسة</a> --}}
                            <a class="edit-profile btn" 
                       href="{{ route('session.video', $nextSession->id) }}">
                        بدء الجلسة
                    </a>
            @endif
        </td>


                </tr>
            @endforeach
        </tbody>
    </table>

</div>
   

    <div class="articles-section">

        <div class="articles-header">
            <h3>مقالاتي</h3>
            <a href="{{route('therapist.articles.create')}}" class="add-article">+ إضافة مقال</a>
        </div>

        <div class="articles-grid">

            @forelse($articles as $article)
                <div class="article-card">
                    <img src="{{ asset('storage/' . $article->image) }}" alt="">
        
                    <div class="article-content">
                        <h5>{{ $article->title }}</h5>
                        <p>{{ $article->excerpt}}</p>
        
                        <a href="{{ route('articles.show', $article->id) }}" class="btn btn-sm btn-primary">
                            عرض المقال
                        </a>
                    </div>
                </div>
            @empty
                <p>لا يوجد مقالات بعد 😢</p>
            @endforelse
        
        </div>

    </div>

</section>
@endsection
