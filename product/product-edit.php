<?php
require "../includes/product-class.php";
echo "<a class='btn btn-danger' href='../user/user-logout.php'>Logout</a>";

session_start();
if ($_SESSION['login_status'] != true) {
    header("Location: ../index.php");
    die();
}

if (!isset($_GET['productCode'])) {
    echo "Selecteer eerst een product!";
    header("refresh:2, url = product-view.php");
}



try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $product = new Product();

        // XSS protection
        $name = htmlspecialchars($_POST['name']);
        $description = htmlspecialchars($_POST['description']);
        $price = htmlspecialchars($_POST['price']);
        $productCode = htmlspecialchars($_GET['productCode']); 

        $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $product->editProduct($name, $description, $price, $target_file, $productCode);
            echo "Product edited!";
            header("refresh:2, url = product-view.php");
        }
    } 
}catch (Exception $e) {
    echo $e->getMessage();
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
    <h2>Edit product</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="description" placeholder="Description" required>
        <input type="number" name="price" min="1" step="any" required>
        <input type="file" name="fileToUpload" required>
        <input type="submit">
    </form>
</body>
</html>