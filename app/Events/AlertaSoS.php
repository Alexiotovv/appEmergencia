<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AlertaSoS implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $idUser;
    public $latitud;
    public $longitud;
    public $tipo;
    public $fecha;
    public $hora;

    /**
     * Create a new event instance.
     */
    public function __construct($idUser, $latitud, $longitud, $tipo, $fecha, $hora)
    {
        $this->idUser = $idUser;
        $this->latitud = $latitud;
        $this->longitud = $longitud;
        $this->tipo = $tipo;
        $this->fecha= $fecha;
        $this->hora  = $hora;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return ['appemergencia'];
    }
  
    public function broadcastAs()
    {
        return 'my-appemergencia';
    }
}
