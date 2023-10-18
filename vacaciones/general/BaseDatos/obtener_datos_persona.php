<?php
// ***************************************************************
// Funcion eliminar solicitudes
// API
//
include "conexion.php";
include "datos_conexion.php";

// Obtiene los parametros que le envian el javascript
$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

if ($data !== null) {
    $id = $data['id'];     
} else {
    http_response_code(400); // Bad Request
    echo "Invalid JSON data";
}

try{

    $return_arr = array();
    $conexion=CreateConnectionDB($servidor,$usuario_bd,$clave_bd,$baseDeDatos);

    $sql="select * from personas ". 
         "where id=" . $id;             
    $result=mysqli_query($conexion,$sql);
    $count=mysqli_num_rows($result);
    if($count>0)
    {

        
        $fila = mysqli_fetch_assoc($result);
        $return_arr[] = array(
                    "id" => $fila["Id"],                    
                    "nombre" => $fila["Nombre"],
                    "fecha_registro" => $fila["Fecha_registro"],
                    "fecha_inicio_laboral" => $fila["Fecha_inicio_laboral"],
                    "dias_vacaciones" => $fila["Dias_vacaciones"],
                    "sector" => $fila["sector"]
                );
            
    }

    // Retorna el id del registro eliminado
    header("Content-Type: application/json");
    echo json_encode($return_arr);
    exit();


}catch(Exception $ex)
{
    echo 'Error';
}


?>