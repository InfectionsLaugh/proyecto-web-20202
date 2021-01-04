<?php

require('./connect.php');
session_start();


$songId = $_POST['songId'];
$songFile =  $_POST['songArray'];

// $songFile = json_encode([[1],[2],[3]]);

$stmt = $mysqli->prepare("UPDATE song SET song_file = ? WHERE song_id = ?");  

$stmt->bind_param("si",$songFile,$songId);   
$stmt->execute();
