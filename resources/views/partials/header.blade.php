<nav class="navbar navbar-expand-lg fixed-top custom-nav">
    <div class="container-fluid px-3">

        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{asset('assets')}}/img/logo.png" alt="SUKOON Logo" class="logo-img">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">

            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 nav-links">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">الرئيسية</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#about">من نحن</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#services">خدماتنا</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#articles">مقالاتنا</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('therapists.index') }}">الأخصائيين</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#success">آراء العملاء</a></li>
                <li class="nav-item"><a class="nav-link" href="#footer">تواصل معنا</a></li>
            </ul>

            @auth
            
        
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn-consult btn-logout">
                    تسجيل الخروج
                </button>
            </form>
        @endauth

        </div>
    </div>
</nav>