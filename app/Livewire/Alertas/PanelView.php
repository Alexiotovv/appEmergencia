<?php

namespace App\Livewire\Alertas;

use Livewire\Component;
use Livewire\Attributes\On; 
use App\Models\sos;
use App\Http\Controllers\GeoCoding;

class PanelView extends Component
{
    public $name ="";
    public $apellidos ="";
    public $celular ="";
    public $id ="";
    public $tipo ="";
    public $fecha ="";
    public $hora =""; 
    public $latitud =1;
    public $longitud =1;
    public $address ="";
    public $display_name ="";


    public $display = '';

    #[On('viewSpecificSoS')]  
    public function viewSpecificSoS($id)
    {   
        $geocoding = new GeoCoding();

        $sos = sos::findSoS($id);
        $this->name = $sos->name ;
        $this->celular=$sos->celular;
        $this->id=$sos->id;
        $this->tipo=$sos->tipo;
        $this->fecha=$sos->fecha;
        $this->hora=$sos->hora; 
        $this->latitud=$sos->latitud;
        $this->longitud=$sos->longitud;
        $this->address = $geocoding->getAddress($this->latitud, $this->longitud);
        $this->display_name = $this->address['display_name'];
        $this->display = "display:block !important";
    }

    public function close()
    {   
        $this->name =  "";
        $this->celular= "";
        $this->id= "";
        $this->tipo= "";
        $this->fecha= "";
        $this->hora= ""; 
        $this->latitud= 1;
        $this->longitud= 1;
        $this->display = "";
    }

    public function render()
    {
        return view('livewire.alertas.panel-view');
    }
}
