<?php
 function conecta(){
$host="localhost";
$user="root";
$pass="Zoolitario  1";
$db="brechas";
$conexion = mysqli_connect($host,$user,$pass,$db) or die ("Error al conectar a la bd ");
return $conexion;
}
function despliega_menu($conexion){
    echo "<div style='background-color: #F26852'>A</div>";
    echo '<div class="row row-cols-3">';
    $sql = "SELECT `ID_AREA`, `NOMBRE_AREA` FROM `areas`";
    $res = $conexion->query($sql);
    if ($res->num_rows > 0){
        while ($row = $res->fetch_array(MYSQLI_ASSOC) ){
            echo '<div class="col"><button type="button" class="btn btn-secondary btn-lg ivana">'.$row['NOMBRE_AREA'].'</button></div>';

        }
    }
    echo '</div>';
}
?>

