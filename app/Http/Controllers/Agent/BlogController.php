<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a list of published blogs for agents.
     */
    public function index(Request $request)
    {
        $query = Blog::where('is_published', true);

        // Search by title or content
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Get paginated results
        $blogs = $query->latest()->paginate(9);

        // Get distinct categories for filter dropdown
        $categories = Blog::whereNotNull('category')->distinct()->pluck('category');

        return view('agent.blogs.index', compact('blogs', 'categories'));
    }

    /**
     * Show the full content of a single blog.
     */
    public function show($id)
    {
        $blog = Blog::where('is_published', true)->findOrFail($id);

        return view('agent.blogs.show', compact('blog'));
    }
}
