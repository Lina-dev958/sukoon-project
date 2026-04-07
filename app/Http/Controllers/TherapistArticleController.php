<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;


class TherapistArticleController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $therapist = $user->therapist;
    
        $articles = Article::where('therapist_id', $therapist->id)->latest()->get();
        $articlesCount = $articles->count(); 
        $sessionsCount = 0;
    
        $bookings = Booking::where('therapist_id', $therapist->id)->get();
        $nextSession = $therapist
    ? $therapist->bookings()
        ->where('status', 'approved')
        ->whereNotNull('meeting_link')
        ->orderBy('date', 'asc')
        ->orderBy('time', 'asc')
        ->first()
    : null;
        return view('therapist.dashboard', compact(
            'therapist', 'articles', 'articlesCount', 'sessionsCount', 'bookings','nextSession'
        ));
    }

    // صفحة إنشاء مقال جديد
    public function create()
    {
        return view('articles.create-article');
    }

    // حفظ المقال الجديد
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:255', // <-- حقل النبذة
            'body' => 'required|string',
            'category' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');
        }

        $therapist = Auth::user()->therapist;

        Article::create([
            'therapist_id' => $therapist->id,
            'title' => $request->title,
            'excerpt' => $request->excerpt, // <-- حفظ النبذة
            'content' => $request->body,
            'category' => $request->category,
            'image' => $path,
        ]);

        return redirect()->route('therapist.articles.index')
            ->with('success', 'تم نشر المقال بنجاح');
    }

    // عرض مقال مفصل
    public function show(Article $article)
    {
        return view('pages.artical', compact('article'));
    }
}