<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mood;
use Illuminate\Support\Facades\Auth;

class MoodController extends Controller
{
    public function index()
    {
        $moods = Auth::user()->moods()->latest()->get();
        return view('pages.mood', compact('moods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mood' => 'required|string|max:255',
            'note' => 'nullable|string',
        ]);

        Mood::create([
            'user_id' => Auth::id(),
            'mood' => $request->mood,
            'note' => $request->note,
        ]);

        return response()->json(['success' => true]);
    }
}