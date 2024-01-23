<?php

namespace App\Http\Controllers;

use App\Models\RoomCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class RoomCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('view', 'category');
        $categories = RoomCategory::all();
        return view('pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('create', 'category');

        // dd($request->all());
        $category = new RoomCategory;
        $category->name = $request->name;
        $category->facility = $request->facility;
        $category->description = $request->description;
        $category->normal_rent = $request->normalrent;
        $category->patient_rent = $request->patientrent;
        $category->save();
        return redirect()->back()->with('message', 'Data Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        Gate::authorize('update', 'category');

        if ($request->ajax()) {
            $data = RoomCategory::findOrFail($request->category);
            return response()->json(['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoomCategory $category)
    {
        Gate::authorize('update', 'category');

        $category = RoomCategory::findOrFail($category->id);
        $category->name = $request->name;
        $category->facility = $request->facility;
        $category->description = $request->description;
        $category->normal_rent = $request->normalrent;
        $category->patient_rent = $request->patientrent;
        $this->generateResponse($category->update());
        return redirect()->route('category.index')->with('message', 'Data Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('delete', 'category');

        $cat = RoomCategory::find($id);

        return $this->generateResponse($cat->delete());
    }
}
