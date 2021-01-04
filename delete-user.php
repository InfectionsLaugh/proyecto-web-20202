<?php

require('php/connect.php');

$userId = $_GET['userId'];


if (!$mysqli->connect_errno) {
    $stmt = $mysqli->prepare("DELETE FROM user WHERE user_id= ?");
    $stmt->bind_param("i", $userId);

    $stmt->execute();
}

header("Location:all-users.php");