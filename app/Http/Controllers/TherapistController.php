<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Therapist;
use Illuminate\Support\Str;
use App\Models\Session;
use App\Models\TherapistSkill;
use App\Models\Booking;




class TherapistController extends Controller
{
    public function dashboard()
{
    $user = auth()->user();
    if ($user->role !== 'therapist') abort(403);

    $therapist = $user->therapist;

    if (!$therapist || $therapist->verification_status !== 'approved') {
        return redirect()->route('pending.notice');
    }

    $bookings = Booking::with(['patient.user'])
        ->where('therapist_id', $therapist->id)
        ->orderBy('date')
        ->orderBy('time')
        ->get();

    $articles = $therapist->articles ?? [];
    $articlesCount = count($articles);
    $sessionsCount = $bookings->count();
    $skills = $therapist->skills; 


    $nextSession = $therapist
    ? $therapist->bookings()
        ->where('status', 'approved')
        ->whereNotNull('meeting_link')
        ->orderBy('date', 'asc')
        ->orderBy('time', 'asc')
        ->first()
    : null;

    return view('therapist.dashboard', compact(
        'therapist', 'articles', 'articlesCount', 'sessionsCount', 'skills', 'bookings', 'nextSession'
    ));
}
    public function show($id)
{
    $therapist = Therapist::with(['user','skills'])
        ->where('verification_status','approved')
        ->findOrFail($id);

    $therapist->specialties = json_decode($therapist->specialties ?? '[]', true);
    $therapist->reviews = json_decode($therapist->reviews ?? '[]', true);

    return view('pages.therapist-profile', compact('therapist'));
}
   
public function rating(Therapist $therapist)
{
    return view('pages.therapist-rating', compact('therapist'));
}

public function booking(Therapist $therapist)
{
if($therapist->verification_status!='approved'){
abort(404);
}

return view('pages.therapist-booking',compact('therapist'));
}

    

public function index()
{
    $therapists = Therapist::with('user')
        ->where('verification_status', 'approved')
        ->paginate(9);

    return view('pages.all-therapist', compact('therapists'));
}



    public function editProfile()
    {
        $therapist = auth()->user()->therapist;
        return view('therapist.edit-profile', compact('therapist'));
    }
    public function updateProfile(Request $request)
    {
        $therapist = auth()->user()->therapist;
        $user = $therapist->user;
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'image' => 'nullable|image|max:2048',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        $therapist->update([
            'phone' => $request->phone,
            'job_title' => $request->job_title,
            'experience_years' => $request->experience_years,
            'location' => $request->location,
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $image->storeAs('therapists', $filename, 'public');
            $therapist->image = 'therapists/' . $filename;
            $therapist->save();
        }

        if ($request->interests) {
            $interests = array_map('trim', explode(',', $request->interests));
            $therapist->interests = json_encode($interests);
            $therapist->save();
        }

        if ($request->skill_names) {
            $existingSkills = $therapist->skills()->pluck('id')->toArray();
        
            foreach ($request->skill_names as $index => $name) {
                $level = $request->skill_levels[$index] ?? 0;
                if ($name) {
                    // إذا كان هناك معرف مهارة مخفي يمكن استخدامه لتحديث بدل إنشاء جديد
                    if (isset($request->skill_ids[$index]) && $request->skill_ids[$index]) {
                        $skill = TherapistSkill::find($request->skill_ids[$index]);
                        if ($skill) {
                            $skill->update([
                                'skill_name' => $name,
                                'level' => $level,
                            ]);
                            // إزالة من المصفوفة لتبقى المهارات الغير موجودة للحذف
                            $existingSkills = array_diff($existingSkills, [$skill->id]);
                        }
                    } else {
                        // إنشاء مهارة جديدة
                        $skill = TherapistSkill::create([
                            'therapist_id' => $therapist->id,
                            'skill_name' => $name,
                            'level' => $level,
                        ]);
                    }
                }
            }
        
            // حذف أي مهارات لم تعد موجودة في النموذج
            if (!empty($existingSkills)) {
                TherapistSkill::whereIn('id', $existingSkills)->delete();
            }
        }

        return redirect()->route('therapist.dashboard')
            ->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }
    
   

public function approveSession($id)
{
    $session = Session::findOrFail($id);

    if ($session->therapist_id != auth()->id()) {
        abort(403);
    }

    if ($session->status !== 'pending') {
        return back()->with('error', 'الجلسة ليست قيد الانتظار');
    }

    // إنشاء اسم غرفة فريد
    $roomName = 'therapy_' . $session->id . '_' . Str::random(5);

    $session->meeting_link = "https://meet.jit.si/$roomName";
    $session->status = 'approved';
    $session->save();

    return back()->with('success', 'تمت الموافقة وإنشاء رابط الجلسة');
}
}

