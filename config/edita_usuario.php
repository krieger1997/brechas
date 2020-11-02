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

    
    $sql="UPDATE `usuarios` SET `nombre_de_usuario`='$nombreUsuario',`contrasena`='$contrasena',`tipo_de_usuario`= $tipo,
            `area`=$area,`rut`='$rut',`nombre`='$nombre',`seg_nombre`='$segNombre',`pri_apellido`='$apellido',
            `seg_apellido`='$segApellido',`email`='$email',`telefono`='+569$telefono' WHERE `id` = $id";
    if(mysqli_query($conexion,$sql)  ){
        $resultado ="1";
    }else{
        $resultado = "Error: " . $sql . "<br>" . mysqli_error($conexion);

    }
    echo $resultado;
    
}else{
    error();
}
