/* V A R I A B L E S   G L O B A L E S */
var ServicioDatosSectores = 'http://localhost/vacaciones/general/BaseDatos/cargar_sectores.php';
var ServicioDatosSolicitudes = 'http://localhost/vacaciones/general/BaseDatos/solicitudes_empleador.php';
var ServicioActualizarEstadoSolicitud = 'http://localhost/vacaciones/general/BaseDatos/actualizar_estado_solicitud.php';

let id=0;
let usuario='';
let nombre='';
let fecha_registro='';
let persona_id=0;
let habilitado=0;
let es_admin=0;
let registros = [];

$(document).ready(function () {
    
    inicializar(); 
    obtener_sectores();
    

    $('#boton_solicitar').click(function(){
        // Obtener todos los datos del formulario y enviar a grabar
        // alert("Grabar los datos");
        // Ana
        //grabar_solicitud(....);


    });
})

function inicializar(){

    // Recupera las variables de sesion para poder usarlas
    id              =localStorage['usuario_id'];
    nombre          =localStorage['usuario_nombre'];
    fecha_registro  =localStorage['usuario_fecha_registro'];
    persona_id      =localStorage['usuario_persona_id'];
    habilitado      =localStorage['usuario_habilitado'];
    es_admin        =localStorage['usuario_es_admin'];
    
    // Verifica si esta logueado o no, sino lo redirige a la pagiana de error
    // Se puede redireccionar a la pagina de ingreso "login"
    if(id===undefined){ window.location.href="iniciarSesion.html"; }
    
    $('#sectores').change(function(){
        var item=$(this);
        //alert(item.val())
        var sector_id=item.val();
        
        obtener_solicitudes_empleador(sector_id);
    })
    $('#btn_guardar').click(function(){
        
        if(registros.length>0){

            guardar(registros);
        }
    })

}

function obtener_sectores()
{
 
 
    $.ajax({
        url: ServicioDatosSectores,
        type: 'POST',
        data: ''        
     }).done(function (data) {
        
        // Verifica si la llamada fue exitosa
        if (data.length > 0) {

            var opciones='<option value="0">Seleccione un sector</option>';
            data.forEach((sector) => 
                //console.log(sector.id)
                opciones += '<option value="'+sector.id+'">'+sector.nombre+'</option>'
            );
            $('#sectores').append(opciones);

            //$("#mensaje").text("Ud. tiene " + data.length + " solicitudes");
        }
        else {
            //$("#mensaje").text("No tiene solicitudes");
        }

     }).fail(
        function (error) {
        
        alert('Error en la llamada a la api...'+error);
    
     })

}

function obtener_solicitudes_empleador(sector_id)
{
    
    let parametros = {
        "sector_id" : sector_id
    };
    let jsonStr = JSON.stringify(parametros);

    $('#Grilla').html('');
    $.ajax({
        url: ServicioDatosSolicitudes,
        type: 'POST',
        data: jsonStr
     }).done(function (data) {

        // Verifica si la llamada fue exitosa
        if (data.length > 0) {

            console.log(data.length);

            
            var grilla='<table style="border:1px solid;padding:3px;">';
            grilla +='<tr>';
            grilla +='  <th>Id</th><th>Persona</th><th>Nombre</th><th>Desde</th><th>Hasta</th>'+
                     '  <th>D&iacute;as</th><th>&#10005;</th><th>&#10003;</th>';
            grilla +='</tr>';
            data.forEach(function(solicitud) { 
                
                grilla += '<tr>'+
                             '<td>'+solicitud.id+'</td>'+
                             '<td>'+solicitud.persona_id+'</td>'+
                             '<td style="width:200px;">'+solicitud.nombre+'</td>'+
                             '<td>'+solicitud.fechadesde+'</td>'+
                             '<td>'+solicitud.fechahasta+'</td>'+
                             '<td>'+solicitud.dias_diferencia+'</td>'+
                             '<td style="width:30px;"><input id="chk_rechazar_'+solicitud.id+'" type="checkbox" style="width:18px;" onclick="seleccion_checkbox_rechazar('+solicitud.id+');"/></td>'+
                             '<td style="width:30px;"><input id="chk_aceptar_'+solicitud.id+'" type="checkbox" style="width:18px;" onclick="seleccion_checkbox_aceptar('+solicitud.id+');"/></td>'+
                            '</tr>';
                registros.push(solicitud);
            }
                
                
            );
            grilla+='</table>'
            $('#Grilla').append(grilla);            
            $('#btn_guardar').removeAttr('disabled');
        }
        else {
            $("#mensaje").text("No hay solicitudes");
            $('#btn_guardar').attr('disabled','disabled');
        }

     }).fail(
        function (error) {
        
        alert('Error en la llamada a la api...'+error);
    
     })

}
function seleccion_checkbox_rechazar(id){  
    $('#chk_aceptar_'+id).prop("checked", false);
}
function seleccion_checkbox_aceptar(id){    
    $('#chk_rechazar_'+id).prop("checked", false);
}

function checkbox_esta_seleccionado(id){
    
    if($(id).is(':checked')){
        return true;
    }else
        return false;
}
function guardar(registros)
{
    
    let parametros = '';
    let aceptado=false;
    let rechazado=false;
    let cantidad_registros_almacenados=0;
    let estado='';
    let sector_id=0;

    sector_id = $('#sectores option:selected').val();
    
    registros.forEach(function(registro){

            aceptado=checkbox_esta_seleccionado("#chk_aceptar_"+registro.id);
            rechazado=checkbox_esta_seleccionado("#chk_rechazar_"+registro.id);
            
            
            if(rechazado || aceptado)
            {
                
                estado=(rechazado?'R':'A');
                //console.log(registro.id + ' estado:' + estado);
                
                parametros = {
                    "id" : registro.id,
                    "estado": estado,
                    "persona_id": registro.persona_id,
                    "dias":registro.dias_diferencia
                };
                let jsonStr = JSON.stringify(parametros);

                $.ajax({
                    url: ServicioActualizarEstadoSolicitud,
                    type: 'POST',
                    data: jsonStr        
                }).done(function (data) {
                    
                    // Verifica si la llamada fue exitosa
                    if (data[0].id >= 1) {
                        cantidad_registros_almacenados+=1;
                    }
            
                }).fail(
                    function (error) {
                    
                    alert('Error en la llamada a la api...'+error);
                
                })
                
            }
            
    })
    
    //if(cantidad_registros_almacenados>0){
        console.log('Cantidad actualizados:' + cantidad_registros_almacenados);
        alert("Las solicitudes fueron actualizadas correctamente");
        obtener_solicitudes_empleador(sector_id);
    //}
    //else
    //    alert("No fue posible completar la acción");
    
}


