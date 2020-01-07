<?php

function is_logged_in() {
    if(!empty($_SESSION)) {
        $array = file_to_array(DB_FILE);
        foreach($array as $value) {
            if($value['name'] === $_SESSION['username']) {
                if($value['password'] !== $_SESSION['password']) {
                    header('location:logout.php');
                } else {
                    return true;
                }
            }
        }
    } else {
        return false;
    }
}

function logout($redirect = false) {
    $_SESSION = [];
    session_destroy();
    setcookie(session_name(), null, -1);

    if ($redirect) {
        header("location: login.php");
    }
}