<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking; 
use App\Models\Therapist;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        $totalPatients = User::where('role', 'patient')->count();
        $totalTherapists = User::where('role', 'therapist')->count();
        $completedBooking = Booking::where('status', 'completed')->count();
        $totalBooking = Booking::count();
        $therapists = User::where('role', 'therapist')->get();
        return view('admin.dashboard', compact(
            'totalPatients',
            'totalTherapists',
            'completedBooking',
            'totalBooking',
            'therapists'
        ));
    }
    public function showTherapist($id)
    {
        $therapist = User::where('role', 'therapist')->findOrFail($id);
        return view('admin.therapist-show', compact('therapist'));
    }
    public function deleteTherapist($id)
    {
        $therapist = User::where('role', 'therapist')->findOrFail($id);
        $therapist->delete();
        return redirect()->route('admin.dashboard')->with('success', 'تم حذف الأخصائي بنجاح');
    }
    public function pendingTherapists()
    {
        $therapists = User::where('role', 'therapist')
            ->whereHas('therapist', function($query) {
                $query->where('verification_status', 'pending');
            })
            ->get();
    
        return view('admin.pending-therapists', compact('therapists'));
    }

    public function approveTherapist($id)
    {
        $user = User::where('role', 'therapist')->findOrFail($id);
        $therapist = $user->therapist()->first();
            if ($therapist) {
                $therapist->verification_status = 'approved';
                $therapist->save();
            }

        return redirect()->back()->with('success','تم تفعيل المعالج بنجاح');
   }
}