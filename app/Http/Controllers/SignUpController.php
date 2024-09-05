<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SignUpController extends Controller
{
    public function signup(Request $request){
        $validated = $request->validate([
            'name' => ['required', 'max:45'],
            'email' => ['required', 'max:50'],
            'cpf' => ['required', 'regex:([0-9]{3}\.?[0-9]{3}\.?[0-9]{3}\-?[0-9]{2})'],
            'birthDate' => ['required','date'],
            'password' => ['required']
        ]);
        $user = User::create([
            'name'=>$validated['name'],
            'email'=>$validated['email'],
            'cpf'=>$validated['cpf'],
            'birth date'=>$validated['birthDate'],
            'password'=>$validated['password'],
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }
}