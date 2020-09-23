<?php
session_name('brechas');
session_start();
session_destroy();
header("location:../index.php");
exit();

?>
