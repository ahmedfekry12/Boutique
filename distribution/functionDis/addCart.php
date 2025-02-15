<?php

session_start();
include '../../admin/functions/connection.php';

    $user_id = $_SESSION['user_id'];
    
    $product_id = $_GET['id'];
    

    $checkCartQuery = "SELECT * FROM cart WHERE user_id = $user_id AND pro_id = $product_id";
    $result = $conn->query($checkCartQuery);

    if ($result -> num_rows > 0) {
        
        $updateQuery = "UPDATE cart SET quantities = quantities + 1 WHERE user_id = $user_id AND pro_id = $product_id";
        $conn->query($updateQuery);
    } else {
        
        $insertQuery = "INSERT INTO cart (user_id , pro_id) VALUES ($user_id , $product_id)";
        $result = $conn->query($insertQuery);
    }

    if($result){
    header("Location: ../cart.php");
    exit();
} else {
    
    header("Location: ../login.php");
    exit();
}

?>