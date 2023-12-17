<?php

namespace App\Livewire\Loader;

use Livewire\Component;
use Illuminate\Support\Facades\Validator ;
use Illuminate\Validation\Rule as ValidationRule;
use App\Models\User;

class RegistrarUsuarios extends Component
{
    public $name;
    public $email;
    public $tipo;
    public $status;
    public $password;
    public $statusSave = false;
    
    public function mount()
    {
        $this->tipo = 'admin';
        $this->status = 1;
    }
    
    public function saveNewUser()
    {
        try {
            $validator = Validator::make([
                'name' => $this->name,
                'email' => $this->email,
                'status' => $this->status,
                'tipo' => $this->tipo,
                'password' => $this->password,
            ], [
                'name' => 'required|string|max:255',
                'email' => 'required|string|unique:users,email',
                'tipo' => 'required|in:admin,public',
                'status' => 'required|boolean',
                'password' => [
                    'required',
                    'min:8',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*]).*$/',
                ],
            ], [
                'password.regex' => 'La contraseña debe contener letras, números, caracteres especiales y mayúsculas.',
                'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
                'password.required' => 'Ingrese una contraseña.',
                'password.secure' => 'La contraseña debe ser segura. Esto significa que debe tener al menos 8 caracteres, contener letras, números, caracteres especiales y mayúsculas.',
                'passwor.min' => 'La contraseña debe ser segura. Esto significa que debe tener al menos 8 caracteres, contener letras, números, caracteres especiales y mayúsculas.',
                'email.unique' => 'Este correo ya existe.'
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();

                foreach ($errors->all() as $message) {
                    throw new \Exception($message);
                }
            }
            User::saveUser($this->name, $this->email,$this->tipo, $this->status, $this->password);
            $this->statusSave = true;
        } catch(\Exception $e){
            $this->dispatch('ValidationErrorUser', error: $e->getMessage());
        }
    }
    
    public function setSaveStatus($status)
    {
        $this->statusSave = $status;
    }

    public function render()
    {
        return view('livewire.loader.registrar-usuarios');
    }
}
