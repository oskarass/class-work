<?php

if (isset($_POST['submit'])) {
    $num = $_POST['submit'] +1;
} else {
    $num = 0;
}

?>

<html>
    <head>
        <title>Class work</title>
    </head>
    <body>
        <form method="post">
            <input type="submit" name="submit" value="<?php print $num; ?>">
        </form>
    </body>
</html>


