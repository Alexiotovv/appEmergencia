<?php

namespace App\Livewire\Loader;

use Livewire\Component;
use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;
use App\Models\User;


class ListaUsuarios extends Component
{
    use WithPagination;

    public $statusSave = false; 
    public $sectionEditUser = false;
    public $sectionEditPass = false;
    public $sectionList = true;

    public $idUser;
    public $name; 
    public $email;
    public $tipo;
    public $status;

    public $userNameFind;
    public $password;
    public $newPassword;
    public $message = '';

    public function rules()
    {
        return [
            'email' => ['required', 'email', ValidationRule::unique('users', 'email')->ignore($this->idUser)],
            'name' => 'required|string|max:100',
            'tipo' => 'required|in:admin,public',
            'status' => 'required|boolean',
        ];
    }

    public function setSaveStatus($status)
    {
        $this->statusSave = $status;
    }

    public function buscarPorNombre()
    {
        $this->resetPage(); 
    }

    public function backList()
    {
        $this->sectionList = true;
        $this->sectionEditPass = false;
        $this->sectionEditUser = false;
        $this->resetProperties();
    }

    public function sectionEditUserById($idUsuario)
    {

        $usuario = User::find($idUsuario);
    
        if (!$usuario) {
            return  $this->dispatch('NotFindUser');;
        }
        $this->sectionList = false;
        $this->sectionEditPass = false;
        $this->sectionEditUser = true;
    
        $this->idUser = $usuario->id;
        $this->name = $usuario->name;
        $this->email = $usuario->email;
        $this->tipo = $usuario->tipo;
        $this->status = $usuario->status;
    }

    public function sectionEditPassUserById($idUsuario)
    {
        $usuario = User::find($idUsuario);

        if (!$usuario) {
            return  $this->dispatch('NotFindUser');;
        }

        $this->idUser = $usuario->id;
        $this->name = $usuario->name;

        $this->sectionList = false;
        $this->sectionEditPass = true;
        $this->sectionEditUser = false;
    }

    public function updatePassByUser()
    {  
        try {
            $validator = Validator::make([
                'password' => $this->password,
                'newPassword' => $this->newPassword,
            ], [
                'password' => [
                    'required',
                    'min:8', // Incrementado a 8 caracteres
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*]).*$/', // Agregado de caracteres especiales
                ],
                'newPassword' => [
                    'required',
                    'min:8',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*]).*$/',
                    'same:password', 
                ],
            ], [
                'password.regex' => 'La contraseña debe contener letras, números, caracteres especiales y mayúsculas.',
                'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
                'password.required' => 'Ingrese una contraseña.',
                'newPassword.different' => 'La nueva contraseña debe ser diferente a la actual.',
                'newPassword.regex' => 'La contraseña debe contener letras, números, caracteres especiales mayúsculas.',
                'newPassword.min' => 'La contraseña debe tener al menos 8 caracteres.',
                'newPassword.required' => 'La nueva contraseña es obligatoria.',
                'newPassword.same' => 'Las contraseñas no coinciden'
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();

                foreach ($errors->all() as $message) {
                    throw new \Exception($message);
                }
            }

            User::updatePass($this->idUser, $this->newPassword);
            $this->statusSave = true;
        } catch(\Exception $e){
            $this->dispatch('ValidationError', error: $e->getMessage());
        }
    
    }

    public function updateDataByUser()
    {
        $this->validate();  
        User::updateUser(
            $this->idUser,
            $this->name,
            $this->email,
            $this->tipo,
            $this->status
        );
        $this->statusSave = true;
    }

    private function resetProperties():void 
    {
        $this->idUser = null;
        $this->name =  null;
        $this->email  = null; 
        $this->tipo   = null; 
        $this->status = null; 
        $this->password  = null;
        $this->newPassword = null;
    }

    public function render()
    {
        $listUsers = User::where('name', 'like', '%' . $this->userNameFind . '%')
                         ->paginate(20);

        return view('livewire.loader.lista-usuarios', ['listUsers' => $listUsers]);
    }
}