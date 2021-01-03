<?php

require('php/connect.php');

$userId = $_SESSION["id"];

if (!$mysqli->connect_errno) {

    //Consulta albumes
    $stmt = $mysqli->prepare("SELECT album_id, album_name, created_at FROM `album` where user_id = ?");
    $stmt->bind_param("i", $userId,);
    $stmt->execute();
    $albums = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    //Desplegar tabla albumes

    echo '<table>
            <tr>
              <th>Título</th> <th>Creado</th> <th>Editar</th>  <th>Eliminar</th>
            </tr>';
    foreach($albums as $album ){
      echo '<tr>
        <td>'.$album['album_name'].'</td>
        <td>'.$album['created_at'].'</td>
        <td>
        <a href="view-albums.php?option=2&album_id='.$album["album_id"].'">
        <i class="far fa-edit" style="font-size:20px;color:#808080"></i></a>
        </td>
        <td><a href="delete-album.php?album_id='.$album["album_id"].'">
            <i class="far fa-trash-alt" style="font-size:20px;color:#808080"></i>
            </a>
        </td>
      </tr>';
    }
    echo '</table><br><br>';        
}
?>