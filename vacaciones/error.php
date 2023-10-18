<!DOCTYPE html>
<html lang="es-AR">
<head>
    <title</title>
<!-- CSS - Bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<!-- Javascript - framework JQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="./scripts/principal.js" type="text/javascript"></script>

</head>
<body>
    <div id="container" style="width:100%; padding-top: 0.5em;">
        <h2>Se produjo el siguiente error</h2>
        <br/>
        <span> 
        <?php
            echo '<span style="font-size:18px; font-weight:bold;">Mensaje: </span>' . $_GET['mje'];
        ?>
        </span>
        <button id="boton_error" class="btn" onclick="logout();">Volver al Login</button>
    </div>
</body>
</html>