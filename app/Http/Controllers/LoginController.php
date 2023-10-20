<?php

namespace App\Http\Controllers;

use App\Models\login;
use App\Models\User;
use App\Models\sos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email','password');
        $status=DB::table('users')
        // ->select('users.status')
        ->where('users.status','=',1)
        ->where('users.email','=',request('email'))
        ->latest()->first();

        if ($status) {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('home');
            }
            return redirect('/login');
        }else{
            return redirect('/login');
        }
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
        $years = DB::table('sos')
        ->select(DB::raw('DISTINCT YEAR(fecha) as year'))
        ->orderby('year')
        ->get();
        $total_users=User::count();
        $activos_users=User::where('status',1)->count();
        $total_sos=Sos::count();
        return view('plantillas.home',['years'=>$years, 'total_users'=>$total_users, 'activos_users'=>$activos_users,'total_sos'=>$total_sos]);

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.
     */
    public function show(login $login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(login $login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, login $login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(login $login)
    {
        //
    }
}
