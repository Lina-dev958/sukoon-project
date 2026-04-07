<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>بوابة الدفع</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="{{asset('assets')}}/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{asset('assets')}}/css/font.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="{{asset('assets')}}/css/payment.css">
</head>

<body>

    @include('partials.header')

    @yield('content')
    
    @include('partials.footer')

   
    <script src="{{asset('assets')}}/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')


</body>

</html>