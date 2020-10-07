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
    $id_brecha = $_POST['id_brecha'];
    $sql = 'SELECT b.area as area_brecha, DATE_FORMAT(fecha, "%d/%m/%Y") as fecha, `titulo`, `descripcion`, CONCAT(u.nombre, " ",u.seg_nombre, " ",u.pri_apellido, " ",u.seg_apellido) as nombre_completo , `imagen`, `estado`, rut, email, u.telefono FROM `brechas` b, usuarios u  WHERE b.id = '.$id_brecha.' and b.autor = u.id';
    $result = $conexion -> query($sql);
    if($result->num_rows > 0){
        if($row = $result->fetch_array(MYSQLI_ASSOC)){
            $titulo = $row['titulo'];
            $fecha = $row['fecha'];
            $nombre = $row['nombre_completo'];
            $descripcion = $row['descripcion'];
            $imagen = $row['imagen'];
            $rut = $row['rut'];
            $email = $row['email'];
            $telefono = $row['telefono'];
            $area_brechas = $row['area_brecha'];
            
            
        
            echo "<div id='respuesta' class='container mt-5 shadow-lg p-3 mb-5   rounded'>";
            echo "<h2 class='text-center font-weight-bold '>".$titulo."</H2>";

            echo'<div class= "row"> <div class="col"></div>    
                <div class="col">    <H4 class=" text-center">Información de autor</H4></div>
                <div class="col"></div></div>';
            echo'<div class= "row"> <div class="col font-weight-bold text-right">
              Rut:
            </div><div class="col">
              '.$rut.'
            </div>    <div class="col"></div></div>';
            echo'<div class= "row"> <div class="col font-weight-bold text-right">
              Teléfono:
            </div><div class="col">
              '.$telefono.'
            </div><div class="col"></div>    </div>';
            echo'<div class= "row"> <div class="col font-weight-bold text-right">
              Nombre:
            </div>    <div class="col">
              '.$nombre.'
            </div><div class="col"></div></div>';
            echo'<div class= "row"> <div class="col font-weight-bold text-right">
              Correo:
            </div>    <div class="col">
              '.$email.'
            </div><div class="col"></div></div>';



            echo'<div class= "row mt-5"> <div class="col"></div>    
                <div class="col">    <H4 class=" text-center">Información de brecha</H4></div>
                <div class="col"></div></div>';
            echo'<div class= "row"> <div class="col font-weight-bold text-right">Descripción:</div>    
                <div class="col">'.$descripcion.'</div>
                <div class="col"></div></div>';
            echo'<div class= "row"> <div class="col font-weight-bold text-right">Fecha:</div>    
                <div class="col">'.$fecha.'</div>
                <div class="col"></div></div>';
            
            if ($imagen != ''){
                echo'<div class= "row"> <div class="col font-weight-bold text-right">Imagen:</div>    
                <div class="col "></div>
                <div class="col"></div></div>';
                echo '<div class="mt-3 text-center "><img src="../subidas/'.$imagen.'" class="img-fluid" alt="Responsive image" style=" "></div>';
            }
            
            if ($_SESSION['area'] == $area_brechas OR $_SESSION['tipo'] == 1){
                echo '<button type="button" class="btn btn-warning btn-lg btn-block mt-2 font-weight-bold">Cerrar brecha</button>';
            }
            if ($_SESSION['area'] == 0 or $_SESSION['tipo'] == 1 ){//COMENTARIOS
                //modal para comentarios uwu
            }

            
            echo '<script> </script>';
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
        }
    }else{
         echo "<div id='respuesta' class='container mt-5 shadow-lg p-3 mb-5   rounded'>";
        echo "ERRORRRRRRRRRRRRRRRR";
        echo"</div>";
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    echo "</div>";

}else{
    echo "<div id='respuesta'>";
    echo "<H1>ERROR</H1>";
    echo "</div>";
}
       
    
    

?>
