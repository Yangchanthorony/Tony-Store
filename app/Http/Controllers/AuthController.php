<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(){
        return view('auth.register');
    }

    public function registerPost(Request $request){
       $user = new User();
       
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->date_of_birth = $request->date_of_birth;
        $user->profile_image = $request->file('profile_image')->store('profile_images', 'public');
        $user->save();
        return back()->with('success', 'Register created successfully');
    }
    
    public function login(){
        return view('auth.login');
    }

    public function loginPost(Request $request){
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($credentials)) {
            return redirect('/home')->with('success', 'login successfully');     
        }
        return back()->with('error', 'Email or password is incorrect');

    }

    public function logout(){
        Auth::logout();
        return redirect('/login')->with('success', 'Logout successfully');
    }
    public function profile()
{
    $user = Auth::user(); // currently authenticated user
    return view('auth.profile', compact('user'));
}

}
