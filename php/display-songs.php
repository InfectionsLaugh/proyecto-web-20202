<?php

require('php/connect.php');

$userId = $_SESSION["id"];

if (!$mysqli->connect_errno) {
    $stmt = $mysqli->prepare("SELECT s.song_id, s.song_name as `Título`, a.album_name as `Album`, s.created_at  as `Creada`, s.updated_at as `Actualizada` FROM `song` `s` inner join `album` `a` on s.album_id = a.album_id where s.user_id = ?");
    $stmt->bind_param("i", $userId,);
    $stmt->execute();
    $result = $stmt->get_result();
    $test  = $result;
    // $stmt2 = $mysqli->prepare("SELECT album_id, album_name as `Nombre`, created_at as `Creado` FROM `album` where user_id = ?");

    $stmt2 = $mysqli->prepare("SELECT album_id, album_name FROM `album` where user_id = ?");
    $stmt2->bind_param("i", $userId,);
    $stmt2->execute();
    // $albums = $stmt2->get_result();
    

    $rows = $stmt2->get_result()->fetch_all(MYSQLI_ASSOC);

    $album_id = [];
    $album_name = [];
    
    foreach($rows as $row ){
        $album_id[] = $row['album_id'];
        $album_name[] = $row['album_name'];
    }

    // Imprime una lista de albumes
    function printSelector($album_name,$album_id,$row){   
      echo '<select name="albumes[]" required>';
      $index=0;
      foreach($album_name as $album ){
        echo '<option value="'.$album_id[$index].'"';
        if($row==$album){
          echo 'selected';
        }
        echo '>'.$album.'</option>'; 
        $index++;
      }
      echo '</select><p></p>';
    }

    // desplegado de resultados de la consulta
echo "<table><tr>";
while ($titulo= mysqli_fetch_field($result)){
  // No imprimir song_id
  if($titulo->name!='song_id'){
    echo '<th>';
    echo $titulo->name;
    echo '</th>';
  }
}
echo '<th>Eliminar</th>';
echo '</tr>'; 

    if($result->num_rows > 0) {
        while ($row = $result-> fetch_assoc()){
          mysqli_field_seek($result, 0);
          echo '<tr>';
          while ($atributo= mysqli_fetch_field($result)){
            //No imprimir song_id
            if($atributo->name!='song_id'){
              echo '<td>';
              
              if($atributo->name=='Título'){
                echo '<a href="view-songs.php?option=2&song_id='.$row["song_id"].'"><i class="far fa-edit" style="font-size:20px;color:#808080"></i></a>';
              }
              if($atributo->name=='Album'){
                printSelector($album_name,$album_id,$row[$atributo->name]);
              }
              else{
                echo $row[$atributo->name];
              }
              echo '</td>';
            }
          }
          echo '<td><a href="delete-song.php?song_id='.$row["song_id"].'"><i class="far fa-trash-alt" style="font-size:20px;color:#808080"></i></a></td>';
          echo"</tr>";      
        }
        echo "</table>";
      }
      else {
        echo "0 resultado";
      }
      
      
     
      
    
}