<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login(){
        return view('auths.login');
    }

    public function postlogin(Request $request){
        $errors = [
            'required' => ':attribute wajib diisi !',
            'email' => ':attribute harus diisi dengan minimal :min karakter !',
            'min' => ':attribute harus diisi dengan minimal :min karakter !'
        ];


        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:4'
        ], $errors);

        if(Auth::attempt($request->only('email','password'))){
            return redirect('/dashboards');
        }

        return redirect('/login')->with('error','Email atau Password salah, silahkan Login Kembali !!');
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
