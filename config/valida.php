<?php
require "conecta.php";
$conexion = conecta();
session_name('brechas');
session_start();
function error(){
    echo "<script>alert('Error al iniciar sesión.'); window.location.href='index.php'</script>";
}

//if(!isset($_SESSION['nombre']) && !isset($_SESSION['contrasena']) && !isset($_SESSION['tipo']) && !isset($_SESSION['area']) ){
if(!isset($_SESSION['id'])  && !isset($_SESSION['tipo']) && !isset($_SESSION['area']) ){
    $usuario = $_POST['usuario'];
    $contrasena =  $_POST['contrasena'];
    $sql = "SELECT id, nombre_de_usuario, contrasena, tipo_de_usuario, area FROM usuarios WHERE nombre_de_usuario = '$usuario' and contrasena = '$contrasena'";
    $result = $conexion -> query($sql);
    if($result->num_rows > 0){
        if($row = $result->fetch_array(MYSQLI_ASSOC)){
            $tipo = $row['tipo_de_usuario'];
            $area = $row['area'];
            $id = $row['id'];
           // $_SESSION['usuario']= $usuario;
            //$_SESSION['contrasena']=$contrasena;
            $_SESSION['tipo'] = $tipo;
            $_SESSION['area'] = $area;
            $_SESSION['id']=$id;
            
            despliega_menu($conexion);
            //echo '<div class="alert alert-dark" role="alert">  EL TIPO DE USUARIO ES '.$tipo.' Y la sesion id es: </div>';
            /*echo '<div class="row row-cols-3">';
            $sql = "SELECT `ID_AREA`, `NOMBRE_AREA` FROM `areas`";
            $res = $conexion->query($sql);
            if ($res->num_rows > 0){
                while ($row = $res->fetch_array(MYSQLI_ASSOC) ){
                    echo '<div class="col">'.$row['NOMBRE_AREA'].'</div>';
                    
                }
            }
            echo '</div>';*/
            //echo session_id();
            echo "<script>
                $('#logeo').hide();
                $('.salir').show();
                </script>";
            if ($_SESSION['tipo'] == 1){
            echo "<script>
            $('.admin').show();
                </script>";
        }

        }else{
            error();
        }
    }else{
        error();
    }
}
       
    
    

?>

