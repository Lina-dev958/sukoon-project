@extends('layouts.therapist-profile')

@section('content')

<section class="profile-page py-5">
    <div class="container">
        <div class="row g-4">

            <!-- Left Card -->
            <div class="col-lg-4">
                <div class="profile-card text-center">
                    <img src="{{ asset('storage/' . $therapist->image) }}" 
                    class="profile-img rounded-circle mb-3"
                    alt="{{ $therapist->user->name }}">

                    <h6 class="fw-bold mt-3">أ.د/ {{ $therapist->user->name }}</h6>
                    <p class="text-muted">{{ $therapist->job_title ?? '—' }}</p>

                    {{-- Rating --}}
                    <div class="stars mb-2">
                        {!! str_repeat('★', $therapist->rating ?? 4) !!}
                        {!! str_repeat('☆', 5 - ($therapist->rating ?? 4)) !!}
                    </div>

                    <ul class="profile-info text-start">
                            <li><i class="bi bi-translate"></i> العربية، الإنجليزية</li>
                       
                        @if($therapist->location)
                            <li><i class="bi bi-geo-alt"></i> {{ $therapist->location }}</li>
                        @endif
                        @if($therapist->experience_years)
                            <li><i class="bi bi-briefcase"></i> خبرة أكثر من {{ $therapist->experience_years }} أعوام</li>
                        @endif
                       <li><i class="bi bi-clock"></i> 40 دولار / 60 دقيقة | 20 دولار / 30 دقيقة</li>
                    </ul>

                    <div class="d-flex gap-2 justify-content-center mt-3">
                        <a href="{{ route('therapist.rating', $therapist->id) }}" class="btn btn-outline btn-sm">اكتب تقييم</a>
                        <a href="{{ route('therapist.booking', $therapist->id) }}" class="btn btn-success btn-sm">احجز موعد الجلسة</a>
                    </div>
                </div>
            </div>

            <!-- Right Side -->
            <div class="col-lg-8">

                <!-- Specialties -->
                <div class="info-box mb-4">
                    <h6 class="fw-bold mb-3">الإهتمامات</h6>
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

               <!-- Skills -->
               <div class="info-box mb-4">
               <h6 class="fw-bold mb-3">مهارات التواصل</h6>

                @php
               // اختار أول 4 مهارات مختلفة فقط
               $uniqueSkills = collect($therapist->skills ?? [])
                ->unique('skill_name') // يحذف التكرارات حسب اسم المهارة
                ->take(4); // يأخذ أول 4 فقط
                @endphp

               @foreach($uniqueSkills as $skill)
                    <div class="skill">
                        <span>{{ $skill['skill_name'] ?? $skill['name'] }}</span>
                        <div class="progress">
                        <div class="progress-bar" style="width: {{ $skill['level'] }}%"></div>
                       </div>
                    </div>
                @endforeach
               </div>

                <!-- Reviews -->
                <div class="info-box">
                    <h6 class="fw-bold mb-3">آراء العملاء</h6>
                    <div id="reviewsSlider" class="carousel slide carousel-fade" data-bs-ride="carousel"
                      data-bs-interval="3000">
                      <!-- Indicators -->
                      <div class="carousel-indicators">
                        <button type="button" data-bs-target="#reviewsSlider" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#reviewsSlider" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#reviewsSlider" data-bs-slide-to="2"></button>
                      </div>
        
                      <!-- Slides -->
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <div class="review">
                            <p>استماع رائع وتعامل مهني جدًا.</p>
                            <div class="stars small">★★★★★</div>
                          </div>
                        </div>
                        <div class="carousel-item">
                          <div class="review">
                            <p>شعرت براحة كبيرة أثناء الجلسة.</p>
                            <div class="stars small">★★★★★</div>
                          </div>
                        </div>
                        <div class="carousel-item">
                          <div class="review">
                            <p>أسلوب راقٍ واحترافي، أنصح به.</p>
                            <div class="stars small">★★★★☆</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</section>
@endsection