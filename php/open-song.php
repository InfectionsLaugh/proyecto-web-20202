<?php
// $data = json_decode(file_get_contents('php://input'), true);

require('./connect.php');
session_start();

$songId =  $_GET['song_id'];

$stmt = $mysqli->prepare("SELECT song_file from song where song_id= ?");  
$stmt->bind_param("i",$songId);   
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

// http://127.0.0.1/web/proyecto-web-20202/php/open-song.php?song_id=10


$jsonRespose = isset($result['song_file']) ? $result['song_file'] : json_encode([]);

header('Content-Type: application/json');
echo $jsonRespose;

// $a = [];
// $a['data'] = [[],[23],[23],[],[26],[],[26]];

// echo json_encode($a);

//----------otro archivo

// $userId = $_SESSION[id];
// $stmt = $mysqli->prepare("SELECT * from song where user_id= ?");  
// $stmt->bind_param("i",$userId);   

// cancion1 (value=id_cancion) <- 
// cancion2
// cancion3

