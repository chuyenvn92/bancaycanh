<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\Slide;
use App\ProductCategory;
use App\Product;
use App\Attribute;
use App\Contact;
use App\About;
use App\Color;
use App\Size;
use App\Tag;
use App\PostCategory;
use App\Post;
use App\PostTag;
use App\CommentPost;
use App\CommentProduct;
use App\Order;
use App\OrderDetail;
use View;
use Session;
use Cart;
use Auth;

class FrontendController extends Controller
{
    public function __construct()
    {
        $productCategories = ProductCategory::all();
        View::share('productCategories', $productCategories);
    }

    public function showRegisterForm(){
        return view('frontend.register');
    }

    public function register(Request $request){
        $this->validate($request,
                    [
                        'name' => ['required', 'string', 'max:255'],
                        'dob' => ['required', 'date'],
                        'sex' => ['required'],
                        'address' => ['required','string', 'max:255'],
                        'number_phone' => ['required'],
                        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                        'password' => ['required', 'string', 'min:6', 'confirmed'],
                    ]
                    );

        User::create([
            'name' => $request->name,
            'dob' => $request->dob,
            'sex' => $request->sex,
            'address' => $request->address,
            'number_phone' => $request->number_phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
            
        Session::flash('success','Create new account successfully!');

        return redirect()->route('user.login');
    }

    public function showLoginForm(){
        return view('frontend.login');
    }


    public function login(Request $request){
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->route('index');
        }
                
        Session::flash('error', 'E-mail hoặc mật khẩu không đúng!');
        return redirect()->route('user.login');
    }

    public function showProfile($id){
        $user = User::find($id);

        return view('frontend.profile')->with('user', $user);
    }

    public function profile(Request $request, $id){
        $this->validate($request,
        [
            'name' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date'],
            'sex' => ['required'],
            'address' => ['required','string', 'max:255'],
            'number_phone' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]
        );

        $user = User::find($id);
        
        $user->name = $request->name;
        $user->dob = $request->dob;
        $user->sex = $request->sex;
        $user->address = $request->address;
        $user->number_phone = $request->number_phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        Session::flash('success','Update profile successfully!');

        return redirect()->route('user.profile',['user' => $user]);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('index');
    }
    
    public function index(){
        $slides = Slide::all();
        $productCategories = ProductCategory::all();
        $products = Product::paginate(12);
        $colors = Color::all();
        $tags = Tag::all();

        return view('frontend.index')->with('slides', $slides)
                                    ->with('productCategories', $productCategories)
                                    ->with('products', $products)
                                    ->with('colors', $colors)
                                    ->with('tags', $tags);
    }

    public function about(){
        $about = About::all()->first();
        return view('frontend.about')->with('about', $about);
    }

    public function contact(){
        $contact = Contact::all()->first();
        return view('frontend.contact')->with('contact', $contact);
    }

    public function product(){
        $productCategories = ProductCategory::all();
        $products = Product::paginate(12);
        $colors = Color::all();
        $tags = Tag::all();

        return view('frontend.product')->with('productCategories', $productCategories)
                                        ->with('products', $products)
                                        ->with('colors', $colors)
                                        ->with('tags', $tags);
    }

    public function productDetail($slug){
        $product = Product::where('slug', $slug)->first();
        $relatedProducts = Product::where('product_category_id', $product->product_category->id)->get();
        $sizes = Size::all();
        $colors = Color::all();
        $comments = CommentProduct::where('product_id', $product->id)->paginate(2);
        $comments_count = CommentProduct::where('product_id', $product->id)->count();
        return view('frontend.product-detail')->with('product', $product)
                                                ->with('relatedProducts', $relatedProducts)
                                                ->with('sizes', $sizes)
                                                ->with('colors', $colors)
                                                ->with('comments', $comments)
                                                ->with('comments_count', $comments_count);
    }

    public function storeCommentProduct(Request $request, $id){
        $content = $request->review;
        $product = Product::find($id);
        CommentProduct::create([
            'user_id' => Auth::id(),
            'product_id' => $id,
            'content' => $content,
        ]);

        Session::flash('success', 'Comment successfully!');

        return redirect()->route('product.detail', ['slug' => $product->slug]);
    }

    public function productSearch(Request $request){
        $id = $request->search;
            
        $products = Product::where('name', 'like', '%' . $id . '%')
                            ->orWhere('slug', 'like', '%' . $id . '%')
                            ->orWhere('description', 'like', '%' . $id . '%')
                            ->orWhere('price', 'like', '%'. $id . '%')
                            ->orWhere('discount', 'like', '%'. $id . '%')->paginate(12);
        $productCategories = ProductCategory::all();
        $colors = Color::all();
        $tags = Tag::all();

        return view('frontend.product')->with('productCategories', $productCategories)
                                        ->with('products', $products)
                                        ->with('colors', $colors)
                                        ->with('tags', $tags);
    }

    public function order(){
        $carts = Cart::content();
        
        return view('frontend.shoping-cart')->with('carts', $carts);
    }

    public function store(Request $request){
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        $size = Size::find($request->size);
        $color = Color::find($request->color);
        $attribute = Attribute::where('product_id', $product_id)->where('size_id', $size->id)->where('color_id', $color->id)->first();
        $qty = $request->qty;
        $price_discount = $product->price - $product->price * $product->discount / 100;
        Cart::add(['id' => $attribute->id, 'name' => $attribute->product->name, 'qty' => $qty, 'price' => $price_discount, 'options' => [ 'size' => $size->name, 'color' => $color->name, 'discount' => $product->discount, 'price' => $product->price ]]);
        Session::flash('success', 'Add to cart succesfully!');
        return redirect()->back();
    }

    public function update(Request $request){
    
        $rowIds = $request->rowid;
        $qtys = $request->qty;
        foreach ($rowIds as $key => $rowId) {
            Cart::update($rowId, $qtys[$key]);
        }

        Session::flash('success', 'Updated successfully!');
        return redirect()->route('order');
    }

    public function destroy($id){
        Cart::remove($id);
        Session::flash('success', 'Destroy product successfully!');
        return redirect()->route('order');
    }

    public function checkout(){
        $contents = Cart::content();

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => Cart::total(null,null,''),
            'status' => 0
        ]);
        
