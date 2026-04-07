@extends('layouts.admin')
@section('content')
<div class="container mt-5">
    <h3 class="mb-4 text-center">المعالجون المنتظرون</h3>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>صورة الاخصائي</th>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>الإجراء</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($therapists as $therapist)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $therapist->image) }}"
                                     class="rounded-circle"
                                     width="50"
                                     height="50"
                                     style="object-fit: cover;">
                            </td>
                            <td class="fw-bold">{{ $therapist->name }}</td>
                            <td>{{ $therapist->email }}</td>

                            <td>
                                <form action="{{ route('admin.approve.therapist', $therapist->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm px-3">
                                        <i class="fa fa-check"></i> موافقة
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-muted">
                                لا يوجد معالجين بانتظار الموافقة
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>
</div>
    
@endsection

