<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

    public function register(Request $request) {
        $userData = $request->validate([
            'name' => ['required', 'min:3', 'max:80', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8']
        ]);

        $userData['password'] = bcrypt($userData['password']);
        $user = User::create($userData);
        auth::login($user);
        return redirect('/');
    }

    public function login(Request $request) {
        $loginData = $request->validate([
            'loginEmail' => ['required'],
            'loginPassword' => ['required']
        ]);

        if (auth::attempt(['email' => $loginData['loginEmail'], 'password' => $loginData['loginPassword']])) {
            $request->session()->regenerate();
        } else {
            return back()->withErrors([
                'loginError' => 'The provided credentials do not match our records.',
            ]);

        }

        return redirect('/');

    }

    public function logout() {
        auth::logout();
        return redirect('/');
    }

}
