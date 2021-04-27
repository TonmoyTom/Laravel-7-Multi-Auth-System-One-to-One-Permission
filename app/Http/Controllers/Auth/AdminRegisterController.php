<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminRegisterController extends Controller
{
   
  
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function showRegisterFrom(){
        return view('auth.adminregister');
    }

    public function register(Request $request){

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
      

        try{
            $admin = Admin::create ([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            
            Auth::guard('admin')->loginUsingId($admin->id,true);
            return redirect()->route('admin.dashboard');
        } catch (\Exception $e){
            return redirect()->back()->withInput($request->only('name','email'));
        }
    }
  
   
}
