<?php

require('php/connect.php');

$song_id = $_GET['song_id'];

if (!$mysqli->connect_errno) {

    $stmt = $mysqli->prepare("DELETE FROM song WHERE song_id= ?");
    $stmt->bind_param("i", $song_id);
    $stmt->execute();
}

header("Location:view-songs.php");