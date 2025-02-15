<?php

$name = $_POST['name'];
$price = $_POST['price'];
$sale = $_POST['sale'];
$description = $_POST['description'];
$category = $_POST['category'];


if (isset($_FILES['images']) && count($_FILES['images']['name']) > 0) {
    $upladedImgs = [];
    $extension = ['jpg' , 'png' , 'gif' , 'jpeg'];

    foreach ($_FILES['images']['name'] as $key => $imgName) {
        $temp = $_FILES['images']['tmp_name'][$key];
        $ext = pathinfo($imgName , PATHINFO_EXTENSION);

        if (in_array($ext , $extension)) {
            
            if ($_FILES['images']['size'][$key] < 5000000) {
                $newImg = md5(uniqid()) . '.' . $ext;

                move_uploaded_file($temp , "../../img/$newImg");

                $upladedImgs[] = $newImg;
            } else {
                echo "the size is to big";
                exit();
            }

        } else {
            echo "Wrong file extension";
            exit();
        }
    }
} else {
    echo 'You Must Upload An Image';
    exit();
}

include "../connection.php";

// if ($conn) {
//     echo "efgweerf";
// }

$insertPro = "INSERT INTO products

(name , price , sale , description , category_id)

VALUES

('$name' , '$price' , '$sale' , '$description' , '$category')";

if ($conn -> query($insertPro)) {
    $product_id = $conn->insert_id;
    // echo $product_id;

    foreach ($upladedImgs as $image) {
        $insertImg = "INSERT INTO images
        (product_id , img)
        VALUES
        ('$product_id' , '$image')";

        $conn -> query($insertImg);
    }

    header("location: ../../products.php");
} else {
    echo $conn -> error;
}