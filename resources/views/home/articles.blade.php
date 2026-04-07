{{-- <section class="articles-section" id="articles">
    <span class="section-tag center">المقالات</span>
    <h2 class="section-title">مقالات نفسية</h2>
    <p class="section-sub">
        نقدم مجموعة متنوعة من المقالات النفسية التي كتبها أخصائيون منصة سكون
    </p>

    <div class="articles-grid">
        <div class="articles-grid">
            @foreach($articles as $article)
                <div class="article-card">
                    <img src="{{ asset('assets/img/' . $article->image) }}" alt="">
                    <div class="article-content">
                        <h3>{{ $article->title }}</h3>
                        <p>{{ $article->excerpt }}</p>
                        <a href="{{ route('articles.show', $article->id) }}">اعرف المزيد</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="view-all">
        <a href="{{ route('therapist.articles.index') }}">تصفح جميع المقالات</a>
    </div>
</section> --}}



<section class="articles-section" id="articles">

    <span class="section-tag center">المقالات</span>
    <h2 class="section-title">مقالات نفسية</h2>
    <p class="section-sub">
        نقدم مجموعة متنوعة من المقالات النفسية التي كتبها أخصائيون منصة سكون
    </p>

    <div class="articles-grid">
        @foreach($articles as $article)
        <div class="article-card">
            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
            <div class="article-content">
                <h3>{{ $article->title }}</h3>
                <p>{{ $article->excerpt }}</p>
                <a href="{{ route('articles.show', $article->id) }}">اعرف المزيد</a>
            </div>
        </div>
        @endforeach
    </div>

    <div class="view-all">
        <a href="{{ route('articles.index') }}">تصفح جميع المقالات</a> 
    </div>

</section>