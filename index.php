<?php

require('bootloader.php');

require_once ('functions/form/validators.php');

is_logged_in();

$show_form = isset($_SESSION['user_id']) ? true : false;

?>

<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <?php if($show_form): ?>
    <div class="text-center">
        <img src="https://i.kym-cdn.com/photos/images/newsfeed/000/114/139/tumblr_lgedv2Vtt21qf4x93o1_40020110725-22047-38imqt.jpg">
        <h3 class="mt-5">Username: <?php print $_SESSION['username']; ?></h3>
        <h3>User ID: <?php print $_SESSION['user_id']; ?></h3>

        <a href="logout.php" class="btn btn-primary mt-5">Log fucking out</a>
    </div>
    <?php else: ?>
        <?php header('location:login.php'); ?>
    <?php endif; ?>
    </body>
</html>
