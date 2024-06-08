<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;


class AuthController extends Controller
{
    public function login(){
        if(Auth::check()){
            return Redirect('/home'); 
        }else{
            return view('login');
        }
    }
    public function showRegisterForm(){
            return view('register'); 
    }
    public function register(Request $request){
        if($request->password_confirmasi == $request->password){     
            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
            return Redirect('/'); 
        }else{
            return Redirect('/register')->with('error', 'Password dan Confirmasi tidak sama.'); 
        }
    }

    public function Ceklogin(Request $request){
        if(!Auth::attempt(['email' => $request->email,
        'password' => $request->password])){
           return Redirect('/');
        }else{
           return Redirect('/home');
        }
    }
    public function logout(){
        Auth::logout();
        return Redirect('/');
    }
    public function ubahpassword(Request $request){
        if (!Hash::check($request->password_lama, Auth::user()->password)) {
            return back()->withErrors(['password_lama' => 'Password lama tidak sesuai']);
        }

        $user = Auth::user();
        $user->password = Hash::make($request->password_baru);
        $user->save();
    
        return back()->with('success', 'Password berhasil diubah');
    
    }

}
