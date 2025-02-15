<?php

// echo "ahmed";

include "../connection.php";

$id = $_GET['id'];

$deletePro = "DELETE FROM products WHERE id = $id";

$queryPro = $conn -> query($deletePro);

if ($queryPro) {
    header("location: ../../products.php");
} else {
    echo $conn -> error;
}