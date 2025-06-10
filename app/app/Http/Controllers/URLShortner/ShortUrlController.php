<?php

namespace App\Http\Controllers\URLShortner;

use App\Http\Controllers\Controller;
use App\Models\URLShortner\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{
    //

    public function index() {
        return view('urlShortner/shorten');
    }

    public function store(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url'
        ]);

        $shortCode = Str::random(6);

        $shortUrl = ShortUrl::create([
            'original_url' => $request->original_url,
            'short_code' => $shortCode
        ]);

        return redirect()->back()->with('shortUrl', url($shortCode));
    }

    public function redirect($code)
    {
        $shortUrl = ShortUrl::where('short_code', $code)->firstOrFail();
        return redirect($shortUrl->original_url);
    }

    public function list()
    {
        $urls = ShortUrl::latest()->paginate(10); // You can use simplePaginate if preferred
        return view('urlShortner/list', compact('urls'));
    }

}
