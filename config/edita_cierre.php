<?php
require "conecta.php";
$conexion = conecta();
session_name('brechas');
session_start();


$fecha=$_POST['fecha'];
$descripcion=$_POST['descripcion'];
$titulo=$_POST['titulo'];
//$brecha = $_POST['brecha'];
$cierre = $_POST['id_cierre'];
$borrar= $_POST['borrar'];


$nombre_img = $_FILES['imagen']['name'];
$tipo = $_FILES['imagen']['type'];
$tamano = $_FILES['imagen']['size'];

$resultado = "--";


if($borrar == 0){
    if( isset($_FILES['imagen']) && $nombre_img == !NULL ){ 
        if($_FILES['imagen']['type'] == "image/gif" || $_FILES['imagen']['type'] == "image/jpg"  || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png" ){
        //ruta donde se guardaran las fotos
        $directorio = $_SERVER['DOCUMENT_ROOT']."/brechas/cierres/";
        //$directorio = $_SERVER['DOCUMENT_ROOT']."/cierres/";//ESTE AL SUBIR
        //echo $directorio;
        if(move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img )){
        
            try {
                $sql="UPDATE `cierres` SET titulo = '$titulo', descripcion = '$descripcion', fecha='$fecha', imagen = '$nombre_img' WHERE id = $cierre";
                
                if(mysqli_query($conexion,$sql)){
                    $resultado ="¡Cierre editado exitosamente!";
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
        try {
            $sql="UPDATE `cierres` SET titulo = '$titulo', descripcion = '$descripcion', fecha='$fecha'  WHERE id = $cierre";
            if(mysqli_query($conexion,$sql)){
                $resultado ="¡Cierre editado exitosamente sin imagen!";
            }else{
                $resultado = "Error: " . $sql . "<br>" . mysqli_error($conexion);
            }

        } catch (Exception $ex) {
            $resultado = "Error ".$ex;
        }  
        
    }
    
}elseif ($borrar == 1){
    if( isset($_FILES['imagen']) && $nombre_img == !NULL ){ 
        if($_FILES['imagen']['type'] == "image/gif" || $_FILES['imagen']['type'] == "image/jpg"  || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png" ){
            try {
                $sql1= "SELECT `imagen` FROM `cierres` WHERE id = $cierre";
                $result1 = $conexion -> query($sql1);
                if($result1->num_rows > 0){
                    if($row1 = $result1->fetch_array(MYSQLI_ASSOC)){
                        $img_eliminar=$row1['imagen'];
                        $directorio2 = $_SERVER['DOCUMENT_ROOT']."/brechas/cierres/".$img_eliminar;
                       // $directorio2 = $_SERVER['DOCUMENT_ROOT']."/cierres/".$img_eliminar;//ESTE AL SUBIR
                        
                        $directorio = $_SERVER['DOCUMENT_ROOT']."/brechas/cierres/";
                       // $directorio = $_SERVER['DOCUMENT_ROOT']."/cierres/";//ESTE AL SUBIR
                        
                        if(move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img )){

                            $sql="UPDATE `cierres` SET titulo = '$titulo', descripcion = '$descripcion', fecha='$fecha', imagen = '$nombre_img' WHERE id = $cierre";

                            if(mysqli_query($conexion,$sql)){
                                $resultado ="¡Cierre editado exitosamente!";
                                unlink($directorio2);
                            }else{
                                $resultado = "Error: " . $sql . "<br>" . mysqli_error($conexion);

                            }

                             

                        }//fin del if move_uploaded
                        
                        
                        



                    }
                }



            } catch (Exception $ex) {
                $resultado = "Error ".$ex;
            }
        
        }
    }else{//UPDATE `brechas` SET titulo = '$titulo', descripcion = '$descripcion', fecha='$fecha', `imagen` = NULL WHERE `brechas`.`id` = $brecha; 
        try{
            $sql1= "SELECT `imagen` FROM `cierres` WHERE id = $cierre";
                $result1 = $conexion -> query($sql1);
                if($result1->num_rows > 0){
                    if($row1 = $result1->fetch_array(MYSQLI_ASSOC)){
                        $img_eliminar=$row1['imagen'];
                        $directorio2 = $_SERVER['DOCUMENT_ROOT']."/brechas/cierres/".$img_eliminar;
                        $sql="UPDATE `cierres` SET titulo = '$titulo', descripcion = '$descripcion', fecha='$fecha', imagen = NULL WHERE id = $cierre";
                        if(mysqli_query($conexion,$sql)){
                            $resultado ="¡Cierre editado exitosamente!";
                            unlink($directorio2);
                        }else{
                            $resultado = "Error: " . $sql . "<br>" . mysqli_error($conexion);

                        }
                        
                        
                    }
                }
            
            
            
        } catch (Exception $ex) {
            $resultado = "Error ".$ex;
        }
        
        
    }
    
    
}else{
    $resultado = "Ha ocurrido un error";
}






//if( isset($_FILES['imagen']) && $nombre_img == !NULL ){ 
//    if($_FILES['imagen']['type'] == "image/gif" || $_FILES['imagen']['type'] == "image/jpg"  || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png" ){
//        //ruta donde se guardaran las fotos
//        $directorio = $_SERVER['DOCUMENT_ROOT']."/brechas/subidas/";
//        //echo $directorio;
//        if(move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img )){
//        
//            try {
//                $sql="INSERT INTO `brechas`( `area`, `fecha`, `titulo`, `descripcion`, `autor`, `imagen`) VALUES ($area, '$fecha', '$titulo', '$descripcion', $autor, '$nombre_img')";
//                if(mysqli_query($conexion,$sql)){
//                    $resultado ="¡Brecha creada exitosamente!";
//                }else{
//                    $resultado = "Error: " . $sql . "<br>" . mysqli_error($conexion);
//
//                }
//
//            } catch (Exception $ex) {
//                $resultado = "Error ".$ex;
//            }  
//        
//        }//fin del if move_uploaded
//        
//    }else{
//        $resultado = "error de formato de imagen";
//    }
//}else{
//    
//    $sql="INSERT INTO `brechas`( `area`, `fecha`, `titulo`, `descripcion`, `autor`) VALUES ($area, '$fecha', '$titulo', '$descripcion', $autor)";
//    if(mysqli_query($conexion,$sql)){
//        $resultado ="¡Brecha creada exitosamente sin imagen!";
//    }else{
//        $resultado = "Error: " . $sql . "<br>" . mysqli_error($conexion);
//
//    }
//}
//
//
//
//
//
//
//try {
//    $sql="UPDATE `brechas` SET titulo = '$titulo', descripcion = '$descripcion', fecha='$fecha'  WHERE id = $brecha";
//    if(mysqli_query($conexion,$sql)){
//        $resultado ="¡Brecha editada exitosamente!";
//    }else{
//        $resultado = "Error: " . $sql . "<br>" . mysqli_error($conexion);
//    }
//
//} catch (Exception $ex) {
//$resultado = "Error ".$ex;
//}  

echo $resultado;
exit();