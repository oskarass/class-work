<?php

var_dump($_COOKIE);


$user_id = $_COOKIE['user_id'] ?? uniqid();
$visits = ($_COOKIE['visits'] ?? 0) +1;

setcookie('visits', $visits, time() +3600, '/');
setcookie('user_id', $user_id, time() + 3600, '/');

?>

<h1> <?php print $user_id; ?> </h1>
<h2> <?php print $visits; ?> </h2>
