<?php
require "conecta.php";
$conexion = conecta();

if(isset($_POST['area'])){
    $area = $_POST['area'];
    $sql="SELECT  `NOMBRE_AREA` as n FROM `areas` WHERE ID_AREA = $area";
    $result = $conexion -> query($sql);
    if($result->num_rows > 0){
        if($row = $result->fetch_array(MYSQLI_ASSOC)){
            $area_titulo = $row['n'];
        }
    }
    $sql="SELECT COUNT(*) as ab FROM brechas where `estado` = 'ABIERTO'  and area = $area";
    $result = $conexion -> query($sql);
    if($result->num_rows > 0){
        if($row = $result->fetch_array(MYSQLI_ASSOC)){
            $abierto = $row['ab'];
        }
    }
    $sql="SELECT COUNT(*) as pen FROM brechas where `estado` = 'PENDIENTE'  and area = $area";
    $result = $conexion -> query($sql);
    if($result->num_rows > 0){
        if($row = $result->fetch_array(MYSQLI_ASSOC)){
            $pendiente = $row['pen'];
        }
    }
    $sql="SELECT COUNT(*) as cer FROM brechas where `estado` = 'CERRADO'  and area = $area";
    $result = $conexion -> query($sql);
    if($result->num_rows > 0){
        if($row = $result->fetch_array(MYSQLI_ASSOC)){
            $cerrado = $row['cer'];
        }
    }
    
    
    echo"<h1 class='font-weight-bold text-center'>".$area_titulo."</h1>";
    echo '<div class="row row-cols-7" id="botones">';
        echo '<div class="col"></div>';
        echo '<div class="col"><button type="button" class="btn btn-danger" id="ABIERTO">Brechas abiertas<br><span class="badge badge-light">'.$abierto.'</span></button></div>';
        echo '<div class="col"></div>';
        echo '<div class="col"><button type="button" class="btn btn-warning" id="PENDIENTE">Brechas pendientes<br><span class="badge badge-light">'.$pendiente.'</span></button></div>';
        echo '<div class="col"></div>';
        echo '<div class="col"><button type="button" class="btn btn-success" id="CERRADO">Brechas cerradas<br><span class="badge badge-light">'.$cerrado.'</span></button></div>';
        echo '<div class="col"></div>';
    echo '</div>';
    
    echo"
<script>
    $(document).ready(function(){
      $('body #botones').on('click', 'button', function(){
        var estado = $(this).attr('id');
        var area =".$area.";
        
        $.ajax({
            data: 'estado='+ estado+'&area='+area,
            url:'config/lista.php',
            type:'POST',
            success: function() {
                $(location).attr('href','config/lista.php');
                
             }  
            });
        

      });
    });
    
    

</script>";


    
    //MODAL
    
    echo '<div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Brecha para '.$area_titulo.'</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="return false" onsubmit="return false" method="POST">
                        <div class="form-group">
                            <label for="txtTitulo">Título</label>
                            <input type="text"  name="txtTitulo"  class="form-control" required id="txtTitulo" placeholder="Título">
                        </div>
                        <div class="form-group">
                            <label for="txtTitulo">Descripción</label>
                            <textarea rows="5" cols="10"  name="txtDescripcion" required class="form-control" id="txtDescripcion" placeholder="Descripción"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="txtTitulo">Fecha</label>
                            <input type="date"  name="txtFecha"  class="form-control" required id="txtFecha" value="'.date("Y-m-d").'">
                        </div>
                    
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                  <button type="button" class="btn btn-primary" onclick="crea_brecha( $(\'#txtTitulo\').val() , $(\'#txtDescripcion\').val() , $(\'#txtFecha\').val() )">GUARDAR</button>
                  </form>
                </div>
              </div>
            </div>
            </div>';
    echo '<button type="button" class="btn btn-primary btn-lg btn-block mt-5" data-toggle="modal" data-target="#exampleModalCenter" id="crea">Crear brecha</button>';
    
    echo "<script>
	function crea_brecha(titulo, descripcion, fecha)
	{
        var area = ".$area.";
		$.ajax({
			url: 'config/crea_brecha.php',
			type: 'POST',
			data: 'titulo='+titulo+'&descripcion='+descripcion+'&fecha='+fecha+'&area='+area,
			success: function(resp){
				//$('#contenido').html(resp);
                                alert(resp);
                                $('body').removeClass('modal-open');
                                $('.modal-backdrop').remove();
                                $('#resumen').load(' #resumen');
			}
		});
	}
        </script>";
    
    echo "<script>$('#resumen').show();</script>";
}

