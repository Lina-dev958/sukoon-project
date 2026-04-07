@extends('layouts.journal')
@section('content')
<div class="container">
    <div class="card p-4">
        <h3 class="text-center">اكتب ما بداخلك</h3>
        <p>هذه مساحة شخصية وآمنة لتفريغ أفكارك ومشاعرك.</p>

        <textarea class="form-control mb-3" id="journal" rows="10"
            placeholder="اكتب بحرية… لا أحد سيقرأ هذا غيرك 🤍"></textarea>

        <div class="d-flex flex-column flex-sm-row gap-2 justify-content-between mb-3">
             <button class="btn btn-success" id="saveBtn">حفظ</button>
            <div>
                <button class="btn btn-secondary" onclick="clearJournal()">مسح الكتابة الحالية</button>
                <button class="btn btn-danger" onclick="clearAllJournals()">مسح الكل</button>
            </div>
        </div>

        <div class="mt-4">
            <h5>آخر كتاباتك:</h5>
            <ul class="list-group" id="journalList">
                @foreach($journals ?? [] as $journal)
                    <li class="list-group-item">{{ $journal->content }} <small class="text-muted">{{ $journal->created_at->format('d/m/Y H:i') }}</small></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<script>
document.getElementById('saveBtn').addEventListener('click', function(){
    let content = document.getElementById('journal').value;

    if(!content) return alert('اكتب شيئاً قبل الحفظ');

    fetch("{{ route('journal.store') }}", {
        method: 'POST',
        headers: {
            'Content-Type':'application/json',
            'X-CSRF-TOKEN':'{{ csrf_token() }}'
        },
        body: JSON.stringify({content: content})
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            let ul = document.getElementById('journalList');
            let li = document.createElement('li');
            li.classList.add('list-group-item');
            li.innerHTML = content + ` <small class="text-muted">الآن</small>`;
            ul.prepend(li); // تضيف الكتابة فوق
            document.getElementById('journal').value = ''; // تفريغ الـ textarea
        }
    })
    .catch(err => console.error(err));
});
</script>
@endsection