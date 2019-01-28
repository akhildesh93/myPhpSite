<?php

    include "../includes/db.php";

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $bday = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
    $gender = $_POST['gender'];

    $sql = "INSERT INTO users (first_name, last_name, email, password, bday, gender) VALUES ('{$first_name}', '{$last_name}', '{$email}', '{$password}', '{$bday}', '{$gender}')";

    mysqli_query($conn, $sql);

    mysqli_close($conn);

    header('Location: ../index.php');

?>