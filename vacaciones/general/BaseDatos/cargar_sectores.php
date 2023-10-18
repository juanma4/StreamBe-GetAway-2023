<?php
// ***************************************************************
// Funcion obtener todas las solicitudes
// API
//
include "conexion.php";
include "datos_conexion.php";

try{

    // Obtiene los parametros que le envian el javascript
    /*
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);
    
    if ($data !== null) {
       $persona_id = $data['persona_id'];
    } else {
       http_response_code(400); // Bad Request
       echo "Invalid JSON data";
    }
    */

    $return_arr = array();
    $conexion=CreateConnectionDB($servidor,$usuario_bd,$clave_bd,$baseDeDatos);
    $sql="select * from sectores";

    $result=mysqli_query($conexion,$sql);
    $count=mysqli_num_rows($result);
    if($count>0)
    {

        
        while ($fila = mysqli_fetch_assoc($result)) {
                $return_arr[] = array(
                            "id" => $fila["id"],
                            "nombre" => $fila["Nombre"]
                            
                        );
           
        }
       


        
    }else{

        $mensaje='No hay sectores';
        
    }

    
    /* Respuesta */
    header("Content-Type: application/json");
    echo json_encode($return_arr);
    exit();

}catch(Exception $ex){
    echo $ex->getMessage();
    
}




?>