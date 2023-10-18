
/* V A R I A B L E S   G L O B A L E S */
var ServicioLogin = 'http://localhost/vacaciones/general/BaseDatos/validacion_login.php';

$(document).ready(function () {
    
    inicializar();    

})

function inicializar(){
    $('#boton_ingreso').click(function(){
        
        var usuario=$('#usuario').val();
        var clave=$('#clave').val();

        validar_usuario(usuario,clave);
    })

    $('#boton_volver').click(function(){
        
        window.location="index.php";
    })
    
}

//Valida los datos del usuario
function validar_usuario(usuario, clave)
{

    var parametros = "usuario=" + usuario + "&clave=" + clave;
    
    $.ajax({
        url: ServicioLogin,
        type: 'GET',
        data: parametros
     }).done(function (data) {

        // Verifica si la llamada fue exitosa
        if (data.length > 0) {

            
            if (data[0].id > 0 ) {

                // Guarda las variables de sesion para poder usarlas en todas
                // las paginas
                localStorage['usuario_id'] = data[0].id;
                localStorage['usuario_nombre'] = data[0].nombre;
                localStorage['usuario_fecha_registro'] = data[0].fecha_registro;
                localStorage['usuario_persona_id'] = data[0].persona_id;
                localStorage['usuario_habilitado'] = data[0].habilitado;
                localStorage['usuario_es_admin'] = data[0].es_admin;
            
                
                if(data[0].es_admin == '1') {  
                    window.location = "empleador.php";                    
                }else{
                    window.location = "principal.php";
                }
                    
                

            } else {
                //usuario no es valido
                //window.location = "error.php?mje=Usuario no valido";
                $('#mensaje').text('Usuario no registrado');
            }
           

        }
        else {
           $('#mensaje').text('Usuario no registrado');
        }

     }).fail(
        function (error) {
        
        alert('Error en la llamada a la api...'+error);
    
     })

}

