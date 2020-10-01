<?php 
require 'config/configuracionIndex.php';
require 'config/conecta.php';
$conexion = conecta();
head("Brechas");
?>
<div class="container" >
    <h1 class="text-center font-weight-bold ">PLATAFORMA DE GESTIÓN DE BRECHAS</h1>
         
    <?php
    session_name('brechas');
    session_start();
    //if(isset($_SESSION['usuario']) && isset($_SESSION['contrasena']) && isset($_SESSION['tipo']) && isset($_SESSION['area']) ){
    if(isset($_SESSION['id'])  && isset($_SESSION['tipo']) && isset($_SESSION['area']) ){
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
                    <!--<button  class='btn btn-primary'  onclick=\"valida(document.getElementById('txtUsuario').value,document.getElementById('txtContrasena').value)\">Ingresar</button>-->
                    <button  class='btn btn-primary'  onclick=\"valida($('#txtUsuario').val(),$('#txtContrasena').val())\">Ingresar</button>
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
    
    

    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>