<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\StoreBlogRequest;
use App\Http\Requests\Blog\UpdateBlogRequest;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);

        $totalBlogs = Blog::count();

        $updatedThisMonth = Blog::whereMonth('updated_at', now()->month)
            ->whereYear('updated_at', now()->year)
            ->count();

        $latestPost = Blog::latest()->first();

        return view('admin.blog.index', compact('blogs', 'totalBlogs', 'updatedThisMonth', 'latestPost'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $validatedData = $request->validated();

        // Handle the thumbnail upload if it exists
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('blog', 'public');
            $validatedData['thumbnail'] = $thumbnailPath;
        }

        Blog::create($validatedData);

        return redirect()->route('admin.blog.index')->with('success', 'Blog post created successfully.');
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
    public function edit(Blog $blog)
    {
        return view('admin.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $validatedData = $request->validated();

        // Handle the thumbnail upload if it exists
        if ($request->hasFile('thumbnail')) {
            // Delete the old thumbnail if it exists
            if ($blog->thumbnail) {
                if(Storage::disk('public')->exists($blog->thumbnail)) {
                    Storage::disk('public')->delete($blog->thumbnail);
                }
            }

            $thumbnailPath = $request->file('thumbnail')->store('blog', 'public');
            $validatedData['thumbnail'] = $thumbnailPath;
        }

        $blog->update($validatedData);

        return redirect()->route('admin.blog.index')->with('success', 'Blog post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        Storage::disk('public')->delete($blog->thumbnail);
        $blog->delete();
        return redirect()->back()->with('success', 'Blog deleted successfully.');
    }
}
