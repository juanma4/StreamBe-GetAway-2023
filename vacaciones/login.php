<html>

<head>

<!-- CSS - Bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<!-- Javascript - framework JQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="./scripts/login.js" type="text/javascript"></script>

</head>

<body id="login_bg">
    <header class="header_vista">
        <a href="index.html"><img src="./img/streambe_banner.png" alt="LogoPagina" class="logo_pagina"/></a>
    </header>
    <div class="formulario" class="container" id="login">

        <div class="row text-center">
            <div class="col-12">
                <div>
                    <span class="h2 font-weight-bold">Ingreso al sistema de vacaciones</span>
                </div>
            </div>               
        </div>
        <div class="row pt-5">
            <div class="col-2"></div>
            <div class="col-8 text-center">
                <div class="formulario">
                    <span>Usuario:</span>
                    <input id="usuario" type="text"/>
                    <br/><br/>
                    <span>Clave:</span>
                    <input id="clave" type="password"/>

                    <br/><br/>
                    <button id="boton_ingreso" class="btn principal">Ingresar al sistema</button>
                    
                </div>
            </div>
            <div class="col-2"></div>
        </div>
        <div class="row pt-5">
            <div class="col-2"></div>
            <div class="col-8 text-center">
                <span id="mensaje"></span>
            </div>
            <div class="col-2"></div>
        </div>               



    </div>


</body>

</html>