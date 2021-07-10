<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/admin', 'Auth\LoginController@showLoginForm')->name('get.login');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::resources([
        'dashboad' => 'HomeController',
        'orders' => 'OrderController',
        'productcategories' => 'ProductCategoryController',
        'products' => 'ProductController',
        'commentproducts' => 'CommentProductController',
        'tags' => 'TagController',
        'postcategories' => 'PostCategoryController',
        'posts' => 'PostController',
        'commentposts' => 'CommentPostController',
        'abouts' => 'AboutController',
        'contacts' => 'ContactController',
        'slides' => 'SlideController',
        'users' => 'UserController',
        'sizes' => 'SizeController',
        'colors' => 'ColorsController'
    ]);
});

Route::get('/user/login', 'FrontendController@showLoginForm')->name('user.login');
Route::post('/user/login', 'FrontendController@login');
Route::post('/user/logout', 'FrontendController@logout')->name('user.logout');
Route::get('/user/register', 'FrontendController@showRegisterForm')->name('user.register');
Route::post('/user/register', 'FrontendController@register')->name('register.store');
Route::get('/user/profile/{id}', 'FrontendController@showProfile')->name('user.profile');
Route::post('/user/profile/{id}', 'FrontendController@profile')->name('user.update');

Route::resource('carts', 'CartController');
Route::get('/', 'FrontendController@index')->name('index');
Route::get('/about', 'FrontendController@about')->name('about');
Route::get('/contact', 'FrontendController@contact')->name('contact');

Route::get('/product', 'FrontendController@product')->name('product');
Route::get('/product-detail/{slug}', 'FrontendController@productDetail')->name('product.detail');
Route::post('/product-detail/store/{id}', 'FrontendController@storeCommentProduct')->name('product.store')->middleware('user');
Route::get('/product-detail/paginate', 'FrontendController@paginateProduct')->name('paginate.product');

Route::get('/history/{id}', 'FrontendController@history')->name('history')->middleware('user');
Route::get('/history/detail/{id}', 'FrontendController@historyDetail')->name('history.detail')->middleware('user');
Route::get('/verify/{order}', 'FrontendController@verify')->name('verify');

Route::get('/order', 'FrontendController@order')->name('order');
Route::post('/order/store', 'FrontendController@store')->name('order.store');
Route::post('/order/update', 'FrontendController@update')->name('order.update');
Route::get('/order/destroy/{id}', 'FrontendController@destroy')->name('order.destroy');
Route::post('/order/checkout', 'FrontendController@checkout')->name('order.checkout')->middleware('user');

Route::post('/product/search', 'FrontendController@productSearch')->name('product.search');



Route::get('/blog', 'FrontendController@blog')->name('blog');
Route::get('/blog/category/{category_slug}', 'FrontendController@blogCategory')->name('blog.category');
Route::get('/blog/tag/{tag_slug}', 'FrontendController@blogTag')->name('blog.tag');
Route::post('/blog/search', 'FrontendController@blogSearch')->name('blog.search');

Route::get('/blog-detail/{slug}', 'FrontendController@blogDetail')->name('blog.detail');
Route::post('/blog-detail/store/{id}', 'FrontendController@storeCommentPost')->name('blog.store')->middleware('user');
Route::get('/blog-detail/paginate/{page}', 'FrontendController@paginateCommentPost')->name('blog.paginate');