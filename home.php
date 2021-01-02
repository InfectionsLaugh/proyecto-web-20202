<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Saludos</title>

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
      <ul class="navbar-nav ml-auto">
        <div class="hori-selector">
          <div class="left"></div>
          <div class="right"></div>
        </div>
        <li class="nav-item">
          <a class="nav-link" href="index.php"><i class="fas fa-music"></i>Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0);"><i class="far fa-folder-open"></i>Biblioteca</a>
        </li>
        <li class="nav-item  active">
          <a class="nav-link" href="#" id="userDropdownBtn"><i class="fas fa-user"></i><?= $_SESSION["user_name"] ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0);"><i class="fas fa-sign-out-alt"></i>Cerrar Sesion</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <div class="row gutters-sm">
      <!-- Menu -->
      <div class="col-md-4 d-none d-md-block">
        <div class="card">
          <div class="card-body">
            <nav class="nav flex-column nav-pills nav-gap-y-1">
              <a href="#profile" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded active">
                <i class="fas fa-user"></i>Mi perfil
              </a>
              <a href="#account" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                <i class="fas fa-user-cog"></i>Ajustes
              </a>
              <a href="#songs" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                <i class="far fa-file-audio"></i>Mis canciones
              </a>
            </nav>
          </div>
        </div>
      </div>
      <!-- Content -->
      <div class="col-md-8">
        <div class="card">
          <div class="card-header border-bottom mb-3 d-flex d-md-none">
            <ul class="nav nav-tabs card-header-tabs nav-gap-x-1" role="tablist">
              <li class="nav-item">
                <a href="#profile" data-toggle="tab" class="nav-link has-icon active"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                  </svg></a>
              </li>
              <li class="nav-item">
                <a href="#account" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings">
                    <circle cx="12" cy="12" r="3"></circle>
                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                    </path>
                  </svg></a>
              </li>
              <li class="nav-item">
                <a href="#songs" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                  </svg></a>
              </li>
            </ul>
          </div>
          <div class="card-body tab-content">
            <div class="tab-pane active" id="profile">
              <h6>TU INFORMACION PERSONAL</h6>
              <hr>
              <div class="form-group">
                <p>Nombre de usuario:</p>
              </div>
              <div class="form-group small text-muted"><?= $_SESSION["user_name"] ?></div>

              <div class="form-group">
                <p>Nombre completo:</p>
              </div>
              <div class="form-group small text-muted"><?= $_SESSION["name"] ?></div>

              <div class="form-group">
                <p>Correo electrónico:</p>
              </div>
              <div class="form-group small text-muted"><?= $_SESSION["email"] ?></div>

              <div class="form-group">
                <p>Miembro desde:</p>
              </div>
              <div class="form-group small text-muted">11-19-2020</div>



            </div>
            <div class="tab-pane" id="account">
              <h6>AJUSTES DE CUENTA</h6>
              <hr>
              <form action="edit-profile.php" method="post">
                <div class="form-group">
                  <label for="username">Cambiar nombre personal</label>
                  <input type="text" class="form-control" name="name" id="name" aria-describedby="usernameHelp" placeholder="Ingresa tu nombre">
                </div>
                <hr>
                <div class="form-group">
                  <label for="username">Cambiar correo electronico</label>
                  <input type="text" class="form-control" name="email" id="email" aria-describedby="usernameHelp" placeholder="Nuevo correo electrónico">
                </div>
                <hr>
                <div class="form-group">
                  <label class="d-block">Cambiar contrasena</label>
                  <input type="text" class="form-control" name="current-pass" id="current-pass" placeholder="Ingresa tu contraseña actual">
                  <input type="text" class="form-control mt-1" name="new-pass" id="new-pass" placeholder="Nueva contraseña">
                  <input type="text" class="form-control mt-1" name="confirm-new-pass" id="confirm-new-pass" placeholder="Confirma tu nueva contraseña">
                </div>
                <input type="submit" class="btn btn-primary" value="Save"></input>
                <button type="button" class="btn btn-primary">Actualizar perfil</button>
                <!-- <button type="reset" class="btn btn-light">Reset Changes</button> -->
              </form>
            </div>
            <div class="tab-pane" id="songs">
              <h6>MIS CANCIONES</h6>
              <hr>
              
              <?php include 'php/view-songs.php';?>

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>