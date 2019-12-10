<?php

if (isset($_POST['submit'])) {
    $num = $_POST['submit'] +1;
    for($i=1; $i <= $num; $i++) {
        print "<img src=\"https://api.time.com/wp-content/uploads/2019/11/gettyimages-459761948.jpg?w=200&quality=85\">";
    }
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


