@extends('layouts.artical')
@section('contsnt')
@section('content')
<div class="article-container mt-5 pt-5">
    <h1 class="article-title">{{ $article->title }}</h1>

    <p class="article-author">
        بقلم: {{ $article->therapist->user->name ?? 'أخصائي' }} – {{ $article->therapist->job_title ?? 'أخصائي نفسي' }}
    </p>

    <div class="article-content mt-4">
        <p>
            {{ $article->excerpt ?? Str::limit($article->content, 300) }}
        </p>

        {{-- إذا أردت عرض المحتوى الكامل أسفل النبذة --}}
        <div>
            {!! nl2br(e($article->content)) !!}
        </div>
    </div>

    <a href="{{ route('articles.index') }}" class="btn btn-read mt-4">العودة للصفحة الرئيسية</a>
</div>
@endsection