<div>
    <div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-right pl-2" style="width:80%;right:0;top:0px; paddin-left:10px; {{ $display }}" id="PanelInfoSoS">
        <div class="row">
            <div class="col-md-12 p-0 bg-warning col-md-offset-1" style="border-radius: 0% !important">
                <a  wire:click.prevent="close" class="w3-bar-item w3-button w3-hide-large card-title float-right" style="font-weight: 12"> <i class="lni lni-close"></i> Cerrar</a>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Datos de Usuario</h5>
                            <div>
                                <a href="#" wire:click.prevent="" class="btn btn-secondary mr-1">Enviar Ayuda</a>
                                <a href="#" wire:click.prevent="" class="btn btn-danger">Cerrar Incidencia</a>
                            </div>
                        </div>
                        <hr>
                        <table class="table mb-0 border">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Celular</th>
                                    <th scope="col">Tipo de Ayuda</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Hora</th>
                                    <th scope="col">Direccion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">{{$name}}</th>
                                    <td>{{ $celular}}</td>
                                    <td>{{ $tipo }}</td>
                                    <td>{{ $fecha }}</td>
                                    <td>{{ $hora }}</td>
                                    <td>{{ $display_name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <iframe width="100%" height="290" 
                    src="https://www.openstreetmap.org/export/embed.html?bbox={{ $longitud-0.002 }}%2C{{ $latitud-0.002 }}%2C{{ $longitud+0.002 }}%2C{{ $latitud+0.002 }}&amp;layer=mapnik&amp;marker={{ $latitud }}%2C{{ $longitud }}" 
                    style="border: 1px solid black"></iframe>
            </div>
        </div>
    </div>    
</div>