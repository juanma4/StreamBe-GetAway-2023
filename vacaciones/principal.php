<?php

//include "./general/BaseDatos/conexion.php";

?>

<html>
<head>

<!-- CSS - Bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    
<link rel="stylesheet" href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" type="text/css" />
<link rel="stylesheet" href="style.css" />
<link rel="icon" type="image/x-icon" href="./img/streambe_logo.png">
<!-- Javascript - framework JQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
<script src="./scripts/principal.js" type="text/javascript"></script>
<style>
    .borde-tabla {
        border: 1px solid black;
        margin-left: 3px;
        margin-right: 3px;
    }
    .tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
  }
  
  
</style>

</head>
<body>
    <header class="header_vista">
      <a href="index.html"><img src="./img/streambe_banner.png" alt="LogoPagina" class="logo_pagina"/></a>
      <a href="login.php" id="cerrar_sesion">Cerrar sesión</a>
    </header>
    <div id="formulario">
        <div id="datos" class="informacion">
            <div class="col-12">
                <span>Bienvenido/a&nbsp;</span>
                <span id="etiqueta_nombre" class="font-weight-bold"></span>
                <br/>
                <span>ID de persona&nbsp;</span>
                <span id="etiqueta_persona_id" class="font-weight-bold"></span>
            </div>
        </div>
        
        <!-- Fechas  -->
        <div class="calendario">
            <div id="inputs">
            <div class="row pt-2">
                <div class="col-4"><span>Fecha Desde:</span></div>
                <div class="col-4">
                    <input id="fecha_desde" class="input_ing_fecha" width="270" />
                    <script>
                        $('#fecha_desde').datepicker({
                            uiLibrary: 'bootstrap4',
                            format: 'dd/mm/yyyy',
                            minDate: new Date()
                        });
                    </script>
                </div>

            </div>
            <div class="row pt-2">
                <div class="col-4"><span>Fecha Hasta:</span></div>
                <div class="col-4">
                    <input id="fecha_hasta" class="input_ing_fecha" width="270" />
                    <script>
                        $('#fecha_hasta').datepicker({
                            uiLibrary: 'bootstrap4',
                            format: 'dd/mm/yyyy',
                            minDate: new Date()
                        });
                    </script>
                </div>
            </div>
            </div>
            <div id="contenedor_dias">
                    <div class="col-6 text-center border border-secondary rounded">
                        <label for="dias_diferencia" style="font-size:9px;">Cant. d&iacute;as</label><br/>
                        <span id="dias_diferencia"></span>
                    </div>
                    <div class="col-6 text-center border border-primary rounded">
                        <label for="dias_restantes" style="font-size:9px;">Disponible</label><br/>
                        <span id="dias_restantes"></span>
                    </div>
                </div>
        </div>
        <div class="estadoSolicitud">
            <div id="Grilla"></div>
            <!-- Datos de solicitudes realizadas -->
            <div class="btns_solicitud">
                <button id="boton_volver" class="btn btn-danger" onclick="logout();">Salir del sistema</button>
                <button id="boton_solicitar" class="btn btn-success" >Solicitar fechas</button>
            </div>
        </div>
    </div>
</body>
</html>