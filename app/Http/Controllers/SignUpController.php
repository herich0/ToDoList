<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        User::create($validated);

        return redirect()->route('login');
    }
}