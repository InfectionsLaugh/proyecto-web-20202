<?php

require('php/connect.php');

$userId = $_SESSION["id"];

if (!$mysqli->connect_errno) {

    // Consulta canciones 
    $stmt = $mysqli->prepare("SELECT s.song_id, s.song_name, a.album_name, s.created_at, s.updated_at FROM `song` `s` left join `album` `a` on s.album_id = a.album_id where s.user_id = ?");
    $stmt->bind_param("i", $userId,);
    $stmt->execute();
    $songs = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
    //Consulta albumes
    $stmt = $mysqli->prepare("SELECT album_id, album_name, created_at FROM `album` where user_id = ?");
    $stmt->bind_param("i", $userId,);
    $stmt->execute();
    $albums = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    // Desplegar tabla canciones
    echo '<table>
            <tr>
              <th>Título</th> <th>Album</th> <th>Creada</th> <th>Actualizada</th> <th>Eliminar</th>
            </tr>';
    foreach($songs as $song ){
      echo '<tr>
        <td>'.$song['song_name'].'
        <a href="view-songs.php?option=2&song_id='.$song["song_id"].'">
        <i class="far fa-edit" style="font-size:20px;color:#808080"></i></a>
        </td>
        <td>'.$song['album_name'].'</td>
        <td>'.$song['created_at'].'</td>
        <td>'.$song['updated_at'].'</td>
        <td><a href="delete-song.php?song_id='.$song["song_id"].'">
            <i class="far fa-trash-alt" style="font-size:20px;color:#808080"></i>
            </a>
        </td>
      </tr>';
    }
    echo '</table>';


    echo '<select name="albumes[]" required>';
      foreach($albums as $album ){
        echo '<option value="'.$album['album_id'].'"';
        // if($row==$album){
        //   echo 'selected';
        // }
        echo '>'.$album['album_name'].'</option>'; 
      }
      echo '</select><p></p>';

         
}
?>