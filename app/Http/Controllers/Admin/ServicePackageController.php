<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServicePackage\StoreServicePackageRequest;
use App\Http\Requests\ServicePackage\UpdateServicePackageRequest;
use App\Models\Service;
use App\Models\ServicePackage;
use Illuminate\Http\Request;

class ServicePackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $selectedService = null;
        $services = collect();

        if ($request->filled('service')) {
            $selectedService = Service::where('slug', $request->query('service'))->firstOrFail();
        } else {
            $services = Service::latest()->get();
        }

        return view('admin.service.package.create', compact('services', 'selectedService'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServicePackageRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['populer'] = (bool) $validatedData['populer'];

        $package = ServicePackage::create($validatedData);

        return redirect()->route('admin.service.show', $package->service)->with('success', 'Service package created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServicePackage $servicePackage)
    {
        $servicePackage->load('service');

        return view('admin.service.package.edit', compact('servicePackage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServicePackageRequest $request, ServicePackage $servicePackage)
    {
        $validatedData = $request->validated();
        $validatedData['populer'] = (bool) $validatedData['populer'];

        $servicePackage->update($validatedData);

        return redirect()->route('admin.service.show', $servicePackage->service)->with('success', 'Service package updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServicePackage $servicePackage)
    {
        $servicePackage->delete();

        return redirect()->back()->with('success', 'Service package deleted successfully.');
    }
}
