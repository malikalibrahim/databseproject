<?php
session_start();
session_destroy();  
header("Location: homepagina.php");
exit();
?>