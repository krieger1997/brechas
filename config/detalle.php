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
    $sql = 'SELECT b.area as area_brecha, DATE_FORMAT(fecha, "%d/%m/%Y") as fecha,DATE_FORMAT(fecha, "%Y-%m-%d") as fecha2, `titulo`, `descripcion`, DATE_FORMAT(limite, "%d/%m/%Y") as limite ,DATE_FORMAT(limite, "%Y-%m-%d") as limite2, CONCAT(u.nombre, " ",u.seg_nombre, " ",u.pri_apellido, " ",u.seg_apellido) as nombre_completo , `imagen`, `estado`, rut, email, u.telefono, b.autor as autor FROM `brechas` b, usuarios u  WHERE b.id = '.$id_brecha.' and b.autor = u.id';
    $result = $conexion -> query($sql);
    if($result->num_rows > 0){
        if($row = $result->fetch_array(MYSQLI_ASSOC)){
            $titulo = $row['titulo'];
            $fecha = $row['fecha'];
            $fecha2 = $row['fecha2'];
            $nombre = $row['nombre_completo'];
            $descripcion = $row['descripcion'];
            $limite = $row['limite'];
            $limite2 = $row['limite2'];
            $imagen = $row['imagen'];
            $rut = $row['rut'];
            $email = $row['email'];
            $telefono = $row['telefono'];
            $area_brechas = $row['area_brecha'];
            $id_autor = $row['autor'];
            $estado = $row['estado'];
            $sql ="SELECT `area` FROM `usuarios` WHERE `id` = $id_autor";
            $result = $conexion -> query($sql);
            if($result->num_rows > 0){
                if($row2 = $result->fetch_array(MYSQLI_ASSOC)){
                       $area_autor = $row2['area'];
                }
            }
            echo "<div id='respuesta' class='container mt-5 shadow-lg p-3 mb-5   rounded'>";
            if($estado == "ABIERTA"){



                echo'<div class= "row"> <div class="col">';
                if ($_SESSION['tipo'] == 1){
                    echo '<button onclick="elimina_brecha()" type="button" title="Eliminar brecha" class="btn btn-outline-danger float-left"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                       <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                     </svg>Eliminar</button>';
                    echo "<script>
                        function elimina_brecha()
                                   {
                                   var pregunta = confirm('Si existen cierres para esta brecha también se elimnarán');
                                   if (pregunta == true) {
                                        var pregunta2 = confirm('Esta acción no se puede deshacer.  ¿Está segur@?');
                                        if (pregunta2==true){
                                        var id_brecha = ".$id_brecha.";
                                           $.ajax({
                                                   url: 'elimina_brecha.php',
                                                   type: 'POST',
                                                   data: 'id_brecha='+id_brecha,
                                                   success: function(resp){
                                                           alert(resp);
                                                           location.reload();
                                                   }
                                           });
                                        }//fin p2
                                   }//fin ifp1 



                                   }
                     </script>";
                }
             
                echo '</div>
                <div class="col-8">  ';
                echo "<h2 class='text-center font-weight-bold '>" . $titulo . "</H2>";
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
                        
                        <div class="form-group">
                            <label for="txtLimite2">Plazo máximo</label>
                            <input type="date"  name="txtLimite2"  class="form-control" required id="txtLimite2" value="'.$limite2.'">
                        </div>
                        ';
                if ($_SESSION['tipo'] != 1){
                    echo "<script> $('#txtLimite2').prop('disabled', true);</script>";
                }
               
                echo '<div class="form-group">
                            <label for="txtImagen">Imagen</label>';
                echo "<script>var borrar = 0;</script>";
                if ($imagen != ''){
                    echo'<input type="file"  name="txtImagen2" accept="image/png, .jpeg, .jpg, image/gif"  class="form-control-file " id="txtImagen2" style="display:none;">';
                    echo'<button type="button" class="btn btn-light" onclick="borra_img();" id="btn_imagen"><img src="../subidas/'.$imagen.'"  class="img-thumbnail" alt="Responsive image" id="img1"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                  </svg></button>';
                    echo '<script>
                        //var borrar = 0;
                        function borra_img(){
                            var r = confirm("¿Desea eliminar esta imagen?");
                            if (r == true) {
                                $("#txtImagen2").show();
                                $("#btn_imagen").hide();
                                borrar = 1;
                            } else {
                                borrar = 0;
                            }
                        }
                        </script>';
//                    echo "<script>
//                            function edita_brecha(titulo, descripcion, fecha, imagen)
//                            {
//                            //var area = ".$area.";
//                            var formData = new FormData();
//                            formData.append('titulo', titulo);
//                            formData.append('descripcion',descripcion);
//                            formData.append('fecha',fecha);
//                            //formData.append('area',area);
//
//                            //formData.append('imagen',imagen);
//                            var id_brecha = ".$id_brecha.";
//                                formData.append('brecha',id_brecha);
//
//
//                                    $.ajax({
//                                            url: 'edita_brecha.php',
//                                            type: 'POST',
//                                            data: formData,
//                                            contentType: false,
//                                            processData: false,
//                                            success: function(resp){
//                                                    //$('#contenido').html(resp);
//                                                    alert(resp);
//                                                    $('body').removeClass('modal-open');
//                                                    $('.modal-backdrop').remove();
//                                                    //$('#resumen').load(' #resumen');
//                                                     location.reload();
//                                            }
//                                    });
//                            }
//
//
//                            </script>";
                }else{
                       echo'<input type="file"  name="txtImagen2" accept="image/png, .jpeg, .jpg, image/gif"  class="form-control-file" id="txtImagen2" >';
//                       echo "<script>
//                                function edita_brecha(titulo, descripcion, fecha, imagen)
//                                {
//                                //var area = ".$area.";
//                                var formData = new FormData();
//                                formData.append('titulo', titulo);
//                                formData.append('descripcion',descripcion);
//                                formData.append('fecha',fecha);
//                                //formData.append('area',area);
//
//                                //formData.append('imagen',imagen);
//                                var id_brecha = ".$id_brecha.";
//                                    formData.append('brecha',id_brecha);
//
//
//                                        $.ajax({
//                                                url: 'edita_brecha.php',
//                                                type: 'POST',
//                                                data: formData,
//                                                contentType: false,
//                                                processData: false,
//                                                success: function(resp){
//                                                        //$('#contenido').html(resp);
//                                                        alert(resp);
//                                                        $('body').removeClass('modal-open');
//                                                        $('.modal-backdrop').remove();
//                                                        //$('#resumen').load(' #resumen');
//                                                         location.reload();
//                                                }
//                                        });
//                                }
//
//
//                                </script>";
                }
                echo ' </div>';


                echo "<script>
                                function edita_brecha(titulo, descripcion, fecha,limite ,  imagen)
                                {
                                //var area = ".$area.";
                                    //$('#loading').show();$('#btn').prop('disabled', true);
                                    $('.modal-footer .text-center').show(); $('.modal-footer .btn').prop('disabled', true);
                                var formData = new FormData();
                                formData.append('titulo', titulo);
                                formData.append('descripcion',descripcion);
                                formData.append('fecha',fecha);
                                formData.append('limite',limite);
                                //formData.append('area',area);

                                formData.append('imagen',imagen);
                                var id_brecha = ".$id_brecha.";
                                    formData.append('brecha',id_brecha);
                                    formData.append('borrar',borrar);



                                        $.ajax({
                                                url: 'edita_brecha.php',
                                                type: 'POST',
                                                data: formData,
                                                contentType: false,
                                                processData: false,
                                                success: function(resp){
                                                    $('.modal-footer .text-center').hide();  $('.modal-footer .btn').prop('disabled', false);
                                                //$('#loading').hide(); $('#btn').prop('disabled', false);
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




                     echo ' </div>
                <div class="modal-footer">
                <div class="text-center" id = "loading" style="display:none;">
                        <div class="spinner-border" role="status">
                          <span class="sr-only">Cargando...</span>
                        </div>
                      </div>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" >CERRAR</button>
                  <button type="button" class="btn btn-primary" id="btn" onclick="edita_brecha( $(\'#txtTitulo2\').val() , $(\'#txtDescripcion2\').val() , $(\'#txtFecha2\').val() , $(\'#txtLimite2\').val(),   $(\'#txtImagen2\')[0].files[0]  )">GUARDAR</button>
                  </form>
                </div>
              </div>
            </div>
            </div>';






            }

            echo '</div></div>';



            echo'<div class= "row">
                <div class="col">    <H4 class=" text-center">Información de autor</H4></div>
                </div>';
            echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">
              Rut:
            </div><div class="col-8">
              '.$rut.'
            </div>    </div>';
            echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">
              Teléfono:
            </div><div class="col-8">
              '.$telefono.'
            </div>   </div>';

            echo'<div class= "row row-cols-2">
                <div class="col-4 font-weight-bold text-right">
              Nombre:
            </div>
            <div class="col-8">
              '.$nombre.'
            </div>

            </div>';
            echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">
              Correo:
            </div>    <div class="col-8">
              '.$email.'
            </div>  </div>';



            echo'<div class= "row mt-5">
                <div class="col">    <H4 class=" text-center">Información de brecha</H4></div>
               </div>';


            echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">Descripción:</div>
                <div class="col-8">'.$descripcion.'</div>
                </div>';
            echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">Fecha:</div>
                <div class="col-8">'.$fecha.'</div>
                </div>';
            echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">Plazo máximo:</div>
                <div class="col-8">'.$limite.'</div>
                </div>';

            if ($imagen != ''){
                echo'<div class= "row"> <div class="col font-weight-bold text-right">Imagen:</div>
                <div class="col "></div>
                <div class="col"></div></div>';
                echo '<div class="mt-3 text-center "><img src="../subidas/'.$imagen.'" class="img-fluid" alt="Responsive image" style=" "></div>';
            }

            if (($_SESSION['area'] == $area_brechas OR $_SESSION['tipo'] == 1) AND $estado =='ABIERTA' ){
                echo '<button type="button" class="btn btn-warning btn-lg btn-block mt-2 font-weight-bold" data-toggle="modal" data-target="#cierraBrecha">Cerrar brecha</button>';
                echo '<div class="modal fade" id="cierraBrecha" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalCenterTitle">Cierre de brecha</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <form action="return false" onsubmit="return false" method="POST" >
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
                                <div class="form-group">
                                    <label for="txtImagen">Imagen</label>
                                    <input type="file"  name="txtImagen" accept="image/png, .jpeg, .jpg, image/gif"  class="form-control-file" id="txtImagen" >
                                </div>


                            </div>
                            <div class="modal-footer">
                            <div class="text-center" id = "loading" style="display:none;">
                        <div class="spinner-border" role="status">
                          <span class="sr-only">Cargando...</span>
                        </div>
                      </div>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                              <button type="button" class="btn btn-primary" id="btn" onclick="cierra_brecha($(\'#txtTitulo\').val() , $(\'#txtDescripcion\').val() , $(\'#txtFecha\').val() , $(\'#txtImagen\')[0].files[0])">GUARDAR</button>
                              </form>
                            </div>
                          </div>
                        </div>
                        </div>';
                echo "<script>
                        function cierra_brecha(titulo, descripcion, fecha, imagen)
                        {
                        //$('#loading').show();$('#btn').prop('disabled', true);
                          $('.modal-footer .text-center').show(); $('.modal-footer .btn').prop('disabled', true);  
                        var id_brecha = ".$id_brecha.";
                        var formData = new FormData();
                        formData.append('titulo', titulo);
                        formData.append('descripcion',descripcion);
                        formData.append('fecha',fecha);

                        formData.append('imagen',imagen);
                        formData.append('brecha',id_brecha);


                                $.ajax({
                                        url: 'cierra_brecha.php',
                                        type: 'POST',
                                        data: formData,
                                        contentType: false,
                                        processData: false,
                                        success: function(resp){
                    $('.modal-footer .text-center').hide();  $('.modal-footer .btn').prop('disabled', false);                    
                    //$('#loading').hide(); $('#btn').prop('disabled', false);
                                                //$('#contenido').html(resp);
                                                alert(resp);
                                                //$('body').removeClass('modal-open');
                                               // $('.modal-backdrop').remove();
                                                //$('#resumen').load(' #resumen');
                                                location.reload();
                                        }
                                });
                        }
                        </script>";




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
                            <div class="text-center" id = "loadingCmnt1" style="display:none;">
                        <div class="spinner-border" role="status">
                          <span class="sr-only">Cargando...</span>
                        </div>
                      </div>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                              <button type="button" class="btn btn-primary" id="btnCmnt" onclick="comentario( $(\'#txtComentario\').val())">GUARDAR</button>
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
                                    // $('#loadingCmnt1').show();$('#btnCmnt').prop('disabled', true);
                                    $('.modal-footer .text-center').show(); $('.modal-footer .btn').prop('disabled', true);
                                    
                                            $.ajax({
                                                url: 'envia_comentario.php',
                                                type: 'POST',
                                                data: 'comentario='+contenido+'&admin='+admin+'&autor='+autor+'&receptor='+receptor+'&brecha='+".$id_brecha.",
                                                success: function(resp){
                                                       // $('#loadingCmnt1').hide(); $('#btnCmnt').prop('disabled', false);
                                                        $('.modal-footer .text-center').hide();  $('.modal-footer .btn').prop('disabled', false);
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
            }elseif ($estado == "PENDIENTE") { // ----------------------------------------------------------------------------------------------------
                echo '<div class="row">
                    <div class="col border-right"> ';
                //brecha
                echo'<div class= "row"> <div class="col">';
                if ($_SESSION['tipo'] == 1){
                    echo '<button onclick="elimina_brecha()" type="button" title="Eliminar brecha" class="btn btn-outline-danger float-left"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                       <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                     </svg></button>';
                    echo "<script>
                        function elimina_brecha()
                                   {
                                   var pregunta = confirm('Si existen cierres para esta brecha también se elimnarán');
                                   if (pregunta == true) {
                                        var pregunta2 = confirm('Esta acción no se puede deshacer.  ¿Está segur@?');
                                        if(pregunta2 == true){
                                       //var formData = new FormData();
                                       var id_brecha = ".$id_brecha.";
                                       //formData.append('id_brecha',id_brecha);

                                           $.ajax({
                                                   url: 'elimina_brecha.php',
                                                   type: 'POST',
                                                   data: 'id_brecha='+id_brecha,
                                                   success: function(resp){
                                                           alert(resp);
                                                           location.reload();
                                                   }
                                           });
                                           }//fin pregunta 2
                                   }//FIN IF PREGUNTA1 



                                   }
                     </script>";
                }
                
                echo '</div>
                <div class="col-8">  ';
            echo "<h2 class='text-center font-weight-bold '>".$titulo."</H2>";
            echo '</div>      <div class="col">';

             if ($_SESSION['area'] == $area_autor OR $_SESSION['tipo'] == 1){
                echo '<button type="button"  class="btn btn-outline-light float-right  font-weight-bold" id="editar" data-toggle="modal" data-target="#modalEdita">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                    </svg>
                 
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
                        <div class="form-group">
                            <label for="txtLimite2">Plazo máximo</label>
                            <input type="date"  name="txtLimite2"  class="form-control" required id="txtLimite2" value="'.$limite2.'">
                        </div>
                        ';
                if ($_SESSION['tipo'] != 1){
                    echo "<script> $('#txtLimite2').prop('disabled', true);</script>";
                }
                        
                echo '<div class="form-group">
                            <label for="txtImagen">Imagen</label>';
                echo "<script>var borrar = 0;</script>";
                if ($imagen != ''){
                    echo'<input type="file"  name="txtImagen2" accept="image/png, .jpeg, .jpg, image/gif"  class="form-control-file " id="txtImagen2" style="display:none;">';
                    echo'<button type="button" class="btn btn-light" onclick="borra_img();" id="btn_imagen"><img src="../subidas/'.$imagen.'"  class="img-thumbnail" alt="Responsive image" id="img1"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                  </svg></button>';
                    echo '<script>
                        //var borrar = 0;
                        function borra_img(){
                            var r = confirm("¿Desea eliminar esta imagen?");
                            if (r == true) {
                                $("#txtImagen2").show();
                                $("#btn_imagen").hide();
                                borrar = 1;
                            } else {
                                borrar = 0;
                            }
                        }
                        </script>';
//                    echo "<script>
//                            function edita_brecha(titulo, descripcion, fecha, imagen)
//                            {
//                            //var area = ".$area.";
//                            var formData = new FormData();
//                            formData.append('titulo', titulo);
//                            formData.append('descripcion',descripcion);
//                            formData.append('fecha',fecha);
//                            //formData.append('area',area);
//
//                            //formData.append('imagen',imagen);
//                            var id_brecha = ".$id_brecha.";
//                                formData.append('brecha',id_brecha);
//
//
//                                    $.ajax({
//                                            url: 'edita_brecha.php',
//                                            type: 'POST',
//                                            data: formData,
//                                            contentType: false,
//                                            processData: false,
//                                            success: function(resp){
//                                                    //$('#contenido').html(resp);
//                                                    alert(resp);
//                                                    $('body').removeClass('modal-open');
//                                                    $('.modal-backdrop').remove();
//                                                    //$('#resumen').load(' #resumen');
//                                                     location.reload();
//                                            }
//                                    });
//                            }
//
//
//                            </script>";
                }else{
                       echo'<input type="file"  name="txtImagen2" accept="image/png, .jpeg, .jpg, image/gif"  class="form-control-file" id="txtImagen2" >';
//                       echo "<script>
//                                function edita_brecha(titulo, descripcion, fecha, imagen)
//                                {
//                                //var area = ".$area.";
//                                var formData = new FormData();
//                                formData.append('titulo', titulo);
//                                formData.append('descripcion',descripcion);
//                                formData.append('fecha',fecha);
//                                //formData.append('area',area);
//
//                                //formData.append('imagen',imagen);
//                                var id_brecha = ".$id_brecha.";
//                                    formData.append('brecha',id_brecha);
//
//
//                                        $.ajax({
//                                                url: 'edita_brecha.php',
//                                                type: 'POST',
//                                                data: formData,
//                                                contentType: false,
//                                                processData: false,
//                                                success: function(resp){
//                                                        //$('#contenido').html(resp);
//                                                        alert(resp);
//                                                        $('body').removeClass('modal-open');
//                                                        $('.modal-backdrop').remove();
//                                                        //$('#resumen').load(' #resumen');
//                                                         location.reload();
//                                                }
//                                        });
//                                }
//
//
//                                </script>";
                }
                echo ' </div>';


                echo "<script>
                                function edita_brecha(titulo, descripcion, fecha,limite ,  imagen)
                                {
                               //$('#loading').show();$('#btn').prop('disabled', true);
                                $('.modal-footer .text-center').show(); $('.modal-footer .btn').prop('disabled', true);
                                //var area = ".$area.";
                                var formData = new FormData();
                                formData.append('titulo', titulo);
                                formData.append('descripcion',descripcion);
                                formData.append('fecha',fecha);
                                formData.append('limite',limite);
                                //formData.append('area',area);

                                formData.append('imagen',imagen);
                                var id_brecha = ".$id_brecha.";
                                    formData.append('brecha',id_brecha);
                                    formData.append('borrar',borrar)



                                        $.ajax({
                                                url: 'edita_brecha.php',
                                                type: 'POST',
                                                data: formData,
                                                contentType: false,
                                                processData: false,
                                                success: function(resp){
                                                $('.modal-footer .text-center').hide();  $('.modal-footer .btn').prop('disabled', false);
//$('#loading').hide(); $('#btn').prop('disabled', false);
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




                     echo ' </div>
                <div class="modal-footer">
                <div class="text-center" id = "loading" style="display:none;">
                        <div class="spinner-border" role="status">
                          <span class="sr-only">Cargando...</span>
                        </div>
                      </div>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" >CERRAR</button>
                  <button type="button" class="btn btn-primary" id="btn" onclick="edita_brecha( $(\'#txtTitulo2\').val() , $(\'#txtDescripcion2\').val() , $(\'#txtFecha2\').val(), $(\'#txtLimite2\').val() ,  $(\'#txtImagen2\')[0].files[0]  )">GUARDAR</button>
                  </form>
                </div>
              </div>
            </div>
            </div>';






            }

            echo '</div></div>';



            echo'<div class= "row">
                <div class="col">    <H4 class=" text-center">Información de autor</H4></div>
                </div>';
            echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">
              Rut:
            </div><div class="col-8">
              '.$rut.'
            </div>    </div>';
            echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">
              Teléfono:
            </div><div class="col-8">
              '.$telefono.'
            </div>   </div>';

            echo'<div class= "row row-cols-2">
                <div class="col-4 font-weight-bold text-right">
              Nombre:
            </div>
            <div class="col-8">
              '.$nombre.'
            </div>

            </div>';
            echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">
              Correo:
            </div>    <div class="col-8">
              '.$email.'
            </div>  </div>';



            echo'<div class= "row mt-5">
                <div class="col">    <H4 class=" text-center">Información de brecha</H4></div>
               </div>';


            echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">Descripción:</div>
                <div class="col-8">'.$descripcion.'</div>
                </div>';
            echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">Fecha:</div>
                <div class="col-8">'.$fecha.'</div>
                </div>
                ';
            echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">Plazo máximo:</div>
                <div class="col-8">'.$limite.'</div>
                </div>
                ';

            if ($imagen != ''){
                echo'<div class= "row"> <div class="col font-weight-bold text-right">Imagen:</div>
                <div class="col "></div>
                <div class="col"></div></div>';
                echo '<div class="mt-3 text-center "><img src="../subidas/'.$imagen.'" class="img-fluid" alt="Responsive image" style=" "></div>';
            }

                echo '</DIV><DIV CLASS="col border-left">';
                //cierre de brecha
                
                $sql3='SELECT c.id as id_c, DATE_FORMAT(fecha, "%d/%m/%Y") as fecha,DATE_FORMAT(fecha, "%Y-%m-%d") as fecha2, `titulo`, `descripcion`, CONCAT(u.nombre, " ",u.seg_nombre, " ",u.pri_apellido, " ",u.seg_apellido) as nombre_completo , `imagen`, rut, email, u.telefono, c.autor as autor FROM `cierres` c, usuarios u  WHERE id_brecha = '.$id_brecha.' and c.autor = u.id';
                $result3 = $conexion -> query($sql3);
                if($result3->num_rows > 0){
                    if($row3 = $result3->fetch_array(MYSQLI_ASSOC)){
                        $id_c = $row3['id_c'];
                        $titulo_c = $row3['titulo'];
                        $fecha_c = $row3['fecha'];
                        $fecha_c2 = $row3['fecha2'];
                        $nombre_c = $row3['nombre_completo'];
                        $descripcion_c = $row3['descripcion'];
                        $imagen_c = $row3['imagen'];
                        $rut_c = $row3['rut'];
                        $email_c = $row3['email'];
                        $telefono_c = $row3['telefono'];
                       
                        echo'<div class= "row"> <div class="col"></div>
                        <div class="col-8">  ';
                        echo "<h2 class='text-center font-weight-bold '>" . $titulo_c . "</H2>";
                        echo '</div>      <div class="col">';

                        //EDICION
                        if ($_SESSION['area'] == $area_brechas OR $_SESSION['tipo'] == 1){
                           echo '<button title="Editar cierre" type="button"  class="btn btn-outline-light float-right  font-weight-bold" id="editar" data-toggle="modal" data-target="#modalEditaCierre">
                               <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                   <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                               </svg>
                            
                           </button>';

                           echo '<div class="modal fade" id="modalEditaCierre" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
                       <div class="modal-dialog modal-dialog-centered modal-lg">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalCenterTitle">Edición de cierre</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">×</span>
                             </button>
                           </div>
                           <div class="modal-body">
                               <form action="return false" onsubmit="return false" method="POST" enctype="multipart/form-data">
                                   <div class="form-group">
                                       <label for="txtTitulo_c">Título</label>
                                       <input type="text"  name="txtTitulo_c"  class="form-control" required id="txtTitulo2_c" placeholder="Título" value="'.$titulo_c.'">
                                   </div>
                                   <div class="form-group">
                                       <label for="txtTitulo_c">Descripción</label>
                                       <textarea rows="5" cols="10"  name="txtDescripcion_c" required class="form-control" id="txtDescripcion2_c" placeholder="Descripción">'.$descripcion_c.'</textarea>
                                   </div>
                                   <div class="form-group">
                                       <label for="txtTitulo_c">Fecha</label>
                                       <input type="date"  name="txtFecha_c"  class="form-control" required id="txtFecha2_c" value="'.$fecha_c2.'">
                                   </div>
                                   ';
                           echo '<div class="form-group">
                                       <label for="txtImagen_c">Imagen</label>';
                           echo "<script>var borrar = 0;</script>";
                           if ($imagen_c != ''){
                               echo'<input type="file"  name="txtImagen2_c" accept="image/png, .jpeg, .jpg, image/gif"  class="form-control-file " id="txtImagen2_c" style="display:none;">';
                               echo'<button type="button" class="btn btn-light" onclick="borra_img_c();" id="btn_imagen_c"><img src="../cierres/'.$imagen_c.'"  class="img-thumbnail" alt="Responsive image" id="img1"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                               <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                             </svg></button>';
                               echo '<script>
                                   var borrar_c = 0;
                                   function borra_img_c(){
                                       var rc = confirm("¿Desea eliminar esta imagen?");
                                       if (rc == true) {
                                           $("#txtImagen2_c").show();
                                           $("#btn_imagen_c").hide();
                                           borrar_c = 1;
                                       } else {
                                           borrar_c = 0;
                                       }
                                   }
                                   </script>';
           
                           }else{
                                  echo'<input type="file"  name="txtImagen2_c" accept="image/png, .jpeg, .jpg, image/gif"  class="form-control-file" id="txtImagen2_c" >';
           
                           }
                           echo ' </div>';


                           echo "<script>
                                           function edita_cierre(titulo, descripcion, fecha, imagen)
                                           {
  $('.modal-footer .text-center').show(); $('.modal-footer .btn').prop('disabled', true);                                         
//$('#loading').show();$('#btn').prop('disabled', true);
                                            var formData_c = new FormData();
                                            formData_c.append('titulo', titulo);
                                            formData_c.append('descripcion',descripcion);
                                            formData_c.append('fecha',fecha);


                                            formData_c.append('imagen',imagen);
                                            var id_cierre = ".$id_c.";
                                            formData_c.append('id_cierre',id_cierre);
                                            formData_c.append('borrar',borrar_c);

                                                $.ajax({
                                                        url: 'edita_cierre.php',
                                                        type: 'POST',
                                                        data: formData_c,
                                                        contentType: false,
                                                        processData: false,
                                                        success: function(resp){
                                                                //$('#contenido').html(resp);
$('.modal-footer .text-center').hide();  $('.modal-footer .btn').prop('disabled', false);                                                               
//$('#loading').hide(); $('#btn').prop('disabled', false);
                                                                alert(resp);
                                                                $('body').removeClass('modal-open');
                                                                $('.modal-backdrop').remove();
                                                                //$('#resumen').load(' #resumen');
                                                                 location.reload();
                                                        }
                                                });
                                           }


                                           </script>";




                                echo ' </div>
                           <div class="modal-footer">
                           <div class="text-center" id = "loading" style="display:none;">
                        <div class="spinner-border" role="status">
                          <span class="sr-only">Cargando...</span>
                        </div>
                      </div>
                             <button type="button" class="btn btn-secondary" data-dismiss="modal" >CERRAR</button>
                             <button type="button" class="btn btn-primary" id="btn" onclick="edita_cierre( $(\'#txtTitulo2_c\').val() , $(\'#txtDescripcion2_c\').val() , $(\'#txtFecha2_c\').val() ,  $(\'#txtImagen2_c\')[0].files[0]  )">GUARDAR</button>
                             </form>
                           </div>
                         </div>
                       </div>
                       </div>';






                       }//FIN EDICION

                        echo "</div></div>";

                        echo'<div class= "row">
                        <div class="col">    <H4 class=" text-center">Información de autor</H4></div>
                        </div>';
                        echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">
                          Rut:
                        </div><div class="col-8">
                          '.$rut_c.'
                        </div>    </div>';
                        echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">
                          Teléfono:
                        </div><div class="col-8">
                          '.$telefono_c.'
                        </div>   </div>';

                        echo'<div class= "row row-cols-2">
                            <div class="col-4 font-weight-bold text-right">
                          Nombre:
                        </div>
                        <div class="col-8">
                          '.$nombre_c.'
                        </div>

                        </div>';
                        echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">
                          Correo:
                        </div>    <div class="col-8">
                          '.$email_c.'
                        </div>  </div>';



                        echo'<div class= "row mt-5">
                            <div class="col">    <H4 class=" text-center">Información de cierre de brecha</H4></div>
                           </div>';


                        echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">Descripción:</div>
                            <div class="col-8">'.$descripcion_c.'</div>
                            </div>';
                        echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">Fecha:</div>
                            <div class="col-8">'.$fecha_c.'</div>
                            </div>';

                        if ($imagen_c != ''){
                            echo'<div class= "row"> <div class="col font-weight-bold text-right">Imagen:</div>
                            <div class="col "></div>
                            <div class="col"></div></div>';
                            echo '<div class="mt-3 text-center "><img src="../cierres/'.$imagen_c.'" class="img-fluid" alt="Responsive image" style=" "></div>';
                        }
                        
                        
                        
                        
                        
                        
                    }
                }
                
                
                
                
                
                

                echo '</div></div>';
                if ($_SESSION['tipo'] == 1){
                    echo '<button type="button" class="btn btn-success btn-lg btn-block mt-3" onclick="confirma_cierre();">Confirmar cierre</button>';
                    echo "<script>
                        function confirma_cierre()
                            {
                                $.ajax({
                                        url: 'confirma_cierre.php',
                                        type: 'POST',
                                        data: 'id_brecha='+".$id_brecha.",
                                        success: function(resp){
                                                alert(resp);
                                                location.reload();
                                        }
                                });
                            }
                        
                    </script>";
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
                            <div class="text-center" id = "loading" style="display:none;">
                        <div class="spinner-border" role="status">
                          <span class="sr-only">Cargando...</span>
                        </div>
                      </div>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                              <button type="button" class="btn btn-primary" id="btn" onclick="comentario( $(\'#txtComentario\').val())">GUARDAR</button>
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
                                     $('.modal-footer .text-center').show(); $('.modal-footer .btn').prop('disabled', true);
//$('#loading').show();$('#btn').prop('disabled', true);
                                            $.ajax({
                                                url: 'envia_comentario.php',
                                                type: 'POST',
                                                data: 'comentario='+contenido+'&admin='+admin+'&autor='+autor+'&receptor='+receptor+'&brecha='+".$id_brecha.",
                                                success: function(resp){
    $('.modal-footer .text-center').hide();  $('.modal-footer .btn').prop('disabled', false);                                                    
    //$('#loading').hide(); $('#btn').prop('disabled', false);
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

                }
            }elseif($estado == "CERRADA"){ // ----------------------------------------------------------------------------------------------------
                echo '<div class="row">
                    <div class="col border-right"> ';
                //brecha
                echo'<div class= "row"> <div class="col">';
                if ($_SESSION['tipo'] == 1){
                    echo '<button onclick="elimina_brecha()" type="button" title="Eliminar brecha" class="btn btn-outline-danger float-left"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                       <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                     </svg></button>';
                    echo "<script>
                        function elimina_brecha()
                                   {
                                   var pregunta = confirm('Si existen cierres para esta brecha también se elimnarán');
                                   if (pregunta == true) {
                                        var pregunta2 = confirm('Esta acción no se puede deshacer.  ¿Está segur@?');
                                        if(pregunta2 == true){
                                       //var formData = new FormData();
                                       var id_brecha = ".$id_brecha.";
                                       //formData.append('id_brecha',id_brecha);
                                        
                                           $.ajax({
                                                   url: 'elimina_brecha.php',
                                                   type: 'POST',
                                                   data: 'id_brecha='+id_brecha,
                                                   success: function(resp){
                                                           alert(resp);
                                                           location.reload();
                                                   }
                                           });
                                   } 
                                   }


                                   }
                     </script>";
                }
                echo'</div>
                <div class="col-8">  ';
            echo "<h2 class='text-center font-weight-bold '>".$titulo."</H2>";
            echo '</div>      <div class="col">';//sin comentario
            echo '</div></div>';



            echo'<div class= "row">
                <div class="col">    <H4 class=" text-center">Información de autor</H4></div>
                </div>';
            echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">
              Rut:
            </div><div class="col-8">
              '.$rut.'
            </div>    </div>';
            echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">
              Teléfono:
            </div><div class="col-8">
              '.$telefono.'
            </div>   </div>';

            echo'<div class= "row row-cols-2">
                <div class="col-4 font-weight-bold text-right">
              Nombre:
            </div>
            <div class="col-8">
              '.$nombre.'
            </div>

            </div>';
            echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">
              Correo:
            </div>    <div class="col-8">
              '.$email.'
            </div>  </div>';



            echo'<div class= "row mt-5">
                <div class="col">    <H4 class=" text-center">Información de brecha</H4></div>
               </div>';


            echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">Descripción:</div>
                <div class="col-8">'.$descripcion.'</div>
                </div>';
            echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">Fecha:</div>
                <div class="col-8">'.$fecha.'</div>
                </div>';
            echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">Plazo máximo:</div>
                <div class="col-8">'.$limite.'</div>
                </div>';

            if ($imagen != ''){
                echo'<div class= "row"> <div class="col font-weight-bold text-right">Imagen:</div>
                <div class="col "></div>
                <div class="col"></div></div>';
                echo '<div class="mt-3 text-center "><img src="../subidas/'.$imagen.'" class="img-fluid" alt="Responsive image" style=" "></div>';
            }

                echo '</DIV><DIV CLASS="col border-left">';
                //cierre de brecha
                
                $sql3='SELECT DATE_FORMAT(fecha, "%d/%m/%Y") as fecha, `titulo`, `descripcion`, CONCAT(u.nombre, " ",u.seg_nombre, " ",u.pri_apellido, " ",u.seg_apellido) as nombre_completo , `imagen`, rut, email, u.telefono, c.autor as autor FROM `cierres` c, usuarios u  WHERE id_brecha = '.$id_brecha.' and c.autor = u.id';
                $result3 = $conexion -> query($sql3);
                if($result3->num_rows > 0){
                    if($row3 = $result3->fetch_array(MYSQLI_ASSOC)){
                        $titulo_c = $row3['titulo'];
                        $fecha_c = $row3['fecha'];
                        $nombre_c = $row3['nombre_completo'];
                        $descripcion_c = $row3['descripcion'];
                        $imagen_c = $row3['imagen'];
                        $rut_c = $row3['rut'];
                        $email_c = $row3['email'];
                        $telefono_c = $row3['telefono'];
                       
                        echo'<div class= "row"> <div class="col"></div>
                        <div class="col-8">  ';
                        echo "<h2 class='text-center font-weight-bold '>" . $titulo_c . "</H2>";
                        echo '</div>      <div class="col">';

                        //edicion??

                        echo "</div></div>";

                        echo'<div class= "row">
                        <div class="col">    <H4 class=" text-center">Información de autor</H4></div>
                        </div>';
                        echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">
                          Rut:
                        </div><div class="col-8">
                          '.$rut_c.'
                        </div>    </div>';
                        echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">
                          Teléfono:
                        </div><div class="col-8">
                          '.$telefono_c.'
                        </div>   </div>';

                        echo'<div class= "row row-cols-2">
                            <div class="col-4 font-weight-bold text-right">
                          Nombre:
                        </div>
                        <div class="col-8">
                          '.$nombre_c.'
                        </div>

                        </div>';
                        echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">
                          Correo:
                        </div>    <div class="col-8">
                          '.$email_c.'
                        </div>  </div>';



                        echo'<div class= "row mt-5">
                            <div class="col">    <H4 class=" text-center">Información de cierre de brecha</H4></div>
                           </div>';


                        echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">Descripción:</div>
                            <div class="col-8">'.$descripcion_c.'</div>
                            </div>';
                        echo'<div class= "row row-cols-2"> <div class="col-4 font-weight-bold text-right">Fecha:</div>
                            <div class="col-8">'.$fecha_c.'</div>
                            </div>';

                        if ($imagen_c != ''){
                            echo'<div class= "row"> <div class="col font-weight-bold text-right">Imagen:</div>
                            <div class="col "></div>
                            <div class="col"></div></div>';
                            echo '<div class="mt-3 text-center "><img src="../cierres/'.$imagen_c.'" class="img-fluid" alt="Responsive image" style=" "></div>';
                        }
                        
                        
                        
                        
                        
                        
                    }
                }
                
                
                
                
                
                

                echo '</div></div>';
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
                            <div class="text-center" id = "loading" style="display:none;">
                        <div class="spinner-border" role="status">
                          <span class="sr-only">Cargando...</span>
                        </div>
                      </div>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                              <button type="button" class="btn btn-primary" id="btn"  onclick="comentario( $(\'#txtComentario\').val())">GUARDAR</button>
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
                                     $('.modal-footer .text-center').show(); $('.modal-footer .btn').prop('disabled', true);
//$('#loading').show();$('#btn').prop('disabled', true);
                                            $.ajax({
                                                url: 'envia_comentario.php',
                                                type: 'POST',
                                                data: 'comentario='+contenido+'&admin='+admin+'&autor='+autor+'&receptor='+receptor+'&brecha='+".$id_brecha.",
                                                success: function(resp){
$('.modal-footer .text-center').hide();  $('.modal-footer .btn').prop('disabled', false);                                                
//$('#loading').hide(); $('#btn').prop('disabled', false);
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

                }   
                
                
            }





             echo "</div>";//FIN RESPUESTA

        }

    }else{
        echo "<div id='respuesta' class='container mt-5 shadow-lg p-3 mb-5   rounded'>";
        echo "ERRORRRRRRRRRRRRRRRR";
        echo"</div>";
    }





}else{
    echo "<div id='respuesta'>";
    echo "<H1>ERROR</H1>";
    echo "</div>";
}




?>
