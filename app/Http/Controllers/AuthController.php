<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return inertia('Authentication/SigninView');
    }
    public function login(LoginFormRequest $request){
        if(auth()->attempt($request->validated())) {

            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email'=>"Пользователь не найден, либо данные введены неверно"
        ])->onlyInput('email');
    }

    public function logout(){

        auth()->logout();

        \request()->session()->invalidate();

        \request()->session()->regenerateToken();

        return redirect()->route('home');
    }
}
