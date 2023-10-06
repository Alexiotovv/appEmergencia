<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\sos;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    function register(Request $request){
        // $validateData=$request->validate([
        //     'name'=>'required|string|max:255',
        //     'email'=>'required|string|email|max:255|unique:users',
        //     'password'=>'required|string|max:255'
        // ]);
        // $user=User::create([
        //     'name'=>$validateData['name'],
        //     'email'=>$validateData['email'],
        //     'password'=>$validateData['password']
        // ]);

        $user=new User();
        $user->name=request('name');
        $user->email=request('email');
        $user->password=request('password');
        $user->tipo='public';
        $user->celular=request('celular');
        $user->dni=request('dni');
        $user->save();

        $token=$user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'acces_token'=>$token,
            'token_type'=>'Bearer'
        ]);
    }


    function login(Request $request){
        
        $credentials = $request->only('email','password');
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid login details'
            ],401);
        }

        $user = User::where('email',$request['email'])->firstOrFail();
        $token=$user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token'=> $token,
            'token_type'=>'Bearer'
        ]);
    }

    function infouser(Request $request) {
        return $request->user();
    }

    function create_sos(){
        $obj= new sos();
        $obj->iduser=auth()->user()->id;
        $obj->latitud=request('latitud');
        $obj->longitud=request('longitud');#
        // $obj->celular=request('celular');#
        $obj->tipo=request('tipo');
        $obj->fecha=request('fecha');
        $obj->hora=request('hora');
        //status se guarda por defecto 0 y 
        //atendido por vacío hasta que un poli envie el rescate
        $obj->save();
        $data =['msje'=>'sos_enviado'];
        
        return response()->json($data);
    }


}
