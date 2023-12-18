<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\sos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Events\AlertaSoS;


class AuthController extends Controller
{   
    /** 
     * Por Implementar
     */
    // public function sendResetLinkEmail(Request $request)
    // {
    //     $this->validateEmail($request);
    //     $status = $this->broker()->sendResetLink(
    //         $request->only('email')
    //     );
    //     if ($status === Password::RESET_LINK_SENT) {
    //         return response()->json(['message' => 'Correo de restablecimiento de contraseña enviado']);
    //     }
    //     return response()->json(['error' => 'No se pudo enviar el correo de restablecimiento de contraseña']);

    // }

    public function register(Request $request) 
    {
        // Valida los datos de entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|max:255',
        ]);
    
        // Busca si ya existe un usuario con el mismo correo electrónico
        $existingUser = User::where('email', $request->input('email'))->first();
    
        if ($existingUser) {
            // El usuario ya existe, devuelve un mensaje de error
            return response()->json(['error' => 'El correo electrónico ya se encuentra registrado.'], 422);
        }
    
        // El usuario no existe, crea uno nuevo
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->tipo = 'public';
        $user->celular = $request->input('celular');
        $user->dni = $request->input('dni');
        $user->verification_token = Str::random(40); // Genera un token de verificación
        $user->save();

        // Define la variable $url
        $url = route('verification.verify', [
            'id' => $user->getKey(),
            'token' => $user->verification_token,
        ]);

        // Construye el contenido del correo
        // $emailContent = "Por favor, haga clic en el siguiente enlace para verificar su correo electrónico:\n\n$url\n\nGracias por usar nuestra aplicación.";

        // Envía el correo de verificación
        // Mail::raw($emailContent, function ($message) use ($user) {
        //     $message->to($user->email);
        //     $message->subject('Verificar Correo');
        // });

        $token = $user->createToken('auth_token')->plainTextToken;
        
        return response()->json([
            'message' => 'Usuario registrado con éxito. Se ha enviado un correo de verificación.',
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function login(Request $request)
    {
        
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

    public function infouser(Request $request) 
    {
        return $request->user();
    }

   public function create_sos()
   {    
        /**
         * Verifica que un SoS no sea guardado si el rango de horas es menos de 1 horas.
        */
        $verify = sos::isUserSosSpam(auth()->user()->id, request('fecha'), request('hora'));
        $data =['msje'=>'sos_enviado'];
        if($verify){
            return response()->json($data, 200);
        }
        /**
         * status se guarda por defecto 0 y atendido por vacío hasta que un poli envie el rescate.
        */

        $obj= new sos();
        $obj->iduser=auth()->user()->id;
        $obj->latitud=request('latitud');
        $obj->longitud=request('longitud');
        $obj->tipo=request('tipo');
        $obj->fecha=request('fecha');
        $obj->hora=request('hora');
        $obj->save();
       
        
        /**
         * Lanza un evento para los administradores.
        */
        event(new AlertaSoS(
            $obj->iduser,
            $obj->latitud,
            $obj->longitud,
            $obj->tipo,
            $obj->fecha,
            $obj->hora
        ));
        return response()->json($data, 200);
   }

}
