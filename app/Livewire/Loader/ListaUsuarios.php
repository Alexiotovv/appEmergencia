<?php

namespace App\Livewire\Loader;

use Livewire\Component;

class ListaUsuarios extends Component
{
    public $statusSave = false; 
    
    public function render()
    {
        return view('livewire.loader.lista-usuarios');
    }
}
