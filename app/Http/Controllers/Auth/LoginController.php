<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }
    public function showLoginForm(){
        return view('auth.login');
    }
    public function login(Request $request){
        $this->validate($request,
                        [
                            'email' => ['required', 'string', 'email', 'max:255'],
                            'password' => ['required', 'string', 'min:6'],
                        ],
                        [
                            'email.required' => 'Email không được để trống',
                            'email.string' => 'Email phải là ký tự',
                            'email.email' => 'Email không đúng định dạng',
                            'email.max' => 'Email không được quá 255 ký tự',
                            'password.required' => 'Password không được bỏ trống',
                            'password.string' => 'Password phải là ký tự',
                            'password.min' => 'Password phải từ 6 ký tự',
                        ]
                        );
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->route('dashboad.index');
        }
                
        Session::flash('error', 'E-mail hoặc mật khẩu không đúng!');
        return redirect()->route('get.login');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('get.login');
    }
}
