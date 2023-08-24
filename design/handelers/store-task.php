<?php
require('../function.php');
session_start();
if(isset($_SESSION['auth'])){
    $id=$_SESSION['auth']['id'];
    
}
// var_dump($id);
// die;
$conn=mysqli_connect("localhost","root","","todoapp");
if(!$conn){
    echo "connect error" . mysqli_connect_error($conn);
}
if(checkMethod("POST")&&isset($_POST['title'])){
    // var_dump($_POST);
    $title=sanitize($_POST['title']);
    if(!maxLength($title,25)){
        $_SESSION['error']='filed should be less than 25 char';
        header('location:../todo.php');
    }
    if(!minLength($title,6)){
        $_SESSION['error']='filed should be more than 6 char';
        header('location:../todo.php');
    }    // var_dump($title);
    if(!notNull($title)){
        $_SESSION['error']='filed require';
        header('location:../todo.php');
        
    }
    header("location:../todo.php");
}else{
    
    $_SESSION['error']='invalid method';
    header("location:../todo.php");
}
if(!isset($_SESSION['error'])){

    $sql="INSERT INTO `tasks`(`title`,`users_id`) VALUES ('$title','$id')";
    // echo mysqli_affected_rows($conn);
    $result = mysqli_query($conn,$sql);
    echo mysqli_affected_rows($conn);
    if(mysqli_affected_rows($conn)==1)
    {
        $_SESSION["success"]="task added successfully!";
        // echo "data insert succeful";
    }
}