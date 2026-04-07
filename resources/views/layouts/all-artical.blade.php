<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>مقالات سكون</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
     <!-- Bootstrap -->
     <link href="{{asset('assets')}}/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

   <!-- Font -->
   <link href="{{asset('assets')}}/css/font.css" rel="stylesheet">
   <link href="{{asset('assets')}}/css/article.css" rel="stylesheet">


</head>

<body>

    @include('partials.header')

      @yield('content')
   

    @include('partials.footer')

    <script src="{{asset('assets')}}/js/bootstrap.bundle.min.js"></script>

    <script>
    
        const articlesPerPage = 6;
        let currentPage = 1;
        const totalPages = Math.ceil(articles.length / articlesPerPage);

        function displayArticles(page) {
            currentPage = page;

            const start = (page - 1) * articlesPerPage;
            const end = start + articlesPerPage;
            const container = document.getElementById("blog-container");
            container.innerHTML = "";

            articles.slice(start, end).forEach(article => {
                container.innerHTML += `
        <div class="col-lg-4 col-md-6 col-sm-10 mb-4">
            <div class="blog-card p-3 border rounded h-100">
                <img src="${article.img}" class="img-fluid mb-3" alt="${article.title}">
                <h5 class="blog-title">${article.title}</h5>
                <p class="blog-desc">${article.desc}</p>
                <p class="blog-author">${article.author}</p>
                <a href="${article.link}" class="btn btn-read btn-sm">
                    اقرأ المزيد
                </a>
            </div>
        </div>`;
            });

            renderPagination();
            window.scrollTo({ top: 0, behavior: "smooth" });
        }

        function renderPagination() {
            const pagination = document.getElementById("pagination");
            pagination.innerHTML = "";

            pagination.innerHTML += `
        <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="displayArticles(${currentPage - 1})">السابق</a>
        </li>`;

            for (let i = 1; i <= totalPages; i++) {
                pagination.innerHTML += `
        <li class="page-item ${i === currentPage ? 'active' : ''}">
            <a class="page-link" href="#" onclick="displayArticles(${i})">${i}</a>
        </li>`;
            }

            pagination.innerHTML += `
        <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="displayArticles(${currentPage + 1})">التالي</a>
        </li>`;
        }

        // Initial load
        displayArticles(1);
    </script>

</body>

</html>