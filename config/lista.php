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
    echo "<h1>".$_POST['estado']."  ".$_POST['area']."</h1>";
    var_dump($_POST);
    
    
    
    
    
    
}else{
    
    echo "<script>alert('aaaaaaaaa');</script>";
}



?>
</div>
    </body>
</html>
