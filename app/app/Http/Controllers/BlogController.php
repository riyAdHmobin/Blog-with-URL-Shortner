<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with(['categories', 'tags'])
            ->where('status', true)
            ->latest()
            ->paginate(10);

        $categories = BlogCategory::withCount('posts')->get();
        $tags = BlogTag::withCount('posts')->get();

        return view('blog.blog.index', compact('posts', 'categories', 'tags'));
    }

    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)
            ->where('status', true)
            ->with(['categories', 'tags'])
            ->firstOrFail();

        $categories = BlogCategory::withCount('posts')->get();
        $tags = BlogTag::withCount('posts')->get();

        return view('blog.blog.show', compact('post', 'categories', 'tags'));
    }

    public function category($slug)
    {
        $category = BlogCategory::where('category_slug', $slug)->firstOrFail();

        $posts = $category->posts()
            ->where('status', true)
            ->latest()
            ->paginate(10);

        $categories = BlogCategory::withCount('posts')->get();
        $tags = BlogTag::withCount('posts')->get();

        return view('blog.blog.index', compact('posts', 'categories', 'tags'));
    }

    public function tag($slug)
    {
        $tag = BlogTag::where('tag_slug', $slug)->firstOrFail();

        $posts = $tag->posts()
            ->where('status', true)
            ->latest()
            ->paginate(10);

        $categories = BlogCategory::withCount('posts')->get();
        $tags = BlogTag::withCount('posts')->get();

        return view('blog.blog.index', compact('posts', 'categories', 'tags'));
    }
}
