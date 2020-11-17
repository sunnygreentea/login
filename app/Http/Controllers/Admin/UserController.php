<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    // All functions apply middleware auth
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Gate::allows('is_admin')) {
            
            $users = User::all();
            return view('admin.users.index', compact('users'));
        }
        else {
            return redirect()->route('home');
        }
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Gate::allows('is_admin')) {
            // Get all roles
            $allRoles = Role::all();
            //Get all role ids for current user
            $userRoles = $user->roles->pluck('id')->toArray();

            return view('admin.users.edit')->with(['user'=>$user, 'roles'=>$allRoles, 'userRoles' => $userRoles]);
        }
        else {
            return redirect()->route('home');
        }
        
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
        $user->name = $request->name;
        if($user->save() && $user->roles()->sync($request->roles)) {
            $request->session()->flash('success','User has beed saved');
        }
        else {
            $request->session()->flash('eror','Error when saving user');
        }
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->delete();
        return redirect()->route('admin.users.index');
    }
}
