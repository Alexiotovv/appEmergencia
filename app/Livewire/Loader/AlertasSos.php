<?php

namespace App\Livewire\Loader;

use Livewire\Component;
use App\Models\sos;
use Livewire\Attributes\On; 

class AlertasSos extends Component
{
    public $idUser;
    public $longitud;
    public $latitud;

    public $listSoS = [
        'id' => "",
        'latitud' => "",
        'longitud' => "",
        'tipo' => "",
        'fecha' => "",
        'hora' => "",
    ];

    public function mount()
    {
        $this->listSoS = sos::listActiveSos();
    }

    #[On('listenNewSos')] 
    public function listenNewSos($dataEvent)
    {
        $idUser = $dataEvent['idUser'];
        $latitud = $dataEvent['latitud'];
        $longitud = $dataEvent['longitud'];
        $tipo = $dataEvent['tipo'];
        $fecha = $dataEvent['fecha'];
        $hora = $dataEvent['hora'];
    
        $newSosList = [];

        array_push($newSosList, [
          'id' => $idUser,
          'latitud' => $latitud,
          'longitud' => $longitud,
          'tipo' => $tipo,
          'fecha' => $fecha,
          'hora' => $hora,
        ]);
      
        $this->listSoS = array_merge($this->listSoS, $newSosList);
    }

  

    public function render()
    {        

        return view('livewire.loader.alertas-sos', [$this->listSoS]);
    }
}
