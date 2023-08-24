<?php
session_start();
require_once "../function.php";
$conn = mysqli_connect("localhost", "root", "", "todoapp");
if (!$conn) {
    echo "not connected" . "<br>";
}
if (checkMethod("POST")) {
    $errors = [];

    foreach ($_POST as $key => $value) {
        $$key = sanitize($value);
    }

    if (!notNull($name)) {
        $errors['name'] = "Name is required";
    } elseif (!minLength($name, 2)) {
        $errors['name'] = "Name must be at least 3 characters";
    } elseif (!maxLength($name, 15)) {
        $errors['name'] = "Name must be smaller than 15 characters";
    }

    if (!notNull($email)) {
        $errors['email'] = "Email is required";
    } elseif (!emailValid($email)) {
        $errors['email'] = "Email is invalid";
    }


    $sql = "SELECT `email` FROM `users`";
    $result = mysqli_query($conn, $sql);
    // $users =mysqli_fetch_assoc($result);
    while ($row = mysqli_fetch_assoc($result)) {
        // var_dump($row['email']);

        if ($row['email'] == $email) {
            $errors['email'] = "Email Already Exists";
        }
    }

    if (!notNull($password)) {
        $errors['password'] = "Password is required";
    } elseif (!minLength($password, 6)) {
        $errors['password'] = "Password must be at least 7 characters";
    } elseif (!maxLength($password, 15)) {
        $errors['password'] = "password must be smaller than 15 characters";
    }

    if (empty($errors)) {


        $sql = "INSERT INTO `users`( `email`, `name`, `password`) VALUES ('$email','$name','$password')";
        $result = mysqli_query($conn, $sql);
        if (mysqli_affected_rows($conn) == 1) {
            $_SESSION["success"] = "user added successfully!";
            header("location:../index.php");
        }

    } else {
        $_SESSION['error'] = $errors;
        header("location:../index.php");
        // die;
    }




} else {
    $_SESSION['request_error'] = "Invalid Method";
    header("location:../index.php");
    // die;
}