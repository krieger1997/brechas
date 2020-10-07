<?php
function head($titulo){
    
    echo "<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
     <link rel='icon' href='img/pidenco_blanco_web.png' type='image/png'>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' integrity='sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z' crossorigin='anonymous'>
    <link rel='stylesheet' type='text/css' href='css/main.css'>
    <script src='https://code.jquery.com/jquery-3.5.1.min.js' integrity='sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=' crossorigin='anonymous'></script>
    <title>".$titulo."</title>
</head>
  <body>
       <div class='salir' ><button type='button' class='btn btn-outline-danger' id='cerrar' onclick=\"window.location.href='config/salir.php'\">CERRAR SESIÓN</button></div>";
    
}

