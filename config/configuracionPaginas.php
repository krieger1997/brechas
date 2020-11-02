<?php
function head($titulo){
    
    echo "<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
     <link rel='icon' href='../img/pidenco_blanco_web.png' type='image/png'>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' integrity='sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z' crossorigin='anonymous'>
    <link rel='stylesheet' type='text/css' href='../css/main.css'>
    <script src='https://code.jquery.com/jquery-3.5.1.min.js' integrity='sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=' crossorigin='anonymous'></script>
    <title>".$titulo."</title>
</head>
  <body>";  
      echo '<div clasS="d-flex justify-content-between bd-highlight mb-3"> 
    <div class="p-2 bd-highlight "><button type="button" class="btn btn-outline-dark align-middle ml-4 float-left" onclick="javascript:location.href=`../index.php`"  >
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left-square-fill mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm9.5 8.5a.5.5 0 0 0 0-1H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5z"/>
                </svg>Volver
        </button></div> 
    <div class="p-2 bd-highlight"></div> 
    <div class="p-2 bd-highlight "><button type="button" class="btn btn-outline-danger" id="cerrar" onclick=\'window.location.href="salir.php"\'>CERRAR SESIÓN</button></div> 
    </div>';
//       <div class='mb-3 salir' ><button type='button' class='btn btn-outline-danger' id='cerrar' onclick=\"window.location.href='salir.php'\">CERRAR SESIÓN</button></div>
//       <div class='mb-3 ' style='display: none;    margin-right: 90%;    margin-top: 0.5%;' ><button type='button' class='btn btn-outline-danger' id='cerrar' onclick=\"window.location.href='salir.php'\">CERRAR SESIÓN</button></div>";";
    
    
    
}

