<?php

$song_id=$_GET['song_id'];

require('php/connect.php');

if (!$mysqli->connect_errno) {
    $stmt = $mysqli->prepare("SELECT s.song_name as `Título`, a.album_name as `Album`, s.created_at  as `Creada`, s.updated_at as `Actualizada` FROM `song` `s` left join `album` `a` on s.album_id = a.album_id  WHERE song_id = ?");
    $stmt->bind_param("i", $song_id);

    $stmt->execute();

    $result = $stmt->get_result();

    include 'desplegar_tabla.php';    
}
?>

<div class="form-style-6" align="center">
    <form action="view-songs.php?option=3&song_id=<?=$song_id?>" method="post">
        <input type="text" name="name" id="name" required><br> 
        <label for="name">Título de canción</label>
        <input type="submit" value="Editar"></p>
    </form>
</div>


