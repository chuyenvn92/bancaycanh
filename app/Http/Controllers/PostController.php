<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use App\PostCategory;
use App\PostTag;
use Session;
use Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('backend.post.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postCategories = PostCategory::all();
        $tags = Tag::all();
        return view('backend.post.create')->with('tags',$tags)
                                        ->with('postCategories',$postCategories);
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
                            'post_category_id' => 'required',
                            'title' => 'required',
                            'content' => 'required',
                            'tags' => 'required',
                            'image' => 'required'
                        ]    
        );
 
        $image_upload = $request->image;
        $image_new_name = time() . $image_upload->getClientOriginalName();
        $image_upload->move('uploads/posts', $image_new_name);
        $image = 'uploads/posts/' . $image_new_name;

        $post = Post::create([
            'post_category_id' => $request->post_category_id,
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'content' => $request->content,
            'image' => $image
        ]);

        $post->tags()->attach($request->tags);

        Session::flash('success', 'Add successfully!');

        return redirect()->route('posts.create');
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
        $postCategories = PostCategory::all();
        $tags = Tag::all();
        $post = Post::find($id);
        return view('backend.post.edit')->with('post',$post)
                                        ->with('tags',$tags)
                                        ->with('postCategories',$postCategories);
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
                            'title' => 'required',
                            'content' => 'required',
                            'tags' => 'required',
                        ]    
        );

        $post = Post::find($id);

        if ($request->hasFile('image')){
            $image_upload = $request->image;
            $image_new_name = time() . $image_upload->getClientOriginalName();
            $image_upload->move('uploads/posts', $image_new_name);
            $image = 'uploads/posts/' . $image_new_name;
            unlink($post->image);
            $post->image = $image;
        }

        $post->post_category_id = $request->post_category_id;
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = str_slug($request->title);
        $post->content = $request->content;
        $post->save();

        $post->tags()->sync($request->tags);

        Session::flash('success', 'Edit successfully!');

        return redirect()->route('posts.edit', ['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if(isset($post->image)){
            unlink($post->image);
        }
        
        $post->tags()->detach();
        $post->delete();
        Session::flash('success','Destroy successfully!');

        return redirect()->route('posts.index');
    }
}
