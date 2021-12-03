<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use app\Models\User;

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
        return view('spa');
    }

    public function handleAdmin()
    {
        return view('admin.dashboard');
    }
    public function getUsers()
    {

        $users = DB::table('users')->latest()->get();
        $role = auth()->user()->role;
        return response()->json([
            'users' => $users,
            'role' => $role
        ]);
    }

    public function getStudent()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return response()->json($user);
    }
    public function editProfile($id, Request $request)
    {
        $user = User::find($id);
        $user->update($request->all());

        return response()->json('Profile updated!');
    }


    // admin functions


    public function addUser(Request $request)
    {
        $password = Hash::make("1234");
        $user = new User([


            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
            'password' => $password,

        ]);
        $user->save();
    }
    public function editUser($id, Request $request)
    {
        $user = User::find($id);
        $user->update($request->all());

        return response()->json('User updated!');
    }

    public  function destroy(User  $id)
    {
        $id->delete();
        return response()->json('user deleted');
    }
}
