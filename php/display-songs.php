<?php

require('php/connect.php');
// session_start();

// http://localhost/web/proyecto-web-20202/index.php

// http://localhost/web/proyecto-web-20202/song.php?id_song=12

$userId = $_SESSION["id"];

if (!$mysqli->connect_errno) {
    // $stmt = $mysqli->prepare("SELECT * FROM song WHERE user_id = ?");
    $stmt = $mysqli->prepare("SELECT song_id, song_name, created_at, updated_at FROM song where user_id = ?");
    $stmt->bind_param("i", $userId,);

    $stmt->execute();

    $result = $stmt->get_result();
  


    // desplegado de resultados de la consulta
echo "<table><tr>";
while ($titulo= mysqli_fetch_field($result)){
  echo '<th>';
  echo $titulo->name;
  echo '</th>';
}
echo '<th>Abrir</th>';
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
          echo '<td><a href="php/open-song.php?song_id='.$row["song_id"].'"><i class="far fa-folder-open" style="font-size:20px;color:#808080"></i></a>';
          echo"</tr>";      
        }
        echo "</table>";
      }
      else {
        echo "0 resultado";
      }


    
}