<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email','password');
        $status = DB::table('users')
                    ->where('users.status','=',1)
                    ->where('users.email','=',request('email'))
                    ->latest()->first();

        if($status && Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/admin/home');
        }
        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

    public function index(Request $request)
    {
        return view('bases.base');
    }
}
