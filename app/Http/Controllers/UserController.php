<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('backend.user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.user.create');
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
                        'name' => ['required', 'string', 'max:255'],
                        'dob' => ['required', 'date'],
                        'sex' => ['required'],
                        'address' => ['required','string', 'max:255'],
                        'number_phone' => ['required'],
                        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                        'password' => ['required', 'string', 'min:6', 'confirmed'],
                        'image' => 'required',
                    ]
                    );
        $image_upload = $request->image;
        $image_new_name = time() . $image_upload->getClientOriginalName();
        $image_upload->move('uploads/users', $image_new_name);
        $image = 'uploads/users/' . $image_new_name;
        User::create([
            'name' => $request->name,
            'dob' => $request->dob,
            'sex' => $request->sex,
            'address' => $request->address,
            'number_phone' => $request->number_phone,
            'email' => $request->email,
            'password' => Hash::make('secret'),
            'image' => $image,
        ]);

        Session::flash('success','Add user successfully!');

        return redirect()->route('users.create');
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
        $user = User::find($id);
        return view('backend.user.edit')->with('user', $user);
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
        if ($request->hasFile('image')){
            $image_upload = $request->image;
            $image_new_name = time() . $image_upload->getClientOriginalName();
            $image_upload->move('uploads/users', $image_new_name);
            $image = 'uploads/users/' . $image_new_name;
            if (!empty($user->image)) {
                unlink($user->image);
            }
            $user->image = $image;
        }
        
        $user->name = $request->name;
        $user->dob = $request->dob;
        $user->sex = $request->sex;
        $user->address = $request->address;
        $user->number_phone = $request->number_phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        Session::flash('success','Edit user successfully!');

        return redirect()->route('users.edit',['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        Session::flash('success', 'Destroy user successfully!');

        return redirect()->route('users.index');
    }
}
