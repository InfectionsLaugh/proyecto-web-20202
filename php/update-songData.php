<?php

require('php/connect.php');

$songId = $_GET['song_id'];
$songName = $_POST['name'];
$album_id = $_POST['albumes'];
if (!$mysqli->connect_errno) {
    $stmt = $mysqli->prepare("UPDATE song SET song_name = ?, album_id = ? WHERE song_id= ?");
    $stmt->bind_param("sii", $songName, $album_id, $songId);

    $stmt->execute();
}

header("Location:view-songs.php");
?>