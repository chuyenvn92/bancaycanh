<?php

namespace App\Http\Controllers;

use App\PostCategory;
use Session;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postCategories = PostCategory::all();
        return view('backend.post_category.index')->with('postCategories',$postCategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.post_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
                        [
                           'name' => 'required' 
                        ]
        );

        PostCategory::create([
            'name' => $request->name,
            'slug' => str_slug($request->name)
        ]);

        Session::flash('success', 'Add successfully!');

        return redirect()->route('postcategories.create');
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
    public function edit($id)
    {
        $category = PostCategory::find($id);
        return view('backend.post_category.edit')->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
                        [
                        'name' => 'required' 
                        ]
        );

        $postCategories = PostCategory::find($id);
        $postCategories->name = $request->name;
        $postCategories->slug = str_slug($request->name);

        Session::flash('success', 'Edit successfully!');

        return redirect()->route('postcategories.edit', ['postCategories' => $postCategories]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postCategories = PostCategory::find($id);
        $postCategories->delete();

        Session::flash('success', 'Destroy successfully!');

        return redirect()->route('postcategories.index');
    }
}
