<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Db;
use App\Models\User;

class Listar extends Component
{

    public function render()
    {
        return view('livewire.listar');
    }
}
