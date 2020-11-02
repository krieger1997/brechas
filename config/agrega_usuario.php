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
    $nombreUsuario = $_POST['nombreUsuario']; 
    $contrasena = $_POST['contrasena']; 
    $tipo = $_POST['tipo']; 
    $area = $_POST['area']; 
    $rut = $_POST['rut']; 
    $nombre = $_POST['nombre']; 
    $segNombre = $_POST['segNombre']; 
    $apellido = $_POST['apellido']; 
    $segApellido = $_POST['segApellido']; 
    $email = $_POST['email']; 
    $telefono = $_POST['telefono']; 
    
    $sql="INSERT INTO `usuarios`( `nombre_de_usuario`, `contrasena`, `tipo_de_usuario`, `area`, `rut`, `nombre`, `seg_nombre`, `pri_apellido`, `seg_apellido`, `email`, `telefono`) VALUES 
            ('$nombreUsuario', '$contrasena',$tipo,$area,'$rut','$nombre','$segNombre','$apellido','$segApellido','$email','+569$telefono')";
    if(mysqli_query($conexion,$sql)  ){
        $resultado ="0";
    }else{
        $resultado = "Error: " . $sql . "<br>" . mysqli_error($conexion);

    }
    echo $resultado;
    
}else{
    error();
}


