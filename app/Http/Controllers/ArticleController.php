<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
{
    
    $articles = Article::with('therapist.user')->paginate(6);
    

    return view('pages.all-artical', compact('articles'));
}

public function show($id)
{
    $article = Article::findOrFail($id);
    return view('pages.article-detail', compact('article'));
}
}