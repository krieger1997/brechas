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

$sql1 = 'SELECT CONCAT(`nombre`," ",`pri_apellido`, " ",`seg_apellido`) as nombre, email, telefono  FROM `usuarios` WHERE `id` = '.$autor.' ';
$result1 = $conexion -> query($sql1);
if($result1->num_rows > 0){
    if($row1 = $result1->fetch_array(MYSQLI_ASSOC)){
        $autor_nombre = $row1['nombre'];
        $autor_email = $row1['email'];
        $autor_telefono = $row1['telefono'];
    }
}

$para ="";
$sql2 = 'SELECT `email` FROM `usuarios` WHERE `tipo_de_usuario` = 1 ';
$result2 = $conexion -> query($sql2);
if($result2->num_rows > 0){
    while($row2 = $result2->fetch_array(MYSQLI_ASSOC)){
        $para .= $row2['email'].", ";
    }
}   
$sql3 = "SELECT `email` FROM `usuarios` WHERE `area` = $area";
$result3 = $conexion -> query($sql3);
if($result3->num_rows > 0){
    while($row3 = $result3->fetch_array(MYSQLI_ASSOC)){
        $para .= $row3['email'].", ";
    }
}

$sqlx = "SELECT `NOMBRE_AREA` FROM `areas` WHERE `ID_AREA` = $area";
$resultx = $conexion -> query($sqlx);
if ($resultx-> num_rows > 0){
    while($rowx = $resultx->fetch_array(MYSQLI_ASSOC)){
        $area_nombre = utf8_encode($rowx['NOMBRE_AREA']);
    }
}

$para =  trim($para, ', ');
$asunto = "Nueva brecha abierta";
$contenido='<!DOCTYPE html>
<html>
<head>
<title>HTML</title>
</head>
<body>
<h1>Nueva brecha abierta </h1>
<table border="1">
    <tr>

        <td>Titulo</td>
        <td>Descripción</td>
        <td>Area destino</td>
        <td>Fecha</td>

    </tr>
    <tr>

        <td>'.$titulo.'</td>
        <td>'.$descripcion.'</td>
        <td>'.$area_nombre.'</td>
        <td>'.$fecha.'</td>
    </tr>

</table>
<br>


  <hr>      
<label > <strong> Autor:</strong></label><br>
<p >'.$autor_nombre.'</p>
<p >'.$autor_email.'</p>
<p >'.$autor_telefono.'</p>
<hr>

<h3>Mensaje automático, no responder.</h3>
</body>
</html>';
$encabezado= 'MIME-Version: 1.0' . "\r\n";
$encabezado .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$encabezado .= "From: Sistema Gestión de Brechas";



try {

if( isset($_FILES['imagen']) && $nombre_img == !NULL ){ 
    if($_FILES['imagen']['type'] == "image/gif" || $_FILES['imagen']['type'] == "image/jpg"  || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png" ){
        //ruta donde se guardaran las fotos
        $directorio = $_SERVER['DOCUMENT_ROOT']."/brechas/subidas/";
        //$directorio = $_SERVER['DOCUMENT_ROOT']."/subidas/";//ESTE AL SUBIR
        //echo $directorio;
        if(move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img )){
        
            
                $sql="INSERT INTO `brechas`( `area`, `fecha`, `titulo`, `descripcion`, `autor`, `imagen`) VALUES ($area, '$fecha', '$titulo', '$descripcion', $autor, '$nombre_img')";
                if(mysqli_query($conexion,$sql) && mail($para, $asunto, $contenido, $encabezado)){
                    $resultado ="¡Brecha creada exitosamente!";
                    

                    
                    
                }else{
                    $resultado = "Error1: " . $sql . "<br>" . mysqli_error($conexion);

                }

             
        
        }//fin del if move_uploaded
        
    }else{
        $resultado = "Error de formato de imagen";
    }
}else{
    
    $sql="INSERT INTO `brechas`( `area`, `fecha`, `titulo`, `descripcion`, `autor`) VALUES ($area, '$fecha', '$titulo', '$descripcion', $autor)";
    if(mysqli_query($conexion,$sql)  && mail($para, $asunto, $contenido, $encabezado)){
        $resultado ="¡Brecha creada exitosamente sin imagen!";
    }else{
        $resultado = "Error3: " . $sql . "<br>" . mysqli_error($conexion);

    }
}
} catch (Exception $ex) {
    $resultado = "Error 2".$ex;
} 
echo $resultado;
exit();
