<?php

session_start();

$_SESSION['visits'] = ($_SESSION['visits'] ?? 0) + 1;

$h1 = session_id();
$h2 = $_SESSION['visits'];

?>

<h1><?php print $h1; ?></h1>
<h2><?php print $h2; ?></h2>
