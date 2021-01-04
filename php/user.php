<?php

require('./connect.php');

session_start();

if (!isset($_POST['edit'])) {
    $user_name = $_POST['user'];
    $user_pass = md5($_POST['pass']);
    if (!$mysqli->connect_errno) {
        $stmt = $mysqli->prepare("SELECT * FROM user WHERE user_name = ? AND password = ?");
        $stmt->bind_param("ss", $user_name, $user_pass);

        $stmt->execute();

        $result = $stmt->get_result()->fetch_assoc();

        if ($result != null) {
            $_SESSION["user_name"] = $result["user_name"];
            $_SESSION["name"] = $result["name"];
            $_SESSION["email"] = $result["email"];
            $_SESSION["created_at"] = $result["created_at"];
            $_SESSION["id"] = $result["user_id"];
            echo json_encode($result);
        } else {
            echo "null";
        }
    }
} else if (isset($_POST['edit'])) {
    if (!$mysqli->connect_errno) {
        $field = $_POST['field'];
        if ($field == "user_name") {
            $stmt = $mysqli->prepare("SELECT user_name FROM user WHERE user_name = ?");
            $stmt->bind_param("s", $_POST['data']);

            $stmt->execute();

            $result = $stmt->get_result()->fetch_assoc();

            if ($result != null) {
                $arr = ['result' => 'fail', 'message' => 'El usuario ya existe'];
                echo json_encode($arr);
            } else {
                $stmt = $mysqli->prepare("UPDATE user SET user_name = ? WHERE user_id = ?");
                $stmt->bind_param("si", $_POST['data'], $_SESSION['id']);

                $stmt->execute();

                $result = $stmt->get_result();

                if ($result == false) {
                    $arr = ['result' => 'success', 'message' => 'Nombre de usuario actualizado correctamente', 'value' => $_POST['data']];
                    $_SESSION['user_name'] = $_POST['data'];
                    echo json_encode($arr);
                } else {
                    $arr = ['result' => 'fail', 'message' => 'Error actualizando nombre de usuario'];
                    echo json_encode($arr);
                }
            }
        } else if ($field == "email") {
            $stmt = $mysqli->prepare("SELECT email FROM user WHERE email = ?");
            $stmt->bind_param("s", $_POST['data']);

            $stmt->execute();

            $result = $stmt->get_result()->fetch_assoc();

            if ($result != null) {
                $arr = ['result' => 'fail', 'message' => 'Este correo ya fue registrado'];
                echo json_encode($arr);
            } else {
                $stmt = $mysqli->prepare("UPDATE user SET email = ? WHERE user_id = ?");
                $stmt->bind_param("si", $_POST['data'], $_SESSION['id']);

                $stmt->execute();

                $result = $stmt->get_result();

                if ($result == false) {
                    $arr = ['result' => 'success', 'message' => 'Correo actualizado correctamente', 'value' => $_POST['data']];
                    $_SESSION['email'] = $_POST['data'];
                    echo json_encode($arr);
                } else {
                    $arr = ['result' => 'fail', 'message' => 'Error actualizando correo'];
                    echo json_encode($arr);
                }
            }
        } else if ($field == "password") {
            $stmt = $mysqli->prepare("SELECT password FROM user WHERE password = MD5(?)");
            $stmt->bind_param("s", $_POST['data']);

            $stmt->execute();

            $result = $stmt->get_result()->fetch_assoc();

            if ($result != null) {
                $arr = ['result' => 'fail', 'message' => 'Tu nueva contraseña no puede ser igual a tu vieja contraseña'];
                echo json_encode($arr);
            } else {
                $stmt = $mysqli->prepare("UPDATE user SET password = MD5(?) WHERE user_id = ?");
                $stmt->bind_param("si", $_POST['data'], $_SESSION['id']);

                $stmt->execute();

                $result = $stmt->get_result();

                if ($result == false) {
                    $arr = ['result' => 'success', 'message' => 'Contraseña actualizada correctamente', 'value' => $_POST['data']];
                    echo json_encode($arr);
                } else {
                    $arr = ['result' => 'fail', 'message' => 'Error actualizando contraseña'];
                    echo json_encode($arr);
                }
            }
        } else {
            $stmt = $mysqli->prepare("UPDATE user SET name = ? WHERE user_id = ?");
            $stmt->bind_param("si", $_POST['data'], $_SESSION['id']);

            $stmt->execute();

            $result = $stmt->get_result();

            if ($result == false) {
                $arr = ['result' => 'success', 'message' => 'Nombre actualizado correctamente', 'value' => $_POST['data']];
                $_SESSION['name'] = $_POST['data'];
                echo json_encode($arr);
            } else {
                $arr = ['result' => 'fail', 'message' => 'Error actualizando nombre'];
                echo json_encode($arr);
            }
        }
    }
}
