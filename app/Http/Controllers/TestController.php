<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TestResult;

class TestController extends Controller
{
    public function index()
    {
        return view('pages.test');
    }

    public function submit(Request $request)
{
    $answers = $request->answers ?? [];
    $score = array_sum($answers);

    if ($score <= 4) {
        $result = 'وضعك النفسي جيد 😊';
    } elseif ($score <= 8) {
        $result = 'هناك بعض التوتر 💛';
    } else {
        $result = 'ننصحك بمراجعة أخصائي 🧠';
    }

    // تخزين
    \App\Models\TestResult::updateOrCreate(
        ['user_id' => auth()->id()],
        ['score' => $score]
    );

    return back()->with('result', $result);
}
}