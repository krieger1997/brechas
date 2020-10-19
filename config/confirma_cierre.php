<?php
require "conecta.php";
$conexion = conecta();
session_name('brechas');
session_start();
function error(){
    echo "<script>alert('Error.'); window.location.href='index.php'</script>";
}

//if(!isset($_SESSION['nombre']) && !isset($_SESSION['contrasena']) && !isset($_SESSION['tipo']) && !isset($_SESSION['area']) ){
if(isset($_SESSION['id'])  && isset($_SESSION['tipo']) && isset($_SESSION['area']) && isset($_POST['id_brecha']) ){
    $id_brecha = $_POST['id_brecha'];
    $sql = "UPDATE `brechas` SET estado = 'CERRADA' WHERE `id` = $id_brecha";
    if(mysqli_query($conexion,$sql)){
        $resultado ="¡Brecha confirmada exitosamente!";
    }else{
        $resultado = "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
    echo $resultado;
    
    
    
    
    
    
    
    
}else{
    echo "Error";
}