<?php

var_dump($_COOKIE);


$counter = 0;
if(isset($_COOKIE['visits'])){
    $counter = $_COOKIE['visits'];
} else {
    $_COOKIE['visits'] = '';
}
$counter++;

setcookie('visits', $counter, time() +3600, '/');

$user_id = rand(0, 1000000);

if(isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $_COOKIE['user_id'] = '';
    setcookie('user_id', $user_id, time() + 3600, '/');
}

?>

<h1> <?php print $_COOKIE['user_id']; ?> </h1>
<h2> <?php print $_COOKIE['visits']; ?> </h2>
