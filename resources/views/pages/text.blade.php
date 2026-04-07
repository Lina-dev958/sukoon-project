{{-- @extends('layouts.all-therapist')

@section('content')

<div class="container py-5">

    <div class="text-center mb-4">
        <h2 class="section-title">فريق الأخصائيين</h2>
        <p class="section-subtitle">
            نخبة من الأخصائيين النفسيين المعتمدين ذوي الخبرة الواسعة
        </p>
    </div>

    @php
        $specialization = $therapists->chunk(3);
    @endphp

    {{-- الصفحة الأولى --}}
    <div id="page1" class="page-section active">

        @foreach($specialization as $specialty)
            <section class="specialty-section mb-5">

                <h4 class="specialty-title mb-4">{{ $specialty }}</h4>

                <div class="d-flex flex-wrap justify-content-center gap-4">
                    @foreach($therapists as $therapist)
                        <div class="therapy-card-wrapper">
                            <div class="therapy-card">
                                <img src="{{ asset('storage/' . $therapist->image) }}" 
                                class="profile-img rounded-circle mb-3"
                                alt="{{ $therapist->user->name }}">                                
                                
                                <h6 class="fw-bold mt-3">
                                    {{ $therapist->user->name }}
                                </h6>
                                <p class="phone">
                                    {{ $therapist->phone }}
                                </p>
                                <a href="{{ route('therapist.show',$therapist->id) }}" class="btn btn-success">
                                    الملف التعريفي
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

            </section>
        @endforeach

    </div>

    {{-- الصفحة الثانية --}}
    <div id="page2" class="page-section">

        @foreach($specialization->skip(1)->first() ?? [] as $specialty => $items)
            <section class="specialty-section mb-5">

                <h4 class="specialty-title mb-4">{{ $specialty }}</h4>

                <div class="d-flex flex-wrap justify-content-center gap-4">
                    @foreach($items as $therapist)
                        <div class="therapy-card-wrapper">
                            <div class="therapy-card">
                                <img src="{{ asset('storage/' . $therapist->image) }}" 
                                class="profile-img rounded-circle mb-3"
                                alt="{{ $therapist->user->name }}">

                                <h6 class="fw-bold mt-3">
                                    {{ $therapist->user->name }}
                                </h6>
                                <p class="phone">
                                    {{ $therapist->phone }}
                                </p>
                                <a href="{{ route('therapist.show',$therapist->id) }}" class="btn btn-success">
                                    الملف التعريفي
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

            </section>
        @endforeach

    </div>

    {{-- زر الانضمام --}}
    <div class="join-team-section text-center my-5">
        <h3 class="fw-bold mb-3">
            قدم طلب انضمام لفريق سكون
        </h3>
        <a href="{{route('therapist.register')}}" class="btn btn-success btn-lg">
            طلب الانضمام
        </a>
    </div>

    {{-- pagination --}}
    <nav class="mt-5">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" href="#" onclick="showPage(1)">1</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#" onclick="showPage(2)">2</a>
            </li>
        </ul>
    </nav>

</div>

@endsection --}}