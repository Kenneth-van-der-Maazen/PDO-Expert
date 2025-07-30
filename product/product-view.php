<?php
session_start();
if ($_SESSION['login_status'] != true) {
    header("Location: ../index.php");
    die();
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
    <h2>Product overzicht</h2>
    <a class="btn btn-info" href="product-add.php">Toevoegen</a>
    <a class='btn btn-danger' href='../user/user-logout.php'>Logout</a>

    <br><br>

    <table class="table table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th class="w-25">Image</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
        require "../includes/product-class.php";

        $product = new Product();
        $products = $product->getProducts();

        foreach ($products as $product) {
            echo "<tr>";
            echo "<td>". $product['productCode']. "</td>";
            echo "<td>". $product['naam']. "</td>";
            echo "<td>". $product['description']. "</td>";
            echo "<td>". $product['prijs']. "</td>";
            echo "<td> <img class='w-25' src=".$product['image']."></td>";
            echo "<td><a class='btn btn-primary' href='product-edit.php?productCode=". $product['productCode']. "'>Edit</td>";
            echo "<td><a class='btn btn-danger' href='product-delete.php?productCode=". $product['productCode']. "'>Delete</td>";
            echo "</tr>";   
        }
       ?>
    </table>
</body>
</html>