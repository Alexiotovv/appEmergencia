<?php

namespace App\Livewire\Loader;

use Livewire\Attributes\Layout;
use Livewire\Component;

class SibeBarLoader extends Component
{
    public $pageCurrent;
    public $pageNames = [
        'dashboard' => 'Dashboard',
        'lista-usuarios' => 'Lista de usuarios',
        'registrar-usuarios' => 'Registrar usuarios',
        'alertas-sos' => 'SOS'
    ];
    public $pageTitle;
    
    public function mount($page = 'dashboard') 
    {
        $this->pageCurrent = $page;
        $this->pageTitle = $this->pageNames[$page];
    }

    public function render()
    {
        return view('livewire.loader.sibe-bar-loader')
            ->layout('components.layouts.app', ['title' => $this->pageTitle]);
    }
}
