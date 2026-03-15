<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of published blog posts.
     */
    public function index(Request $request)
    {
        $posts = BlogPost::published()
            ->with('user')
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        $featuredPosts = BlogPost::published()
            ->featured()
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $categories = ['News', 'Tutorial', 'Recipe', 'Story', 'Announcement'];

        return view('frontend.blog.index', compact('posts', 'featuredPosts', 'categories'));
    }

    /**
     * Display the specified blog post.
     */
    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)
            ->published()
            ->with('user')
            ->firstOrFail();

        // Increment view count
        $post->increment('views');

        // Get related posts
        $relatedPosts = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->where('category', $post->category)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('frontend.blog.show', compact('post', 'relatedPosts'));
    }

    /**
     * Filter posts by category
     */
    public function category($category)
    {
        $posts = BlogPost::published()
            ->where('category', $category)
            ->with('user')
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        $featuredPosts = BlogPost::published()
            ->featured()
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $categories = ['News', 'Tutorial', 'Recipe', 'Story', 'Announcement'];

        return view('frontend.blog.index', compact('posts', 'featuredPosts', 'categories'));
    }
}
