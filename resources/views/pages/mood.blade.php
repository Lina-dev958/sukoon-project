@extends('layouts.mood')
@section('content')
<div class="container py-5">
    <div class="card p-4 shadow">
        <h3>كيف تشعر الآن؟</h3>
        <p>اختر شعورك الحالي وسجله لمتابعة مزاجك اليومي.</p>

        <div class="d-flex justify-content-center gap-3 mb-3">
            <button class="btn btn-outline mood-btn" onclick="selectMood('😊 سعيد')">😊 سعيد</button>
            <button class="btn btn-outline mood-btn" onclick="selectMood('😐 عادي')">😐 عادي</button>
            <button class="btn btn-outline mood-btn" onclick="selectMood('😔 حزين')">😔 حزين</button>
        </div>

        <textarea class="form-control mb-3" id="moodNote" rows="4" placeholder="اكتب سبب شعورك (اختياري)"></textarea>

        <div class="d-flex justify-content-between mb-3">
            <button class="btn btn-success" onclick="saveMood()">حفظ</button>
            <button class="btn btn-danger" onclick="clearAllMoods()">مسح الكل</button>
        </div>

        <div>
            <h5>سجل مزاجك:</h5>
            <ul class="list-group" id="moodList">
                @foreach($moods as $mood)
                    <li class="list-group-item d-flex justify-content-between">
                        <span>{{ $mood->mood }} {{ $mood->note ? '- '.$mood->note : '' }}</span>
                        <small class="text-muted">{{ $mood->created_at->format('Y-m-d H:i') }}</small>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<script>
    function saveMood() {
        let mood = document.querySelector('.mood-btn.selected')?.textContent;
        let note = document.getElementById('moodNote').value;
    
        if (!mood) {
            alert('اختر شعورك أولاً');
            return;
        }
    
        fetch("{{ route('mood.store') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ mood: mood, note: note })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                alert('تم الحفظ بنجاح');
                location.reload(); // لتحديث قائمة المزاج
            }
        });
    }
    </script>
@endsection