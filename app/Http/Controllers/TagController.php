<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Resources\CategoryTagResource;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $totalTags = Tag::all();
        $search = $request->input('search');

        $query = Tag::query();

        if ($search) {
            $query->where('title', 'LIKE', '%' . $search . '%');
        }

        $tags = $query->latest()->paginate($request->perpage ?? 10)->withQueryString();

        return inertia('Dashboard/Tags/DashboardTags', [
            'totalTags' => $totalTags->count(),
            'tags' => CategoryTagResource::collection($tags),
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Dashboard/Tags/DashboardCreateTags');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Tag::create([
            'user_id' => 1,
            'title' => $request->title,
            'slug' => Str::slug($request->title . '-' . uniqid())
        ]);

        Session::flash('success', 'Tag was Created!');

        return to_route('tags.index');
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
    public function edit(Tag $tag)
    {
        return inertia('Dashboard/Tags/DashboardEditTags', [
            'singleTag' => new CategoryTagResource($tag),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $tag->update([
            'user_id' => 1,
            'title' => $request->title,
            'slug' => Str::slug($request->title . '-' . uniqid())
        ]);

        Session::flash('success', 'Tag was Updated!');

        return to_route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return back();
    }
}
