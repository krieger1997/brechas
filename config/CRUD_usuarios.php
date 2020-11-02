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

if(isset($_SESSION['id'])  && isset($_SESSION['tipo']) && isset($_SESSION['area']) && $_SESSION['tipo'] == 1 ){
    
    $sql2 = "SELECT `id`, `nombre_tipo` FROM `tipo_de_usuario` ";
    $result2 = $conexion->query($sql2);
    if ($result2->num_rows > 0){
        $combobit="<option value='' selected disabled hidden>Seleccionar</option>";
        $combobit1="";
        while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)){	
            $combobit .=" <option value='".$row2['id']."'>".$row2['nombre_tipo']."</option>"; 
            $combobit1 .=" <option value='".$row2['id']."'>".$row2['nombre_tipo']."</option>"; 
        }
    }else{
        echo "No hubo resultados";
    }
    
    $sql3 = "SELECT `ID_AREA`, `NOMBRE_AREA` FROM `areas`";
    $result3 = $conexion->query($sql3);
    if ($result3->num_rows > 0){
        $combobit2="<option value='' selected disabled hidden>Seleccionar</option>";
        $combobit22 ="";
        while ($row3 = $result3->fetch_array(MYSQLI_ASSOC)){	
            $combobit2 .=" <option value='".$row3['ID_AREA']."'>".utf8_encode($row3['NOMBRE_AREA'])."</option>"; 
            $combobit22 .=" <option value='".$row3['ID_AREA']."'>".utf8_encode($row3['NOMBRE_AREA'])."</option>"; 
        }
    }else{
        echo "No hubo resultados";
    }
    
    
    
    echo '<div class="" style="background-color: rgba(255, 255, 255, 0.8); width:95%!important; margin:auto;">';
    echo '<table class="table table-hover"  >
  <thead style="font-size: 14px;" class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre de usuario</th>
      <th scope="col">Contraseña</th>
      <th scope="col">Tipo de usuario</th>
      <th scope="col">Área</th>
      <th scope="col">Rut</th>
      <th scope="col">Nombre</th>
      <th scope="col">Seg. Nombre</th>
      <th scope="col">Pri. Apellido</th>
      <th scope="col">Seg. Apellido</th>
      <th scope="col">Email</th>
      <th scope="col">Telefono</th>
      <th scope="col"><button type="button" class="btn btn-primary p-1 " data-toggle="modal" data-target="#modalAgrega">Nuevo</button><br>Acción</th>
      <div class="modal fade" id="modalAgrega" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Nuevo usuario</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="return false" onsubmit="return false" method="POST" autocomplete="off" >
                        <div class="form-group">
                            <label for="txtNombreUsuario">Nombre de usuario</label>
                            <input type="text"  name="txtNombreUsuario"  class="form-control" required id="txtNombreUsuario" autocomplete="nope" maxlength="30" placeholder="30 caracteres max.">
                        </div>
                        <div class="form-group">
                            <label for="txtContrasena1">Contraseña</label>
                            <input type="password"  name="txtContrasena1"  class="form-control" required id="txtContrasena1" autocomplete="nope" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="txtContrasena2">Repetir contraseña</label>
                            <input  type="password"  name="txtContrasena2"  class="form-control" required id="txtContrasena2" autocomplete="off"  placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="txtTipo">Tipo de usuario</label>
                            <select   name="txtTipo"  class="form-control" required id="txtTipo" >';echo $combobit; echo '    </select>
                        </div>
                        <div class="form-group">
                            <label for="txtArea">Área</label>
                            <select   name="txtArea"  class="form-control" required id="txtArea" >';echo $combobit2; echo '    </select>
                        </div>
                        <div class="form-group">
                            <label for="txtRut">Rut</label>
                            <input type="text"  name="txtRut"  class="form-control" required id="txtRut" placeholder="11.222.333-4" maxlength="12">
                        </div>
                        <script>function mayus(e) {
                                e.value = e.value.toUpperCase();
                                }
                        </script>

                        <div class="form-group">
                            <label for="txtNombre">Nombre</label>
                            <input type="text"  name="txtNombre"  class="form-control" required id="txtNombre" onkeyup="mayus(this);">
                        </div>
                        <div class="form-group">
                            <label for="txtSegNombre">Segundo nombre</label>
                            <input type="text"  name="txtSegNombre"  class="form-control"  id="txtSegNombre" onkeyup="mayus(this);">
                        </div>
                        <div class="form-group">
                            <label for="txtApellido">Apellido</label>
                            <input type="text"  name="txtApellido"  class="form-control" required id="txtApellido" onkeyup="mayus(this);">
                        </div>
                        <div class="form-group">
                            <label for="txtSegApellido">Segundo apellido</label>
                            <input type="text"  name="txtSegApellido"  class="form-control" required id="txtSegApellido" onkeyup="mayus(this);">
                        </div>
                        <div class="form-group">
                            <label for="txtEmail">Email</label>
                            <input type="text"  name="txtEmail"  class="form-control" required id="txtEmail" placeholder="correo@correo.ok">
                        </div>
                        <div class="form-group">
                            <label for="txtTelefono">Teléfono</label>
                             <div class="input-group ">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">+569</div>
                                </div>
                                <input type="text" class="form-control" required id="txtTelefono" placeholder="12345678" maxlength="8">
                              </div>
                        </div>
                        
                    
                </div>
                <div class="modal-footer">
                <div class="text-center" id = "loading" style="display:none;">
                        <div class="spinner-border" role="status">
                          <span class="sr-only">Cargando...</span>
                        </div>
                      </div>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                  <button type="button" class="btn btn-primary" id="btn" onclick="agrega_usuario( $(\'#txtNombreUsuario\').val()  ,  $(\'#txtContrasena2\').val()  ,  $(\'#txtTipo\').val()  ,  $(\'#txtArea\').val()  ,  $(\'#txtRut\').val()  ,  $(\'#txtNombre\').val()  ,  $(\'#txtSegNombre\').val()  ,  $(\'#txtApellido\').val()  ,  $(\'#txtSegApellido\').val()  ,  $(\'#txtEmail\').val()  ,  $(\'#txtTelefono\').val()  )">GUARDAR</button>
                  </form>
                </div>
              </div>
            </div>
            </div>
            
