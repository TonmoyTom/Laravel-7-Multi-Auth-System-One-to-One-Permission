<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function profile()
    {
        return view('auth.user.profile');
    }
    public function profilechange()
    {
        $userdetails = User::where('email',Auth::user()->email)->first();
        return view('auth.user.profilechange')->with(compact('userdetails'));
    }


    public function useroldPassword(Request $request){
        $data = $request->all();
        // echo "<pre>" ; print_r($data); 
        // echo "<pre>" ; print_r( Auth::guard('admin')->user()->password); 
        if(Hash::check($data['userold_password'],Auth::user()->password)){
            echo "true";
        }else{
            echo "false";
        }
    }

    public function upadtepassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
           //Password Change
           //  print_r($data);
           if(Hash::check($data['userold_password'],Auth::user()->password)){
               if($data['usernew_password'] == $data['userconfirm_pass']){
                   User::where('id', Auth::user()->id)->update(['password'=> bcrypt($data['usernew_password'])]);
                   return redirect()->route('user.profile.change')->with('success','Your Password Has been Change!');
               }else{
                   return redirect()->route('user.profile.change')->with('error','Your  Password Is Not Match!');
               }
           }else{
              return redirect()->route('user.profile.change')->with('error','Your current Password Is Incorrect!');
           }
        }
   }


   public function upadteprofile()
   { $userdetails = User::where('email',Auth::user()->email)->first();
       return view('auth.user.updateprofile')->with(compact('userdetails'));
   }


   public function upadteprofilestore(Request $request)
   {
       

       if($request->isMethod('post')){
           $data = $request->all();
           $rules = [
               'name' => 'required',
               'email' => 'required',
           ];
           $customMessage = [
               'name.required' => 'Name Is Requerd',
               'email.required' => 'email Is Requerd',
           ];
               $this->validate($request,$rules,$customMessage);

               if(Hash::check($data['userold_password'],Auth::user()->password)){
                   User::where('email', Auth::user()->email)->update(['name'=> $data['name'],'email' =>$data['email']]);
                   return redirect()->route('user.update.profile.change')->with('success','Your current profile  has Been Change!');
               }else{
                   return redirect()->route('user.update.profile.change')->with('error','Your current Password Is Incorrect!');
               }
       }
   }

}
