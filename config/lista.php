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
//    echo '<button type="button" class="btn btn-outline-dark align-middle ml-4 float-left" onclick="javascript:location.href=`../index.php`"  >
//                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left-square-fill mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
//                    <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm9.5 8.5a.5.5 0 0 0 0-1H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5z"/>
//                </svg>Volver
//        </button>';
    
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
            echo"<div class='m-auto' style='width:80%;'>";
            echo "<h2 class='mb-3 text-center'>Brechas <SPAN CLASS='font-weight-bold'> ".$estado."S</SPAN> en ".utf8_encode($row['NOMBRE_AREA'])."</h2>";
            echo "</div>";
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
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="x"  onclick="javascript:location.href=`../index.php`">
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
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>
    
    </html>
