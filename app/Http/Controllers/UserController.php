<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class UserController extends Controller
{

    public function create()
    {
        return view('users.register');
    }
    public function login()
    {
        return view('users.login');
    }
    public function store(Request $request)
    {

        $formdata = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
        ]);
        // hash the password
        $formdata['password'] = bcrypt($formdata['password']);

        $user = User::create($formdata);
        auth()->login($user);

        return redirect('/')->with('message', 'Account crated successfully!');
    }
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'user logged out successfully');
    }
    public function authenticate(Request $request)
    {
        $formdata = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);
        if (auth()->attempt($formdata)) {
            $request->session()->regenerate();
            return redirect('/')->with('message', 'you are now logged in');
        }
        return back()->withErrors(['email' => 'Invalid credential'])->onlyInput();
    }
}
