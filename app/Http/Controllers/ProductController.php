<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use App\Tag;
use App\Color;
use App\Size;
use App\Attribute;
use App\ProductTag;
use Session;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('backend.product.index')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productCategories = ProductCategory::all();
        $tags = Tag::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('backend.product.create')->with('productCategories', $productCategories)
                                            ->with('tags', $tags)
                                            ->with('colors', $colors)
                                            ->with('sizes', $sizes);
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
                            'product_category_id' => 'required',
                            'name' => 'required',
                            'description' => 'required',
                            'import_price' => 'required',
                            'price' => 'required',
                            'discount' => 'required',
                            'image' => 'required'
                        ]    
        );
        $arr_image = array();
        foreach ($request->image as $image) {
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move('uploads/products', $image_new_name);
            array_push($arr_image, array('name' => $image_new_name));
        }
        
        $image = json_encode($arr_image);

        $product = Product::create([
            'product_category_id' => $request->product_category_id,
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'description' => $request->description,
            'import_price' => $request->import_price,
            'price' => $request->price,
            'discount' => $request->discount,
            'image' => $image
        ]);

        $product->tags()->attach($request->tags);

        foreach ($request->sizes as $key => $size) {
            Attribute::create([
                'product_id' => $product->id,
                'size_id' => $size,
                'color_id' => $request->colors[$key],
                'qty' => $request->qtys[$key]
            ]);
        }

        Session::flash('success', 'Add successfully!');

        return redirect()->route('products.create');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if(!isset($product->image)){
            unlink($product->image);
        }
        
        foreach ($product->tags as $tag) {
            ProductTag::where('product_id', $product->id)->where('tag_id', $tag->id)->delete();
        }

        Attribute::where('product_id', $product->id)->delete();

        $product->delete();

        Session::flash('success','Destroy successfully!');

        return redirect()->route('products.index');
    }
}
