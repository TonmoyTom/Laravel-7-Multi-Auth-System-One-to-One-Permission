<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminLoginController extends Controller
{


    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginFrom(){

        return view('auth.admin-login');
    }

    public function login(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:',
        ]);

        if(Auth::guard('admin')->attempt(['email'=> $request->email, 'password' => $request->password] )){
              return  redirect()->intended(route('admin.dashboard'));
        }
        return redirect()->back()->withInput($request->only('email'));

    }


    public function logout(Request $request ){
        Auth::guard('admin')->logout();

        return redirect('/admin/login');
    }
}
