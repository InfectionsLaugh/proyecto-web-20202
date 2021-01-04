<?php

require('php/connect.php');

$userId = $_SESSION["id"];

if (!$mysqli->connect_errno) {

    // Consulta canciones 
    $stmt = $mysqli->prepare("SELECT s.song_id, s.song_name, a.album_name, s.created_at, s.updated_at FROM `song` `s` left join `album` `a` on s.album_id = a.album_id where s.user_id = ?");
    $stmt->bind_param("i", $userId,);
    $stmt->execute();
    $songs = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
    // Desplegar tabla canciones
    echo '<table>
            <tr>
              <th>Título</th> <th>Album</th> <th>Creada</th> <th>Actualizada</th> <th>Editar</th> <th>Eliminar</th>
            </tr>';
    foreach($songs as $song ){
      echo '<tr>
        <td>'.$song['song_name'].'</td>
        <td>';

        if($song['album_name']==null)
          echo 'Sin álbum';
        else
          echo $song['album_name'];
        
        echo '</td>
        <td>'.$song['created_at'].'</td>
        <td>'.$song['updated_at'].'</td>
        <td><a href="view-songs.php?option=2&song_id='.$song["song_id"].'">
        <i class="far fa-edit" style="font-size:20px;color:#808080"></i></a>
        </td>
        <td><a href="delete-song.php?song_id='.$song["song_id"].'">
            <i class="far fa-trash-alt" style="font-size:20px;color:#808080"></i>
            </a>
        </td>
      </tr>';
    }
    echo '</table>';
         
}
?>