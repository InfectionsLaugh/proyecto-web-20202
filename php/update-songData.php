<?php

require('php/connect.php');

$songId = $_GET['song_id'];
$songName = $_POST['name'];

echo $songId;
echo $songName;
if (!$mysqli->connect_errno) {
    $stmt = $mysqli->prepare("UPDATE song SET song_name = ? WHERE song_id= ?");
    $stmt->bind_param("si", $songName, $songId);

    $stmt->execute();
}

header("Location:view-songs.php");
?>