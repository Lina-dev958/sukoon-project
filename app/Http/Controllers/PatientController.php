<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Booking;

class PatientController extends Controller
{
    // صفحة داشبورد المريض
    public function dashboard()
    {
        $user = auth()->user();
        $patient = $user->patient;

        // لو سجل المريض مش موجود، نعمل واحد فارغ تلقائياً
if (!$patient) {
    $patient = $user->patient()->create([
        'phone' => null,
        'location' => null,
    ]);
}

        // عدد الجلسات
        $sessionsCount = $patient ? $patient->bookings()->count() : 0;

        // الأخصائيين (unique)
        $therapists = $patient 
            ? $patient->bookings()->with('therapist.user')->get()->unique('therapist_id')
            : collect();

        // 🔥 الجلسة القادمة
        $nextSession = $patient
            ? $patient->bookings()
                ->where('status', 'approved')
                ->whereNotNull('meeting_link')
                ->orderBy('date', 'asc')
                ->orderBy('time', 'asc')
                ->first()
            : null;

        return view('patient.dashboard', compact(
            'user',
            'patient',
            'sessionsCount',
            'therapists',
            'nextSession'
        ));
    }

    // صفحة تعديل الملف الشخصي
    public function editProfile()
    {
        $user = auth()->user();
        $patient = $user->patient; 

        return view('patient.patient-profile-edit', compact('patient'));
    }

    // حفظ تحديث الملف الشخصي
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $patient = $user->patient;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'location' => 'nullable|string|max:255',
        ]);

        // تحديث بيانات المستخدم
        $user->patient()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'phone' => $request->phone,
                'location' => $request->location ?? null,
            ]
        );

        // تحديث كلمة المرور (اختياري)
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        // تحديث بيانات المريض (لو موجود)
        if ($patient) {
            $patient->update([
                'phone' => $request->phone,
                'location' => $request->location ?? null,
            ]);
        }

        return redirect()->route('patient.dashboard')
            ->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }
}