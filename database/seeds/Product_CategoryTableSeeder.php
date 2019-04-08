<?php

use Illuminate\Database\Seeder;

class Product_CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\ProductCategory::class, 50)->create();

        factory(App\Attribute::class,400)->create();
        //factory(App\Color::class,10)->create();
        factory(App\CommentProduct::class,100)->create();
        factory(App\OrderDetail::class,150)->create();
        factory(App\Order::class,50)->create();
        
        factory(App\ProductTag::class, 100)->create();
        factory(App\Product::class,100)->create();
        //factory(App\Size::class,10)->create();
        //factory(App\Tag::class,50)->create();
        factory(App\User::class,100)->create();

        factory(App\PostCategory::class,50)->create();
        factory(App\CommentPost::class,100)->create();
        factory(App\Post::class,50)->create();
        factory(App\PostTag::class,100)->create();
    }
}
