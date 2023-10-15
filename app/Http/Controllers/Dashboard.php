<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use Session;

class Dashboard extends Controller
{
     public function dashboard(){
        $data=[];
        if(Session::has('userid')){
           $data['userdata']=Users::where('id','=',Session::get('userid'))->first();
           return view('dashboard.masterDashboard',$data);
        }else{
        return redirect('/');
        }

     }
     public function logout(){
        if(Session::has('userid')){
            $updateUser =  Users::where('id','=',Session::get('userid'))->update(array('login_status' => 0));
            if($updateUser){
                session()->pull('userid');
                return redirect('/');
            }
         }
     }
}