<script>';
echo "function agrega_usuario(nombreUsuario, contrasena, tipo, area, rut, nombre, segNombre, apellido, segApellido, email, telefono){
    //alert($('#txtContrasena1').val());
        if( $('#txtContrasena1').val() != $('#txtContrasena2').val() ){
            alert('Contraseñas deben ser iguales');
            $('#txtContrasena2').focus();
        }else{
        $('#loading').show();$('#btn').prop('disabled', true);
        var formDatax = new FormData();
        formDatax.append('nombreUsuario',nombreUsuario);
        formDatax.append('contrasena',contrasena);
        formDatax.append('tipo',tipo);
        formDatax.append('area',area);
        formDatax.append('rut',rut);
        formDatax.append('nombre',nombre);
        formDatax.append('segNombre',segNombre);
        formDatax.append('apellido',apellido);
        formDatax.append('segApellido',segApellido);
        formDatax.append('email',email);
        formDatax.append('telefono',telefono);
        
        $.ajax({
                url: 'agrega_usuario.php',
                type: 'POST',
                data: formDatax,
                contentType: false,
                processData: false,
                success: function(resp1){
                    $('#loading').hide(); $('#btn').prop('disabled', false);
                        if(resp1 == 0){
                            alert('¡Usuario creado exitosamente!');
                            location.reload();
                        }else{
                            alert(resp1);
                        }
                        
                }
        });
    }
}";

