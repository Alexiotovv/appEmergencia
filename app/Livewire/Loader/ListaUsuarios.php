<?php

namespace App\Livewire\Loader;

use Livewire\Component;
use Illuminate\Validation\Rule as ValidationRule;
use Livewire\WithPagination;
use App\Models\User;

class ListaUsuarios extends Component
{
    use WithPagination;

    public $statusSave = false; 
    public $sectionEditUser = false;
    public $sectionEditPass = false;
    public $sectionList = true;
    public $userData = [
        'id' => '',
        'name' => '',
        'email' => '',
        'password' => '',
        'tipo' => '',
        'status' => ''
    ] ;
    public $userNameFind;
    public $message = '';

    public function rules()
    {
        return [
            'userData.email' => ['required', 'email', ValidationRule::unique('users', 'email')->ignore($this->userData['id'])],
            'userData.name' => 'required|string|max:100',
            'userData.tipo' => 'required|in:admin,public',
            'userData.status' => 'required|boolean',
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
    }

    public function sectionEditUserById($idUsuario)
    {
        $this->sectionList = false;
        $this->sectionEditPass = false;
        $this->sectionEditUser = true;
    
        $usuario = User::find($idUsuario);
    
        if ($usuario) {
            $this->userData = [
                'id' => $usuario->id,
                'name' => $usuario->name,
                'email' => $usuario->email,
                'password' => $usuario->password, 
                'tipo' => $usuario->tipo,
                'status' => $usuario->status
            ];
        } else {
            $this->userData = [
                'id' => '',
                'name' => '',
                'password' => '',
                'tipo' => '',
                'status' => ''
            ];
        }
    }

    public function updateDataByUser()
    {
        $this->validate();  
        User::updateUser(
            $this->userData['id'],
            $this->userData['name'],
            $this->userData['email'],
            $this->userData['tipo'],
            $this->userData['status']
        );
        $this->statusSave = true;
    }

    public function render()
    {
        $listUsers = User::where('name', 'like', '%' . $this->userNameFind . '%')
                         ->paginate(20);

        return view('livewire.loader.lista-usuarios', ['listUsers' => $listUsers]);
    }
}