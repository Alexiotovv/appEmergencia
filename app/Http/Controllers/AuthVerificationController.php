<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Verified;

class AuthVerificationController extends Controller
{
    public function verify(Request $request, $id, $token)
    {
        $user = User::find($id);

        if ($user->hasVerifiedEmail()) {
            // return redirect('/home');
            return view('verifyEmail',['verified'=> 'tu correo ya fue verificado']);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
            return view('verifyEmail',['verified'=> 'Gracias por verificar tu correo electrónico']);
        }
        // return redirect('/home');
    }

}
