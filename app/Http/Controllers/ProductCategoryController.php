<?php

namespace App\Http\Controllers;

use Session;
use App\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productCategories = ProductCategory::all();
        return view('backend.product_category.index')->with('productCategories', $productCategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.product_category.create');
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
                            'name' => 'required | min:2'
                        ]);

        ProductCategory::create([
            'name' => $request->name,
            'slug' => str_slug($request->name)
        ]);
        
        Session::flash('success', 'Add successfully!');
        return redirect()->route('productcategories.create');
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
        $category = ProductCategory::find($id);
        return view('backend.product_category.edit')->with('category', $category);
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
            'name' => 'required | min:2'
        ]);

        $category = ProductCategory::find($id);
        $category->name = $request->name;
        $category->slug = str_slug($request->name);
        $category->save();
        Session::flash('success', 'Edit successfully!');

        return redirect()->route('productcategories.edit', [ 'category' => $category ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = ProductCategory::find($id);
        $category->delete();
        Session::flash('success', 'Destroy successfully!');

        return redirect()->route('productcategories.index');
    }
}
