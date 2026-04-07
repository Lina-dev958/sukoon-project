<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>كتابة اليوميات</title>

   <link href="{{asset('assets')}}/css/bootstrap.min.css" rel="stylesheet">
  
  <link href="{{asset('assets')}}/css/font.css" rel="stylesheet">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="{{asset('assets')}}/css/journal.css">
</head>

<body>
    @include('partials.header')
    @yield('content')
    @include('partials.footer')

    <script src="{{asset('assets')}}/js/bootstrap.bundle.min.js"></script>

    <script>
        function saveJournal() {
            let text = document.getElementById('journal').value.trim();
            if (!text) { alert("اكتب شيئًا قبل الحفظ!"); return; }

            let journals = JSON.parse(localStorage.getItem('journals') || '[]');
            journals.unshift(text); // آخر كتابة أولاً
            localStorage.setItem('journals', JSON.stringify(journals));
            alert("تم حفظ يومياتك 🤍");
            document.getElementById('journal').value = "";
            loadJournals();
        }

        function clearJournal() { document.getElementById('journal').value = ""; }

        function clearAllJournals() {
            if (confirm("هل أنت متأكد من مسح كل كتاباتك؟")) {
                localStorage.removeItem('journals');
                loadJournals();
                alert("تم مسح كل اليوميات!");
            }
        }

        function loadJournals() {
            let journals = JSON.parse(localStorage.getItem('journals') || '[]');
            let list = document.getElementById('journalList');
            list.innerHTML = "";
            journals.slice(0, 5).forEach(j => {
                let li = document.createElement('li');
                li.className = "list-group-item";
                li.textContent = j;
                list.appendChild(li);
            });
        }

        loadJournals();
    </script>
</body>

</html>