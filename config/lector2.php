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
    $id_area = $_POST['id'];
    
    
    $sql="SELECT ID_AREA, NOMBRE_AREA FROM areas WHERE ID_AREA = $id_area ";
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