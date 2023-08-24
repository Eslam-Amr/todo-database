<?php
session_start();
if (isset($_GET['id'])) {
    // echo $_GET['id'] ;

    $conn = mysqli_connect("localhost", "root", "", "todoapp");
    if (!$conn) {
        $_SESSION['error']= "not connected" . "<br>";
    }
    $id = $_GET['id'];
    $sql = "SELECT * FROM `tasks` WHERE `id`='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);
    if (!$row) {

        $_SESSION['error']= "data not exisit";
    }
else{

    $sql = "DELETE FROM `tasks` WHERE `id`='$id'";
    $result = mysqli_query($conn, $sql);
}



    if (mysqli_affected_rows($conn) == 0) {
        $_SESSION['error']= "data not exisit";
    }
    if (mysqli_affected_rows($conn) == 1) {
        $_SESSION["delete"] = "task deleted successfully!";
        // echo "data insert succeful";
    }

    header("location:../todo.php");

}