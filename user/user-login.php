<?php
require '../includes/user-class.php';



try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sql = new User();

        // XSS protection
        $name = htmlspecialchars($_POST['name']);
        $password = htmlspecialchars($_POST['password']);

        $userData = $sql->loginUser($name);

        if ($userData && password_verify($password, $userData['password'])) {
            session_start();
            $_SESSION['login_status'] = true;
            $_SESSION['name'] = $userData['name'];

            echo "<br>Hello, " . $userData['name'] . "!";
            header("refresh:2, url = ../index.php");
        } else {
            echo "<br>Invalid username or password.";
        }
    }
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
<h2>Inloggen</h2>
<form method="POST">
        <input type="text" name="name" placeholder="Name" required><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <input type="submit">
    </form>
<a href="user-register.php">Nog geen account?</a>
</body>
</html>