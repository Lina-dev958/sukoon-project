<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>تتبع المزاج</title>

   <link href="{{asset('assets')}}/css/bootstrap.min.css" rel="stylesheet">
  
  <link href="{{asset('assets')}}/css/font.css" rel="stylesheet">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="{{asset('assets')}}/css/mood.css">
</head>

<body>
    @include('partials.header')
     @yield('content')
   
    @include('partials.footer')

    <div class="modal fade" id="moodModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">

                <div class="modal-header border-0">
                    <h5 class="modal-title w-100" id="moodModalTitle"></h5>
                    <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p id="moodModalMessage" class="fs-5"></p>
                </div>

                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        إغلاق
                    </button>
                </div>

            </div>
        </div>
    </div>
    <script src="{{asset('assets')}}/js/bootstrap.bundle.min.js"></script>

    <script>
        let currentMood = "";

        function selectMood(mood) {
            currentMood = mood;

            let title = "";
            let message = "";

            if (mood.includes("سعيد")) {
                title = "جميل جدًا ";
                message = "سعادتك اليوم شيء رائع، حاول تحتفظ بهذا الشعور وشاركه مع من تحب ";
            }
            else if (mood.includes("عادي")) {
                title = "كل شيء متوازن ";
                message = "ليس كل يوم يجب أن يكون مثاليًا، الاستقرار بحد ذاته نعمة.";
            }
            else if (mood.includes("حزين")) {
                title = "نحن معك ";
                message = "من الطبيعي أن تشعر بالحزن أحيانًا، خذ نفسًا عميقًا وتذكر أنك لست وحدك.";
            }

            document.getElementById("moodModalTitle").innerText = title;
            document.getElementById("moodModalMessage").innerText = message;

            let modal = new bootstrap.Modal(document.getElementById("moodModal"));
            modal.show();
        }
        function loadMoods() {
            let moodList = document.getElementById('moodList');
            moodList.innerHTML = "";

            let moods = JSON.parse(localStorage.getItem('moods') || '[]');

            moods.forEach(item => {
                let li = document.createElement('li');
                li.className = "list-group-item";

                li.innerHTML = `
                <strong>${item.mood}</strong> - ${item.date}
                <br>
                <small>${item.note || "بدون ملاحظة"}</small>
            `;

                moodList.appendChild(li);
            });
        }
        function clearAllMoods() {
            if (confirm("هل أنت متأكد أنك تريد مسح جميع السجلات؟")) {
                localStorage.removeItem('moods');
                document.getElementById('moodList').innerHTML = "";
            }
        }
        document.addEventListener("DOMContentLoaded", loadMoods);
        function saveMood() {
            if (!currentMood) {
                alert("اختاري مزاجك أولاً");
                return;
            }

            let note = document.getElementById('moodNote').value;

            let moods = JSON.parse(localStorage.getItem('moods') || '[]');

            moods.unshift({
                mood: currentMood,
                note: note,
                date: new Date().toLocaleDateString()
            });

            localStorage.setItem('moods', JSON.stringify(moods));

            document.getElementById('moodNote').value = "";
            currentMood = "";

            loadMoods();
        }

    </script>


</body>

</html>