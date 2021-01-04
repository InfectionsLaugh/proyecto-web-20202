<?php

require('php/connect.php');
session_start();

$userId = $_SESSION["id"];
$album_name = $_POST['name'];

echo $userId;
echo $album_name;

$stmt = $mysqli->prepare("INSERT INTO album (album_name,user_id,created_at) 
                            VALUES (?,?,NOW())");  

$stmt->bind_param("si",$album_name,$userId);   
$stmt->execute();

header("Location:view-albums.php");