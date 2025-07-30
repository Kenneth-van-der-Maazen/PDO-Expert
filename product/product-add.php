<?php
require "../includes/product-class.php";

session_start();
if ($_SESSION['login_status'] != true) {
    header("Location: ../index.php");
    die();
}
echo "<a class='btn btn-danger' href='../user/user-logout.php'>Logout</a>";
echo "<a class='btn btn-info' href='product-view.php'>Product overzicht</a>";



try {
    $product = new Product();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target_path = "../images/";  
    $target_path = $target_path.basename($_FILES['fileToUpload']['name']);   
  
        if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_path)) {  
            $name = htmlspecialchars($_POST['name']);
            $description = htmlspecialchars($_POST['description']);
            $price = htmlspecialchars($_POST['price']);
            $categorie = htmlspecialchars($_POST['categorie']);

            $product->addProduct($name, $description, $price, $target_path, $categorie);
            echo "Product toegevoegd!";
    }
    }     
} catch (\Exception $e) {
    echo "Error: ". $e->getMessage();
    exit();
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
    <h2>Product toevoegen</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Name" required> <br>
        <input type="text" name="description" placeholder="Description" required><br>
        <input type="number" name="price" min="1" step="any" placeholder="Prijs" required><br>
        <input type="file" name="fileToUpload"/><br>
        <select name="categorie" required>
        <option value=''>Selecteer een categorie</option>;
            <?php 
                $categoris = $product->getCategorie();
                foreach ($categoris as $categorie) {
                    echo "<option value='". $categorie['categorieId']. "'>". 
                    $categorie['naam']. "</option>";
                }
            ?>
        </select>
        <input type="submit">
    </form>
</body>
</html>