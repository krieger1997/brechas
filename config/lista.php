<?php 
require 'configuracionPaginas.php';
require 'conecta.php';
$conexion = conecta();
head("Brechas");
?>

<?php
session_name('brechas');
session_start();
//if(isset($_SESSION['id'])  && isset($_SESSION['tipo']) && isset($_SESSION['area']) && isset($_POST['estado']) && isset($_POST['area']) ){
if(isset($_SESSION['id'])  && isset($_SESSION['tipo']) && isset($_SESSION['area']) && isset($_GET['estado']) && isset($_GET['area'])  ){
    
    //boton para volver a mostrar lista, inicia invisible
    echo '<button type="button" onclick="muestra_lista();" id="muestra_brecha" class="btn btn-outline-light float-left ml-5">Mostrar brechas</button>';
    
    echo '<div class="container" >';
    echo "<script>$('.salir').show();</script>";
    $estado = $_GET['estado'];
    $area = $_GET['area'];
    
    //titulo
    $sql="SELECT `ID_AREA`, `NOMBRE_AREA` FROM `areas` WHERE `ID_AREA` = $area";
    $result = $conexion -> query($sql);
    if($result->num_rows > 0){
        if($row = $result->fetch_array(MYSQLI_ASSOC)){
            echo "<h2 class='mb-3 text-center'>Brechas <SPAN CLASS='font-weight-bold'> ".$estado."S</SPAN> en ".$row['NOMBRE_AREA']."</h2>";
        }
    }
    
    echo "<div id='contenido'>";//div de contenido dinamico
    echo '<div class="list-group " id="lista_brechas">';//lista
    $sql="SELECT `id`, `area`, DATE_FORMAT(fecha, '%d/%m/%Y') as fecha_formateada, `titulo`, `descripcion`, `autor`, `imagen`, `estado` FROM `brechas` WHERE `area` = $area AND `estado` = '$estado'";
    $result = $conexion -> query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            //elementos de la lista
            echo '<a href="#"  onclick="detalle($(this).attr(\'id\'));"  class="list-group-item list-group-item-action lista" id="'.$row['id'].'">'.$row['fecha_formateada'].' - ' .$row['titulo'] .' - ' . $row['descripcion'] .'</a>';
        }
    }else{
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>¡Vaya!</strong> No hay nada aquí.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="x"  onclick="vuelve();">
              <span aria-hidden="true">&times;</span>
            </button>
            <script>function vuelve(){window.history.back();
            }
            
            $(document).ready(function(){
                //setTimeout(alert("aa"),2000);
                setTimeout(function(){$("#x").css("background-color", "black" );},2500);
                var n = 1;
                setInterval(function(){
                atencion(n);
                n++;
                },500);
            });


            function atencion(num){
                if(num%2==0){
                    $("#x").css("background-color", "black" );
                }else{
                    $("#x").css( "background-color", "transparent" );
                }
            }

            </script>
          </div>';
    }
    echo '</div>';
    echo '</div>';
     echo"<script>
    function detalle(id_brecha){
             
          $.ajax({
                url: 'detalle.php',
                type: 'POST',
                data: 'id_brecha='+id_brecha,
                success: function(resp){
                        //$('#contenido').html(resp);                        
                        $('#contenido').append(resp);                        
                        $('#lista_brechas').hide(); // oculta div lista
                        $('#muestra_brecha').show(500); //boton de mostrar lista    
                }
        });
    }
    
    //vuelve a mostrar la lista y oculta el boton
    function muestra_lista(){
        
        $('#respuesta').remove(); // elimina el div respuesta, que viene de detalle.php 
        $('#lista_brechas').show(); // muestra lista (no funciona)
        $('#muestra_brecha').hide(500);//boton de mostrar lista 
        //$('#respuesta').hide(); //oculta respuesta
    }

</script>";
    
    
    
    
    
    
    
    
    
    
}else{
    vuelve1();
}



?>
</div>
    </body>
    
    </html>
