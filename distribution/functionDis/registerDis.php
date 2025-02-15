<?php

// echo "sdfdfgd";

$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];

include_once "../../admin/functions/connection.php";

$regInsert = "INSERT INTO register
(first_name , last_name , email , password)
VALUES
('$firstName' , '$lastName' , '$email' , '$password')";

$regQuery = $conn -> query($regInsert);

if ($regQuery) {
    header ('location: ../index.php');
} else {
    echo $conn -> error;
}