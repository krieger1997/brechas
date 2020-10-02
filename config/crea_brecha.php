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

$nombre_img = $_FILES['imagen']['name'];
$tipo = $_FILES['imagen']['type'];
$tamano = $_FILES['imagen']['size'];

$resultado = "--";
//if(isset($_FILES['imagen'])){
//    $resultado= var_dump($_FILES);
//}else{
//    $resultado="no imagen";
//}
if( isset($_FILES['imagen']) && $nombre_img == !NULL ){
    if($_FILES['imagen']['type'] == "image/gif" || $_FILES['imagen']['type'] == "image/jpg"  || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png" ){
        //ruta donde se guardaran las fotos
        $directorio = $_SERVER['DOCUMENT_ROOT']."/brechas/subidas/";
        //echo $directorio;
        if(move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img )){
        
            try {
                $sql="INSERT INTO `brechas`( `area`, `fecha`, `titulo`, `descripcion`, `autor`, `imagen`) VALUES ($area, '$fecha', '$titulo', '$descripcion', $autor, '$nombre_img')";
                if(mysqli_query($conexion,$sql)){
                    $resultado ="¡Brecha creada exitosamente!";
                }else{
                    $resultado = "Error: " . $sql . "<br>" . mysqli_error($conexion);

                }

            } catch (Exception $ex) {
                $resultado = "Error ".$ex;
            }  
        
        }//fin del if move_uploaded
        
    }else{
        $resultado = "error de formato de imagen";
    }
}else{
    $resultado = "imagen demasiado grande";
}

echo $resultado;
exit();
//try {
//    $sql="INSERT INTO `brechas`( `area`, `fecha`, `titulo`, `descripcion`, `autor`) VALUES ($area, '$fecha', '$titulo', '$descripcion', $autor)";
//    if(mysqli_query($conexion,$sql)){
//        $resultado ="¡Brecha creada exitosamente!";
//    }else{
//        $resultado= "Error: " . $sql . "<br>" . mysqli_error($conexion);
//            
//    }
//    
//} catch (Exception $ex) {
//    $resultado = "Error ".$ex;
//}  finally {
//    echo $resultado;
//}