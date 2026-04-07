<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function createPatient()
    {
        return view('auth.patient_login');
    }
    public function createTherapist()
    {
        return view('auth.therapist_login');
    }
    public function createAdmin()
    {
        return view('auth.admin_login');
    }
   
    public function storePatient(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
    
        if ($request->user()->role !== 'patient') {
            Auth::logout();
            return back()->withErrors(['email' => 'هذا الحساب ليس مريض']);
        }
    
        return redirect()->route('patient.dashboard');
    }
    public function storeTherapist(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
    
        if ($request->user()->role !== 'therapist') {
            Auth::logout();
            return back()->withErrors(['email' => 'هذا الحساب ليس معالج']);
        }
    
        return redirect()->route('therapist.dashboard');
    }
    
    public function storeAdmin(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
    
        if ($request->user()->role !== 'admin') {
            Auth::logout();
            return back()->withErrors(['email' => 'هذا الحساب ليس أدمن']);
        }
    
        return redirect()->route('admin.dashboard');
    }
    
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
     // protected function authenticated(Request $request, $user)
    // {
    //     // 
    // }

}
