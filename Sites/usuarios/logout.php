<?php
session_start();
unset($_SESSION['uid']); 
unset($_SESSION['nombre']); 
unset($_SESSION['rut']); 
unset($_SESSION['edad']); 
unset($_SESSION['sexo']); 
unset($_SESSION['contra']); 
header("Location: http://codd.ing.puc.cl/~grupo94/index.php");
?>