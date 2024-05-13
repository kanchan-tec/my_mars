<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
   public function index()
   {
    return view('admin.auth.login');
   }

   public function staff_store(Request $request){
    // echo "test";die;
    $input = $request->all();
    //print_r($input);die;
            $this->validate($request, [
               // 'email' => 'required|email',
                'email' => 'required|exists:admin2,user_name',
                'password' => 'required|min:8',
            ]);
            if(auth()->attempt(array('user_name' => $input['email'], 'passcode' => $input['password'])))
            {
                    return redirect('admin_dashboard');
            }else{
                return redirect()->route('staff.login')->withErrors([
                    'password' => 'You have entered an incorrect password,',
                ]);
            }
        }


        public function admin_dashboard (){
          return view('index');
  }
}
