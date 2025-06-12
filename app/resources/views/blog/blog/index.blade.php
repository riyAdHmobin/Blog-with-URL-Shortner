@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1 class="mb-4">Blog Posts</h1>

            @foreach($posts as $post)
                <div class="card mb-4">
                    @if($post->feature_image)
                        <img src="{{ asset($post->feature_image) }}" class="card-img-top" alt="{{ $post->title }}">
                    @endif
                    <div class="card-body">
                        <h2 class="card-title">{{ $post->title }}</h2>

                        <div class="mb-2">
                            @foreach($post->categories as $category)
                                <a href="{{ route('blog.category', $category->category_slug) }}" class="badge bg-primary text-decoration-none">
                                    {{ $category->category_name }}
                                </a>
                            @endforeach
                        </div>

                        @if($post->excerpt)
                            <p class="card-text">{{ $post->excerpt }}</p>
                        @endif

                        <div class="mb-2">
                            @foreach($post->tags as $tag)
                                <a href="{{ route('blog.tag', $tag->tag_slug) }}" class="badge bg-secondary text-decoration-none">
                                    {{ $tag->tag_name }}
                                </a>
                            @endforeach
                        </div>

                        <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-primary">Read More</a>
                    </div>
                    <div class="card-footer text-muted">
                        Posted on {{ $post->created_at->format('F d, Y') }}
                    </div>
                </div>
            @endforeach

            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
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
