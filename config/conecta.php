<?php
 function conecta(){
$host="localhost";
$user="root";
$pass="Zoolitario  1";
$db="brechas";
$conexion = mysqli_connect($host,$user,$pass,$db) or die ("Error al conectar a la bd ");
return $conexion;
}

?>

