<div>
    <div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-right pl-2" style="width:80%;right:0;top:0px; paddin-left:10px; {{ $display }}" id="PanelInfoSoS">
        <div class="row">
            <div class="col-md-8 ml-3 bg-warning">
                <div class="logo-text ml-3" style="color:rgb(0, 0, 0);">DETALLES DE SOS</div>
            </div>
            <div class="col-md-4 p-0 bg-warning" style="border-radius: 0% !important">
                <a  wire:click.prevent="close" class="btn btn-dark w-100">Cerrar</a>
            </div>
            <div class="col-md-12">
                <iframe width="100%" height="290" 
                    src="https://www.openstreetmap.org/export/embed.html?bbox={{ $longitud-0.002 }}%2C{{ $latitud-0.002 }}%2C{{ $longitud+0.002 }}%2C{{ $latitud+0.002 }}&amp;layer=mapnik&amp;marker={{ $latitud }}%2C{{ $longitud }}" 
                    style="border: 1px solid black"></iframe>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Datos de Usuario</h5>
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Tipo de Ayuda</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Hora</th>
                                    <th scope="col">Direccion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">{{$name}}</th>
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
        </div>
    </div>    
</div>