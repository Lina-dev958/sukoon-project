<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function video($id)
    {
        $booking = Booking::findOrFail($id);

        $user = auth()->user();

        // السماح فقط للمريض أو الأخصائي
        if (
            $user->id !== $booking->user_id && // المريض
            (!$user->therapist || $user->therapist->id !== $booking->therapist_id) // الأخصائي
        ) {
            abort(403);
        }

        // تأكد إن الجلسة approved
        if ($booking->status !== 'approved') {
            return redirect()->back()->with('error', 'الجلسة لم يتم تأكيدها بعد');
        }

        return view('pages.session', compact('booking'));
    }
}