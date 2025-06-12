@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <article>
                @if($post->feature_image)
                    <img src="{{ asset($post->feature_image) }}" class="img-fluid mb-4" alt="{{ $post->title }}">
                @endif

                <h1 class="mb-4">{{ $post->title }}</h1>

                <div class="mb-4">
                    @foreach($post->categories as $category)
                        <a href="{{ route('blog.category', $category->category_slug) }}" class="badge bg-primary text-decoration-none">
                            {{ $category->category_name }}
                        </a>
                    @endforeach
                </div>

                @if($post->excerpt)
                    <div class="lead mb-4">
                        {{ $post->excerpt }}
                    </div>
                @endif

                <div class="blog-content mb-4">
                    {!! nl2br(e($post->description)) !!}
                </div>

                <div class="mb-4">
                    @foreach($post->tags as $tag)
                        <a href="{{ route('blog.tag', $tag->tag_slug) }}" class="badge bg-secondary text-decoration-none">
                            {{ $tag->tag_name }}
                        </a>
                    @endforeach
                </div>

                <div class="text-muted">
                    Posted on {{ $post->created_at->format('F d, Y') }}
                </div>
            </article>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    @foreach($categories as $category)
                        <a href="{{ route('blog.category', $category->category_slug) }}" class="d-block mb-2">
                            {{ $category->category_name }} ({{ $category->posts_count }})
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="card">
                <div class="card-header">Tags</div>
                <div class="card-body">
                    @foreach($tags as $tag)
                        <a href="{{ route('blog.tag', $tag->tag_slug) }}" class="badge bg-secondary text-decoration-none m-1">
                            {{ $tag->tag_name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
