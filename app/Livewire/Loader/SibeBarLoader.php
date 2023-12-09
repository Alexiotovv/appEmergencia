<?php

namespace App\Livewire\Loader;

use Livewire\Attributes\Layout;
use Livewire\Component;

class SibeBarLoader extends Component
{
    public $pageCurrent;
    public $pageName;
    
    public function mount($page = 'dashboard') 
    {
        $this->pageCurrent = $page;
        $this->pageName = $page;
    }

    public function render()
    {
        return view('livewire.loader.sibe-bar-loader')
            ->layout('components.layouts.app', ['title' => $this->pageName]);
    }
}
