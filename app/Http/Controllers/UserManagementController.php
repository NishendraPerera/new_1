<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Role;

use Auth;
use Hash;

class UserManagementController extends Controller
{

    /**
     * Display the home of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function users_home()
    {
        $roles = Role::where('name', '!=', 'user')->select('id', 'name')->get();

        return view('user.management', compact('roles'));
    }

    public function employees_home()
    {
        $roles = Role::where('name', '!=', 'user')->select('id', 'name')->get();

        return view('user.employee', compact('roles'));
    }

    public function new_home()
    {
        $roles = Role::where('name', '!=', 'user')->select('id', 'name')->get();

        return view('user.new', compact('roles'));
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function employees()
    {
        $users = User::join('roles', 'users.role_id', '=', 'roles.id')->select('users.id', 'users.name', 'roles.name AS role', 'users.email')
                    ->where('role_id', '!=', 3)->get();

        return response()->json(array("data" => $users))->header('Content-Type', 'application/json');

        // return view('user.employee', compact('roles'));
    }

    public function users()
    {
        $users = User::join('roles', 'users.role_id', '=', 'roles.id')->select('users.id', 'users.name', 'roles.name AS role', 'users.email')
                    ->where('role_id', 3)->get();

        return response()->json(array("data" => $users))->header('Content-Type', 'application/json');

        //return view('user.employee', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->role_id  = $request->role;
        $user->password = Hash::make('p');
        $user->save();

        $request->session()->flash('success', 'New employee successfully added!');

        return "Success";

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        User::where('id', $request->id)->delete();

        $request->session()->flash('warning', 'User successfully deleted!');

        return "Success";

    }
}
