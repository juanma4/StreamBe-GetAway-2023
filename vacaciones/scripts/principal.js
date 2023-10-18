/* V A R I A B L E S   G L O B A L E S */
var ServicioDatosSolicitudes = 'http://localhost/vacaciones/general/BaseDatos/obtener_solicitudes.php';
var ServicioGrabarDatosSolicitud = 'http://localhost/vacaciones/general/BaseDatos/grabar_solicitud.php';
var ServicioEliminarDatosSolicitud = 'http://localhost/vacaciones/general/BaseDatos/eliminar_solicitud.php';
var ServicioDatosPersona = 'http://localhost/vacaciones/general/BaseDatos/obtener_datos_persona.php';


let id=0;
let usuario='';
let tipo_solicitud='VS';
let estado='S';
let nombre='';
let persona_id=0;
let observa_notifica='';
let habilitado=0;
let es_admin=0;

$(document).ready(function () {
    
    inicializar();     
    cargardatos_perfil();
    obtener_solicitudes(persona_id);
    obtener_datos_persona();

    $('#boton_solicitar').click(function(){

        let fecha_desde='';
        let fecha_hasta='';

        fecha_d = $('#fecha_desde').val(); 
        fecha_h = $('#fecha_hasta').val();
        

        fecha_desde = fecha_d.substring(6,11) + '-' + fecha_d.substring(3,5) + '-' + fecha_d.substring(0,2);
        fecha_hasta = fecha_h.substring(6,11) + '-' + fecha_h.substring(3,5) + '-' + fecha_h.substring(0,2);
        // Obtener todos los datos del formulario y enviar a grabar
        
        // Ana
        if(fecha_desde=='' || fecha_hasta==''){
            alert("Ingrese las fechas desde y hasta");
            return;
        }
        if(calcular_diferencia_dias()>0)
        {
            grabar_solicitud(tipo_solicitud,estado,fecha_desde,fecha_hasta,observa_notifica);
        }else
        {
            alert('No es posible grabar la solicitud si las fechas no son correctas');
        }
    });
    
    $('#fecha_desde').change(function(){
        $('#dias_diferencia').text(calcular_diferencia_dias());
    });
    $('#fecha_hasta').change(function(){
        $('#dias_diferencia').text(calcular_diferencia_dias()); 
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
    console.log(id);
    
    // Verifica si esta logueado o no, sino lo redirige a la pagiana de error
    // Se puede redireccionar a la pagina de ingreso "login"
    if(id===undefined){ window.location.href="iniciarSesion.html"; }
    limpiar_fechas();

}
function limpiar_fechas()
{
    $('#fecha_desde').val('');
    $('#fecha_hasta').val('');
}
function calcular_diferencia_dias(){

    fecha_d = $('#fecha_desde').val().substring(6,11) +'-'+ $('#fecha_desde').val().substring(3,5)+'-'+$('#fecha_desde').val().substring(0,2);        
    fecha_h = $('#fecha_hasta').val().substring(6,11) +'-'+ $('#fecha_hasta').val().substring(3,5)+'-'+$('#fecha_hasta').val().substring(0,2);
    
    const fd = new Date(fecha_d);
    const fh = new Date(fecha_h);

    const diff = fh - fd;
    console.log(diff);
    // Calcula la diferencia en dias
    let dias = diff / (1000 * 60 * 60 * 24);
    if(isNaN(dias) || dias<0 ) dias=0;
    return dias; 

}
function cargardatos_perfil()
{
    
    $("#titulo span").text("Perfil de empleado");
    $("#etiqueta_nombre").text("ID: " + id + " - " +  nombre);
    $("#etiqueta_persona_id").text(persona_id);
}

function obtener_solicitudes()
{

    let parametros = {
        "persona_id" : persona_id
    };    
    let jsonStr = JSON.stringify(parametros);

    $('#Grilla').html('');

    $.ajax({
        url: ServicioDatosSolicitudes,
        type: 'POST',
        data: jsonStr
     }).done(function (data) {

        let color='';
        
        // Verifica si la llamada fue exitosa
        if (data.length > 0) {
            //console.log(data);
            $("#mensaje").text("Ud. tiene " + data.length + " solicitude/s pendientes");

            var grilla='<table style="border:1px solid;padding:3px;">';
            grilla +='<tr class="borde-tabla">';
            grilla +='  <th>Id</th><th>Persona</th><th>Nombre</th><th>Desde</th><th>Hasta</th>';
            grilla +='  <th>Estado</th><th></th>';
            grilla +='</tr>';
            data.forEach(function(solicitud) { 
                color='#000000';
                switch(solicitud.estado){
                    case 'A':
                        color='#0000ff';
                        break;
                    case 'S':
                        color='#000000';
                        break;
                    case 'R':
                        color='#ff0000';
                        break;
                }
                grilla +=   '<tr class="borde-tabla" style="color:'+color+'">'+
                                '<td style="padding-left:5px;">'+solicitud.id+'</td>'+
                                '<td style="padding-left:5px;">'+solicitud.persona_id+'</td>'+
                                '<td style="padding-left:5px; width:200px;">'+solicitud.nombre+'</td>'+
                                '<td style="padding-left:5px;">'+solicitud.fecha_desde+'</td>'+
                                '<td style="padding-left:5px;">'+solicitud.fecha_hasta+'</td>'+
                                '<td style="padding-left:5px;">'+solicitud.estado+'</td>';
                if(solicitud.estado=='S'){
                    grilla +=   '<td>' +                                
                                '        <button id="eliminar_'+solicitud.id+'" onclick="eliminar_solicitid('+solicitud.id+');">&#10005;</button>' +                                
                                '</td>';
                }else{
                    grilla +=   '<td></td>';
                }
                grilla +=       '</tr>';
                
            });

            grilla+='</table>'
            $('#Grilla').append(grilla);


        }
        else {
            $("#mensaje").text("No tiene solicitudes");
        }

     }).fail(
        function (error) {
        
        alert('Error en la llamada a la api...'+error);
    
     });
     return;
}

function obtener_datos_persona()
{
    let parametros = {
        "id" : persona_id
    };    
    let jsonStr = JSON.stringify(parametros);

    $('#Grilla').html('');

    $.ajax({
        url: ServicioDatosPersona,
        type: 'POST',
        data: jsonStr
     }).done(function (data) {
        if (data.length > 0) {
           
            $('#dias_restantes').text(data[0].dias_vacaciones);
        }


     }).fail(
        function (error) {
        
        alert('Error en la llamada a la api...'+error);
    
     });
}

function grabar_solicitud(tipo_solicitud,estado,fecha_desde,fecha_hasta,observa_notifica){

    let parametros = {
        "persona_id" : persona_id,        
        "tipo_solicitud" : tipo_solicitud,        
        "estado" : estado,
        "fecha_desde" : fecha_desde,
        "fecha_hasta" : fecha_hasta,
        "observa_notifica": observa_notifica
    };
  
    let jsonStr = JSON.stringify(parametros);

    

    $.ajax({
        url: ServicioGrabarDatosSolicitud,
        type: 'POST',
        data: jsonStr
     }).done(function (data) {
        if(data[0].id>0)
        {
            obtener_solicitudes(persona_id);
            limpiar_fechas();
        }


     }).fail(function (error) {        
            alert('Error en la llamada a la api...'+error);
     })
}

function eliminar_solicitid(id){
    let parametros = '';

    if (confirm("Desea eliminar la solicitud " + id) == true) {
        
        parametros = {
            "id" :id
        };
        let jsonStr = JSON.stringify(parametros);

        $.ajax({
            url: ServicioEliminarDatosSolicitud,
            type: 'POST',
            data: jsonStr        
        }).done(function (data) {
            
            // Verifica si la llamada fue exitosa
            if (data[0].id >= 1) {                
                obtener_solicitudes();
            }
            obtener_solicitudes();
    
        }).fail(
            function (error) {            
                alert('Error en la llamada a la api de eliminacion');        
        })
        
    } 
    return;
}

function logout(){

    localStorage.clear();
    window.location="login.php";
}