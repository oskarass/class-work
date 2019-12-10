<?php

$status = "";
$displayCert = false;

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $level = $_POST['level'];

    if (empty($name) || empty($lastname) || empty($age) || empty($level)) {
        $status = "All fields must be filled!";
    } else {
        if (!preg_match("/[a-zA-Z-'\s]+$/", $name) || !preg_match("/[a-zA-Z-'\s]+$/", $lastname)) {
            $status = "Enter a valid Name and Last name!";
        } elseif (is_int($age)) {
            $status = "Only numbers required";
        } else {
            $displayCert = true;
            $name = "Name: $name";
            $lastname = "Last name: $lastname";
            $age = "Age: $age";
            $level = "Level: $level";
        }
    }

}

?>

<html>
<head>
    <title>Class work</title>
</head>
<body>
    <h4>Dumbass Form</h4>
    <form method="post">
        <input type="name" name="name" placeholder="Name" required>
        <input type="name" name="lastname" placeholder="Last name" required>
        <input type="number" name="age" placeholder="Age">
        <select name="level">
            <option>Pradedantysis</option>
            <option>Pazenges</option>
            <option>Profesionalas</option>
        </select>
        <input type="submit" name="submit" value="Generate form">
    </form>
    <h3><?php print $status; ?></h3>
    
    <?php if($displayCert) : ?>
        <div>
            <h2>Dumbass Certificate</h2>
            <h4><?php print $name; ?></h4>
            <h4><?php print $lastname; ?></h4>
            <h4><?php print $age; ?></h4>
            <h4><?php print $level; ?></h4>
            <img src="http://www.liberaldictionary.com/wp-content/uploads/2019/01/dumbass-3.jpg">
        </div>
    <?php endif; ?>
</body>
</html>


