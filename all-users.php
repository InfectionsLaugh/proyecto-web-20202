<?php
session_start();
if (!isset($_SESSION["user_name"])) {
    header("Location:index.php");
}
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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Usuarios</title>

  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="css/table.css">



  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/navbar.js"></script>
  <script type="text/javascript" src="js/icons.js"></script>


</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-mainbg">
    <a class="navbar-brand navbar-logo" href="#">Cimapiano</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars text-white"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <div class="hori-selector">
                    <div class="left"></div>
                    <div class="right"></div>
                </div>
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="fas fa-music"></i>Inicio</a>
                </li>
                <?php if (isset($_SESSION["user_name"])) { ?>
                    <?php if($_SESSION["user_name"]=='admin') { ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="all-users.php" id="all-users"><i class="fas fa-users-cog"></i>Usuarios</a>
                    </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="view-albums.php" id="my-albums"><i class="fas fa-compact-disc"></i>Mis Albumes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view-songs.php" id="my-songs"><i class="fas fa-file-audio"></i>Mis Canciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="home.php" id="userDropdownBtn"><i class="fas fa-user"></i><?= $_SESSION["user_name"] ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="logout"><i class="fas fa-sign-out-alt"></i>Cerrar Sesión</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link open-login" href="#"><i class="fas fa-sign-in-alt"></i>Iniciar Sesion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link open-register" href="#"><i class="fas fa-user-plus"></i>Registrarse</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
  </nav>
  <nav class="navbar navbar-light bg-dark z-1000">
        <div class="row no-gutters flex-grow-1">
            <div class="col-sm">
                <div class="form-inline">
                <h2></h2>
                </div>
            </div>
        </div>
    </nav>
  <div class="container">
    <div class="row gutters-sm">
    <h2 id="title-header">		
		<?php 
		echo $titulo; 
	  	?>	  	
          </h2>
          <br><br>

    <?php include $contenido; ?>      
    
    </div>

  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="js/login.js"></script>
</body>

</html>