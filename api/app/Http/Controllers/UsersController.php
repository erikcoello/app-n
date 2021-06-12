<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
   {
    $this->middleware('auth');
   } 



    public function index()
    {   
        if(Gate::denies('isAdmin')) {
            abort(403);
        }      


        $users = User::orderBy('id', 'desc')->get();
        return view('users.index', compact('users'));
        //return $users;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        if($request->ajax()){
           
            $roles = Role::where('id', $request->role_id)->first();
            $permissions = $roles->permissions;
            return $permissions;
        }
        $roles = Role::all();


         return view('users.create',compact('roles'));     /*,[

            'user' => new User

        ]*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::denies('isAdmin')) {
            abort(493);
        }      

       //validate the fields
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|email|max:255',
            'password' => 'required|between:8,255|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        if($request->role != null){
            $user->roles()->attach($request->role);
            $user->save();
        }

        if($request->permissions != null){            
            foreach ($request->permissions as $permission) {
                $user->permissions()->attach($permission);
                $user->save();
            }
        }



     return redirect('users');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //return $user;
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

         $roles = Role::get();
        $userRole = $user->roles->first();
        if($userRole != null){
            $rolePermissions = $userRole->allRolePermissions;
        }else{
            $rolePermissions = null;
        }
        $userPermissions = $user->permissions;

         //dd($rolePermission);
         return view('users.edit',
            compact('user','roles','userRole','rolePermissions','userPermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        if(Gate::denies('isAdmin')) {
            abort(493);
        } 

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password != null){
            $user->password = Hash::make($request->password);
        }
        $user->save();

//elimina las relaciones anteriores en la tabla pivote - para agregar los nuevos permisos
       $user->roles()->detach();
        $user->permissions()->detach();
// guardamos los nuevos valores con attach de roles
        if($request->role != null){
            $user->roles()->attach($request->role);
            $user->save();
        }

    // guardo los permisos
        if($request->permissions != null){            
            foreach ($request->permissions as $permission) {
                $user->permissions()->attach($permission);
                $user->save();
            }
        }

     return redirect('users');

   }

 public function destroy(User $user){

        if(Gate::denies('isAdmin')) {
            abort(493);
        } 

        $user->roles()->detach();
         $user->permissions()->detach();
        $user->delete();
          return redirect('users');

}
}