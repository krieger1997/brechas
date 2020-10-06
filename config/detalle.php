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
    echo "<div id='respuesta'>";
    echo "aaaaaaaaaaa";
    echo "</div>";
}else{
    echo "<div id='respuesta'>";
    echo "<H1>ERROR</H1>";
    echo "</div>";
}
       
    
    

?>
