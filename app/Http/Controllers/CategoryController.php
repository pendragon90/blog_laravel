<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryTagResource;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $totalCategories = Category::all();
        $search = $request->input('search');

        $query = Category::query();

        if ($search) {
            $query->where('title', 'LIKE', '%' . $search . '%');
        }

        $categories = $query->latest()->paginate($request->perpage ?? 10)->withQueryString();

        return inertia('Dashboard/Categories/DashboardCategories', [
            'totalCategories' => $totalCategories->count(),
            'categories' => CategoryTagResource::collection($categories),
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Dashboard/Categories/DashboardCreateCategories');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Category::create([
            'user_id' => 1,
            'title' => $request->title,
            'slug' => Str::slug($request->title . '-' . uniqid())
        ]);

        Session::flash('success', 'Category was Created!');

        return to_route('categories.index');
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
    public function edit(Category $category)
    {
        return inertia('Dashboard/Categories/DashboardEditCategories', [
            'singleCategory' => new CategoryTagResource($category),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->update([
            'user_id' => 1,
            'title' => $request->title,
            'slug' => Str::slug($request->title . '-' . uniqid())
        ]);

        Session::flash('success', 'Category was Updated!');

        return to_route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return back();
    }
}
