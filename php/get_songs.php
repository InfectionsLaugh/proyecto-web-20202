<?php

require('./connect.php');
session_start();
$userId =  $_SESSION['id'];


// $userId = 4;

$stmt = $mysqli->prepare("SELECT song_name from song where user_id= ?");  
$stmt->bind_param("i",$userId);   
$stmt->execute();

// $result = $stmt->get_result();
$rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$songs = [];

foreach($rows as $row ){
    $songs[] = $row['song_name'];
}


header('Content-Type: application/json');
echo json_encode($songs);