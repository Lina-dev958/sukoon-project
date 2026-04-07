@extends('layouts.therapist')
@section('content')

<section class="edit-therapist-profile py-5">
    <div class="container">
        <h2 class="mb-4 text-center">تعديل البيانات الشخصية</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('therapist.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- الاسم -->
            <input type="text" name="name" class="form-control mb-3" value="{{ auth()->user()->name }}" placeholder="الاسم">

            <!-- الإيميل -->
            <input type="email" name="email" class="form-control mb-3" value="{{ auth()->user()->email }}" placeholder="الإيميل">

            <!-- الباسورد -->
            <input type="password" name="password" class="form-control mb-3" placeholder="كلمة مرور جديدة">

            <!-- بيانات -->
            <input type="text" name="phone" class="form-control mb-3" value="{{ $therapist->phone }}" placeholder="الهاتف">
            <input type="text" name="job_title" class="form-control mb-3" value="{{ $therapist->job_title }}" placeholder="التخصص ">
            <input type="number" name="experience_years" class="form-control mb-3" value="{{ $therapist->experience_years }}" placeholder="سنوات الخبرة">
            <input type="text" name="location" class="form-control mb-3" value="{{ $therapist->location }}" placeholder="الموقع">

            <!-- الصورة -->
            @if($therapist->image)
                <img src="{{ asset('storage/'.$therapist->image) }}" width="100" class="mb-2">
            @endif
            <input type="file" name="image" class="form-control mb-3">

            <!-- الاهتمامات -->
            <label for="">اضافة اهتمامات</label>
            <textarea name="interests" class="form-control mb-3" placeholder="اضافة اهتمامات">
                {{ implode(', ', json_decode($therapist->interests ?? '[]', true) ?? []) }}
                
                    {{-- <input type="text" value="{{$therapist->interests ?? '[]', true ?? [] }}" class="form-control"> --}}
            </textarea> 

            <!-- المهارات -->
            <div id="skills-container">
                <label for="">اضافة مهارات</label>
                @forelse($therapist->skills as $skill)
                    <div class="d-flex gap-2 mb-2">
                        <input type="hidden" name="skill_ids[]" value="{{ $skill->id }}">
                        <input type="text" name="skill_names[]" value="{{ $skill->skill_name }}" class="form-control">
                        <input type="number" name="skill_levels[]" value="{{ $skill->level }}" class="form-control" style="width:100px;">
                        <button type="button" class="btn btn-danger remove-skill">X</button>
                    </div>
                @empty
                    <div class="d-flex gap-2 mb-2">
                        <input type="hidden" name="skill_ids[]" value="">
                        <input type="text" name="skill_names[]" class="form-control">
                        <input type="number" name="skill_levels[]" class="form-control" style="width:100px;">
                        <button type="button" class="btn btn-danger remove-skill">X</button>
                    </div>
                @endforelse
            </div>

            <button type="button" id="add-skill" class="btn btn-primary mt-2">+ مهارة</button>

            <br><br>
            <button class="btn btn-success">حفظ</button>
        </form>
    </div>
</section>

<script>
document.getElementById('add-skill').onclick = function(){
    let div = document.createElement('div');
    div.classList.add('d-flex','gap-2','mb-2');
    div.innerHTML = `
        <input type="text" name="skill_names[]" class="form-control">
        <input type="number" name="skill_levels[]" class="form-control" style="width:100px;">
        <button type="button" class="btn btn-danger remove-skill">X</button>
    `;
    document.getElementById('skills-container').appendChild(div);
};

document.addEventListener('click', function(e){
    if(e.target.classList.contains('remove-skill')){
        e.target.parentElement.remove();
    }
});
</script>

@endsection