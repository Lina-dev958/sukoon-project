@extends('layouts.all-artical')
@section('content')
<div class="container py-5" id="blog">

    <div class="text-center mb-5">
        <h2 class="fw-bold">مدونة سكون</h2>
        <p class="text-muted">
            جميع المقالات مكتوبة بقلم الأخصائيين المعتمدين من أقسام مختلفة
        </p>
    </div>

    <!-- Articles -->
    <div class="row justify-content-center">
        @foreach($articles as $article)
        <div class="col-lg-4 col-md-6 col-sm-10 mb-4">
            <div class="blog-card p-3 border rounded h-100">
                @if($article->image)
                    <img src="{{ asset('storage/' . $article->image) }}" class="img-fluid mb-3" alt="{{ $article->title }}">
                @else
                    <img src="{{ asset('assets/img/default-article.png') }}" class="img-fluid mb-3" alt="{{ $article->title }}">
                @endif

                <h5 class="blog-title">{{ $article->title }}</h5>
                <p class="blog-desc">{{ $article->excerpt }}</p>
                <p class="blog-author">
                   د / {{ $article->therapist->user->name ?? 'أخصائي' }}
                </p>
                <a href="{{ route('articles.show', $article->id) }}" class="btn btn-read btn-sm">اقرأ المزيد</a>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $articles->links() }}
    </div>

    

</div>
@endsection
