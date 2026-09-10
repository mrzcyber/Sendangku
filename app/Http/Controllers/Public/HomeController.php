<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Service;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::query()
            ->latest()
            ->get()
            ->map(fn (Service $service) => [
                'title' => $service->name,
                'description' => $service->description,
                'href' => route('service.detail', $service),
                'image' => $this->imageUrl($service->thumbnail),
            ]);

        $blogs = Blog::query()
            ->latest()
            ->limit(3)
            ->get()
            ->map(fn (Blog $blog) => [
                'id' => $blog->id,
                'name' => $blog->name,
                'slug' => $blog->slug,
                'content' => $blog->content,
                'image' => $this->imageUrl($blog->thumbnail),
                'date' => $blog->created_at ? $blog->created_at->translatedFormat('d M Y') : '-',
            ]);

        return view('front.index', compact('services', 'blogs'));
    }

    private function imageUrl(?string $path): string
    {
        return filled($path)
            ? '/storage/' . ltrim($path, '/')
            : asset('img/sendang.png');
    }
}
