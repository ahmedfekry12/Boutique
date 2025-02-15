<?php

// var_dump($_POST['priv']);

// die();

session_start();

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$address = $_POST['address'];

if (isset($_POST['gender'])) {
    $gender = $_POST['gender'];
} else {
    $gender = null; // أو تعيين قيمة افتراضية
}

$priv = $_POST['priv'];

include "../connection.php";

// if (empty($username)) {
//     $_SESSION['name_error'] = "<div class='alert alert-danger'> username is empty </div>";
//     header("location: ../../users.php?action=add");
//     exit();
// } elseif (empty($email)) {
//     $_SESSION['email_error'] = "<div class='alert alert-danger'> email is empty </div>";
//     header("location: ../../users.php?action=add");
//     exit();
// } elseif (empty($gender)) {
//     $_SESSION['gender_error'] = "<div class='alert alert-danger'> gender is empty </div>";
//     header("location: ../../users.php?action=add");
//     exit();
// } elseif (empty($address)) {
//     $_SESSION['add_error'] = "<div class='alert alert-danger'> address is empty </div>";
//     header("location: ../../users.php?action=add");
//     exit();
// } 

$insert = "INSERT INTO users
    (username , password , email , address , gender , priv)
    VALUES
    ('$username' , '$password' , '$email' , '$address' , '$gender' , '$priv')";

$query = $conn -> query($insert);

if ($query) {

    $id = $conn -> insert_id;

    echo "<tr id = userInfo>
            <td> $id </td>
            <td> $username </td>
            <td> $email </td>
            <td> $address </td>
            <td>" . ($gender == 0 ? 'Male' : 'Female') . "</td>
            <td>" . ($priv == 0 ? 'admin' : 'user') . "</td>
            <td>
                <button class='btn btn-primary editUser' data-id='$id' data-username='$username' data-email='$email' data-address='$address' data-gender='$gender'>Edit</button>
                <button class='btn btn-danger deleteUser' data-id='$id'>Delete</button>
            </td>
        </tr>";
} else {
    echo $conn -> error;
}