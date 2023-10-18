<?php
// ***************************************************************
// Funcion grabar las solicitudes
// API
//
include "conexion.php";
include "datos_conexion.php";


try{

    // Obtiene los parametros que le envian el javascript
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);
    
    if ($data !== null) {

       $persona_id = $data['persona_id'];
       $tipo_solicitud = $data['tipo_solicitud'];
       $estado = $data['estado'];
       $fecha_desde = $data['fecha_desde'];
       $fecha_hasta = $data['fecha_hasta'];
       $observa_notifica = $data['observa_notifica'];

    } else {
       http_response_code(400); // Bad Request
       echo "Invalid JSON data";
    }

    $return_arr = array();
    $conexion=CreateConnectionDB($servidor,$usuario_bd,$clave_bd,$baseDeDatos);
    $sql="insert into solicitudes (persona_id,tipo_solicitud,estado,fecha_registro,fecha_desde,fecha_hasta,observa_notifica) " 
        . "values(" . $persona_id . ",'" . $tipo_solicitud . "','" . $estado . "',now(),'" 
        . $fecha_desde . "','" . $fecha_hasta . "','" . $observa_notifica . "')";
    
    $result=mysqli_query($conexion,$sql);
    
    /* Respuesta */
    $return_arr[] = array(
        "id" => mysqli_insert_id($conexion));    
    header("Content-Type: application/json");
    echo json_encode($return_arr);
    exit();

}catch(Exception $ex){
    echo $ex->getMessage();

}


?>