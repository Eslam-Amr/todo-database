<?php
require("../function.php");

session_start();
if(checkMethod("POST")){
    $updatetask=sanitize($_POST['updateTask']);
    if(!maxLength($updatetask,25)){
        $_SESSION['error']='filed should be less than 25 char';
        header('location:./update-tasks.php');
    }
    if(!minLength($updatetask,6)){
        $_SESSION['error']='filed should be more than 6 char';
        header('location:./update-tasks.php');
    }
    if(!notNull($updatetask)){
        $_SESSION['error']='filed require';
        header('location:./update-tasks.php');
        
    }
    // $row = mysqli_fetch_row($result);
    
}else{
    $_SESSION['error']='invalid method';
    header('location:../index');
}
if(!isset($_SESSION['error'])){
    $conn = mysqli_connect("localhost", "root", "", "todoapp");
    if (!$conn) {
        echo "not connected" . "<br>";
    }
    $sql = "UPDATE `tasks` set title='$updatetask'  WHERE `id`='$_SESSION[user_id]'";
    $result=mysqli_query($conn,$sql);
    $_SESSION['success']='tasks update successfully';
    
    header('location:../todo.php');

}


// echo $_SESSION['user_id'];


var_dump($_POST['updateTask']);