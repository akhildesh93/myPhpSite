<?php
    session_start();

    include '../includes/db.php';

    $email = $_POST['email'];
    $bday = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
    $gender = $_POST['gender'];
    $phone_number = $_POST['phone_number'];
    $user_id = $_SESSION['user_id'];

    $sql = "UPDATE users SET email='{$email}', bday='{$bday}', gender='{$gender}', phone_number='{$phone_number}' WHERE id={$user_id}";

    mysqli_query($conn, $sql);

    mysqli_close($conn);

    header("Location: ../about.php");

?>