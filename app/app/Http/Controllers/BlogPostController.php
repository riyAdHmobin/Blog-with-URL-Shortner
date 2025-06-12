<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with(['categories', 'tags'])->latest()->paginate(10);
        return view('blog.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = BlogCategory::all();
        $tags = BlogTag::all();
        return view('blog.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'excerpt' => 'nullable',
            'feature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'required|array',
            'tags' => 'nullable|array'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('feature_image')) {
            $image = $request->file('feature_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/blog'), $imageName);
            $data['feature_image'] = 'images/blog/' . $imageName;
        }

        $post = BlogPost::create($data);
        $post->categories()->sync($request->categories);
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

    public function show(BlogPost $post)
    {
        $post->load(['categories', 'tags']);
        return view('blog.posts.show', compact('post'));
    }

    public function edit(BlogPost $post)
    {
        $categories = BlogCategory::all();
        $tags = BlogTag::all();
        return view('blog.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, BlogPost $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'excerpt' => 'nullable',
            'feature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'required|array',
            'tags' => 'nullable|array'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('feature_image')) {
            if ($post->feature_image && file_exists(public_path($post->feature_image))) {
                unlink(public_path($post->feature_image));
            }

            $image = $request->file('feature_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/blog'), $imageName);
            $data['feature_image'] = 'images/blog/' . $imageName;
        }

        $post->update($data);
        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags ?? []);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    public function destroy(BlogPost $post)
    {
        if ($post->feature_image && file_exists(public_path($post->feature_image))) {
            unlink(public_path($post->feature_image));
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}
