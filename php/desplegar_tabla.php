

<?php
// desplegado de resultados de la consulta
echo "<table>";
  while ($titulo= mysqli_fetch_field($result)){
    echo '<th>';
    echo $titulo->name;
    echo '</th>';
  }
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
      echo"</tr>";      
    }
    echo "</table>";
  }
  else {
    echo "0 resultado";
  }
?>