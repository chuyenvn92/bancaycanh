<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use App\Tag;
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
        return view('backend.product.create')->with('productCategories', $productCategories)
                                            ->with('tags', $tags);
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
                            'qty' => 'required',
                            'image' => 'required'
                        ],
                        [
                            'product_category_id.required' => 'Hãy chọn danh mục sản phẩm',
                            'name.required' => 'Tên sản phẩm không được để trống.',
                            'description.required' => 'Mô tả không được để trống.',
                            'import_price.required' => 'Giá nhập không được để trống.',
                            'price.required' => 'Giá bán không được để trống',
                            'discount.required' => 'Giảm giá không được để trống',
                            'qty.required' => 'Số lượng không được để trống',
                            'image.required' => 'Hãy chọn hình ảnh cho sản phẩm.'
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
            'qty' => $request->qty,
            'image' => $image
        ]);

        $product->tags()->attach($request->tags);

        Session::flash('success', 'Thêm thành công!');

        return redirect()->route('products.index');
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

        Session::flash('success','Xóa thành công!');

        return redirect()->route('products.index');
    }
}
