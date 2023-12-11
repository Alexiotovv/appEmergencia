<?php

namespace App\Livewire\Loader;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class ListaUsuarios extends Component
{
    use WithPagination;

    public $statusSave = false; 
    public $sectionEdit = false;
    public $sectionList = true;
    public $userNameFind;

    // Método para manejar la búsqueda
    public function buscarPorNombre()
    {
        $this->resetPage(); 
    }

    public function render()
    {
        $listUsers = User::where('name', 'like', '%' . $this->userNameFind . '%')
                         ->paginate(20);

        return view('livewire.loader.lista-usuarios', ['listUsers' => $listUsers]);
    }
}