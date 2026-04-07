@extends('layouts.patient')

@section('content')
<div class="container text-center">

    <h3 class="mb-4">الجلسة العلاجية المباشرة</h3>

    <h2>جلسة الفيديو</h2>

@if($booking->meeting_link)
    <iframe 
        src="{{ $booking->meeting_link }}" 
        width="100%" 
        height="500"
        allow="camera; microphone; fullscreen">
    </iframe>
@else
    <p>لا يوجد رابط جلسة</p>
@endif

</div>
@endsection