echo '
</script>

      
    </tr>
  </thead>
  <tbody class="" style="font-size: 12px;">';

    
    $sql="SELECT  usuarios.id as id, `nombre_de_usuario`, `contrasena`, nombre_tipo as tipo, NOMBRE_AREA as area, `rut`, `nombre`, `seg_nombre`, `pri_apellido`, `seg_apellido`, `email`, `telefono` FROM usuarios, areas, tipo_de_usuario WHERE areas.ID_AREA = usuarios.area AND tipo_de_usuario.id = usuarios.tipo_de_usuario";
    $result = $conexion -> query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            echo '<tr>';
            echo '<th scope="row">'.$row['id'].'</th>';
            echo '<td>'.$row['nombre_de_usuario'].'</td>';
            echo '<td>'.$row['contrasena'].'</td>';
            echo '<td>'.$row['tipo'].'</td>';
            echo '<td>'.utf8_encode($row['area']).'</td>';
            echo '<td>'.$row['rut'].'</td>';
            echo '<td>'.$row['nombre'].'</td>';
            echo '<td>'.$row['seg_nombre'].'</td>';
            echo '<td>'.$row['pri_apellido'].'</td>';
            echo '<td>'.$row['seg_apellido'].'</td>';
            echo '<td>'.$row['email'].'</td>';
            echo '<td>'.$row['telefono'].'</td>';
            echo'<td class="p-1">
                
            <button type="button" class="btn btn-outline-danger p-1 elimina " id="'.$row['id'].'"     >
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                  </svg>
            </button>   
            
            














            <button type="button" class="btn btn-outline-warning p-1 edita " id="'.$row['id'].'">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
              </svg> 
            </button>
            







            
            </TD>';

            echo '</tr>';
        }   
        
        
        
        echo "<script>   
            var id;
            function elimina_usuario(id)
                {
                        $.ajax({
                                url: 'elimina_usuario.php',
                                type: 'POST',
                                data: 'id='+id,
                                success: function(resp){
                                        alert(resp);
                                        location.reload();
                                }
                        });
                }
            $(document).ready(function() {
                    $('.elimina').on('click', function(event) {
                            let id = this.id;
                            var r = confirm('¿Está segur@ de que desea eliminar este usuario?');
                            if (r == true) {
                                elimina_usuario(id);
                            }     
                 });
                 
                 $('.edita').on('click', function(event) {
                            id = this.id;
                            $.ajax({
                                url: 'lector.php',
                                type: 'POST',
                                data: {id:id},
                                dataType: 'json',
                                success: function(resp){
                                        $('#txtNombreUsuario_ed').val(resp.nombre_de_usuario);
                                        $('#txtContrasena1_ed').val(resp.contrasena);  
                                        $('#txtContrasena2_ed').val(resp.contrasena);  
                                        $('#txtTipo_ed').val(resp.tipo_de_usuario); 
                                        $('#txtArea_ed').val(resp.area);  
                                        $('#txtRut_ed').val(resp.rut);  
                                        $('#txtNombre_ed').val(resp.nombre); 
                                        $('#txtSegNombre_ed').val(resp.seg_nombre);  
                                        $('#txtApellido_ed').val(resp.pri_apellido);  
                                        $('#txtSegApellido_ed').val(resp.seg_apellido);
                                        $('#txtEmail_ed').val(resp.email);
                                        $('#txtTelefono_ed').val(resp.telefono);
                                        $('#modalEdita').modal('show'); 


                                }
                        });     
                 });

                 
               });        
        </script>";   
        
        
        
        
        
        //EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION EDICION 
        echo "<script>function edita_usuario(nombreUsuario, contrasena, tipo, area, rut, nombre, segNombre, apellido, segApellido, email, telefono){
            
        if( $('#txtContrasena1_ed').val() != $('#txtContrasena2_ed').val() ){
            alert('Contraseñas deben ser iguales');
            $('#txtContrasena2_ed').focus();
        }else{
        $('#loading').show();$('#btn').prop('disabled', true);
        var formDatax2 = new FormData();
        formDatax2.append('nombreUsuario',nombreUsuario);
        formDatax2.append('contrasena',contrasena);
        formDatax2.append('tipo',tipo);
        formDatax2.append('area',area);
        formDatax2.append('rut',rut);
        formDatax2.append('nombre',nombre);
        formDatax2.append('segNombre',segNombre);
        formDatax2.append('apellido',apellido);
        formDatax2.append('segApellido',segApellido);
        formDatax2.append('email',email);
        formDatax2.append('telefono',telefono);
        formDatax2.append('id',id);
        
        $.ajax({
                url: 'edita_usuario.php',
                type: 'POST',
                data: formDatax2,
                contentType: false,
                processData: false,
                success: function(resp){
                    
$('#loading').hide(); $('#btn').prop('disabled', false);
                        if(resp == 1){
                            alert('¡Usuario editado exitosamente!');
                            location.reload();
                        }else{
                            alert(resp);
                        }
                        
                }
            });
        }
    }
