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
    //$comentario = $_POST['comentario'];

    $fecha = date("d-m-Y");
   echo var_dump($_POST);
    
    $contenido='<!DOCTYPE html>
<html>
<head>
<title>HTML</title>
</head>
<body>
<h1>Comentario en brecha </h1>
<table border="1">
    <tr>
        <td>ID </td>
        <td>Titulo</td>
        <td>Descripción</td>
        <td>Area destino</td>

    </tr>
    <tr>
        <td>32</td>
        <td>sdsdafdsaafsdf asdsdsa  as</td>
        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor quidem vero eos reiciendis repellat sequi est dolorem cum laboriosam, maxime, consequuntur perspiciatis nemo ipsa neque dolorum maiores, assumenda in ut?</td>
        <td>GPDO</td>
    </tr>
    
</table>
<br>
<label for="comentario" > <strong> Comentario:</strong></label>
<p name="comentario" id="comentario">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consectetur, at earum. Magni veniam tempore beatae sunt a neque. Voluptatem ipsum itaque quis possimus illum architecto repudiandae facere rem a ratione?</p>
<p>Enviado por: Supervisor 08-10-2020</p>
<label for="correo"> <strong> Correo:</strong></label>
<p name="correo" id="correo">kadjlas@aklak.cl</p>
<label for="numero"><strong>Teléfono: </strong></label>
<p name="numero" id="numero">+56989855512</p>




<h3>Mensaje automático, no responder.</h3>
</body>
</html>';
}else{
    error();
}