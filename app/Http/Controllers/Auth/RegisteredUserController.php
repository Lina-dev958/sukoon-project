<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function createPatient()
    {
        return view('auth.patient_register');
    }
    public function createTherapist()
    {
        return view('auth.therapist_register');
    }
    public function storePatient(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed|min:6',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'patient',
    ]);

    Auth::login($user);

    return redirect()->route('patient.dashboard');
}
public function storeTherapist(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed|min:6',
        'certificate_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'therapist',
    ]);

    $certificatePath = null;
    if ($request->hasFile('certificate_file')) {
        $file = $request->file('certificate_file');
        $filename = time().'_'.$file->getClientOriginalName();
        $certificatePath = $file->storeAs('public/certificates', $filename);
    }

    $user->therapist()->create([
        'certificate_file' => $certificatePath,
        'verification_status' => 'pending', 
    ]);

    Auth::login($user);

    return redirect()->route('therapist.dashboard')
        ->with('success', 'تم إنشاء حسابك بنجاح! في انتظار التحقق من الشهادة.');
}
}