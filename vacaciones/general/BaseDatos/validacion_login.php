
<?php

// ***************************************************************
// Funcion de valicacion de usuario  y clave
// API
//
include "conexion.php";
include "datos_conexion.php";

/*
    $servidor="localhost:3307"; //127.0.0.1
    $baseDeDatos="vacaciones";
    $usuario_bd="root";
    $clave_bd="";
*/
    $id=0;
    $nombre='';
    $fecha_registro='';
    $persona_id=0;
    $habilitado=0;
    $es_admin=0;
    $imagen='';
    $mensaje='';



    try{

        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $explode = explode("#", $url);
        $components = parse_url($url);
        parse_str($components['query'], $params);

        $usuario = $_GET['usuario'];
        $clave = $_GET['clave'];

		$conexion=CreateConnectionDB($servidor,$usuario_bd,$clave_bd,$baseDeDatos);

		$sql="select * from usuarios where usuario='".$usuario."' and clave='".$clave."' and habilitado=true";

		$result=mysqli_query($conexion,$sql);
		$count=mysqli_num_rows($result);
		if($count>0)
		{

            $fila = mysqli_fetch_assoc($result);
			//while ($fila = mysqli_fetch_assoc($result)) {
			//	echo "Nombre: " . $fila["Nombre"] . " ID:" . $fila["Id"] . "<br>";
			//}
            $id=$fila["id"];
            $nombre=$fila["nombre"];
            $fecha_registro=$fila["fecha_registro"];
            $persona_id=$fila["persona_id"];
            $habilitado=$fila["habilitado"];
            $es_admin=$fila["es_admin"];
            $imagen=$fila["imagen"];;
            $mensaje='';


            //echo '<script type="text/javascript">window.location = "./error.php?mje="'.$usuario.' clave'.$clave.'</script>';

		}else{

            $mensaje='No habilitado';
			//echo '<script type="text/javascript">window.location = "./error.php?mje=NO validado"</script>';
		}

        
        /* Respuesta */
        $return_arr[] = array(
                    "id" => $id,
                    "nombre" => $nombre,
                    "fecha_registreo" => $fecha_registro,
                    "persona_id" => $persona_id,
                    "habilitado" => $habilitado,
                    "es_admin" => $es_admin,
                    "imagen" => $imagen,
                    "message" => $mensaje);

        header("Content-Type: application/json");
        echo json_encode($return_arr);
        exit();

    }catch(Exception $ex){
        echo $ex->getMessage();
        
    }
?>