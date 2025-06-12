@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>{{ $post->title }}</h3>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>
        </div>
        <div class="card-body">
            @if($post->feature_image)
                <div class="mb-4">
                    <img src="{{ asset($post->feature_image) }}" alt="{{ $post->title }}" class="img-fluid">
                </div>
            @endif

            <div class="mb-4">
                <h5>Categories:</h5>
                @foreach($post->categories as $category)
                    <span class="badge bg-primary">{{ $category->category_name }}</span>
                @endforeach
            </div>

            <div class="mb-4">
                <h5>Tags:</h5>
                @foreach($post->tags as $tag)
                    <span class="badge bg-info">{{ $tag->tag_name }}</span>
                @endforeach
            </div>

            @if($post->excerpt)
                <div class="mb-4">
                    <h5>Excerpt:</h5>
                    <p class="lead">{{ $post->excerpt }}</p>
                </div>
            @endif

            <div class="mb-4">
                <h5>Description:</h5>
                {!! nl2br(e($post->description)) !!}
            </div>

            <div class="mb-4">
                <p><strong>Status:</strong>
                    <span class="badge bg-{{ $post->status ? 'success' : 'danger' }}">
                        {{ $post->status ? 'Active' : 'Inactive' }}
                    </span>
                </p>
            </div>

            <div class="mt-4">
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">Edit Post</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete Post</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
