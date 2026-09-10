<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::query()->latest()->get();
        $services->each(fn (Service $service) =>
            $service->setAttribute('thumbnail_url', $this->imageUrl($service->thumbnail))
        );

        return view('front.service', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        $service->load([
            'serviceGalleries:id,service_id,image',
            'servicePackages' => fn ($query) => $query->orderByDesc('populer')->orderBy('price'),
        ]);

        $service->setAttribute('thumbnail_url', $this->imageUrl($service->thumbnail));
        $service->serviceGalleries->each(fn ($gallery) =>
            $gallery->setAttribute('image_url', $this->imageUrl($gallery->image))
        );

        return view('front.detail', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function imageUrl(?string $path): string
    {
        return filled($path) ? '/storage/' . ltrim($path, '/') : asset('img/sendang.png');
    }
}
