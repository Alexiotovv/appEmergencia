function GuardarRegistroDevolucion(ds,ru,mje,frm){
  
    Swal.fire({
        title: 'Estás seguro?', text: "Por favor confirma para poder guardar!",
        showCancelButton: true, confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33', confirmButtonText: 'Sí, Guardar!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            type: "POST",
            url: ru,
            data: ds,
            dataType: "json",
            beforeSend: function () { 
                // $("#spinner_guardar").prop('hidden',false)
            },
            success: function (response) {
                Swal.fire(
                    {
                    position: 'top-end',
                    icon: 'success',
                    title: mje,
                    showConfirmButton: false,
                    timer: 1500}
                    )

                BuscarSalidasComprobantes()
                
                // $("#spinner_guardar").prop('hidden',true)
                // LimpiarForm()
                $(frm).modal('hide');
            },
            error: function(response) {
                Swal.fire('OPS!', 'Hubo un error!', 'código de error' + response)
            },
            });
        }
    })
};


function MensajeError(mje) { 
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })
      
      Toast.fire({
        icon: 'error',
        title: mje
      })
 }

function GuardarRegistroRapido(ds,ru,mje) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })

      $.ajax({
        type: "POST",
        url: ru,
        data: ds,
        dataType: "json",
        success: function (response) {
            Toast.fire({ icon: 'success', title: mje, })
        },
        error: function(response) {
            Toast.fire({ icon: 'error', title: 'Hubo un Error'+response, })
        },
        
      });


}

////LA FUNCIÓN PARA GUARDAR O ACTUALIZAR REGISTRO
function GuardarRegistro(ds,ru,mje,dt){
  
    Swal.fire({
        title: 'Estás seguro?', text: "Por favor confirma para poder guardar!",
        showCancelButton: true, confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33', confirmButtonText: 'Sí, Guardar!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            type: "POST",
            url: ru,
            data: ds,
            dataType: "json",
            beforeSend: function () { 
                $("#spinner_guardar").prop('hidden',false)
            },
            success: function (response) {
                Swal.fire(
                    {
                    position: 'top-end',
                    icon: 'success',
                    title: mje,
                    showConfirmButton: false,
                    timer: 1500}
                    )
                if (dt=='') {
                    //No hace nada
                }else{
                    $(dt).DataTable().ajax.reload();
                }
                $("#spinner_guardar").prop('hidden',true)                
                LimpiarForm()
                BuscarSalidasComprobantes();//
            },
            error: function(response) {
                Swal.fire('OPS!', 'Hubo un error!', 'código de error' + response)
            },
            });
        }
    })
};

///FUNCION ELIMINAR REGISTRO
function EliminarRegistro(ru,mje,dt){
    Swal.fire({
        title: 'Estás seguro?', text: "Confirma para poder eliminar el registro!",
        icon: 'Mensaje', showCancelButton: true, confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33', confirmButtonText: 'Sí, eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                url: ru,
                dataType: "json",
                success: function (response) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: mje,
                        showConfirmButton: false,
                        timer: 1500});
                    $(dt).DataTable().ajax.reload();
                },
                error: function(response) {
                    Swal.fire('OPS!', 'Hubo un error!', 'error');
                },
            });
        }
    })

};

