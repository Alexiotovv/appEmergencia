<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Actualiza los datos de un usuario en especifico 
     * @param  $idusuario, $name, $email, $tipo, $status
     * @return void
     */

    public static function updateUser( $idusuario, $name, $email, $tipo, $status, $pass = null)
    {
        $usuario = User::findOrFail($idusuario);
        $usuario->name = $name;
        $usuario->email = $email;
        $usuario->tipo = $tipo;
        $usuario->status = $status;
        if($pass){
            $usuario->password = Hash::make($pass);
        }
        $usuario->save();
    }

    /**
     * Actualiza la contraseña de un usuario.
     *
     * @param int $idUsuario
     * @param string $nuevaContrasena
     * @return void
     */
    public function actualizarContrasena($idUsuario, $nuevaContrasena)
    {
        $usuario = $this->findOrFail($idUsuario);
        $usuario->password = Hash::make($nuevaContrasena);
        $usuario->save();
    }

    /**
     * Verifica si un nombre de usuario está disponible.
     *
     * @param string $name
     * @return bool
     */
    public function esNombreDisponible($name)
    {
        return $this->where('name', $name)->count() === 0;
    }

    /**
     * Verifica si un correo electrónico está disponible.
     *
     * @param string $email
     * @return bool
     */
    public function esEmailDisponible($email)
    {
        return $this->where('email', $email)->count() === 0;
    }

    public static function updatePass ($id, $pass): void 
    {   
        DB::table('users')
            ->where('id', '=' , $id)
            ->update(['password' => $pass]);
        return;
    }

    public static function saveUser ($name, $email, $tipo, $status, $password)
    {
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'tipo' => $tipo,
            'status' => $status,
            'password' => bcrypt($password),
        ]);
    
        return $user;
    }

    public static function isUserSosRedundancy($id, $fecha, $hora)
    {
        
    }

}
