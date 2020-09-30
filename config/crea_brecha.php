<?php
require "conecta.php";
$conexion = conecta();
session_name('brechas');
session_start();

$area=$_POST['area'];
$fecha=$_POST['fecha'];
$descripcion=$_POST['descripcion'];
$titulo=$_POST['titulo'];
$autor =$_SESSION['id'];

$resultado = "VACÍO";
try {
    $sql="INSERT INTO `brechas`( `area`, `fecha`, `titulo`, `descripcion`, `autor`) VALUES ($area, '$fecha', '$titulo', '$descripcion', $autor)";
    if(mysqli_query($conexion,$sql)){
        $resultado ="¡Brecha creada exitosamente!";
    }else{
        $resultado= "Error: " . $sql . "<br>" . mysqli_error($conexion);
            
    }
    
} catch (Exception $ex) {
    $resultado = "Error ".$ex;
}  finally {
    echo $resultado;
}