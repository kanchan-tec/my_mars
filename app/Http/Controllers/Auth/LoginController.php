<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
       // echo "test";die;
        $input = $request->all();
        //print_r($input);die;
        $this->validate($request, [
           // 'email' => 'required|email',
            'username' => 'required|exists:users,name',
            'password' => 'required|min:8',
        ]);

        if(auth()->attempt(array('name' => $input['username'], 'password' => $input['password'], 'type'=>$input['type'])))
        {
           // dd(auth()->user()->toArray());
                 if (auth()->user()->type == 'staff') {
                return redirect()->route('admin.home');
                 }
                 else
                 {
                     return redirect()->route('hospital.home');
                 }

        }else{
            return redirect()->route('login')->withErrors([
                'password' => 'You have entered an incorrect password,',
            ]);

        }

    }
}
