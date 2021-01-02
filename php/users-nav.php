<?php

if(isset($_GET["option"]))
	$option=$_GET["option"];
else 
	$option=1;
switch($option) {
    case 1:
        $titulo="Usuarios registrados";
		$contenido="php/display-users.php";
	break;
    case 2:
        $titulo="Editar usuario";
		$contenido="php/edit-user.php";
	break;	
    case 3:
        $titulo="Actualizando";
		$contenido="php/update-user.php";					
	break;	
	// case 4:
	// 	$contenido=".php";
	// break;
	// case 5:
	// 	$contenido=".php";
	// break; 
}

?>