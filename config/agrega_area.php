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
    $nombreArea = $_POST['nombreArea']; 
    
    
    $sql="INSERT INTO `areas`(`NOMBRE_AREA`) VALUES ('$nombreArea')";
    if(mysqli_query($conexion,$sql)  ){
        $resultado ="0";
    }else{
        $resultado = "Error: " . $sql . "<br>" . mysqli_error($conexion);

    }
    echo $resultado;
    
}else{
    error();
}

