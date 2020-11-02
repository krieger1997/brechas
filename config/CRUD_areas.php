<?php

require 'configuracionPaginas.php';
require 'conecta.php';
$conexion = conecta();
head("Brechas");
session_name('brechas');
session_start();
function error(){
    echo "<script>alert('Error.'); window.location.href='../index.php'</script>";
}

if(isset($_SESSION['id'])  && isset($_SESSION['tipo']) && isset($_SESSION['area']) && $_SESSION['tipo'] == 1   ){
    echo '<div class="container" style="background-color: rgba(255, 255, 255, 0.8);">';
    echo '<table class="table table-hover"  >
  <thead  class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre de área</th>
      <th scope="col"><button type="button" class="btn btn-primary p-1 " data-toggle="modal" data-target="#modalAgregaArea">Nuevo</button><br>Acción</th>
      <div class="modal fade" id="modalAgregaArea" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Nueva área</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="return false" onsubmit="return false" method="POST" autocomplete="off" >
                        <div class="form-group">
                            <label for="txtNombreArea">Nombre de área</label>
                            <input type="text"    class="form-control" required id="txtNombreArea" autocomplete="nope" maxlength="50" placeholder="Ej: Adquisiciones y Abastecimiento">
                        </div>                    
                </div>
                <div class="modal-footer">
                <div class="text-center" id = "loading" style="display:none;">
                        <div class="spinner-border" role="status">
                          <span class="sr-only">Cargando...</span>
                        </div>
                      </div>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                  <button type="button" class="btn btn-primary" id="btn" onclick="agrega_area( $(\'#txtNombreArea\').val()  )">GUARDAR</button>
                  </form>
                </div>
              </div>
            </div>
            </div>
            ';
    echo "<script>
    function agrega_area(nombreArea){  
    $('#loading').show();$('#btn').prop('disabled', true);
        $.ajax({
                url: 'agrega_area.php',
                type: 'POST',
                data: 'nombreArea='+nombreArea,
                success: function(resp1){
                    $('#loading').hide(); $('#btn').prop('disabled', false);
                        if(resp1 == 0){
                            alert('¡Área creada exitosamente!');
                            location.reload();
                        }else{
                            alert(resp1);
                        }
                        
                }
        });
    }
</script>";
    echo '</tr>
  </thead>
  <tbody >';
    $sql="SELECT `ID_AREA`, `NOMBRE_AREA` FROM `areas`";
    $result = $conexion -> query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            echo '<tr>';
            echo '<th scope="row">'.$row['ID_AREA'].'</th>';
            echo '<td>'.utf8_encode($row['NOMBRE_AREA']).'</td>';
            echo'<td class="p-1">
                
            <button type="button" class="btn btn-outline-danger p-1 elimina2 " id="'.$row['ID_AREA'].'"     >
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                  </svg>
            </button>   
            

            <button type="button" class="btn btn-outline-warning p-1 edita2 " id="'.$row['ID_AREA'].'">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
              </svg> 
            </button>

            
            </TD></tr>';

        }
        
        echo "<script>   
            var id;
            function elimina_area(id)
                {
                        $.ajax({
                                url: 'elimina_area.php',
                                type: 'POST',
                                data: 'id='+id,
                                success: function(resp){
                                        alert(resp);
                                        location.reload();
                                }
                        });
                }
            $(document).ready(function() {
                    $('.elimina2').on('click', function(event) {
                            let id = this.id;
                            var r = confirm('¿Está segur@ de que desea eliminar esta área');
                            if (r == true) {
                                elimina_area(id);
                            }     
                 });
                 
                 $('.edita2').on('click', function(event) {
                            id = this.id;
                            $.ajax({
                                url: 'lector2.php',
                                type: 'POST',
                                data: {id:id},
                                dataType: 'json',
                                success: function(resp){
                                        $('#txtNombreArea_ed').val(resp.NOMBRE_AREA);
                                        $('#modalEditaArea').modal('show'); 


                                }
                        });     
                 });

                 
               });        
        </script>";
                //EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION 
        
        echo "<script>function edita_area(nombreArea){
            $('#loading').show();$('#btn').prop('disabled', true);
        
        var formDatax2 = new FormData();
        formDatax2.append('nombreArea',nombreArea);

        formDatax2.append('id',id);
        
        $.ajax({
                url: 'edita_area.php',
                type: 'POST',
                data: formDatax2,
                contentType: false,
                processData: false,
                success: function(resp){
                
$('#loading').hide(); $('#btn').prop('disabled', false);
                        if(resp == 1){
                            alert('¡Área editada exitosamente!');
                            location.reload();
                        }else{
                            alert(resp);
                        }
                        
                }
            });
        }
    
</script>";
        echo '<div class="modal fade" id="modalEditaArea" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Editar área</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="return false" onsubmit="return false" method="POST" autocomplete="off" >
                        <div class="form-group">
                            <label for="txtNombreUsuario_ed">Nombre de área</label>
                            <input type="text"  name="txtNombreArea_ed"  class="form-control" required id="txtNombreArea_ed" autocomplete="nope" maxlength="50" placeholder="Ej: Adquisiciones y Abastecimiento">
                        </div>
                        
                        
                    
                </div>
                <div class="modal-footer">
                <div class="text-center" id = "loading" style="display:none;">
                        <div class="spinner-border" role="status">
                          <span class="sr-only">Cargando...</span>
                        </div>
                      </div>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                  <button type="button" class="btn btn-primary" id="btn" onclick="edita_area( $(\'#txtNombreArea_ed\').val() )">GUARDAR</button>
                  </form>
                </div>
              </div>
            </div>
            </div>';
        
    }
    echo '  </tbody>
</table>';
    echo '</div><script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>';
    
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    echo '</div>'; //fin container
}else{
    error();
}
