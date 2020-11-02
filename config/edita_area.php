<?php
require "conecta.php";
$conexion = conecta();
session_name('brechas');
session_start();
function error(){
    echo "<script>alert('Error.'); window.location.href='index.php'</script>";
}

//if(!isset($_SESSION['nombre']) && !isset($_SESSION['contrasena']) && !isset($_SESSION['tipo']) && !isset($_SESSION['area']) ){
if(isset($_SESSION['id'])  && isset($_SESSION['tipo']) && isset($_SESSION['area']) && $_SESSION['tipo']==1 ){
    $id = $_POST['id'];
    $nombreArea = $_POST['nombreArea'];
    
    $sql="UPDATE `areas` SET `NOMBRE_AREA`='$nombreArea' WHERE `ID_AREA` = $id";
    if(mysqli_query($conexion,$sql)  ){
        $resultado ="1";
    }else{
        $resultado = "Error: " . $sql . "<br>" . mysqli_error($conexion);

    }
    echo $resultado;
    
}else{
    error();
}