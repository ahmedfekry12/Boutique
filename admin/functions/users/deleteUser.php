<?php

// echo "sddfdfsd";

include_once "../connection.php";

$id = $_POST['id'];

$delete = "DELETE FROM users WHERE id = $id";

$delQuery = $conn -> query($delete);

if ($delQuery) {
    // header ("location: ../../users.php");
    echo "success";
} else{
    echo $conn -> error;
}