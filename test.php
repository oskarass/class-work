<?php

session_start();

if(!isset($_COOKIE['PHPSESSID'])) {
    header('location:/classwork/test.php');
} else {
    $_SESSION['user_id'] = $_COOKIE['PHPSESSID'];
    $user_id = $_SESSION['user_id'];
}

$visits = ($_COOKIE['visits'] ?? 0) +1;

setcookie('visits', $visits, time() +3600, '/');

?>

<h1><?php print $user_id; ?></h1>
<h2><?php print $visits; ?></h2>
