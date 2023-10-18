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
       $sector_id = $data['sector_id'];
    } else {
       http_response_code(400); // Bad Request
       echo "Invalid JSON data";
    }
   
    $return_arr = array();
    $conexion=CreateConnectionDB($servidor,$usuario_bd,$clave_bd,$baseDeDatos);
    /*$sql="SELECT S.persona_id, P.nombre, S.fecha_desde, S.fecha_hasta," +
        "DATEDIFF(fecha_hasta, fecha_desde) AS diasdif" +
        "FROM personas P
        INNER JOIN solicitudes S ON S.persona_id=P.id AND S.estado='S'
        INNER JOIN sectores SE ON SE.id=P.sector_id" +
        "WHERE YEAR(S.fecha_desde) = YEAR(NOW())" +
        "ORDER BY S.fecha_desde";
*/
    $sql="SELECT S.id, S.persona_id, P.nombre,DATE_FORMAT(S.fecha_desde,'%d/%m/%Y') AS fecha_desde, " .
         "DATE_FORMAT(S.fecha_hasta,'%d/%m/%Y') AS fecha_hasta," .
         "DATEDIFF(fecha_hasta, fecha_desde) AS diasdif " .
         "FROM personas P " .
         "INNER JOIN solicitudes S ON S.persona_id=P.id AND S.estado='S' " .
         "INNER JOIN sectores SE ON SE.id=P.sector AND SE.id = " . $sector_id . " " .
         "WHERE YEAR(S.fecha_desde) = YEAR(NOW()) " .
         "ORDER BY S.fecha_desde;"; 

    $result=mysqli_query($conexion,$sql);
    $count=mysqli_num_rows($result);
    if($count>0)
    {


        
        while ($fila = mysqli_fetch_assoc($result)) {
                $return_arr[] = array(
                            "id" => $fila["id"],
                            "persona_id" => $fila["persona_id"],
                            "nombre" => $fila["nombre"],
                            "fechadesde" => $fila["fecha_desde"],
                            "fechahasta" => $fila["fecha_hasta"],
                            "dias_diferencia" => $fila["diasdif"]
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