<!DOCTYPE html>
<html>
<head>
    <title>All Shortened URLs</title>
</head>
<body>
<h1>Shortened URLs</h1>
<a href="{{ route('url.shortener') }}">← Back to Shortener</a>

<table border="1" cellpadding="8" cellspacing="0">
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

{{ $urls->links() }} <!-- Pagination -->
</body>
</html>
