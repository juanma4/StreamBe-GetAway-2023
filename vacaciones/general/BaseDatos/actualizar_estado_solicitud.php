<?php
// ***************************************************************
// Funcion grabar las solicitudes
// API
//
include "conexion.php";
include "datos_conexion.php";



// Obtiene los parametros que le envian el javascript
$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

if ($data !== null) {

    $id = $data['id'];
    $estado = $data['estado'];
    $persona_id = $data['persona_id'];
    $dias = $data['dias'];       
} else {
    http_response_code(400); // Bad Request
    echo "Invalid JSON data";
}

try{

    $return_arr = array();
    $conexion=CreateConnectionDB($servidor,$usuario_bd,$clave_bd,$baseDeDatos);

    $sql="UPDATE solicitudes set estado='" . $estado . "' ". 
         "WHERE id=" . $id;             
    $result=mysqli_query($conexion,$sql);
    // Este es el retorno que envia la api al front
    $return_arr[] = array(
        "id" => mysqli_affected_rows($conexion));
        
    // verifica si es una aprobación para actualizar los dias restantes
    if($estado=='A'){
        $sql_persona="update personas set Dias_vacaciones=" . 
                    "case when (Dias_vacaciones- ".$dias.")>=0 then (Dias_vacaciones-".$dias.")" .
                    " else 0 end where Id=" . $persona_id;
        
        $result_persona=mysqli_query($conexion,$sql_persona);       
    }


    // Retorna el id del update
    header("Content-Type: application/json");
    echo json_encode($return_arr);
    exit();



}catch(Exception $ex){
    echo $ex->getMessage();

}


?>