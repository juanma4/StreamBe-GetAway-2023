<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleado</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="shortcut icon" href="./img/logo.png">

    <!-- Javascript - framework JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <script src="./scripts/empleador.js" type="text/javascript"></script>

</head>

<body>
<header>
        <a href="index.html"><img src="./img/streambe_banner.png" alt="LogoPagina" class="logo_pagina"/></a>
    </header>


    <div class="marcoSolicitud">
        <h4 class="tituloSectores">Elegir un Sector</h4>
        <br>
        <!--<input list="Sector">-->
      
        <select name="sectores" id="sectores" >            
        </select>
        


        <br><div class="contenedorTabla">
        <div id="Grilla" class="marcoSolicitud"></div>
        <div class="inputSolicitud">
            <button id="btn_guardar">Guardar aprobaciones</button>
                 
        </div>
        </div>
        
       
    </div>

</body>

</html>