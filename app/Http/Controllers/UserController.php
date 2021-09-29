<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function login ()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('login.index');
    }

    public function loginAction (Request $request)
    {
        $post = $request->all();
        Auth::attempt([
            'email' => $post['username'],
            'password' => $post['password']
        ]);

        if (Auth::check()) {
             return redirect()->route('home');
        }
        return redirect()->route('login')->with('error', 'Incorrect Username or Password');
    }

    public function logout (Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
