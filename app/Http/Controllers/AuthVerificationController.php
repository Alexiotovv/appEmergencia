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
            return redirect('/home');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect('/home')->with('verified', true);
    }

}
