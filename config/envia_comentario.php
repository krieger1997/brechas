 <?php
require "conecta.php";
$conexion = conecta();
session_name('brechas');
session_start();
function error(){
    echo "<script>alert('Error.'); window.location.href='index.php'</script>";
}

//if(!isset($_SESSION['nombre']) && !isset($_SESSION['contrasena']) && !isset($_SESSION['tipo']) && !isset($_SESSION['area']) ){
if(isset($_SESSION['id'])  && isset($_SESSION['tipo']) && isset($_SESSION['area']) ){
    //$comentario = $_POST['comentario'];
    $fecha = date("d-m-Y");
    $comentario = $_POST['comentario'];
    $admin =  $_POST['admin'];// 0 o 1
    $autor = $_POST['autor'];// 0 o 1
    $receptor = $_POST['receptor'];// 0 o 1
    $id_brecha =$_POST['brecha'];
    $id_autor_comentario = $_SESSION['id'];

    $sql = 'SELECT CONCAT(`nombre`," ",`pri_apellido`, " ",`seg_apellido`) as nombre, email, telefono  FROM `usuarios` WHERE `id` = '.$id_autor_comentario.' ';
        $result = $conexion -> query($sql);
        if($result->num_rows > 0){
            if($row = $result->fetch_array(MYSQLI_ASSOC)){
                $autor_comentario = $row['nombre'];
                $email_autor_comentario = $row['email'];
                $telefono_autor_comentario = $row['telefono'];
            }
        }

    $para ="";
    if ($admin == 1){
        $sql = 'SELECT `email` FROM `usuarios` WHERE `tipo_de_usuario` = 1 ';
        $result = $conexion -> query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_array(MYSQLI_ASSOC)){
                $para .= $row['email'].", ";
            }
        }   
    }
    if ($autor == 1){
        $sql = 'SELECT `email` FROM `usuarios` WHERE `area` = (SELECT `area` FROM `usuarios` WHERE `id` = (SELECT `autor` FROM `brechas` WHERE `id` = '.$id_brecha.'))';
        $result = $conexion -> query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_array(MYSQLI_ASSOC)){
                $para .= $row['email'].", ";
            }
        }   
    }
    if ($receptor == 1){
        $sql = 'SELECT `email` FROM `usuarios` WHERE `area` =  (SELECT `area` FROM `brechas` WHERE `id` = '.$id_brecha.')';
        $result = $conexion -> query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_array(MYSQLI_ASSOC)){
                $para .= $row['email'].", ";
            }
        }   
    }
    
    $sql = 'SELECT  a.NOMBRE_AREA as area,  `titulo`, `descripcion` FROM `brechas` b, areas a WHERE   b.`id` = '.$id_brecha.' and b.area = a.ID_AREA';
        $result = $conexion -> query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_array(MYSQLI_ASSOC)){
                $area = $row['area'];
                
                $titulo = $row['titulo'];
                $descripcion = $row['descripcion'];
            }
        }
    
    $para =  trim($para, ', ');
    $asunto = "Comentario en brecha";
    
    
    $contenido='<!DOCTYPE html>
    <html>
    <head>
    <title>HTML</title>
    </head>
    <body>
    <h1>Comentario en brecha </h1>
    <table border="1">
        <tr>
            <td>ID </td>
            <td>Titulo</td>
            <td>Descripción</td>
            <td>Area destino</td>

        </tr>
        <tr>
            <td>'.$id_brecha.'</td>
            <td>'.$titulo.'</td>
            <td>'.$descripcion.'</td>
            <td>'.$area.'</td>
        </tr>

    </table>
    <br>
    <label for="comentario" > <strong> Comentario:</strong></label>
    <p name="comentario" id="comentario">'.$comentario.'</p>
    <p>Enviado por: '.$autor_comentario.' '.$fecha.'</p>
    <label for="correo"> <strong> Correo:</strong></label>
    <p name="correo" id="correo">'.$email_autor_comentario.'</p>
    <label for="numero"><strong>Teléfono: </strong></label>
    <p name="numero" id="numero">'.$telefono_autor_comentario.'</p><br>

    <h3>Mensaje automático, no responder.</h3>
    </body>
    </html>';
    $encabezado = "From: Sistema Gestión de Brechas";
    if(mail($para, $asunto, $contenido, $encabezado)){
        echo "Comentario enviado exitosamente";
    }else{
        echo "Ha ocurrido un error. Intentelo nuevamente";
    }
    
}else{
    error();
}