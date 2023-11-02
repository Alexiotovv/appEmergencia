@extends('bases.base')

@section('extra_css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
crossorigin=""/>

<link href="../../../assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

{{-- <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
      cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
    //   encrypted: true
    });

    var channel = pusher.subscribe('appemergencia');
    channel.bind('Datosentiemporeal', function(data) {
        //   console.log(data);
        document.getElementById('evento-recibido').innerHTML = data;
        console.log("recibió un evento");
        alert(JSON.stringify(data));   
    });
  </script> --}}




@endsection

@section('content')
    <h5>Mapa de Incidencias</h5>
    <span class="badge bg-danger" id="bgActivos">Activos:{{$activos}}</span>
    <span class="badge bg-warning" id="bgEnrescate">En rescate:{{$enrescate}}</span>
    <span class="badge bg-secondary" id="bgCerrado">Cerrado:{{$cerrados}}</span>    
    
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
                                    <th>status</th>
                                    <th>fecha</th>
                                    <th>hora</th>
                                    <th>tipo</th>
                                    <th>atendipor</th>
                                    <th>latitud,longitud</th>
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
    
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
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
            var greyIcon = L.icon({
            iconUrl: '../assets/images/icons/marker-icon-grey.png',
            iconSize: [25, 40],
            iconAnchor: [22, 94],
            popupAnchor: [-3, -76],
            // shadowUrl: '../assets/images/icons/marker-icon-red.png',
            shadowSize: [68, 60],
            shadowAnchor: [22, 94]
            });

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('34638103ef36ee67471e', {
                cluster: 'mt1'
            });

            var channel = pusher.subscribe('appemergencia');
            channel.bind('my-event', function(data) {
            //   alert(JSON.stringify(data));
                pone_marcador()
                cargar_listarsos()
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
                                badge='<span class="badge bg-secondary" id=' +element.id+2+ '>Estado: Cerrado</span>' + '<br>';
                                colorIcon=greyIcon;
                            }

                            if (element.status==0) {
                                botonstatus='<button class="btn btn-primary btn-sm btnEnviarRescate" id="'+ element.id + '")">Enviar rescate</button>';
                            }else if (element.status==1){
                                botonstatus='<button class="btn btn-primary btn-sm btnCerrar" id="'+ element.id + '")">Cerrar Incidencia</button>';
                            }else if (element.status==2){
                                botonstatus='<button class="btn btn-primary btn-sm disabled")>Cerrado</button>';
                            }

                            var marker=L.marker([element.latitud, element.longitud], {icon: colorIcon}).addTo(map);
                            marker.bindPopup(
                                '<p>N°: '+ element.id +'</p>'+
                                '<p>Coordenadas: '+element.latitud+' , ' + element.longitud +'</p>'+
                                'Celular: '+ element.celular + '<br>'+
                                'Agente:'+ element.atendidopor + '<br>'+
                                'Fecha: '+ element.fecha +'<br>'+
                                'Hora: '+ element.hora +'</span>'+ '<br>'+
                                badge + '<br>' +
                                botonstatus
                            ).openPopup();
                        });
                    }
                });
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
                        $("#bgActivos").text("Activos: "+response.activos)
                        $("#bgEnrescate").text("Rescate: "+response.rescate)
                        $("#bgCerrado").text("Cerrado: "+response.cerrado)
                        cargar_listarsos();
                        }
                    });
                pone_marcador()
            })
        
        
            $(document).on("click",".btnCerrar",function (e) { 
            e.preventDefault();
            id = this.id;
            status='2';
            $.ajax({
                type: "GET",
                url: "/sos/update/"+id+"/"+status,
                dataType: "json",
                success: function (response) {
                    $("#"+ id+1).text("Estado: Cerrado");
                    $("#"+ id+1).removeClass('bg-warning');
                    $("#"+ id+1).addClass('bg-secondary');
                    $("#bgActivos").text("Activos: "+response.activos)
                    $("#bgEnrescate").text("Rescate: "+response.rescate)
                    $("#bgCerrado").text("Cerrado: "+response.cerrado)
                    cargar_listarsos();
                    }
                });
                pone_marcador()
            })
        
        
        }


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
                            '<td>' +badge +'</td>'+
                            '<td>' + e.fecha +'</td>'+
                            '<td>' + e.hora +'</td>'+
                            '<td>' + e.tipo +'</td>'+
                            '<td>' + e.atendidopor +'</td>'+
                            '<td>' + e.latitud +', '+ e.longitud + '</td>'+
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
    {{-- <script src="../../../assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
	<script src="../../../assets/js/table-datatable.js"></script> --}}
@endsection
