<?php
//viene de detalle
require "conecta.php";
$conexion = conecta();
session_name('brechas');
session_start();

$id_brecha = $_POST['brecha'];
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




$sql1 = 'SELECT brechas.area as area, areas.NOMBRE_AREA as nombre_area , `fecha`, `titulo`, `descripcion`, CONCAT(`nombre`," ",`pri_apellido`, " ",`seg_apellido`) as nombre, email, telefono FROM `brechas`, usuarios, areas WHERE brechas.id = '.$id_brecha.' and usuarios.id = autor and areas.ID_AREA = brechas.area ';
$result1 = $conexion -> query($sql1);
if($result1->num_rows > 0){
    if($row1 = $result1->fetch_array(MYSQLI_ASSOC)){
        $autor_nombre = $row1['nombre'];
        $autor_email = $row1['email'];
        $autor_telefono = $row1['telefono'];
        $area_b = $row1['area'];
        $fecha_b = $row1['fecha'];
        $titulo_b = $row1['titulo'];
        $descripcion_b = $row1['descripcion'];
        $area_nombre = $row1['nombre_area'];
            
        
        
    }
}else{
    $resultado="no hay resultados";
}

$sqlz = 'SELECT CONCAT(`nombre`," ",`pri_apellido`, " ",`seg_apellido`) as nombre, email, telefono  FROM `usuarios` WHERE `id` = '.$_SESSION['id'].' ';
$result = $conexion -> query($sql1);
if($result->num_rows > 0){
    if($row = $result->fetch_array(MYSQLI_ASSOC)){
        $autor_nombre_c = $row['nombre'];
        $autor_email_c = $row['email'];
        $autor_telefono_c = $row['telefono'];
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

$para =  trim($para, ', ');

$asunto = "Nueva brecha pendiente";


$contenido='<!DOCTYPE html>
<html>
<head>
<title>HTML</title>
</head>
<body>
<h1>Nueva brecha pendiente </h1>
<table border="1">
    <tr>
        <td>Titulo</td>
        <td>Descripción</td>
        <td>Area destino</td>
        <td>Fecha</td>
    </tr>
    <tr>
        <td>'.$titulo_b.'</td>
        <td>'.$descripcion_b.'</td>
        <td>'.utf8_encode($area_nombre).'</td>
        <td>'.$fecha_b.'</td>
    </tr>
</table>
<br>
<hr>      
<label > <strong> Autor:</strong></label><br>
<p >'.$autor_nombre.'</p>
<p >'.$autor_email.'</p>
<p >'.$autor_telefono.'</p>
<hr>
<br>



<h1>Cierre de brecha</h1>
<table border="1">
    <tr>
        <td>Titulo</td>
        <td>Descripción</td>
        <td>Fecha</td>
    </tr>
    <tr>
        <td>'.$titulo.'</td>
        <td>'.$descripcion.'</td>
        <td>'.$fecha.'</td>
    </tr>
</table>
<br>
<hr>      
<label > <strong> Autor:</strong></label><br>
<p >'.utf8_encode($autor_nombre_c).'</p>
<p >'.$autor_email_c.'</p>
<p >'.$autor_telefono_c.'</p>

<h3>Mensaje automático, no responder.</h3>
</body>
</html>';







$encabezado= 'MIME-Version: 1.0' . "\r\n";
$encabezado .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$encabezado .= "From: Sistema Gestión de Brechas";






if( isset($_FILES['imagen']) && $nombre_img == !NULL ){ 
    if($_FILES['imagen']['type'] == "image/gif" || $_FILES['imagen']['type'] == "image/jpg"  || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png" ){
        //ruta donde se guardaran las fotos
        $directorio = $_SERVER['DOCUMENT_ROOT']."/brechas/cierres/";
        //$directorio = $_SERVER['DOCUMENT_ROOT']."/cierres/";//ESTE AL SUBIR
        //echo $directorio;
        if(move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img )){
        
            try {
                $sql="INSERT INTO `cierres`( `id_brecha`, `fecha`, `titulo`, `descripcion`, `autor`, `imagen`) VALUES ($id_brecha, '$fecha', '$titulo', '$descripcion', $autor, '$nombre_img')";
                if(mysqli_query($conexion,$sql)){
                    $sql2= "UPDATE `brechas` SET estado = 'PENDIENTE' WHERE `id` = $id_brecha";
                    if(mysqli_query($conexion,$sql2) && mail($para, $asunto, $contenido, $encabezado)){
                        $resultado ="¡Brecha cerrada exitosamente!";
                    }
                    
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
    
    $sql="INSERT INTO `cierres`( `id_brecha`, `fecha`, `titulo`, `descripcion`, `autor`) VALUES ($id_brecha, '$fecha', '$titulo', '$descripcion', $autor)";
    if(mysqli_query($conexion,$sql)){
        $sql2= "UPDATE `brechas` SET estado = 'PENDIENTE' WHERE `id` = $id_brecha";
        if(mysqli_query($conexion,$sql2) && mail($para, $asunto, $contenido, $encabezado)){
            $resultado ="¡Brecha cerrada exitosamente sin imagen!";
        }
        
    }else{
        $resultado = "Error: " . $sql . "<br>" . mysqli_error($conexion);

    }
}
//$resultado .=  "-->".$titulo_b."<--ID:".$id_brecha;
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