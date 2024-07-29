<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register() {

        return view("auth.register");

    }

    public function store() {

        $validated = request()->validate(
            [
                "name"=> "required|min:3|max:40",
                "email"=> "required|email|unique:users,email",
                "password"=> "required|confirmed|min:8"
            ]
            );

        $user = User::create(
            [
                "name"=> $validated["name"],
                "email"=> $validated["email"],
                "password"=> Hash::make($validated["password"]),
            ]
            );

        Mail::to($user->email)->send(new WelcomeMail($user));

        return redirect("")->with("success","Account Created Successfully");

    }

    public function login() {

        return view("auth.login");

    }

    public function authenticate() {

        $validated = request()->validate(
            [
                "email"=> "required|email",
                "password"=> "required|min:8"
            ]
            );

        if (auth()->attempt($validated)) {
            request()->session()->regenerate();

            return redirect("/")->with("success","Logged In Successfully!");
        }

        return redirect("login")->withErrors([
            'email' => "The Email That You've Entered Is Incorrect."
        ]);

    }

    public function logout() {

        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect("/")->with("success","Logged Out Successfully ");

    }

}
