<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        // Latest news first
        $news = News::latest('published_at')->paginate(10);
        return view('agent.news.index', compact('news'));
    }

    public function show(News $news)
    {
        return view('agent.news.show', compact('news'));
    }
}
