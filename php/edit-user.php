<?php

$userId=$_GET['userId'];

require('php/connect.php');

if (!$mysqli->connect_errno) {
    $stmt = $mysqli->prepare("SELECT * FROM user WHERE user_id = ?");
    $stmt->bind_param("i", $userId);

    $stmt->execute();

    $result = $stmt->get_result();

    include 'desplegar_tabla.php';
    // <form action="index.php?op=4&id_cita='.$cita.'" method="post">
    
}
?>


<div class="form-style-6" align="center">
    <form action="all-users.php?option=3&userId=<?=$userId?>" method="post">
        <label for="username">Nombre de usuario</label>
        <input type="text" name="username" id="username" required><br> 
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" required><br> 
        <label for="email">Correo electronico</label>
        <input type="text" name="email" id="email" required><br> 
        <!-- <label for="password">Contraseña</label>
        <input type="text" name="password" id="password" required><br> -->
        <input type="submit" value="Editar"></p>
    </form>
</div>