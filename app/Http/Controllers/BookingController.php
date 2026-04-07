<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    public function index()
    {
        return Booking::with(['user','therapist'])->get();
    }

    

    public function store(Request $request)
    {
    if (!auth()->check()) {
        return response()->json([
            'status' => 'error',
            'message' => 'يجب تسجيل الدخول أولاً'
        ], 401);
    }

    $user = auth()->user();
    $patient = $user->patient;

    if (!$patient) {
        return response()->json([
            'status' => 'error',
            'message' => 'يجب إكمال ملفك الشخصي أولاً'
        ], 400);
    }

    try {
        $request->validate([
            'therapist_id' => 'required|exists:therapists,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
        ]);
    } catch (ValidationException $e) {
        return response()->json([
            'status' => 'error',
            'errors' => $e->errors()
        ], 422);
    }

    $exists = Booking::where('therapist_id', $request->therapist_id)
        ->where('date', $request->date)
        ->where('time', $request->time)
        ->exists();

    if ($exists) {
        return response()->json([
            'status' => 'error',
            'message' => 'هذا الموعد محجوز مسبقاً'
        ], 400);
    }

    $booking = Booking::create([
        'user_id' => $user->id,
        'therapist_id' => $request->therapist_id,
        'date' => $request->date,
        'time' => $request->time,
        'status' => 'pending',
        'meeting_link' => null,
    ]);
    
    return response()->json([
        'status' => 'success',
        'message' => 'تم حجز الجلسة بنجاح',
        'id' => $booking->id 
    ]);
    }

    public function approveBooking($id)
   {
    $booking = Booking::findOrFail($id);

    if ($booking->therapist_id != auth()->user()->therapist->id) {
        abort(403);
    }

    if ($booking->status !== 'pending') {
        return back()->with('error', 'الجلسة ليست قيد الانتظار');
    }

    $roomName = 'therapy_' . $booking->id . '_' . Str::random(5);
    $booking->meeting_link = "https://meet.jit.si/$roomName";
    $booking->status = 'approved';
    $booking->save();

    return back()->with('success', 'تمت الموافقة وإنشاء رابط الجلسة');
    }
    public function destroy($id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json([
                'message' => 'غير موجود'
            ], 404);
        }

        $booking->delete();

        return response()->json([
            'message' => 'تم الحذف'
        ]);
    }
    public function indexForTherapist()
    {
    $user = auth()->user();
    $bookings = Booking::with(['patient.user'])
    ->where('therapist_id', $therapist->id)
    ->orderBy('date')
    ->orderBy('time')
    ->get();

    return view('therapist.bookings', compact('bookings'));
    }
}