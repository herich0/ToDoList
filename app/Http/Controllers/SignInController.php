<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    public function create(Request $request){
        if (Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password,
        ])){
            $request->session()->regenerate();

            return redirect()->rout('home');
        }
        return redirect()->route('home');
    }
}