        foreach ($contents as $content) {
            OrderDetail::create([
                'order_id' => $order->id,
                'attribute_id' => $content->id,
                'qty' => $content->qty
            ]);
        }

        Cart::destroy();
        Session::flash('success', 'Checkout successfully!');
        return redirect()->route('index');
    }

    public function blog(){
        $posts = Post::paginate(3);
        $postCategories = PostCategory::all();
        $tags = Tag::all();
        return view('frontend.blog')->with('posts', $posts)
                                    ->with('postCategories', $postCategories)
                                    ->with('tags', $tags);
    }

    public function blogTag($id){
        $posts = Tag::find($id)->posts()->paginate(3);
        $postCategories = PostCategory::all();
        $tags = Tag::all();

        return view('frontend.blog')->with('posts', $posts)
                                            ->with('postCategories', $postCategories)
                                            ->with('tags', $tags);
    }

    public function blogCategory($category_slug){
        $category = PostCategory::where('slug', $category_slug)->first();

        $posts = Post::where('post_category_id', $category->id)->paginate(3);
        $postCategories = PostCategory::all();
        $tags = Tag::all();

        return view('frontend.blog')->with('posts', $posts)
                                            ->with('postCategories', $postCategories)
                                            ->with('tags', $tags);
    }

    public function blogSearch(Request $request){
        $id = $request->search;
        $posts = Post::where('id','like' , '%' . $id . '%')->orWhere('title', 'like', '%' . $id . '%')->orWhere('content','like' ,'%' . $id . '%')->paginate(3);
        $postCategories = PostCategory::all();
        $tags = Tag::all();

        return view('frontend.blog')->with('posts', $posts)
                                            ->with('postCategories', $postCategories)
                                            ->with('tags', $tags);
    }

    public function blogDetail($slug){
        $post = Post::where('slug', $slug)->first();
        $postCategories = PostCategory::all();
        $tags = Tag::all();
        $comments = CommentPost::where('post_id', $post->id)->orderBy('created_at', 'DESC')->paginate(5);
        return view('frontend.blog-detail')->with('post', $post)
                                            ->with('postCategories', $postCategories)
                                            ->with('tags', $tags)
                                            ->with('comments', $comments);
    }

    public function storeCommentPost(Request $request, $id){
        $content = $request->comment;
        $post = Post::find($id);
        CommentPost::create([
            'user_id' => Auth::id(),
            'post_id' => $id,
            'content' => $content,
        ]);

        Session::flash('success', 'Comment successfully!');

        return redirect()->route('blog.detail', ['slug' => $post->slug]);
    }

    public function paginateCommentPost($page){
        
    }
}