</script>";
        echo '<div class="modal fade" id="modalEdita" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Nuevo usuario</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="return false" onsubmit="return false" method="POST" autocomplete="off" >
                        <div class="form-group">
                            <label for="txtNombreUsuario_ed">Nombre de usuario</label>
                            <input type="text"  name="txtNombreUsuario_ed"  class="form-control" required id="txtNombreUsuario_ed" autocomplete="nope" maxlength="30" placeholder="30 caracteres max.">
                        </div>
                        <div class="form-group">
                            <label for="txtContrasena1_ed">Contraseña</label>
                            <input type="password"  name="txtContrasena1_ed"  class="form-control" required id="txtContrasena1_ed" autocomplete="nope" placeholder="">
                        </div>
                        <script>

                        </script>
                        <div class="form-group">
                            <label for="txtContrasena2_ed">Repetir contraseña</label>
                            <input  type="password"  name="txtContrasena2_ed"  class="form-control" required id="txtContrasena2_ed" autocomplete="off"  placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="txtTipo_ed">Tipo de usuario</label>
                            <select   name="txtTipo_ed"  class="form-control" required id="txtTipo_ed" >';echo $combobit1; echo '    </select>
                        </div>
                        <div class="form-group">
                            <label for="txtArea_ed">Área</label>
                            <select   name="txtArea_ed"  class="form-control" required id="txtArea_ed" >';echo $combobit22; echo '    </select>
                        </div>
                        <div class="form-group">
                            <label for="txtRut_ed">Rut</label>
                            <input type="text"  name="txtRut_ed"  class="form-control" required id="txtRut_ed" placeholder="11.222.333-4" maxlength="12">
                        </div>
                        <script>function mayus(e) {
                                e.value = e.value.toUpperCase();
                                }
                        </script>

                        <div class="form-group">
                            <label for="txtNombre_ed">Nombre</label>
                            <input type="text"  name="txtNombre_ed"  class="form-control" required id="txtNombre_ed" onkeyup="mayus(this);">
                        </div>
                        <div class="form-group">
                            <label for="txtSegNombre_ed">Segundo nombre</label>
                            <input type="text"  name="txtSegNombre_ed"  class="form-control"  id="txtSegNombre_ed" onkeyup="mayus(this);">
                        </div>
                        <div class="form-group">
                            <label for="txtApellido_ed">Apellido</label>
                            <input type="text"  name="txtApellido_ed"  class="form-control" required id="txtApellido_ed" onkeyup="mayus(this);">
                        </div>
                        <div class="form-group">
                            <label for="txtSegApellido_ed">Segundo apellido</label>
                            <input type="text"  name="txtSegApellido_ed"  class="form-control" required id="txtSegApellido_ed" onkeyup="mayus(this);">
                        </div>
                        <div class="form-group">
                            <label for="txtEmail_ed">Email</label>
                            <input type="text"  name="txtEmail_ed"  class="form-control" required id="txtEmail_ed" placeholder="correo@correo.ok">
                        </div>
                        <div class="form-group">
                            <label for="txtTelefono_ed">Teléfono</label>
                             <div class="input-group ">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">+569</div>
                                </div>
                                <input type="text" class="form-control" required id="txtTelefono_ed" placeholder="12345678" maxlength="8">
                              </div>
                        </div>
                        
                    
                </div>
                <div class="modal-footer">
                <div class="text-center" id = "loading" style="display:none;">
                        <div class="spinner-border" role="status">
                          <span class="sr-only">Cargando...</span>
                        </div>
                      </div>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                  <button type="button" class="btn btn-primary" id="btn" onclick="edita_usuario( $(\'#txtNombreUsuario_ed\').val()  ,  $(\'#txtContrasena2_ed\').val()  ,  $(\'#txtTipo_ed\').val()  ,  $(\'#txtArea_ed\').val()  ,  $(\'#txtRut_ed\').val()  ,  $(\'#txtNombre_ed\').val()  ,  $(\'#txtSegNombre_ed\').val()  ,  $(\'#txtApellido_ed\').val()  ,  $(\'#txtSegApellido_ed\').val()  ,  $(\'#txtEmail_ed\').val()  ,  $(\'#txtTelefono_ed\').val()  )">GUARDAR</button>
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
    
}else{
    error();
}
