<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختبار التقييم النفسي</title>

    <link href="{{asset('assets')}}/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{asset('assets')}}/css/font.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="{{asset('assets')}}/css/test.css">
</head>

<body>
    
    @include('partials.header')
    @yield('content')
    @include('partials.footer')
    <script src="{{asset('assets')}}/js/bootstrap.bundle.min.js"></script>

    <script>
        function showResult() {
            let score = 0;
            const questions = document.querySelectorAll('.q');

            if (questions.length === 0) {
                alert("ما في أسئلة!");
                return;
            }

            questions.forEach(question => {
                score += parseInt(question.value);
            });

            const result = document.getElementById("result");

            if (score <= 4) {
                result.innerHTML = "حالتك النفسية مستقرة حاليًا. استمري بالاهتمام بنفسك.";
                result.style.color = "#2e8b57";
            }
            else if (score <= 8) {
                result.innerHTML = "توترك متوسط. حاولي تخصيص وقت للراحة والتنفس.";
                result.style.color = "#f39c12";
            }
            else {
                result.innerHTML = "قد تكونين بحاجة لدعم نفسي. لا تترددي في طلب المساعدة.";
                result.style.color = "#c0392b";
            }
        }
    </script>


</body>

</html>