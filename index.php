<?php 
require 'config/configuracionPaginas.php';
require 'config/conecta.php';
$conexion = conecta();
head("Brechas");
?>
<div class="container" >
         
    <?php
    session_name('brechas');
    session_start();
    if(isset($_SESSION['usuario']) && isset($_SESSION['contrasena']) && isset($_SESSION['tipo'])){
        despliega_menu($conexion);
        //echo "Sesion iniciada";
        echo "<script>
            $('.salir').show();
                </script>";
    }else{
        echo "<div class='logeo shadow-lg p-3 mb-5  rounded ' id='logeo'>
                <h1 class='font-weight-bold text-center'>BRECHAS</h1>
                <form action='return false' onsubmit='return false' method='POST'>
                    <div class='form-group'>
                        <label for='txtUsuario' >Usuario</label>
                        <input type='text' name='usuario' class='form-control' id='txtUsuario' placeholder='Usuario'>
                    </div>
                    <div class='form-group'>
                        <label for='txtContraseña' >Contraseña</label>
                        <input type='password' name='contrasena' class='form-control' id='txtContrasena' placeholder='Contraseña'>
                    </div>
                    <button  class='btn btn-primary'  onclick=\"valida(document.getElementById('txtUsuario').value,document.getElementById('txtContrasena').value)\">Ingresar</button>
                </form>  
            </div>";
        echo "<script>
	function valida(user, pass)
	{
		$.ajax({
			url: 'config/valida.php',
			type: 'POST',
			data: 'usuario='+user+'&contrasena='+pass,
			success: function(resp){
				$('#contenido').html(resp);
			}
		});
	}
        </script>";
    }
    ?>
          <div class="container" id="contenido">
              
          </div>
          
        </div>
    
    

    
  </body>
</html>