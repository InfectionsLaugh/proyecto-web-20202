<?php

require('php/connect.php');

if (!$mysqli->connect_errno) {
    // $stmt = $mysqli->prepare("SELECT * FROM song WHERE user_id = ?");
    $stmt = $mysqli->prepare("SELECT * FROM user");
    // $stmt->bind_param("s", $userId,);

    $stmt->execute();

    $result = $stmt->get_result();


// desplegado de resultados de la consulta
echo "<table><tr>";
  while ($titulo= mysqli_fetch_field($result)){
    echo '<th>';
    echo $titulo->name;
    echo '</th>';
  }
  echo '<th>Editar</th>';
  echo '<th>Eliminar</th>';
  echo '</tr>'; 

  if($result->num_rows > 0) {
    while ($row = $result-> fetch_assoc()){
      mysqli_field_seek($result, 0);
      echo '<tr>';
      while ($atributo= mysqli_fetch_field($result)){
        echo '<td>';
        echo $row[$atributo->name];
        echo '</td>';
      }
      echo '<td><a href="all-users.php?option=2&userId='.$row["user_id"].'"><i class="far fa-edit" style="font-size:20px;color:#808080"></i></a>';
        echo '<td><a href="delete-user.php?userId='.$row["user_id"].'"><i class="far fa-trash-alt" style="font-size:20px;color:#808080"></i></a>';
    //   echo '<td><a href="index.php?op=9&id_cliente='.$row["user_id"].'"><i class="far fa-edit" style="font-size:20px;color:#808080"></i></a>';
    //   echo '<td><a href="delete_cliente.php?&id_cliente='.$row["user_id"].'"><i class="far fa-trash-alt" style="font-size:20px;color:#808080"></i></a>';
      echo"</tr>";      
    }
    echo "</table>";
  }
  else {
    echo "0 resultado";
  }
    
    // if ($resultado->num_rows > 0) {
        // output data of each row
    //     while($row = $resultado->fetch_assoc()) {
    //       echo "id: " . $row["song_id"]. " - Name: " . $row["song_name"]. "<br>";
    //     }
    //   } else {
    //     echo "0 results";
    //   }
    
    // include 'desplegar_tabla.php';
    // if($resultado != null) {
    //     echo json_encode($resultado);
    // } else {
    //     echo "null";
    // }
}