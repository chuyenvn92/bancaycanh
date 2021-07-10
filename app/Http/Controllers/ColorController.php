<?php

namespace App\Http\Controllers;

use App\Color;
use Session;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::all();
        return view('backend.color.index')->with('colors',$colors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.color.create');
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
                            'name' => 'required',
                            'color_code' => 'required'
                        ],
                        [
                            'name.required' => 'Tên màu không được để trống',
                            'color_code.required' => 'Mã màu không được để trống'
                        ]
        );

        Color::create([
            'name' => $request->name,
            'color_code' => $request->color_code,
        ]);

        Session::flash('success', 'Thêm thành công!');

        return redirect()->route('colors.create');
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
        $color = Color::find($id);
        return view('backend.color.edit')->with('color',$color);
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
                            'name' => 'required',
                            'color_code' => 'required'
                        ],
                        [
                            'name.required' => 'Tên màu không được để trống',
                            'color_code.required' => 'Mã màu không được để trống'
                        ]
        );

        $color = Color::find($id);
        $color->name = $request->name;
        $color->color_code = $request->color_code;
        $color->save();

        Session::flash('success', 'Sửa thành công!');

        return redirect()->route('colors.edit', [ 'color' => $color ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $color = Color::find($id);
        $color->delete();

        Session::flash('success', 'Xóa thành công!');

        return redirect()->route('colors.index');
    }
}
