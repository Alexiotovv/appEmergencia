<?php

namespace App\Livewire\Loader;
use Livewire\WithPagination;

use Livewire\Component;
use App\Models\User;

class ListaUsuarios extends Component
{
    use WithPagination;

    public $statusSave = false; 
    public $sectionEdit = false;
    public $users;
    public $userNameFind;
    protected $listUsers; // Cambiar a propiedad protegida

    public function mount(User $users)
    {
        $this->users = $users;
        
    }

    public function buscarPorNombre()
    {
        $this->listUsers = $this->users->buscarPorNombre($this->userNameFind)->paginate(20);
    }

    public function render()
    {   
        $listUsers = $this->users->buscarPorNombre('')->paginate(20);
        return view('livewire.loader.lista-usuarios', compact('listUsers')); 
    }
}
