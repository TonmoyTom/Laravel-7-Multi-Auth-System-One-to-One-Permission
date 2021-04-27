<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public $admins;


    public function __construct()
    {
        $this->middleware(function($request,$next){
            $this->admins =Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function index()
    {
        if(is_null($this->admins) || !$this->admins->can('role.all')){
            abort(403,'Not Access');
        }

        $roles = Role::orderBy('id', 'asc')->get();
        return view('Admin.role.index',compact('roles'));
    }

    public function create()
    {
       if(is_null($this->admins) || !$this->admins->can('role.create')){
            abort(403,'Not Access');
        }

       $premission =  Permission::all();
       $premission_groups = Admin::getpermissiongroup();
   
       return view('Admin.role.create',compact('premission','premission_groups'));
    }

    public function store(Request $request)
    {

        if(is_null($this->admins) || !$this->admins->can('role.store')){
            abort(403,'Not Access');
        }
        $rules = [
            'name' => 'required|max:100|unique:roles',
        ];
        $customMessage = [
            'name.required' => 'Name Is Requerd',
        ];

        $this->validate($request,$rules,$customMessage);

      
        // $role = Role::where('name', $request->name)->first();
        $premission = $request->input('permissions');

        if(!empty($premission)){
          $role =  Role::create(['guard_name' => 'admin','name' => $request->name]);
          $role->syncPermissions($premission);
          
        }else{

            return redirect()->route('role.create')->with('error','Input your Role!');
        }

        return redirect()->route('role.all')->with('success','Role Has Submit!');
    }


    public function edit($id)
    {
        if(is_null($this->admins) || !$this->admins->can('role.edit')){
            abort(403,'Not Access');
        }
        
        $roles = Role::findOrFail($id);
        $premissions = Permission::all();
        $premission_groups = Admin::getpermissiongroup();
        return view('Admin.role.edit',compact('roles','premission_groups','premissions'));
    }


    public function update(Request $request, $id)
    {
        if(is_null($this->admins) || !$this->admins->can('role.update')){
            abort(403,'Not Access');
        }

        $rules = [
            'name' => 'required|max:100|unique:roles,name,' . $id,
        ];
        $customMessage = [
            'name.required' => 'Name Is Requerd',
        ];

        $this->validate($request,$rules,$customMessage);

        
        // $role = Role::where('name', $request->name)->first();
        $premission = $request->input('permissions');

        if(!empty($premission)){
            $role =  Role::findOrfail($id);
            $role->syncPermissions($premission);
            $role->name = $request->name;
            $role->save();
        }else{

            return redirect()->route('role.edit')->with('error','Input your Role!');
        }

        return redirect()->route('role.all')->with('success','Role Has upadte!');
    }


    public function delete($id)
    {

        if(is_null($this->admins) || !$this->admins->can('role.delete')){
            abort(403,'Not Access');
        }
        $role =  Role::findOrfail($id); 
        if(!is_null($role)){
            $role->delete();
        }

        return redirect()->route('role.all')->with('success','Role Has delete!');
    }






   
}
