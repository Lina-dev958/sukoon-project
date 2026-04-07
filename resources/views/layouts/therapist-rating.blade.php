<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقييم الأخصائي</title>

    <!-- Bootstrap 5 -->
    <link href="{{asset('assets')}}/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{asset('assets')}}/css/font.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="{{asset('assets')}}/css/rating.css">

    <style>

    </style>
</head>

<body>

     @include('partials.header')

    @yield('content')

    @include('partials.footer')

    <script src="{{asset('assets')}}/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- <script>
        const stars = document.querySelectorAll('.stars i');
        let selectedRating = 0;

        stars.forEach(star => {
            star.addEventListener('click', () => {
                selectedRating = star.getAttribute('data-value');
                stars.forEach(s => s.classList.remove('selected'));
                for (let i = 0; i < selectedRating; i++) {
                    stars[i].classList.add('selected');
                }
            });
        });

        const submitBtn = document.getElementById('submitRating');

        submitBtn.addEventListener('click', (e) => {
            e.preventDefault();

            if (selectedRating === 0) {
                alert('الرجاء اختيار عدد النجوم أولاً.');
                return;
            }

            Swal.fire({
                icon: 'success',
                title: 'شكراً لتقييمكم!',
                text: `لقد قمت بتقييم ${selectedRating} نجوم.`,
                confirmButtonText: 'حسناً',
            }).then(() => {
                window.location.href = "therabiest.html";
            });
        });
    </script> --}}


</body>

</html>