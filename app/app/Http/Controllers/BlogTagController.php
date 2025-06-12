<?php

namespace App\Http\Controllers;

use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogTagController extends Controller
{
    public function index()
    {
        $tags = BlogTag::withCount('posts')->paginate(10);
        return view('blog.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('blog.tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tag_name' => 'required|unique:blog_tags|max:255',
        ]);

        BlogTag::create([
            'tag_name' => $request->tag_name,
            'tag_slug' => Str::slug($request->tag_name),
        ]);

        return redirect()->route('tags.index')->with('success', 'Tag created successfully');
    }

    public function edit(BlogTag $tag)
    {
        return view('blog.tags.edit', compact('tag'));
    }

    public function update(Request $request, BlogTag $tag)
    {
        $request->validate([
            'tag_name' => 'required|max:255|unique:blog_tags,tag_name,' . $tag->id,
        ]);

        $tag->update([
            'tag_name' => $request->tag_name,
            'tag_slug' => Str::slug($request->tag_name),
        ]);

        return redirect()->route('tags.index')->with('success', 'Tag updated successfully');
    }

    public function destroy(BlogTag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully');
    }
}
