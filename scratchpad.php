<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // include all utility and controller classes 
    spl_autoload_register(function($classname) {
        include "classes/$classname.php";
    });

    $db = new Database();
    // $db->query("INSERT INTO hw5_user VALUES (1, 'dkf5gz@virginia.edu', 'Dylan Fernandes')");

    ?>
</body>
</html>