<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use App\Product;
use App\Order;
use App\CommentProduct;
use App\Post;
use App\PostCategory;
use App\CommentPost;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $productCategory = ProductCategory::all()->count();
        $product = Product::all()->count();
        $order = Order::all()->count();
        $productComment = CommentProduct::all()->count();
        $post = Post::all()->count();
        $postCategory = PostCategory::all()->count();
        $postComment = CommentPost::all()->count();
        $user = User::all()->count();

        return view('backend.home')->with('productCategory', $productCategory)
                                    ->with('product', $product)
                                    ->with('order', $order)
                                    ->with('commentProduct', $productComment)
                                    ->with('post', $post)
                                    ->with('postCategory', $postCategory)
                                    ->with('commentPost', $postComment)
                                    ->with('user', $user);                     
    }
}
