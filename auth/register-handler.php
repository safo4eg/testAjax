<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'on');
    require_once('../utils/funcs.php');

    $data = [];
    foreach($_POST as $k => $v) if(empty($_POST[$k])) $data['errors'][$k] = "Field $k must be filled!";
    if(empty($data['errors'])) {
        $login = $_POST['login'];
        $pass1 = $_POST['password1'];
        $pass2 = $_POST['password2'];

        $link = get_connection_obj();
        if(!isset($link)) {
            $data['errors']['mysqli'] = 'Error $link: '.mysqli_connect_error();
            echo json_encode($data);
            die();
        }

        $query = "SELECT * FROM users WHERE login='$login'";
        $result = mysqli_query($link, $query);
        if(!$result) {
            $data['errors']['mysqli'] = 'Error query: '.mysqli_error($link);
            echo json_encode($data);
            die();
        }

        $user = mysqli_fetch_assoc($result);
        if($user) {
            $data['errors']['login'] = 'This user already exists';
        }

        if($pass1 !== $pass2) {
            $data['errors']['password1'] = 'Password mismatch';
        }

        if(!empty($data['errors'])) {
            echo json_encode($data);
            die();
        }

        $password = password_hash($pass1, PASSWORD_DEFAULT);

        $query = "INSERT INTO users SET login='$login',password='$password',status_id=1";
        $result = mysqli_query($link, $query);
        if(!$result) {
            $data['errors']['mysqli'] = 'Error query: '.mysqli_error($link);
            echo json_encode($data);
            die();
        }

        echo 'Пользователь успешно создан!';

    } else echo json_encode($data);