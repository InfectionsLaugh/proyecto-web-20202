<?php
// $data = json_decode(file_get_contents('php://input'), true);

require('./connect.php');
session_start();


$userId = $_SESSION["id"];
$songName = $_POST['songName'];
$songFile =  $_POST['songArray'];
$isPrivate = 1;

$stmt = $mysqli->prepare("INSERT INTO song (song_name,song_file,is_private,user_id,created_at, updated_at) 
                            VALUES (?,?,?,?,NOW(), NOW())");  

$stmt->bind_param("ssii",$songName,$songFile,$isPrivate,$userId);   
$stmt->execute();
