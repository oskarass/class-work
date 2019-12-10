<?php

function square() {
    if(isset($_POST['submit'])) {
        $x = $_POST['number'];
        $answer = $x * $x;
        return $answer;
    }
}

?>
<form method="post">
    <p>Ka pakelti kvadratu</p>
    <input type="number" name="number">
    <button type="submit" name="submit">Submit</button>
</form>
<h2>Atsakymas: <?php print square(); ?></h2>


