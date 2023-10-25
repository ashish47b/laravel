<?php

namespace App\Http\Controllers;

use App\Models\menus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use Session;

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data=[];
        if(Session::has('userid')){
           $data['userdata']=Users::where('id','=',Session::get('userid'))->first();
           $data['categories'] = menus::select('id', 'name')
                           ->where('created_by_cid','=',$data['userdata']->company_id)
                           ->get();
           return view('pages.menu_index',$data);
        }else{
        return redirect('/');

        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'menuName'=>'required',
        ]);
        $menus = new menus();
         $menus->name = $request->menuName;
         $menus->parents = $request->parentmenu;
         $menus->status = 1;
         $menus->created_by_cid = $request->company_id;
         $menus->created_by = Session::get('userid');
         $res=$menus->save();
        if($res){
            return back()->with('success','Menu Add Successfully');
            die;
        }else{
            return back()->with('error','Something is Wrong');
            die;
        }
    }

    /**
     * Display the specified resource.
     */
    public function getallmenulist(Request $request)
    {
        // $menuses=menus::where('created_by_cid','=',$request->company_id)->get();
         $categories = menus::select('id', 'name')
                           ->where('created_by_cid','=',$request->company_id)
                           ->get();

            $html='';
            $html .='<option value="0"> Parents <option>';
           if(!empty($categories)){
               foreach ($categories as $menuslist) {
                $html .='<option value="'.$menuslist->id.'"> '.$menuslist->name.' <option>';
                   }
             }

      return $html;
    }
   /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(menus $menus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, menus $menus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(menus $menus)
    {
        //
    }
}
