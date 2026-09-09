<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\StoreServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Models\Service;
use App\Models\ServiceGallery;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::withCount('servicePackages')
            ->latest()
            ->paginate(10);

        return view('admin.service.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        $validatedData = $request->validated();

        unset($validatedData['image']);
       if ($request->hasFile('thumbnail')) {
           $validatedData['thumbnail'] = $request->file('thumbnail')->store('service', 'public');
       }
     $service =  Service::create($validatedData);

       
        if($request->hasFile('image')){

            $images = $request->file('image');
            foreach ($images as $image) {
                $thumbnailPath = $image->store('gallery','public');
                $data =[
                    'service_id'=>$service->id,
                    'image'=>$thumbnailPath
                ];
                ServiceGallery::create($data);
            }
         
        }
            

        return redirect()->route('admin.service.index')->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        $packages = $service->servicePackages()
            ->with('service')
            ->latest()
            ->paginate(10);

        return view('admin.service.package.index', compact('service', 'packages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $data = $service->load('serviceGalleries');
        return view('admin.service.edit',compact('data'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $validatedData = $request->validated();
        unset($validatedData['image']);
        $thumbnail = $service->thumbnail;
        $images = $service->serviceGalleries;


        if($request->hasFile('thumbnail')){
         $validatedData['thumbnail'] = $request->file('thumbnail')->store('service','public');
        }
        $galleryPath = [];
        if($request->hasFile('image')){
            foreach ($request->file('image') as $image) {
                $galleryPath[] = $image->store('gallery','public');
            }
        };

        DB::transaction(function() use ($validatedData,$galleryPath,$service){
            $service->update($validatedData);

            if($galleryPath){

            $service->serviceGalleries()->delete();
                foreach ($galleryPath as $image) {
                    $service->serviceGalleries()->create([
                        'image'=>$image
                    ]);
                }
            }

        });
        

        if($request->hasFile('thumbnail')){
            if($thumbnail){
                if(Storage::disk('public')->exists($thumbnail)){
                    Storage::disk('public')->delete($thumbnail);
                }
            }
 
        };


        if($request->hasFile('image')){
            if($images){
                foreach ($images as  $image) {
                    if(Storage::disk('public')->exists($image->image)){
                        Storage::disk('public')->delete($image->image);
                    }
                }
            }

        }

        return redirect()->route('admin.service.index')->with('success', 'Service post updated successfully.');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {

        if($service->thumbnail){
            if(Storage::disk('public')->exists($service->thumbnail)){
                Storage::disk('public')->delete($service->thumbnail);
            }
        }

        $galleries = $service->serviceGalleries()->pluck('image')->toArray();

            foreach ($galleries as $galery) {
                if(Storage::disk('public')->exists( $galery)){
                    Storage::disk('public')->delete($galery);
                }
            }

        $service->serviceGalleries()->delete();
        $service->delete();

         return redirect()->back()->with('success', 'Service deleted successfully.');
        
    }
}
