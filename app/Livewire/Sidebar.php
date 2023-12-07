<?php

namespace App\Livewire;

use Livewire\Component;

class Sidebar extends Component
{
    public function loadPage($pageName)
    {
        $this->emit('loadPage', $pageName);
    }

    public function render()
    {
        return view('livewire.sidebar');
    }
}
