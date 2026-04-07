@extends('layouts.test')

@section('content')
<section class="my-5">
    <div class="container">
        <div class="card p-4 shadow-lg">
            <h3 class="text-center mb-3">اختبار التقييم النفسي</h3>
            <p class="text-center text-muted">
                أجب بصراحة، لا توجد إجابات صحيحة أو خاطئة
            </p>

            {{-- فورم --}}
                <form action="{{ route('test.submit') }}" method="POST" id="testForm">
                    @csrf
                @csrf

                {{-- سؤال 1 --}}
                <div class="mb-3">
                    <label>هل شعرت بالتوتر أو القلق مؤخرًا؟</label>
                    <select name="answers[]" class="form-select q">
                        <option value="0">أبدًا</option>
                        <option value="1">أحيانًا</option>
                        <option value="2">غالبًا</option>
                    </select>
                </div>

                {{-- سؤال 2 --}}
                <div class="mb-3">
                    <label>هل تعاني من صعوبة في النوم؟</label>
                    <select name="answers[]" class="form-select q">
                        <option value="0">لا</option>
                        <option value="1">أحيانًا</option>
                        <option value="2">نعم</option>
                    </select>
                </div>

                {{-- سؤال 3 --}}
                <div class="mb-3">
                    <label>هل شعرت بفقدان الحافز أو الشغف؟</label>
                    <select name="answers[]" class="form-select q">
                        <option value="0">أبدًا</option>
                        <option value="1">أحيانًا</option>
                        <option value="2">غالبًا</option>
                    </select>
                </div>

                {{-- سؤال 4 --}}
                <div class="mb-3">
                    <label>هل تشعر بالإرهاق حتى بدون مجهود؟</label>
                    <select name="answers[]" class="form-select q">
                        <option value="0">لا</option>
                        <option value="1">أحيانًا</option>
                        <option value="2">نعم</option>
                    </select>
                </div>

                {{-- سؤال 5 --}}
                <div class="mb-3">
                    <label>هل تجد صعوبة في التركيز؟</label>
                    <select name="answers[]" class="form-select q">
                        <option value="0">أبدًا</option>
                        <option value="1">أحيانًا</option>
                        <option value="2">غالبًا</option>
                    </select>
                </div>

                {{-- سؤال 6 --}}
                <div class="mb-3">
                    <label>هل تشعر بالإرهاق بسبب عواطفك؟</label>
                    <select name="answers[]" class="form-select q">
                        <option value="0">أبدًا</option>
                        <option value="1">أحيانًا</option>
                        <option value="2">غالبًا</option>
                    </select>
                </div>

                {{-- سؤال 7 --}}
                <div class="mb-3">
                    <label>هل تشعر بالحزن في كثير من الأحيان؟</label>
                    <select name="answers[]" class="form-select q">
                        <option value="0">أبدًا</option>
                        <option value="1">أحيانًا</option>
                        <option value="2">غالبًا</option>
                    </select>
                </div>

                {{-- زر --}}
                <button type="submit" class="btn btn-success px-4">
                    عرض النتيجة
                </button>
            </form>

            {{-- النتيجة --}}
            <div class="mt-4 text-center fw-bold" id="result">
                @if(session('result'))
                <div class="mt-4 text-center fw-bold">
                {{ session('result') }}
                </div>
@endif
            </div>

        </div>
    </div>
</section>



@endsection