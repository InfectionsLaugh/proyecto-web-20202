<?php

require('./connect.php');

session_start();

$user_name = $_POST['user'];
$user_pass = md5($_POST['pass']);

if (!$mysqli->connect_errno) {
    $stmt = $mysqli->prepare("SELECT * FROM user WHERE user_name = ? AND password = ?");
    $stmt->bind_param("ss", $user_name, $user_pass);

    $stmt->execute();

    $result = $stmt->get_result()->fetch_assoc();

    if($result != null) {
        $_SESSION["user_name"] = $result["user_name"];
        $_SESSION["name"] = $result["name"];
        $_SESSION["email"] = $result["email"];
        $_SESSION["id"] = $result["user_id"];
        echo json_encode($result);
    } else {
        echo "null";
    }
}