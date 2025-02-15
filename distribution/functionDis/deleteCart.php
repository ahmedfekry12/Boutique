<?php

// echo "delete";
// echo $_POST['id'];
// die();

include "../../admin/functions/connection.php";
$id = $_POST['id'];

$delItem = "DELETE FROM cart WHERE pro_id = $id";
$query = $conn -> query($delItem);

if ($query) {
    echo "success";
} else {
    $conn -> error;
}