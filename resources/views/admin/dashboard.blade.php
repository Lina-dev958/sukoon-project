
@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    {{-- رسالة نجاح --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    {{-- كروت الإحصائيات --}}
    <div class="stats-cards">

        <div class="card">
            <i class="fas fa-user-injured"></i>
            <h3>{{ $totalPatients }}</h3>
            <p>عدد المرضى</p>
        </div>

        <div class="card">
            <i class="fas fa-user-md"></i>
            <h3>{{ $totalTherapists }}</h3>
            <p>عدد الأخصائيين</p>
        </div>

        <div class="card">
            <i class="fas fa-check-circle"></i>
            <h3>{{ $completedBooking }}</h3>
            <p>الجلسات المكتملة</p>
        </div>

        <div class="card">
            <i class="fas fa-calendar-alt"></i>
            <h3>{{ $totalBooking }}</h3>
            <p>عدد الجلسات الكلي</p>
        </div>

    </div>



    {{-- جدول الأخصائيين --}}
    <div class="therapists-table">

        <div class="table-header">

            <h2>جميع الأخصائيين</h2>

        </div>


        <table>

            <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>التخصص</th>
                    <th>البريد الإلكتروني</th>
                    <th>تاريخ التسجيل</th>
                    <th>إجراءات</th>
                </tr>
            </thead>

            <tbody>

                @forelse($therapists as $therapist)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $therapist->name }}</td>

                    <td>
                        {{ $therapist->job_title ?? '—' }}
                    </td>

                    <td>{{ $therapist->email }}</td>

                    <td>
                        {{ $therapist->created_at->format('Y-m-d') }}
                    </td>

                    <td class="actions">

                        {{-- عرض --}}
                        <a href="{{ route('therapist.show', ['id' => $therapist->id]) }}"
                           class="btn btn-view"
                           title="عرض">
                           <i class="fas fa-eye"></i>
                        </a>


                        {{-- حذف --}}
                        <form method="POST"
action="{{ route('admin.therapists.delete',$therapist->id) }}"
class="inline-form">

@csrf
@method('DELETE')

<button type="submit"
class="btn btn-delete"
onclick="return confirm('هل أنت متأكد من حذف الأخصائي؟')"
title="حذف">

<i class="fas fa-trash"></i>

</button>

</form>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6" class="text-center">
                        لا يوجد أخصائيين حالياً
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>
        <br><br><hr> <br>
        <div >
            <a href="{{route('pendingTherapists')}}" class=" btn btn-primary ">المعالجون المنتظرون
            </a>
        </div>

    </div>

</div>

@endsection