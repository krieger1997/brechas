<?php
require "conecta.php";
$conexion = conecta();
session_name('brechas');
session_start();
function error(){
    echo "<script>alert('Error.'); window.location.href='index.php'</script>";
}

if(isset($_SESSION['id'])  && isset($_SESSION['tipo']) && isset($_SESSION['area']) && isset($_POST['id_brecha']) && $_SESSION['tipo']== 1 ){
    $id_brecha = $_POST['id_brecha'];
    $sql3="SELECT * FROM `cierres` WHERE `id_brecha` = $id_brecha";
        $result = $conexion -> query($sql3);
        if($result->num_rows > 0){
            if($row = $result->fetch_array(MYSQLI_ASSOC)){
                $sql2 = "DELETE FROM cierres WHERE id_brecha = $id_brecha";
                if (mysqli_query($conexion, $sql2)){
                    $resultado="¡Cierre de brecha eliminado exitosamente!";
                    $sql = "DELETE FROM `brechas` WHERE `id` =  $id_brecha";
                    if(mysqli_query($conexion,$sql)){
                        $resultado .="\n\n¡Brecha eliminada exitosamente!";


                    }else{
                        $resultado .= "\n\nError: " . $sql . "<br>" . mysqli_error($conexion);
                    }
                }else{
                    $resultado="Error: " . $sql2 . "<br>" . mysqli_error($conexion);
                }
            }
        }else{
            $sql = "DELETE FROM `brechas` WHERE `id` =  $id_brecha";
            if(mysqli_query($conexion,$sql)){
                $resultado ="¡Brecha eliminada exitosamente!";


            }else{
                $resultado = "Error: " . $sql . "<br>" . mysqli_error($conexion);
            }
        }
    
    
    
    
    
    echo $resultado;
    
    
    
    
    
    
    
    
}else{
    echo "Error";
}
