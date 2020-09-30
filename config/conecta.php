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
   //echo "<div style='background-color: #F26852'>".$_SESSION['area']."</div>";
    
    echo '<div class="row row-cols-3">';
    $sql = "SELECT `ID_AREA`, `NOMBRE_AREA` FROM `areas`";
    $res = $conexion->query($sql);
    if ($res->num_rows > 0){
        while ($row = $res->fetch_array(MYSQLI_ASSOC) ){
            echo '<div class="col"><button type="button" class="btn btn-secondary btn-lg salmon" id="'.$row['ID_AREA'].'" style="width:100%; margin-top:15%;">'.$row['NOMBRE_AREA'].'</button></div>';
        }
    }
    echo "<script>"
    . "function resumen(area)
	{
		$.ajax({
			url: 'config/resumen.php',
			type: 'POST',
			data: 'area='+area,
			success: function(resp){
				$('#resumen').html(resp);
			}
		});
	}"
    . "$(function() {"
    . "        $(document).on('click', 'button[type=\"button\"]', function(event) {
                    let id = this.id;
                    if (id != 'crea'){
                        resumen(id);
                    }

                    
         });
       });</script>";
    
    echo '</div>';
    echo '<div class="container mt-10 shadow-lg p-3 mb-5  rounded resumen"  id="resumen" >';
   /* echo"<h1 class='font-weight-bold text-center'>TITULO</h1>";
        echo '<div class="row row-cols-7">';
            echo '<div class="col"></div>';
            echo '<div class="col"><button type="button" class="btn btn-danger">Brechas abiertas<br><span class="badge badge-light">0</span></button></div>';
            echo '<div class="col"></div>';
            echo '<div class="col"><button type="button" class="btn btn-warning">Brechas pendientes<br><span class="badge badge-light">0</span></button></div>';
            echo '<div class="col"></div>';
            echo '<div class="col"><button type="button" class="btn btn-success">Brechas cerradas<br><span class="badge badge-light">0</span></button></div>';
            echo '<div class="col"></div>';
        echo '</div>';*/
    echo '</div>';

}
?>

