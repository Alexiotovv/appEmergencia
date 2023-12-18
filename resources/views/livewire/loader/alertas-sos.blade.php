<div>
    @livewire('alertas.panel-view')
    <div class="col">
        <h6 class="mb-0 text-uppercase">PANEL  SOS</h6>
        <hr>
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-primary" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#alertas-sos" role="tab" aria-selected="true">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class="bx bxs-user-pin font-18 me-1"></i>
                                </div>
                                <div class="tab-title">ALERTAS SOS</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#mensajes-sos" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class="bx bxs-home font-18 me-1"></i>
                                </div>
                                <div class="tab-title">MENSAJES SOS</div>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="tab-content py-3">
                    <div class="tab-pane fade active show" id="alertas-sos" role="tabpanel">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Tipo de Ayuda</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Hora</th>
                                    <th scope="col">Atender</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listSoS as $index => $row)
                                <tr wire:key="{{ $index }}">
                                    <th scope="row">{{ $row['id'] }}</th>
                                    <td>{{ $row['name'] }}</td>
                                    <td>{{ $row['tipo'] }}</td>
                                    <td>{{ $row['fecha'] }}</td>
                                    <td>{{ $row['hora'] }}</td>
                                    <td>
                                        <a href="#" wire:click.prevent="$dispatch('viewSpecificSoS',  {id : {{$row['id'] }}, rowId: {{ $index}}  })" class="btn btn-warning btn-sm">Atender</a>
                                    </td>
                                </tr>
                            @endforeach
                            
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="mensajes-sos" role="tabpanel">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Atender</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>

    Pusher.logToConsole = true;
  
    var pusher = new Pusher('6ef44c0b74ed815ca7ba', {
      cluster: 'us2'
    });
  
    var channel = pusher.subscribe('appemergencia');
    channel.bind('my-appemergencia', function(data) { 
        Livewire.dispatch('listenNewSos', { dataEvent: data })
    });
  
  </script>
  
@endpush


