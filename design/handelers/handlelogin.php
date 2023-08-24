<?php
session_start();
require("../function.php");
$conn = mysqli_connect("localhost", "root", "", "todoapp");
if (!$conn) {
    echo "not connected" . "<br>";
}
if (checkMethod("POST")) {
    $errors = [];
    foreach ($_POST as $key => $value) {
        $$key = sanitize($value);
    }

    if (!notNull($email)) {
        $errors['email'] = "Email is required";
    } elseif (!emailValid($email)) {
        $errors['email'] = "Email is invalid";
    }
    if (!notNull($password)) {
        $errors['password'] = "Password is required";
    } elseif (!minLength($password, 6)) {
        $errors['password'] = "Password must be at least 7 characters";
    } elseif (!maxLength($password, 15)) {
        $errors['password'] = "password must be smaller than 15 characters";
    }
    if (empty($errors)) {
        $sql = "SELECT * FROM `users`";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            // var_dump($row['email'],$row['password']);
                            if ($row['email'] == $email) {
                                if($row['password'] == $password){
                                    $_SESSION['auth'] = $row;
                                    header("location:../todo.php");
                                    die;

                                }
                            }
                            else{
                                $_SESSION['error_login'] = "Invalid email or password";
                                header("location:../login.php");
                                // die;

            }
        }

    } else {
        $_SESSION['error'] = $errors;
        header("location:../login.php");
        die();
    }
} else {
    $_SESSION['error_method'] = "Invalid";
    header("location:../login.php");
    die();
}