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
    $sql = 'SELECT b.area as area_brecha, DATE_FORMAT(fecha, "%d/%m/%Y") as fecha,DATE_FORMAT(fecha, "%Y-%m-%d") as fecha2, `titulo`, `descripcion`, CONCAT(u.nombre, " ",u.seg_nombre, " ",u.pri_apellido, " ",u.seg_apellido) as nombre_completo , `imagen`, `estado`, rut, email, u.telefono, b.autor as autor FROM `brechas` b, usuarios u  WHERE b.id = '.$id_brecha.' and b.autor = u.id';
    $result = $conexion -> query($sql);
    if($result->num_rows > 0){
        if($row = $result->fetch_array(MYSQLI_ASSOC)){
            $titulo = $row['titulo'];
            $fecha = $row['fecha'];
            $fecha2 = $row['fecha2'];
            $nombre = $row['nombre_completo'];
            $descripcion = $row['descripcion'];
            $imagen = $row['imagen'];
            $rut = $row['rut'];
            $email = $row['email'];
            $telefono = $row['telefono'];
            $area_brechas = $row['area_brecha'];
            $id_autor = $row['autor'];
            $sql ="SELECT `area` FROM `usuarios` WHERE `id` = $id_autor";
            $result = $conexion -> query($sql);
            if($result->num_rows > 0){
                if($row2 = $result->fetch_array(MYSQLI_ASSOC)){
                       $area_autor = $row2['area'];
                }
            }
           
            
        
            echo "<div id='respuesta' class='container mt-5 shadow-lg p-3 mb-5   rounded'>";
            
            
            echo'<div class= "row"> <div class="col"></div>
                <div class="col-8">  ';
            echo "<h2 class='text-center font-weight-bold '>".$titulo."</H2>";
            echo '</div>      <div class="col">';
            
             if ($_SESSION['area'] == $area_autor OR $_SESSION['tipo'] == 1){
                echo '<button type="button"  class="btn btn-outline-light float-right  font-weight-bold" id="editar" data-toggle="modal" data-target="#modalEdita">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                    </svg>
                 Editar
                </button>';
                
                echo '<div class="modal fade" id="modalEdita" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Edición de brecha</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="return false" onsubmit="return false" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="txtTitulo">Título</label>
                            <input type="text"  name="txtTitulo"  class="form-control" required id="txtTitulo2" placeholder="Título" value="'.$titulo.'">
                        </div>
                        <div class="form-group">
                            <label for="txtTitulo">Descripción</label>
                            <textarea rows="5" cols="10"  name="txtDescripcion" required class="form-control" id="txtDescripcion2" placeholder="Descripción">'.$descripcion.'</textarea>
                        </div>
                        <div class="form-group">
                            <label for="txtTitulo">Fecha</label>
                            <input type="date"  name="txtFecha"  class="form-control" required id="txtFecha2" value="'.$fecha2.'">
                        </div>
                        ';
                echo '<div class="form-group">
                            <label for="txtImagen">Imagen</label>';
                if ($imagen != ''){
                    echo'<input type="file"  name="txtImagen" accept="image/png, .jpeg, .jpg, image/gif"  class="form-control-file " id="txtImagen" style="display:none;">';                       
                    echo'<button type="button" class="btn btn-light" onclick="borra_img();" id="btn_imagen"><img src="../subidas/'.$imagen.'"  class="img-thumbnail" alt="Responsive image" id="img1"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                  </svg></button>';
                    echo '<script>
                        function borra_img(){
                            
                            var r = confirm("¿Desea eliminar esta imagen?");
                            if (r == true) {
                                $("#txtImagen").show();
                                $("#btn_imagen").hide();
                            } else {
                                
                            } 
                        }                        
                        
                        </script>';
                    echo "<script>
                            function edita_brecha(titulo, descripcion, fecha)
                            {
                            //var area = ".$area.";
                            var formData = new FormData();
                            formData.append('titulo', titulo);
                            formData.append('descripcion',descripcion);
                            formData.append('fecha',fecha);
                            //formData.append('area',area);

                            //formData.append('imagen',imagen);
                            var id_brecha = ".$id_brecha.";
                                formData.append('brecha',id_brecha);


                                    $.ajax({
                                            url: 'edita_brecha.php',
                                            type: 'POST',
                                            data: formData,
                                            contentType: false,
                                            processData: false,
                                            success: function(resp){
                                                    //$('#contenido').html(resp);
                                                    alert(resp);
                                                    $('body').removeClass('modal-open');
                                                    $('.modal-backdrop').remove();
                                                    //$('#resumen').load(' #resumen');
                                                     location.reload();
                                            }
                                    });
                            }


                            </script>";
                }else{
                       echo'<input type="file"  name="txtImagen" accept="image/png, .jpeg, .jpg, image/gif"  class="form-control-file" id="txtImagen" >';   
                       echo "<script>
                                function edita_brecha(titulo, descripcion, fecha)
                                {
                                //var area = ".$area.";
                                var formData = new FormData();
                                formData.append('titulo', titulo);
                                formData.append('descripcion',descripcion);
                                formData.append('fecha',fecha);
                                //formData.append('area',area);

                                //formData.append('imagen',imagen);
                                var id_brecha = ".$id_brecha.";
                                    formData.append('brecha',id_brecha);


                                        $.ajax({
                                                url: 'edita_brecha.php',
                                                type: 'POST',
                                                data: formData,
                                                contentType: false,
                                                processData: false,
                                                success: function(resp){
                                                        //$('#contenido').html(resp);
                                                        alert(resp);
                                                        $('body').removeClass('modal-open');
                                                        $('.modal-backdrop').remove();
                                                        //$('#resumen').load(' #resumen');
                                                         location.reload();
                                                }
                                        });
                                }


                                </script>";
                }
                echo ' </div>';
                 if ($imagen != ''){
                     
                 }else{
                     echo ' </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" >CERRAR</button>
                  <button type="button" class="btn btn-primary" onclick="edita_brecha( $(\'#txtTitulo2\').val() , $(\'#txtDescripcion2\').val() , $(\'#txtFecha2\').val()  )">GUARDAR</button>
                  </form>
                </div>
              </div>
            </div>
            </div>';
                 }
                
                

                
            }
            
            echo '</div></div>';
           
            
 
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
            
            if ($_SESSION['area'] == '0' or $_SESSION['tipo'] == 1 ){//COMENTARIOS
                //modal para comentarios 
                echo '<div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalCenterTitle">Comentarios a brecha</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <form action="return false" onsubmit="return false" method="POST" >
                                
                                    
                                    <div class="form-group">
                                        <label for="txtTitulo">Comentario</label>
                                        <textarea class="form-control" id="txtComentario" name="txtComentario" rows="4" placeholder="Ingrese comentario aquí" required></textarea>
                                      </div><label>Enviar a:</label>
                                      <div class="form-check">
                                      
                                        <input type="checkbox" class="form-check-input" id="chAutor" name="chAutor" >
                                        <label class="form-check-label" for="exampleCheck1">Area autora</label>
                                        </div><div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="chReceptor" name="chReceptor" >
                                        <label class="form-check-label" for="exampleCheck1">Area receptora</label>
                                        </div><div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="chAdmin" name="chAdmin" >
                                        <label class="form-check-label" for="exampleCheck1">Administrador</label>
                                      </div>
                                    
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                              <button type="button" class="btn btn-primary" onclick="comentario( $(\'#txtComentario\').val())">GUARDAR</button>
                              </form>
                            </div>
                          </div>
                        </div>
                        </div>';
                echo '<button type="button" class="btn btn-info btn-lg btn-block mt-5" data-toggle="modal" data-target="#exampleModalCenter" >Comentar</button>';
                echo "<script> 
                    function comentario(contenido){
                                var autor = 0;
                                var receptor = 0;
                                var admin = 0;
                                
                                if( $('#chAutor').prop('checked') ) {
                                    var autor = 1;
                                }
                                if( $('#chReceptor').prop('checked') ) {
                                    var receptor = 1;
                                }
                                if( $('#chAdmin').prop('checked') ) {
                                    var admin = 1;
                                }
                                
                                if(admin == 1 || receptor == 1 || autor == 1){
                                     if(contenido !=''){   
                                            $.ajax({
                                                url: 'envia_comentario.php',
                                                type: 'POST',
                                                data: 'comentario='+contenido+'&admin='+admin+'&autor='+autor+'&receptor='+receptor+'&brecha='+".$id_brecha.",
                                                success: function(resp){
                                                        alert(resp);
                                                        $('body').removeClass('modal-open');
                                                        $('body').removeClass('modal-dialog');
                                                        $('.modal-backdrop').remove();
                                                        $('#exampleModalCenter').hide();

                                                }
                                                 });
                                    }else{
                                        alert('Debe escribir un comentario para continuar.');
                                       }
                                }else{
                                    alert('Debe seleccionar al menos uno para continuar.');
                                }

                                
                    }//finfuncion
                    


                </script>";
               
            }//fin if comentarios
            


            
            
            
            
            
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
