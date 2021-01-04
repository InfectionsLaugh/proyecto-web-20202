<?php

require('php/connect.php');

$album_id = $_GET['album_id'];
$album_name = $_POST['name'];

if (!$mysqli->connect_errno) {
    $stmt = $mysqli->prepare("UPDATE album SET album_name = ? WHERE album_id= ?");
    $stmt->bind_param("si",$album_name, $album_id);
    $stmt->execute();
}

header("Location:view-albums.php");

?>