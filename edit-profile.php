<?php

require('php/connect.php');
session_start();

$userId = $_SESSION["id"];
$name = $_POST['name'];
$email = $_POST['email'];
$current_pass = $_POST['current-pass'];
$new_pass = $_POST['new-pass'];
$confirm_new_pass = $_POST['confirm-new-pass'];

echo $userId;
echo $name;
echo $email;
echo $current_pass;
echo $new_pass;
echo $confirm_new_pass;


// if (!$mysqli->connect_errno) {
//     $stmt = $mysqli->prepare("DELETE FROM user WHERE user_id= ?");
//     $stmt->bind_param("i", $userId);

//     $stmt->execute();
// }

// header("Location:all-users.php");




?>