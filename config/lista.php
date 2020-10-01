<?php 
require 'configuracionPaginas.php';
require 'conecta.php';
$conexion = conecta();
head("Brechas");
?>
<div class="container" >
<?php
session_name('brechas');
session_start();
//if(isset($_SESSION['id'])  && isset($_SESSION['tipo']) && isset($_SESSION['area']) && isset($_POST['estado']) && isset($_POST['area']) ){
if(isset($_SESSION['id'])  && isset($_SESSION['tipo']) && isset($_SESSION['area'])  ){
    echo "<script>            $('.salir').show();                </script>";
    $estado = $_GET['estado'];
    $area = $_GET['area'];
    


    
    
    
    
    
    
    
    
    
    
    
}else{
    vuelve1();
}



?>
</div>
    </body>
</html>
