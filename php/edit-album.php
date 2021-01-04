<?php

$album_id=$_GET['album_id'];

require('php/connect.php');

if (!$mysqli->connect_errno) {
    
    $stmt = $mysqli->prepare("SELECT album_name, created_at from album where album_id=?");
    $stmt->bind_param("i", $album_id);
    $stmt->execute();
    $result = $stmt->get_result();
    include 'desplegar_tabla.php';    
}
?>

<div id="form-insert" align="center">
    <form action="view-albums.php?option=3&album_id=<?=$album_id?>" method="post">
        <label for="name">Título de álbum</label>
        <input type="text" name="name" id="name" required><br> 
        <input type="submit" value="Editar"></p>
    </form>
</div>


