<?php

require('php/connect.php');

$album_id = $_GET['album_id'];

if (!$mysqli->connect_errno) {
    $stmt = $mysqli->prepare("UPDATE song SET album_id = NULL WHERE album_id = ?");
    $stmt->bind_param("i", $album_id);
    $stmt->execute();

    $stmt = $mysqli->prepare("DELETE FROM album WHERE album_id= ?");
    $stmt->bind_param("i", $album_id);
    $stmt->execute();
}

header("Location:view-albums.php");