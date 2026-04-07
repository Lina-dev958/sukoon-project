@extends('layouts.all-therapist')

@section('content')
<div class="container py-5">

    <div class="text-center mb-4">
        <h2 class="section-title">فريق الأخصائيين</h2>
        <p class="section-subtitle">نخبة من الأخصائيين النفسيين المعتمدين ذوي الخبرة الواسعة</p>
    </div>

    <div class="d-flex flex-wrap justify-content-center gap-4">

        @foreach($therapists as $therapist)
            <div class="therapy-card-wrapper">
                <div class="therapy-card text-center p-3 shadow rounded">
                    <img src="{{ $therapist->image ? asset('storage/' . $therapist->image) : asset('assets/img/default.png') }}" 
                         class="profile-img rounded-circle mb-3" width="120" height="120"
                         alt="{{ $therapist->user->name }}">
    
                    <h6 class="fw-bold mt-2">{{ $therapist->user->name }}</h6>
                    <p class="text-muted">{{ $therapist->job_title ?? '—' }}</p>
                    <p class="phone text-muted">{{ $therapist->phone ?? '—' }}</p>
    
                    <a href="{{ route('therapist.show', $therapist->id) }}" class="btn btn-success btn-sm">
                        الملف التعريفي
                    </a>
                </div>
            </div>
        @endforeach
    
    </div>

    {{-- زر الانضمام --}}
    <div class="join-team-section text-center my-5">
        <h3 class="fw-bold mb-3">قدم طلب انضمام لفريق سكون</h3>
        <a href="{{ route('therapist.register') }}" class="btn btn-success btn-lg">طلب الانضمام</a>
    </div>

    {{-- Pagination --}}
    {{-- <nav class="mt-5">
        <ul class="pagination justify-content-center">
            @foreach($pages as $pageIndex => $page)
                <li class="page-item">
                    <a class="page-link" href="#" onclick="showPage({{ $pageIndex+1 }}); return false;">
                        {{ $pageIndex+1 }}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav> --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $therapists->links() }}
    </div>

</div>
@endsection

@push('scripts')
<script>
function showPage(page) {
    document.querySelectorAll('.page-section').forEach((el, idx) => {
        el.classList.toggle('active', idx+1 === page);
    });
}
</script>
@endpush












