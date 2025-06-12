@extends('layouts.app')

@section('content')
    <h1>Shorten a URL</h1>
    @if(session('shortUrl'))
        <p>Shortened URL: <a href="{{ session('shortUrl') }}" target="_blank">{{ session('shortUrl') }}</a></p>
    @endif

    <form method="POST" action="{{ route('shorten') }}">
        @csrf
        <input type="url" name="original_url" placeholder="Enter URL" required>
        <button type="submit">Shorten</button>
    </form>
    <a href="{{ route('url.list') }}">View all shortened URLs</a>
@endsection
