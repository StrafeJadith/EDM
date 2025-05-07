


const formularios_ajax = document.querySelectorAll(".FormularioAjax");

formularios_ajax.forEach(formularios => {

    
    formularios.addEventListener("submit",function(e){
        e.preventDefault();

        Swal.fire({
            title: 'Estas seguro?',
            text: "Quieres realizar la accion solicitada",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, realizar.',
            cancelButtonText: 'No, cancelar.'
            }).then((result) => {
                if (result.isConfirmed) {
                    

                    let data = new FormData(this);

                    let method = this.getAttribute("method");
                    let action = this.getAttribute("action");

                    let encabezados = new Headers();

                    let config={
                        method: method,
                        headers: encabezados,
                        mode: 'cors',
                        cache: 'no-cache',
                        body: data
                    };

                    fetch(action,config)
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {

                        if (respuesta.error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: respuesta.error
                            });
                            $('#usuario_nombre').val(''); // Limpia los campos en caso de error (ajusta los IDs)
                            $('#otroInput').val('');  // Limpia otros campos (ajusta los IDs)
                            // ... limpia otros campos ...
                        } else {
                            // Asigna los valores del JSON a los inputs por sus IDs
                            document.getElementById('Nombre_US').value = respuesta.usuario.Nombre_US;
                            document.getElementById('Correo_US').value = respuesta.usuario.Correo_US;
                            document.getElementById('Telefono_US').value = respuesta.usuario.Telefono_US;
                            document.getElementById('Direccion_US').value = respuesta.usuario.Direccion_US;
                            document.getElementById('Valor_Total').value = respuesta.credito.Valor_Total;
                            document.getElementById('Valor_CR').value = respuesta.credito.Valor_CR;
                            document.getElementById('MontoSuma').value = respuesta.abono.MontoSuma;
                            // ... asigna los demás campos usando sus IDs y las claves del JSON ...
                        }

                        return alertas_ajax(respuesta);
                    });
                }
        });

    });
});




function alertas_ajax(alerta){

    if(alerta.tipo=="simple"){

        Swal.fire({
            icon: alerta.icono,
            title: alerta.titulo,
            text: alerta.texto,
            confirmButtonText: 'Aceptar'
        });
        
    }else if(alerta.tipo=="recargar"){

        Swal.fire({
            icon: alerta.icono,
            title: alerta.titulo,
            text: alerta.texto,
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if(result.isConfirmed){
                location.reload();
            }
        });

    }else if(alerta.tipo=="limpiar"){

        Swal.fire({
            icon: alerta.icono,
            title: alerta.titulo,
            text: alerta.texto,
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if(result.isConfirmed){
                document.querySelector(".FormularioAjax").reset();
            }
        });

    }else if(alerta.tipo=="redireccionar"){

        window.location.href=alerta.url;
    }
}


/*Boton cerrar sesion */

let botonSalir = document.getElementById("botonExit");

botonSalir.addEventListener("click", function(e){

    e.preventDefault();

    Swal.fire({
        title: '¿Quieres cerrar la sesion?',
        text: "La sesion actual se cerrara y saldras del sistema",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, salir.',
        cancelButtonText: 'No, cancelar.'
        }).then((result) => {
            if (result.isConfirmed) {

                let url = this.getAttribute("href");
                window.location.href=url;
            }
    });


});
