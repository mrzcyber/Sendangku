<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantMenu\StoreRestaurantMenuRequest;
use App\Http\Requests\RestaurantMenu\UpdateRestaurantMenuRequest;
use App\Models\RestaurantMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RestaurantMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;


    $menuItems = RestaurantMenu::latest()->paginate(5);

    $foodCount = RestaurantMenu::where('category', 'makanan')->count();
    $drinkCount = RestaurantMenu::where('category', 'minuman')->count();
    $otherCount = RestaurantMenu::where('category', 'lainnya')->count();
    $totalMenus = RestaurantMenu::count();
        
    if($search){
            $menuItems = RestaurantMenu::where('name','like',$search.'%')->paginate(5);
    }
        



        return view('admin.restaurant.index', compact('menuItems', 'foodCount', 'drinkCount', 'otherCount', 'totalMenus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.restaurant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantMenuRequest $request)
    {
        $validatedData = $request->validated();

        // Process the validated data (e.g., save to database)
        if($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('menu', 'public');
            $validatedData['thumbnail'] = $thumbnailPath;
        }

        RestaurantMenu::create($validatedData);

        return redirect()->route('admin.restaurant-menu.index')->with('success', 'Menu item created successfully.');

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
    public function edit(string $id)
    {
        $menu = RestaurantMenu::findOrFail($id);
        return view('admin.restaurant.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantMenuRequest $request, string $id)
    {
        $oldMenu = RestaurantMenu::findOrFail($id);
        $validatedData = $request->validated();

        // Process the validated data (e.g., save to database)
        if($request->hasFile('thumbnail')){
            if(Storage::disk('public')->exists($oldMenu->thumbnail)){
                Storage::disk('public')->delete($oldMenu->thumbnail);
            }
            $path = $request->file('thumbnail')->store('menu', 'public');
            $validatedData['thumbnail'] = $path;
        }
        $oldMenu->update($validatedData);
        return redirect()->route('admin.restaurant-menu.index')->with('success', 'Menu item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $oldMenu = RestaurantMenu::findOrFail($id);

                if(Storage::disk('public')->exists($oldMenu->thumbnail)){
                Storage::disk('public')->delete($oldMenu->thumbnail);
            }

        RestaurantMenu::where('id',$id)->delete();

            return redirect()->route('admin.restaurant-menu.index')->with('success', 'Menu item delete successfully.');

    }
}
