<?php 
require 'configuracionPaginas.php';
require 'conecta.php';
$conexion = conecta();
head("Brechas");
?>
<div class="container" >
<?php
session_name('brechas');
session_start();
//if(isset($_SESSION['id'])  && isset($_SESSION['tipo']) && isset($_SESSION['area']) && isset($_POST['estado']) && isset($_POST['area']) ){
if(isset($_SESSION['id'])  && isset($_SESSION['tipo']) && isset($_SESSION['area']) && isset($_GET['estado']) && isset($_GET['area'])  ){
    
    echo "<script>            $('.salir').show();                </script>";
    $estado = $_GET['estado'];
    $area = $_GET['area'];
    
    $sql="SELECT `ID_AREA`, `NOMBRE_AREA` FROM `areas` WHERE `ID_AREA` = $area";
    $result = $conexion -> query($sql);
    if($result->num_rows > 0){
        if($row = $result->fetch_array(MYSQLI_ASSOC)){
            echo "<h2 class='mb-3 text-center'>Brechas <SPAN CLASS='font-weight-bold'> ".$estado."S</SPAN> en ".$row['NOMBRE_AREA']."</h2>";
        }
    }
    
    
    echo '<div class="list-group">';
    
    $sql="SELECT `id`, `area`, DATE_FORMAT(fecha, '%d/%m/%Y') as fecha_formateada, `titulo`, `descripcion`, `autor`, `imagen`, `estado` FROM `brechas` WHERE `area` = $area AND `estado` = '$estado'";
    $result = $conexion -> query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            echo '<a href="#" class="list-group-item list-group-item-action" id="'.$row['id'].'">'.$row['fecha_formateada'].' - ' .$row['titulo'] .' - ' . $row['descripcion'] .'</a>';
        }
    }
    
    


    echo '</div>';
    
    
    
    
    
    
    
    
    
    
}else{
    vuelve1();
}



?>
</div>
    </body>
</html>
