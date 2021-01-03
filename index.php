<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/navbar.css">

    <!-- polyfill -->
    <script src="js/inc/shim/Base64.js" type="text/javascript"></script>
    <script src="js/inc/shim/Base64binary.js" type="text/javascript"></script>
    <script src="js/inc/shim/WebAudioAPI.js" type="text/javascript"></script>
    <!-- midi.js package -->
    <script src="js/midi/audioDetect.js" type="text/javascript"></script>
    <script src="js/midi/gm.js" type="text/javascript"></script>
    <script src="js/midi/loader.js" type="text/javascript"></script>
    <script src="js/midi/plugin.audiotag.js" type="text/javascript"></script>
    <script src="js/midi/plugin.webaudio.js" type="text/javascript"></script>
    <script src="js/midi/plugin.webmidi.js" type="text/javascript"></script>
    <!-- utils -->
    <script src="js/util/dom_request_xhr.js" type="text/javascript"></script>
    <script src="js/util/dom_request_script.js" type="text/javascript"></script>

    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/navbar.js"></script>
    <script type="text/javascript" src="js/icons.js"></script>

    <style>
        #wait-modal {
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #878787;
            opacity: 0;
            display: none;
            position: absolute;
        }

        #wait-modal span {
            position: absolute;
            left: 50%;
            color: white;
            top: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-mainbg z-1000">
        <a class="navbar-brand navbar-logo" href="">
            <img src="img/logo.png" width="30" height="30" loading="lazy" alt="">
            Cimapiano
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-white"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            
            <?php if (isset($_SESSION["user_name"])) { ?>
                <div class="hori-selector">
                    <div class="left"></div>
                    <div class="right"></div>
                </div>
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php"><i class="fas fa-music"></i>Inicio</a>
                    </li>
                <?php if($_SESSION["user_name"]=='admin') { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="all-users.php" id="all-users"><i class="fas fa-users-cog"></i>Usuarios</a>
                    </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="view-songs.php" id="my-songs"><i class="fas fa-user"></i>Canciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="home.php" id="userDropdownBtn"><i class="fas fa-user"></i><?= $_SESSION["user_name"] ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="logout"><i class="fas fa-sign-out-alt"></i>Cerrar Sesión</a>
                    </li>
                <?php } else { ?>
                    <button type="button" class="btn nav-btns btn-login open-login"><i class="fas fa-sign-in-alt"></i>Iniciar Sesión</button>
                    <button type="button" class="btn nav-btns btn-register open-register"><i class="fas fa-user-plus"></i>Registrarse</button>
                    <!-- <li class="nav-item">
                        <a class="nav-link open-login" href="#"><i class="fas fa-sign-in-alt"></i>Iniciar Sesion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link open-register" href="#"><i class="fas fa-user-plus"></i>Registrarse</a>
                    </li> -->
                <?php } ?>
            </ul>
        </div>
    </nav>

    <nav class="navbar navbar-light bg-dark z-1000">
        <div class="row no-gutters flex-grow-1">
            <div class="col-sm">
                <div class="form-inline">
                    <label class="navbar-text text-light" for="song-name">Título: </label>
                    <input class="form-control mr-sm-2" id="song-name" type="text" value="Sin título" aria-label="Nombre">
                    <button class="btn btn-outline-success piano-btn" id="song-new"><i class="far fa-file fa-lg mr-0"></i></button>
                    <button class="btn btn-outline-success piano-btn" id="song-save"><i class="fas fa-save fa-lg mr-0"></i></button>
                    <!-- <button class="btn btn-outline-success piano-btn" id="song-download"><i class="fas fa-download fa-lg mr-0"></i></button> -->
                    <button class="btn btn-outline-success piano-btn" id="song-delete"><i class="fas fa-trash-alt fa-lg mr-0"></i></button>
                    
                    
                </div>
            </div>
            <div class="col-sm">
                <div class="form-inline">
                <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Mis canciones
                        </button>
                        <div id="song-list" class="dropdown-menu scrollable-menu" aria-labelledby="dropdownMenu3">
                            
                        </div>
                </div>
                <button class="btn btn-outline-success piano-btn" id="song-play"><i class="far fa-play-circle fa-lg mr-0"></i></button>
                <button class="btn btn-outline-success piano-btn" id="song-stop"><i class="fas fa-stop fa-lg mr-0"></i></button>
                    
                </div>
            </div>

       
            <div class="col-sm justify-content-center d-flex">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Instrumento
                    </button>
                    <div class="dropdown-menu scrollable-menu" aria-labelledby="dropdownMenu2">
                        <h6 class="dropdown-header">Piano</h6>
                        <a class="dropdown-item instrument-option" data-instrument="acoustic_grand_piano" href="#">Grand Piano</a>
                        <a class="dropdown-item instrument-option" data-instrument="electric_piano_1" href="#">Electric Piano</a>
                        <a class="dropdown-item instrument-option" data-instrument="harpsichord" href="#">Harpsichord</a>
                        <a class="dropdown-item instrument-option" data-instrument="music_box" href="#">Music Box</a>
                        <h6 class="dropdown-header">Orquesta</h6>
                        <a class="dropdown-item instrument-option" data-instrument="violin" href="#">Violin</a>
                        <h6 class="dropdown-header">Guitarra</h6>
                        <a class="dropdown-item instrument-option" data-instrument="acoustic_guitar_nylon" href="#">Guitar</a>
                        <h6 class="dropdown-header">Percusión</h6>
                        <a class="dropdown-item instrument-option" data-instrument="synth_drum" href="#">Synth Drum</a>
                    </div>
                </div>
            </div>
            <div class="col-sm justify-content-center d-flex">
                <label class="navbar-text text-light" for="">BPM: </label>
                <input class="form-control mr-sm-2" type="text" id="bpm-text" placeholder="" aria-label="Search">
            </div>
        </div>
    </nav>

    <div id="piano" class="row height-100 no-gutters overflow-auto">
        <div id="playhead-wrapper">
            <div id="playhead"></div>
        </div>
        <div id="keys"></div>
        <div id="main-sequencer">
            <div id="playhead-line"></div>
        </div>
    </div>

    <div class="overlay"></div>

    <main id="register-form" class="d-flex align-items-center py-3 py-md-0">
        <div class="container formL">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div class="col-md-5">
                        <img src="images/piano-login.jpg" alt="login" class="login-card-img">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <p class="login-card-description">Regístrate gratis</p>
                            <form action="#!">
                                <div class="form-group">
                                    <label for="nombre" class="sr-only">Nombre</label>
                                    <input type="nombre" name="sign-up-name" id="sign-up-name" class="form-control" placeholder="Nombre">
                                </div>
                                <div class="form-group">
                                    <label for="usuario" class="sr-only">Usuario</label>
                                    <input type="usuario" name="sign-up-user" id="sign-up-user" class="form-control" placeholder="Usuario">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="sr-only">Correo electrónico</label>
                                    <input type="email" name="sign-up-email" id="sign-up-email" class="form-control" placeholder="Correo electrónico">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password" class="sr-only">Contraseña</label>
                                    <input type="password" name="sign-up-password" id="sign-up-password" class="form-control" placeholder="***********">
                                </div>
                                <input name="sign-up" id="sign-up" class="btn btn-block login-btn mb-4" type="button" value="Unirse">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <main id="login-form" class="d-flex align-items-center py-3 py-md-0">
        <div class="container formL">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div class="col-md-5">
                        <img src="images/piano-login.jpg" alt="login" class="login-card-img">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <i class="fas fa-user-circle login-avatar"></i>
                            <p class="login-card-description" style=>Inicia sesión</p>
                            <form action="#!">
                                <div class="form-group">
                                    <label for="usuario" class="sr-only">Usuario</label>
                                    <input type="usuario" name="login-user" id="login-user" class="form-control" placeholder="Usuario">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password" class="sr-only">Contraseña</label>
                                    <input type="password" name="login-password" id="login-password" class="form-control" placeholder="Contraseña">
                                </div>
                                <input name="login" id="login" class="btn btn-block login-btn mb-4" type="button" value="Ingresar">
                            </form>
                            <div id="success">Inicio de sesión exitoso. Redirigiendo...</div>
                            <div id="failure">Usuario y/o contraseña incorrectos.</div>
                            <a href="#!" class="forgot-password-link">¿Olvidaste tu contraseña?</a>
                            <p class="login-card-footer-text">¿No tienes una cuenta? <a href="#!" class="text-reset">¡Regístrate aquí!</a></p>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <div class="modal" id="wait-modal">
        <span>Cargando...</span>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/p5.min.js"></script>
    <script src="js/login.js"></script>
    <script src="js/main.js"></script>
    <script src="js/midi.js"></script>
    <!-- <script src="js/piano.js"></script> -->
</body>

</html>