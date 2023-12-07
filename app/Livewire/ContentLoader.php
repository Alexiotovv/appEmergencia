<?php

namespace App\Livewire;

use Livewire\Component;

class ContentLoader extends Component
{
    public $currentPage = 'dashboard';
    protected $listeners = ['loadPage'=> 'setPage'];

    public function setPage($pageName)
    {
        $this->currentPage = $pageName;
    }

    public function render()
    {
        return view('livewire.content-loader');
    }
}
