<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::query()->latest()->paginate(9);
        $blogs->getCollection()->each(fn (Blog $blog) =>
            $blog->setAttribute('thumbnail_url', $this->imageUrl($blog->thumbnail))
        );

        return view('front.blog', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        $relatedBlogs = Blog::query()
            ->whereKeyNot($blog->getKey())
            ->latest()
            ->limit(3)
            ->get();

        $blog->setAttribute('thumbnail_url', $this->imageUrl($blog->thumbnail));
        $relatedBlogs->each(fn (Blog $relatedBlog) =>
            $relatedBlog->setAttribute('thumbnail_url', $this->imageUrl($relatedBlog->thumbnail))
        );

        return view('front.detail-blog', compact('blog', 'relatedBlogs'));
    }

    private function imageUrl(?string $path): string
    {
        return filled($path) ? '/storage/' . ltrim($path, '/') : asset('img/sendang.png');
    }
}
