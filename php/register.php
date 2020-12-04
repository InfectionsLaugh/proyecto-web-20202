<?php

require('./connect.php');

session_start();

$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = md5($_POST['password']);

if(!$mysqli->connect_errno) {
    $stmt = $mysqli->prepare("INSERT INTO user (user_name, name, email, password, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())");
    $stmt->bind_param("ssss", $username, $name, $email, $password);

    $stmt->execute();

    $result = array('result' => 'success');

    echo json_encode($result);
}