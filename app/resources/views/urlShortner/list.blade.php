@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Shortened URLs</h1>
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
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <table border="1" cellpadding="8" cellspacing="0" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Original URL</th>
                    <th>Short Code</th>
                    <th>Short URL</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody>
                @forelse($urls as $url)
                    <tr>
                        <td>{{ $url->id }}</td>
                        <td><a href="{{ $url->original_url }}" target="_blank">{{ $url->original_url }}</a></td>
                        <td>{{ $url->short_code }}</td>
                        <td><a href="{{ url($url->short_code) }}" target="_blank">{{ url($url->short_code) }}</a></td>
                        <td>{{ $url->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No URLs found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
{{--            <a href="{{ route('url.shortener') }}">← Back to Shortener</a>--}}

            {{ $urls->links() }} <!-- Pagination -->
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
