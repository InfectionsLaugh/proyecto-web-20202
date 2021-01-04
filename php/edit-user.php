<?php

$userId=$_GET['userId'];

require('php/connect.php');

if (!$mysqli->connect_errno) {
    $stmt = $mysqli->prepare("SELECT user_id,user_name,name,email,created_at,updated_at FROM user WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    include 'desplegar_tabla.php';   
}
?>


<div id="form-insert" align="center">
    <form action="all-users.php?option=3&userId=<?=$userId?>" method="post">
        <label for="username">Nombre de usuario</label>
        <input type="text" name="username" id="username" required><br> 
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" required><br> 
        <label for="email">Correo electrónico</label>
        <input type="text" name="email" id="email" required><br> 
        <input type="submit" value="Editar"></p>
    </form>
</div>