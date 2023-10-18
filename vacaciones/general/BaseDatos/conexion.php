<?php


//var_dump(function_exists('echo'));
//    exit;

function CreateConnectionDB($server,$usuario,$pwd, $nombre_bd)
{
    
    $connection = NULL;
    $select_db = "";

    if(!is_null($connection)){mysqli_close($connection);}

    // Notificar todos los errores de PHP (ver el registro de cambios)
    error_reporting(E_ALL);

    $connection = mysqli_connect($server,$usuario, $pwd); // Desarrollo

    if (!$connection){
        echo mysqli_connect_errno() . ":" . mysqli_connect_error();
        
        echo '<script type="text/javascript">window.location = "./serror.php?mje=Error BD"</script>';

    }

    $connection->query("SET NAMES 'utf8'");
    mysqli_select_db($connection, $nombre_bd);
    
    return $connection;
}


?>
