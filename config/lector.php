<?php
require "conecta.php";
$conexion = conecta();
session_name('brechas');
session_start();
function error(){
    echo "<script>alert('Error.'); window.location.href='index.php'</script>";
}

//if(!isset($_SESSION['nombre']) && !isset($_SESSION['contrasena']) && !isset($_SESSION['tipo']) && !isset($_SESSION['area']) ){
if(isset($_SESSION['id'])  && isset($_SESSION['tipo']) && isset($_SESSION['area'])  && $_SESSION['tipo']==1 ){
    $id_usuario = $_POST['id'];
    
    //$sql="SELECT `nombre_de_usuario`, `contrasena`, usuarios.tipo_de_usuario ,tipo_de_usuario.nombre_tipo , usuarios.area, areas.NOMBRE_AREA , `rut`, `nombre`, `seg_nombre`, `pri_apellido`, `seg_apellido`, `email`, `telefono` FROM `usuarios`, areas, tipo_de_usuario WHERE areas.ID_AREA = usuarios.area AND tipo_de_usuario.id = usuarios.tipo_de_usuario AND usuarios.id =  $id_usuario ";
    $sql="SELECT  `nombre_de_usuario`, `contrasena`, `tipo_de_usuario`, `area`, `rut`, `nombre`, `seg_nombre`, `pri_apellido`, `seg_apellido`, `email`, SUBSTRING(telefono, 5) AS telefono FROM `usuarios` WHERE id = $id_usuario ";
    $result = $conexion -> query($sql);
    if($result->num_rows > 0){
        if($row = $result->fetch_array(MYSQLI_ASSOC)){
            echo json_encode($row);
        }
    }else{
        echo "Error";
    }
    
    
    
}else{
    error();
}