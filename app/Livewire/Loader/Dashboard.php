<?php

namespace App\Livewire\Loader;

use Livewire\Component;
use App\Models\Estadistica;

class Dashboard extends Component
{
    public $anoSeleccionado;
    public $datosEstadisticos;

    public function mount()
    {
        $this->anoSeleccionado = date('Y');
        $this->cargarDatosEstadisticos();
    }

    public function cargarDatosEstadisticos()
    {
        $this->datosEstadisticos = Estadistica::obtenerDatosPorAno($this->anoSeleccionado);
        $this->dispatch('datosEstadisticosActualizados', datos : $this->datosEstadisticos);
    }

    public function render()
    {
        return view('livewire.loader.dashboard', Estadistica::totales());
    }
}
