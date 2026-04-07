<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    // ----------------------------------------
    // تسجيل دخول / إنشاء حساب للمريض
    // ----------------------------------------
    public function redirectToGooglePatient()
    {
        return Socialite::driver('google')
            ->stateless()
            ->redirectUrl(env('GOOGLE_REDIRECT_PATIENT'))
            ->redirect();
    }

    public function handleGooglePatientCallback()
    {
        $googleUser = Socialite::driver('google')
            ->stateless()
            ->redirectUrl(env('GOOGLE_REDIRECT_PATIENT'))
            ->user();

        // لو موجود بالفعل → تسجيل دخول
        // لو مش موجود → إنشاء حساب جديد
        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'role' => 'patient',
                'password' => bcrypt(uniqid()) // نعمل باسورد عشوائي
            ]
        );

        Auth::login($user);

        return redirect()->route('patient.dashboard');
    }

    // ----------------------------------------
    // تسجيل دخول / إنشاء حساب للمعالج
    // ----------------------------------------
    public function redirectToGoogleTherapist()
    {
        return Socialite::driver('google')
            ->stateless()
            ->redirectUrl(env('GOOGLE_REDIRECT_THERAPIST'))
            ->redirect();
    }

    public function handleGoogleTherapistCallback()
    {
        $googleUser = Socialite::driver('google')
            ->stateless()
            ->redirectUrl(env('GOOGLE_REDIRECT_THERAPIST'))
            ->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'role' => 'therapist',
                'password' => bcrypt(uniqid())
            ]
        );

        Auth::login($user);

        return redirect()->route('therapist.dashboard');
    }
}