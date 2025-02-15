<?php

// echo "rtjtrjy";

session_start();

include "../../admin/functions/connection.php";

$username = $_POST['username'];
$password = $_POST['password'];

$_SESSION['username'] = $username;

$selectLog = "SELECT * FROM register WHERE first_name = '$username' AND password = '$password'";

$queryLog = $conn -> query($selectLog);
$row = $queryLog -> fetch_assoc();

$_SESSION['user_id'] = $row['id'];


if ($queryLog -> num_rows > 0) {
    
    header ("location: ../index.php");
} else {
    $_SESSION['error'] = "<div class='alert alert-danger'> wrong credentials </div>";
    header ("location: ../login.php");

    // $conn -> error;
}