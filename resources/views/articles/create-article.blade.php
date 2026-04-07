@extends('layouts.create-article')
@section('content')
<section class="add-article-page">

    <div class="article-form-card">

        <h2>إضافة مقال جديد</h2>
        <p class="subtitle">اكتب مقالك لمساعدة الآخرين</p>

        <form action="{{ route('therapist.articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>عنوان المقال</label>
                <input type="text" name="title" placeholder="أدخل عنوان المقال">
            </div>
            
            <div class="form-group">
                <label>نبذة عن المقالة</label>
                <input type="text" name="excerpt" placeholder="أدخل فقرة صغيرة عن المقالة ">
            </div>

            <div class="form-group">
                <label>تصنيف المقال</label>
                <select name="category" required>
                    <option>اختر التصنيف</option>
                    <option>الصحة النفسية</option>
                    <option>القلق والتوتر</option>
                    <option>الاكتئاب</option>
                    <option>الإرشاد</option>
                </select>
            </div>

            <div class="form-group">
                <label>محتوى المقال</label>
                <textarea rows="8" name="body" placeholder="اكتب محتوى المقال هنا..."></textarea>
            </div>
            <div>
                <input type="file" name="image">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">نشر المقال</button>
                <a href="{{ route('therapist.articles.index') }}" class="btn btn-cancel">إلغاء</a>            </div>

        </form>

    </div>

</section>
@endsection