<?php

$song_id=$_GET['song_id'];
$userId = $_SESSION["id"];

require('php/connect.php');

if (!$mysqli->connect_errno) {
    $stmt = $mysqli->prepare("SELECT s.song_name as `Título`, a.album_name as `Album`, s.created_at  as `Creada`, s.updated_at as `Actualizada` FROM `song` `s` left join `album` `a` on s.album_id = a.album_id  WHERE song_id = ?");
    $stmt->bind_param("i", $song_id);

    $stmt->execute();

    $result = $stmt->get_result();

    include 'desplegar_tabla.php';    

    //Consulta albumes
    $stmt = $mysqli->prepare("SELECT album_id, album_name, created_at FROM `album` where user_id = ?");
    $stmt->bind_param("i", $userId,);
    $stmt->execute();
    $albums = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
    echo '   
    <div id="form-insert" align="center">
        <form action="view-songs.php?option=3&song_id='.$song_id.'" method="post">
            <label for="name">Título de canción</label>
            <input type="text" name="name" id="name" required><br> 
            <label for="albumes">Album</label>
            <select name="albumes" required>';
            echo '<option value="null">Sin álbum</option>';
            foreach($albums as $album ){
                echo '<option value="'.$album['album_id'].'">'.$album['album_name'].'</option>'; 
            }
            echo '</select><p></p>
            <input type="submit" value="Editar"></p>
        </form>
    </div>';

}
?>
