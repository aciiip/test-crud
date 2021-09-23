<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function login ()
    {
        if (!empty(session('authenticated'))) {
            return redirect(route('home'));
        }
        return view('login.index');
    }

    public function loginAction (Request $request)
    {
        $username = 'admin@rasumi.com';
        $password = 'Rasumi@2021';

        $post = $request->all();
        if ($post['username'] === $username && $post['password'] === $password) {
            $request->session()->put('authenticated', time());
            return redirect(route('home'));
        }

        $request->session()->flash('error', 'Incorrect Username or Password');
        return redirect(route('login'));
    }

    public function logout (Request $request)
    {
        $request->session()->flush();
        return redirect(route('login'));
    }
}
