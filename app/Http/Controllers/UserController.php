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
                    ],
                    [
                        'name.required' => 'Họ tên không được để trống.',
                        'name.string' => 'Họ tên phải là chữ cái.',
                        'name.max' => 'Họ tên không được quá 255 kí tự.',
                        'dob.required' => 'Ngày sinh không được để trống.',
                        'dob.date' => 'Ngày sinh phải và ngày thánh.',
                        'sex' => 'Địa chỉ không được để trống',
                        'address.required' => 'Địa chỉ không được để trống',
                        'address.string' => 'Địa chỉ phải là ký tự',
                        'address.max' => 'Địa chỉ không được quá 255 ký tự',
                        'number_phone.required' => 'Số điện thoại không được để trống',
                        'email.required' => 'Địa chỉ email không được để trống.',
                        'email.string' => 'Địa chỉ email phải là ký tự.',
                        'email.email' => 'Email không đúng định dạng.',
                        'email.max' => 'Địa chỉ email không được quá 255 ký tự.',
                        'password.required' => 'Mật khẩu không được để trống.',
                        'password.min' => 'Mật khẩu ít nhất phải 6 kí tự.',
                        'password.confirmed' => 'Mật khẩu nhập lại không khớp.'
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
            'password' => Hash::make($request->password),
            'image' => $image,
        ]);

        Session::flash('success','Thêm thành công!');

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
                        ],
                        [
                            'name.required' => 'Họ tên không được để trống.',
                            'name.string' => 'Họ tên phải là chữ cái.',
                            'name.max' => 'Họ tên không được quá 255 kí tự.',
                            'dob.required' => 'Ngày sinh không được để trống.',
                            'dob.date' => 'Ngày sinh phải và ngày thánh.',
                            'sex' => 'Địa chỉ không được để trống',
                            'address.required' => 'Địa chỉ không được để trống',
                            'address.string' => 'Địa chỉ phải là ký tự',
                            'address.max' => 'Địa chỉ không được quá 255 ký tự',
                            'number_phone.required' => 'Số điện thoại không được để trống',
                            'email.required' => 'Địa chỉ email không được để trống.',
                            'email.string' => 'Địa chỉ email phải là ký tự.',
                            'email.email' => 'Email không đúng định dạng.',
                            'email.max' => 'Địa chỉ email không được quá 255 ký tự.',
                            'password.required' => 'Mật khẩu không được để trống.',
                            'password.min' => 'Mật khẩu ít nhất phải 6 kí tự.',
                            'password.confirmed' => 'Mật khẩu nhập lại không khớp.'
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
        }else{
            $user->image = 'uploads/users/user-default';
        }
        
        $user->name = $request->name;
        $user->dob = $request->dob;
        $user->sex = $request->sex;
        $user->address = $request->address;
        $user->number_phone = $request->number_phone;
        $user->email = $request->email;
        $user->is_admin = $request->is_admin;
        $user->password = Hash::make($request->password);
        $user->save();

        Session::flash('success','Sửa thành công!');

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
		$user->delete();
        Session::flash('success', 'Xóa thành công!');

        return redirect()->route('users.index');
    }
}
