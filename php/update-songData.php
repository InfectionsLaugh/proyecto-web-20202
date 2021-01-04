<?php

require('php/connect.php');

$songId = $_GET['song_id'];
$songName = $_GET['song_name'];


if (!$mysqli->connect_errno) {
    // $stmt = $mysqli->prepare("UPDATE user SET email= ?, updated_at = NOW() WHERE user_id= ?");
    // $stmt->bind_param("si",$email, $userId);
    $stmt = $mysqli->prepare("UPDATE user SET song_name = ? WHERE song_id= ?");
    $stmt->bind_param("si", $songName, $songId);

    $stmt->execute();
}

header("Location:all-users.php");