<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
<?php
session_start();

if (isset($_GET['id'])) {

    $conn = mysqli_connect("localhost", "root", "", "todoapp");
    if (!$conn) {
        $_SESSION['error'] = "not connected" . "<br>";
    }
    // $id = $_GET['id'];
    $_SESSION['user_id'] = $_GET['id'];
    $sql = "SELECT * FROM `tasks` WHERE `id`='$_GET[id]'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);
    // echo "<pre>";
    // var_dump($row[1]);
}

?>
<form action="handleUpdate.php" method="POST">

    <div class="container mt-5 text-center">
        <div class="row">
            <div style="border: 3px solid black;" class="col-12 text-center">
                <div class="col-12 my-5">

                    <h1>UPDATE</h1>
                </div>
                <div class="col-12 my-5">

                    <h2>
                            <?php
    if (isset($_SESSION['error'])) {

        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
    ?>
                    </h2>
                </div>
                <div class="col-12 my-5">

                    <input type="text" name="updateTask" placeholder="please enter value to update">
                </div>
                <div class="col-12 my-5">

                    <input type="submit">
                </div>
            </div>
        </div>
    </div>



</form>