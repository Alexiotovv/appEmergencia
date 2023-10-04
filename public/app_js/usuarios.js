$("#btnGuardaContrasena").on("click",function (e) {
    e.preventDefault();
    if (($("#passwordchange").val())==($("#passwordchange2").val())) {
        var serializedData = $("#formCambiarClave").serialize();
        let ruta="/ActualizaContrasena";
        let msje="Contraseña Actualizada";
        GuardarRegistro(serializedData,ruta,msje)
        $("#ModalCambiarClave").modal('hide');
    }else{
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: "Las contraseñas no coinciden",
            showConfirmButton: false,
            timer: 1500});
    }
  });

$(document).ready(function () {
    $("#show_hide_password a").on('click', function (event) {
        event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text") {
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass("bx-hide");
            $('#show_hide_password i').removeClass("bx-show");
        } else if ($('#show_hide_password input').attr("type") == "password") {
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass("bx-hide");
            $('#show_hide_password i').addClass("bx-show");
        }
    });
  });


$(document).on("click",".btnCambiarClave",function (e) {
    e.preventDefault();
    fila = $(this).closest("tr");
    id = (fila).find('td:eq(0)').text();
    nombre = (fila).find('td:eq(2)').text();
    $("#EtiquetaCambiarClave").text('Cambiar Contraseña');
    $("#IdUsuarioClave").val(id);
    $("#NombreUsuario").val(nombre);
    
    $("#ModalCambiarClave").modal('show');
  });

$("#name").blur(function(){ 
    $name=$("#name").val();
    $.ajax({
        type: "GET",
        url: "/verificanombre/"+$name, 
        dataType: "json",
        success: function (response) {
            console.log(response['estado']);
            if (response['estado']=='Disponible') {
                $("#estadousuario").css('display','none');
            }else{
                $("#estadousuario").css('display','');
            }
        }
    });
  });
  
  $("#email").blur(function(){
    $email=$("#email").val();
    $.ajax({
        type: "GET",
        url: "/verificaemail/"+$email,
        dataType: "json",
        success: function (response) {
            if (response['estado']=='Disponible') {
                $("#estadoemail").css('display','none');
            }else{
                $("#estadoemail").css('display','');
            }
        }
    });
  });
  