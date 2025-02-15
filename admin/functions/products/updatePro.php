<?php

// echo "sdfdfg";

$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$sale = $_POST['sale'];
$description = $_POST['description'];
$category = $_POST['category'];

include "../connection.php";

// select old images
$oldImagesQuery = "SELECT img FROM images WHERE product_id = $id";
$oldImagesResult = $conn -> query($oldImagesQuery);

while($oldImages = $oldImagesResult -> fetch_assoc()){
    $oldImgPath = $oldImages['img'];
    
    // delete old images from folder
    if (file_exists($oldImgPath)) {
        unlink($oldImgPath);
    }
}

// delete old images from database
$deleteOld = "DELETE FROM images WHERE product_id = $id";
$conn -> query($deleteOld);


if (!empty($_FILES['images']['name'][0])) {

$uploadedImg = [];

    foreach ($_FILES['images']['name'] as $key => $updatedImg) {
        $tmp = $_FILES['images']['tmp_name'][$key];
        $ext = pathinfo($updatedImg , PATHINFO_EXTENSION);

        $newImg = md5(uniqid()) . '.' . $ext;

        move_uploaded_file($tmp , "../../img/$newImg");

        $uploadedImg[] = $newImg;


    $updatePro = "UPDATE products SET
            name = '$name',
            price = '$price',
            sale = '$sale',
            description = '$description',
            category_id = '$category'
        WHERE id = $id";
    
    $queryPro = $conn -> query($updatePro);
    
    if ($queryPro) {

        foreach ($uploadedImg as $updetedImages) {

            $insertImg = "INSERT INTO  images
                (product_id , img)
                VALUES
                ('$id' , '$updetedImages')";
        }
        $conn -> query($insertImg);
        }
}

    header("location: ../../products.php");
} else {
    echo $conn -> error;
}