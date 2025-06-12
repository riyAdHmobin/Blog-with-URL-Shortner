@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Shorten a URL</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Blogs</a></li>
                        <li class="breadcrumb-item active">Blogs List</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
        @if(session('shortUrl'))
            <p>Shortened URL: <a href="{{ session('shortUrl') }}" target="_blank">{{ session('shortUrl') }}</a></p>
       @endif

        <form method="POST" action="{{ route('shorten') }}">
            @csrf
            <input type="url" class="form-control" name="original_url" placeholder="Enter URL" required>
            <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Shorten</button>
        </form>
        <a href="{{ route('url.list') }}">View all shortened URLs</a>
    </div>
@endsection
