<?php
session_start();
require 'includes/user-class.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Index</title>
</head>
<body>
    <h2>Index</h2>
    <?php
    if (isset($_SESSION['login_status']) &&  $_SESSION['login_status'] == true) {
        echo "Welkom " . $_SESSION['name'] . "!<br>";
        echo '<button><a href="user/user-logout.php">Uitloggen</a></button>';
    } else {
        echo '<button><a href="user/user-register.php">Registreer</a></button><br>';
        echo '<button><a href="user/user-login.php">Login</a></button>';
    }
    ?>
</body>
</html>