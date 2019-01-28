<?php

    include "../includes/db.php";

    $text = $_POST['text'];

    $post_id = $_POST['post_id'];

    $sql = "UPDATE posts SET text='{$text}' WHERE id='{$post_id}'";

    mysqli_query($conn, $sql);

    mysqli_close($conn);

    $receiver_id = $_POST['receiver_id'];

    header("location: ../profile.php?id={$receiver_id}");
?>