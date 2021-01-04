<?php

require('php/connect.php');

$userId = $_GET['userId'];
$username = $_POST['username'];
$name = $_POST['name'];
$email = $_POST['email'];

if (!$mysqli->connect_errno) {
    // $stmt = $mysqli->prepare("UPDATE user SET email= ?, updated_at = NOW() WHERE user_id= ?");
    // $stmt->bind_param("si",$email, $userId);
    $stmt = $mysqli->prepare("UPDATE user SET user_name = ?, name = ?, email= ?, updated_at = NOW() WHERE user_id= ?");
    $stmt->bind_param("sssi",$username,$name,$email, $userId);

    $stmt->execute();
}

header("Location:all-users.php");