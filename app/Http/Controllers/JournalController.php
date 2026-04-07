<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journal;
use Illuminate\Support\Facades\Auth;

class JournalController extends Controller
{
    public function index()
    {
        $journals = Auth::user()->journals()->latest()->get();
        return view('pages.journal', compact('journals'));
    }

    public function store(Request $request)
    {
        $request->validate(['content' => 'required|string']);

        $journal = Auth::user()->journals()->create([
            'content' => $request->content,
        ]);

        return response()->json(['success' => true, 'journal' => $journal]);
    }
}