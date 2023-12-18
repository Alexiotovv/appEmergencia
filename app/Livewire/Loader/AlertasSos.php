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
        'name' => "", 
        'latitud' => "",
        'longitud' => "",
        'tipo' => "",
        'fecha' => "",
        'hora' => "",
    ];

    public function mount()
    {
        $this->listSoS =  sos::listActiveSos();
        $this->listSoS = array_map(function ($item) {
            return json_decode(json_encode($item), true);
        }, $this->listSoS);
    }

    #[On('listenNewSos')] 
    public function listenNewSos($dataEvent)
    {
        $id = $dataEvent['id'];
        $name = $dataEvent['name'];
        $latitud = $dataEvent['latitud'];
        $longitud = $dataEvent['longitud'];
        $tipo = $dataEvent['tipo'];
        $fecha = $dataEvent['fecha'];
        $hora = $dataEvent['hora'];
    
        $newSosList = [
          'id' => $id,
          'name' => $name,
          'latitud' => $latitud,
          'longitud' => $longitud,
          'tipo' => $tipo,
          'fecha' => $fecha,
          'hora' => $hora,
        ];
      
        $this->listSoS[] = $newSosList;
    }

  

    public function render()
    {        

        return view('livewire.loader.alertas-sos', [$this->listSoS]);
    }
}
