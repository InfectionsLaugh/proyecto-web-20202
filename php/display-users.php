<?php

require('php/connect.php');

if (!$mysqli->connect_errno) {
    $stmt = $mysqli->prepare("SELECT user_id, user_name, name, email , created_at, updated_at FROM user");
    $stmt->execute();
    // $result = $stmt->get_result();
    $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);


    // Desplegar tabla usuarios
    echo '<table>
          <tr><th>ID usuario</th> <th>Usuario</th>  <th>Nombre</th>
            <th>Correo electrónico</th> <th>Creado</th> <th>Actualizado</th> 
            <th>Editar</th> <th>Eliminar</th>
          </tr>';
    foreach($users as $user ){
      echo '<tr>
      <td>'.$user['user_id'].'</td>
      <td>'.$user['user_name'].'</td>
      <td>'.$user['name'].'</td>
      <td>'.$user['email'].'</td>
      <td>'.$user['created_at'].'</td>
      <td>'.$user['updated_at'].'</td>
      <td><a href="all-users.php?option=2&userId='.$user["user_id"].'">
        <i class="far fa-edit" style="font-size:20px;color:#808080"></i></a>
      </td>
      <td><a href="delete-user.php?userId='.$user["user_id"].'">
        <i class="far fa-trash-alt" style="font-size:20px;color:#808080"></i></a>
      </td>
      </tr>';
    }
    echo '</table>';
  }