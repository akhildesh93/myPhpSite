<?php
    session_start();

    include "../includes/db.php";

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='{$email}' LIMIT 1";

    $result = mysqli_query($conn, $sql);

    $db_user_data = mysqli_fetch_assoc($result);

    if($password == $db_user_data['password']){
        $_SESSION['permission'] = 1;
        $_SESSION['user_id'] = $db_user_data['id'];
        header("location: ../profile.php?id={$db_user_data['id']}");
    } else{
        header("location: ../index.php");
    }

?>