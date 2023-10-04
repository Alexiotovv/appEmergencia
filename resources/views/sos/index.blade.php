@extends('bases.base')

@section('extra_css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
crossorigin=""/>

<link href="../../../assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endsection

@section('content')
    <h5>Mapa de Incidencias</h5>
    <span class="badge bg-danger">Activos: <strong>{{$activos}}</strong></span>
    <span class="badge bg-warning">En rescate: <strong>{{$enrescate}}</strong></span>
    <span class="badge bg-secondary">Cerrado: <strong>{{$cerrados}}</strong></span>

    <div class="row">
        
        <div class="col-md-8"">
            <div id="map" style="height: 850px;"></div>
            <br>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="dtincidencias">
                            <thead>
                                <tr>                                
                                    <th>#</th>
                                    <th>latitud,longitud</th>
                                    <th>tipo</th>
                                    <th>status</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection
@section('extra_js')
    {{-- Mapa --}}
    <script>
    
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(posicion,error,options);

        }else{
            alert("No puedes acceder a la ubicación");
        }

        var options={
            EnableHighAccuracy:true,
            Timeout:500,
            MaximunAge:0
        }

        function error(err){
            alert(err);
        }

        mapita=false;

        function posicion(geolocationPosition) {  
            let coords=geolocationPosition.coords;
            // $("#latitud").val(coords.latitude);
            // $("#longitud").val(coords.longitude);
            // $("#latitud").prop('readonly',true);
            // $("#longitud").prop('readonly',true);

            // var container = L.DomUtil.get('map');
            // if(container != null){
            // container._leaflet_id = null;
            // }

            //esto es la ubicación del propio host
            // var marker = L.marker([coords.latitude,coords.longitude],{draggable: true,}).addTo(map);
            // marker.bindPopup("<h2>Cel. 96665965</h2>").openPopup();
            
            var map = L.map('map').setView([coords.latitude,coords.longitude], 14);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 20,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
                    
            var redIcon = L.icon({
            iconUrl: '../assets/images/icons/marker-icon-red.png',
            iconSize: [25, 40],
            iconAnchor: [22, 94],
            popupAnchor: [-3, -76],
            // shadowUrl: '../assets/images/icons/marker-icon-red.png',
            shadowSize: [68, 60],
            shadowAnchor: [22, 94]
            });
            var goldIcon = L.icon({
            iconUrl: '../assets/images/icons/marker-icon-gold.png',
            iconSize: [25, 40],
            iconAnchor: [22, 94],
            popupAnchor: [-3, -76],
            // shadowUrl: '../assets/images/icons/marker-icon-red.png',
            shadowSize: [68, 60],
            shadowAnchor: [22, 94]
            });
            var greenIcon = L.icon({
            iconUrl: '../assets/images/icons/marker-icon-green.png',
            iconSize: [25, 40],
            iconAnchor: [22, 94],
            popupAnchor: [-3, -76],
            // shadowUrl: '../assets/images/icons/marker-icon-red.png',
            shadowSize: [68, 60],
            shadowAnchor: [22, 94]
            });

            pone_marcador();

            function pone_marcador() { 
                var botonstatus='';
                $.ajax({
                    type: "GET",
                    url: "/sos/show",
                    dataType: "json",
                    success: function (response) {
                        // console.log(response);
                        response.forEach(element => {
                            
                            if (element.status==0) {
                                badge='<span class="badge bg-danger" id='+ element.id+0 +'>Estado: Activo</span>'+ '<br>';
                                colorIcon=redIcon;
                            }else if (element.status==1){
                                    badge='<span class="badge bg-warning" id='+element.id+1+ '>Estado: En rescate</span>'+ '<br>';
                                    colorIcon=goldIcon;
                            }else if (element.status==2){
                                badge='<span class="badge bg-secondary">Estado: Cerrado</span>'+element.id+2+ '<br>';
                                colorIcon=greenIcon;
                            }

                            if (element.status==0) {
                                botonstatus='<button class="btn btn-danger btn-sm btnEnviarRescate" id="'+ element.id + '")">Enviar rescate</button>';
                            }else if (element.status==1){
                                botonstatus='<button class="btn btn-warning btn-sm btnCerrar" id="'+ element.id + '")">Cerrar</button>';
                            }else if (element.status==2){
                                botonstatus='<button class="btn btn-secondary btn-sm")>Cerrado</button>';
                            }

                            var marker=L.marker([element.latitud, element.longitud], {icon: colorIcon}).addTo(map);
                            marker.bindPopup(
                                '<p>N°: '+ element.id +'</p>'+
                                '<h5>Coordenadas: '+element.latitud+' , ' + element.longitud +'</h5>'+ 
                                '<span class="badge bg-success">Celular: '+ element.celular +'</span>'+ '<br>'+ 
                                '<span class="badge bg-success">Agente: Pedro</span>'+ '<br>'+ 
                                badge + '<br>' + 
                                botonstatus
                            ).openPopup();
                        });
                    }
                });
            }

            // marker.on("drag", function () { 
            // $("#latitud").val(marker.getLatLng().lat);
            // $("#longitud").val(marker.getLatLng().lng);
            // });
        }

    
    
    
        $(document).on("click",".btnEnviarRescate",function (e) { 
        e.preventDefault();
        id = this.id;
        status='1';
        $.ajax({
            type: "GET",
            url: "/sos/update/"+id+"/"+status,
            dataType: "json",
            success: function (response) {
                $("#"+ id+0).text("Estado: En rescate");
                $("#"+ id+0).removeClass('bg-danger');
                $("#"+ id+0).addClass('bg-warning');
                iniciar_mapa();
            }
        });
     })
    </script>

    {{-- ListarSOS --}}
    <script>

        cargar_listarsos();

        function cargar_listarsos() {
            var badge='';
            $("#dtincidencias tbody").html('');
            $.ajax({
                type: "GET",
                url: "/sos/listarsos",
                dataType: "json",
                success: function (response) {
                    response.forEach(e => {
                        if (e.status==0) {
                            badge="<span class='badge bg-danger'>Activo</span>";
                        }else if (e.status==1){
                            badge="<span class='badge bg-warning'>En rescate</span>";
                        }else if (e.status==2){
                            badge="<span class='badge bg-secondary'>Cerrado</span>";
                        }
                        $("#dtincidencias tbody").append('<tr>'+
                                '<td>' + e.id +'</td>'+
                                '<td>' + e.latitud +', '+ e.longitud + '</td>'+
                                '<td>' + e.tipo +'</td>'+
                                '<td>' +badge +'</td>'+
                                // '<td>' + e.status +'</td>'+
                            '</tr>'
                        );
                    });
                }
            });    
         }
    </script>

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
    integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
    crossorigin=""></script>
    <script src="../../../assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
	<script src="../../../assets/js/table-datatable.js"></script>
@endsection
