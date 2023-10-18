<?php

// ***************************************************************
// Funcion obtener todas las solicitudes
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
    } else {
       http_response_code(400); // Bad Request
       echo "Invalid JSON data";
    }
   
    $return_arr = array();
    $conexion=CreateConnectionDB($servidor,$usuario_bd,$clave_bd,$baseDeDatos);
    $sql="select so.*,per.Nombre from solicitudes so inner join personas per on per.id=so.persona_id where per.id =".$persona_id.
        " and year(so.fecha_desde) = year(now()) " ;

    $result=mysqli_query($conexion,$sql);
    $count=mysqli_num_rows($result);
    if($count>0)
    {

        
        while ($fila = mysqli_fetch_assoc($result)) {
                $return_arr[] = array(
                            "id" => $fila["id"],
                            "persona_id" => $fila["persona_id"],
                            "nombre" => $fila["Nombre"],
                            "tipo_solicitud" => $fila["tipo_solicitud"],
                            "estado" => $fila["estado"],
                            "fecha_registro" => $fila["fecha_registro"],
                            "fecha_desde" => $fila["fecha_desde"],
                            "fecha_hasta" => $fila["fecha_hasta"],
                            "observa_notifica" => $fila["observa_notifica"]
                        );
            //	echo "Nombre: " . $fila["Nombre"] . " ID:" . $fila["Id"] . "<br>";
        }
       


        
    }else{

        $mensaje='No hay solicitudes';
        
    }

    
    /* Respuesta */
    header("Content-Type: application/json");
    echo json_encode($return_arr);
    exit();

}catch(Exception $ex){
    echo $ex->getMessage();
    
}




?>