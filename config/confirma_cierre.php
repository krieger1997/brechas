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
    
    $sql1 ="SELECT brechas.area as area, areas.NOMBRE_AREA as area_nombre, DATE_FORMAT(brechas.fecha, '%d/%m/%Y') as b_fecha, brechas.titulo as b_titulo, brechas.descripcion as b_descripcion, DATE_FORMAT(limite, '%d/%m/%Y') as limite , brechas.autor as b_autor, DATE_FORMAT(cierres.fecha, '%d/%m/%Y') as c_fecha, cierres.titulo c_titulo, cierres.descripcion as c_descripcion, cierres.autor as c_autor 
    FROM `brechas`, cierres, areas
    WHERE brechas.id = $id_brecha AND cierres.id_brecha = brechas.id and areas.ID_AREA = brechas.area";
    $result1 = $conexion -> query($sql1);
    if($result1->num_rows > 0){
        if($row = $result1->fetch_array(MYSQLI_ASSOC)){
            $area_nombre = $row['area_nombre'];
            $descripcion_b = $row['b_descripcion'];
            $titulo_b = $row['b_titulo'];
            $fecha_b = $row['b_fecha'];
            $limite = $row['limite'];
            $titulo = $row['c_titulo'];
            $descripcion = $row['c_descripcion'];
            $fecha = $row['c_fecha'];
            $area = $row['area'];
            
            
            $sql2='SELECT CONCAT(`nombre`," ",`pri_apellido`, " ",`seg_apellido`) as nombre, email, telefono, area  FROM `usuarios` WHERE `id`='.$row['b_autor'];
            $result2 = $conexion -> query($sql2);
            if($result2->num_rows > 0){
                if($row2 = $result2->fetch_array(MYSQLI_ASSOC)){
                    $autor_nombre= $row2['nombre'];
                    $autor_email= $row2['email'];
                    $autor_telefono= $row2['telefono'];
                    $area_autor = $row2['area'];
                }
            }
            $sql3='SELECT CONCAT(`nombre`," ",`pri_apellido`, " ",`seg_apellido`) as nombre, email, telefono, area  FROM `usuarios` WHERE `id`='.$row['c_autor'];
            $result3 = $conexion -> query($sql3);
            if($result3->num_rows > 0){
                if($row3 = $result3->fetch_array(MYSQLI_ASSOC)){
                    $autor_nombre_c= $row3['nombre'];
                    $autor_email_c= $row3['email'];
                    $autor_telefono_c= $row3['telefono'];
                    $area_c= $row3['area'];
                }
            }
        }
    }
    
$para ="";
$sql4 = 'SELECT `email` FROM `usuarios` WHERE `tipo_de_usuario` = 1 ';//admin
$result4 = $conexion -> query($sql4);
if($result4->num_rows > 0){
    while($row4 = $result4->fetch_array(MYSQLI_ASSOC)){
        $para .= $row4['email'].", ";
    }
}   
$sql5 = "SELECT `email` FROM `usuarios` WHERE `area` = $area";//area destino
$result5 = $conexion -> query($sql5);
if($result5->num_rows > 0){
    while($row5 = $result5->fetch_array(MYSQLI_ASSOC)){
        $para .= $row5['email'].", ";
    }
}
$sql6 = "SELECT `email` FROM `usuarios` WHERE `area` = $area_autor";//area destino
$result6 = $conexion -> query($sql6);
if($result6->num_rows > 0){
    while($row6 = $result6->fetch_array(MYSQLI_ASSOC)){
        $para .= $row6['email'].", ";
    }
}
    
    //faltan destinatarios
    
$para =  trim($para, ', ');

$asunto = "Cierre de brecha confirmado";


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
        <td>Fecha límite</td>
    </tr>
    <tr>
        <td>'.$titulo_b.'</td>
        <td>'.$descripcion_b.'</td>
        <td>'.utf8_encode($area_nombre).'</td>
        <td>'.$fecha_b.'</td>
        <td>'.$limite.'</td>
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
$encabezado .= "X-Priority: 3\n";
$encabezado .= "X-MSMail-Priority: Normal\n";
$encabezado .= "X-Mailer: php\n";
$encabezado .= "From: \"Sistema Gestión de Brechas\" <no-responder@pruebab.pidenco.cl>";
    
    
    
    
    
    
    $sql = "UPDATE `brechas` SET estado = 'CERRADA' WHERE `id` = $id_brecha";
    if(mysqli_query($conexion,$sql) && mail($para, $asunto, $contenido, $encabezado)){
        $resultado ="¡Brecha confirmada exitosamente!";
    }else{
        $resultado = "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
    echo $resultado;
    
    
    
    
    
    
    
    
}else{
    echo "Error";
}