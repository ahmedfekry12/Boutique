<?php

// echo "rtjtrjy";

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

include_once "../connection.php";

$logSelect = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$logQuery = $conn -> query($logSelect);
$user = $logQuery -> fetch_assoc();


// $id_priv = $user['priv'];
// $selectPriv = "SELECT priv_name FROM privliges WHERE id = $id_priv";

// $query = $conn->query($selectPriv);
// $row = $query -> fetch_assoc();

// $type = $row['priv_name'];

// $_SESSION['type'] = $type;

if ($logQuery -> num_rows > 0) {
    $login_id = $user['id'];
    $_SESSION['login_id'] = $login_id;
    header("location: ../../index.php");
} else {
    $_SESSION['error'] = "<div class='alert alert-danger'> wrong credentials </div>";
    header ("location: ../../login.php");
}