<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login()
    {
        return view('auth.index');
    }
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('dashboard.index')->with('success', 'Login successfully');
        } else {
            return back()->with('error', 'Invalid credentials');
        }
    }

    public function register()
    {
        return view('auth.signup');
    }

    public function store(Request $req)
    {
        $req->validate([
            'name' => ['required', 'max:25', 'string'],
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
        ]);

        return redirect()->route('dashboard.users')->with('success', 'user registered successfully');
    }

    public function logout()
    {
        Auth::logout();
        return back()->with('success', 'logout successfully');
    }
    public function destroy(Request $req, String $id)
    {
        $authenticated = Auth::user();
        $user = User::find($id);
        if ($user->email == $authenticated->email) {
            return redirect()->route('dashboard.users')->with('error', 'you cant delete logged in user');
        } else {
            User::destroy($id);
            return redirect()->route('dashboard.users')->with('success', 'user deleted successfully');
        }
    }
}
