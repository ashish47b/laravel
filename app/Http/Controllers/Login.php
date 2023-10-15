<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Users;
//use validotor;
use Hash;
use Illuminate\Support\Facades\Hash as FacadesHash;

class Login extends Controller
{
    public function login(){
        return view('signin');
    }
    public function registration(){
        return view('signup');
    }
    public function forgotPassword(){
        return view('forgot_password');
    }
    public function userRegister(Request $request){
         $request->validate([
             'name'=>'required',
             'email'=>'required|email|unique:users',
             'password'=>'required|min:5|max:12',
             'conpassword'=>'required|same:password',
         ]);
         $user = new Users();
         $user->name = $request->name;
         $user->email = $request->email;
         $user->password = Hash::make($request->password);
        $res=$user->save();
        if($res){
            return back()->with('success','Account Created Successfully');
        }else{
            return back()->with('error','Something is Wrong');
        }
    }
    public function userLogin(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:5|max:12',
        ]);
        $user=Users::where('email','=',$request->email)->first();
        if($user){
             if(Hash::check($request->password, $user->password)){
                  $request->session()->put('userid',$user->id);
                  return redirect('Dashboard');
             }else{
                return back()->with('error','Password Not Matched');
             }
        }else{
            return back()->with('error','User Not Registered');
        }

    }
}// main class
