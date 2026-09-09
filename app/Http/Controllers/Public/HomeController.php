<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
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

        return view('front.index', compact('services'));
    }

    public function show(Service $service)
    {
        $service->load([
            'serviceGalleries:id,service_id,image',
            'servicePackages' => fn ($query) => $query->orderByDesc('populer')->orderBy('price'),
        ]);

        $service->setAttribute('thumbnail_url', $this->imageUrl($service->thumbnail));
        $service->serviceGalleries->each(function ($gallery) {
            $gallery->setAttribute('image_url', $this->imageUrl($gallery->image));
        });

        return view('front.detail', compact('service'));
    }

    private function imageUrl(?string $path): string
    {
        return filled($path)
            ? '/storage/' . ltrim($path, '/')
            : asset('img/sendang.png');
    }
}
