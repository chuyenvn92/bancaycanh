<?php

namespace App\Http\Controllers;

use App\Slide;
use Session;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slide::all();
        return view('backend.slide.index')->with('slides', $slides);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.slide.create');
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
                            'title' => 'required',
                            'content' => 'required',
                            'image' => 'required'
                        ],
                        [
                            'title.required' => 'Tiêu đề slide không được để trống',
                            'content.required' => 'Nội dung slide không được để trống',
                            'image.required' => 'Hãy chọn hình ảnh cho slide'
                        ]
        );
        $image_upload = $request->image;
        $image_new_name = time() . $image_upload->getClientOriginalName();
        $image_upload->move('uploads/slides', $image_new_name);
        $image = 'uploads/slides/' . $image_new_name;

        Slide::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $image
        ]);

        Session::flash('success', 'Thêm thành công!');

        return redirect()->route('slides.create');

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
        $slide = Slide::find($id);
        return view('backend.slide.edit')->with('slide', $slide);
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
                        ],
                        [
                            'title.required' => 'Tiêu đề slide không được để trống.',
                            'content.required' => 'Nội dung slide không được để trống.',
                        ]
        );

        $slide = Slide::find($id);
        
        if ($request->hasFile('image')){
            $image_upload = $request->image;
            $image_new_name = time() . $image_upload->getClientOriginalName();
            $image_upload->move('uploads/slides', $image_new_name);
            $image = 'uploads/slides/' . $image_new_name;
            unlink($slide->image);
            $slide->image = $image;
        }
        
        $slide->title = $request->title;
        $slide->content = $request->content;
        $slide->save();

        Session::flash('success', 'Sửa thành công!');

        return redirect()->route('slides.edit', ['slide' => $slide]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = Slide::find($id);

        if(isset($slide->image)){
            unlink($slide->image);
        }

        $slide->delete();

        Session::flash('success','Xóa thành công!');

        return redirect()->route('slides.index');
    }
}
