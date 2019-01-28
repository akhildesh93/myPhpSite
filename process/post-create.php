<?php
    session_start();

    include '../includes/db.php';

    $poster_id = $_SESSION['user_id'];

    $receiver_id = $_POST['receiver_id'];

    $text = $_POST['text'];

    $sql = "INSERT INTO posts (poster_id, receiver_id, text) VALUES ('{$poster_id}', '{$receiver_id}', '{$text}')";

    mysqli_query($conn, $sql);

    mysqli_close($conn);

    header("Location: ../profile.php?id={$receiver_id}");


?>