@extends('bases.base_public')

@section('extra_css')

@endsection

@section('content')
    <div class="card" >
        <div class="card-title" style="background-color: rgb(179, 25, 25);text-align:center">
            <h5 style="color: white">SOS</h5>
            <h3 style="color: white">PERU</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card" >
                        <div class="card-body" style="text-align: center">
                            <img id="police" src="../../assets/images/police.png" style="width:150px">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body" style="text-align: center">
                            <img id="ambulance" src="../../assets/images/ambulance.png" alt="" style="width:150px">
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body" style="text-align: center">
                            <img id="fireman" src="../../assets/images/fireman.png" alt="" style="width:150px">
                        </div>
                    </div>
                </div>

                <form id="frmEnviarSOS">@csrf
                    <input type="text" name="latitud" id="latitud" hidden>
                    <input type="text" name="longitud" id="longitud" hidden>
                    <input type="text" name="tipo" id="tipo">
                    <input type="text" name="fecha" id="fecha" hidden>
                    <input type="text" name="hora" id="hora" hidden>
                    <input type="text" name="celular" id="celular" value="991785556" hidden>
                </form>

            </div>
        </div>
        <div class="card-footer" style="background-color: rgb(179, 25, 25);text-align:center">
            <h3 style="color: white">TOCA 5 VECES LA IMAGEN PARA PEDIR UN SOS</h3>
        </div>
    </div>

    <div class="modal fade" id="modalBanner" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¡Tu Responsabilidad Salva Vidas! 🚨                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Utiliza esta aplicación con prudencia y solo en situaciones de emergencia genuina. El abuso de esta herramienta afecta la capacidad de respuesta de la policía y pone en riesgo a quienes realmente necesitan ayuda. Juntos, podemos hacer de nuestra comunidad un lugar más seguro. #UsaConResponsabilidad 🤝.</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Acepto la responsabilidad</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEnviado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">¡TU ALERTA FUE ENVIADA 🚨! </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"><h3>Tu SOS fue enviada, por favor espera al rescate y ponte a buen recaudo 🤝.</h3></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" style="width: 100%" data-bs-dismiss="modal">¡...ALERTA FUE ENVIADA...!</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('extra_js')
    <script>

        setInterval(muestrahora, 1000);
        function muestrahora() { 
            var hoy = new Date();
            hora = ('0' + hoy.getHours()).slice(-2) + ':' + ('0' + hoy.getMinutes()).slice(-2);
            document.getElementById("hora").value = hora;
        }
        var fecha = new Date();
        document.getElementById("fecha").value = fecha.toJSON().slice(0, 10);


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

        function posicion(geolocationPosition) {  
            let coords=geolocationPosition.coords;
            $("#latitud").val(coords.latitude);
            $("#longitud").val(coords.longitude);
        }




        num = 0;
        $("#police").on("click",function (e) { 
            e.preventDefault();
            num+=1;
            llamada_sos('policia',num);
         })
         $("#ambulance").on("click",function (e) { 
            e.preventDefault();
            num+=1;
            llamada_sos('ambulancia',num);
         })
         $("#fireman").on("click",function (e) { 
            e.preventDefault();
            num+=1;
            llamada_sos('bombero',num);
         })



         function llamada_sos(tipo,num) { 
            if (num==5){
                //guardar SOS
                $("#tipo").val(tipo);
                frm=$("#frmEnviarSOS").serialize();
                $.ajax({
                    type: "POST",
                    url: "/sos/store",
                    data: frm,
                    dataType: "json",
                    success: function (response) {
                        $("#modalEnviado").modal("show");
                    }
                });
            }else{
                if (num>=6){
                    alert("no pude enviar mas de 1 vez ");
                }

            }
          }

         function banner() { 
            $("#modalBanner").modal('show');
            }
        setTimeout(banner, 500);
    </script>
@endsection
