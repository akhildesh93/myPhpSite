<?php
session_start();
include '../includes/db.php';

$post_id = $_POST['post_id'];
$user_liked_id = $_SESSION['user_id'];

$sql = "SELECT * FROM post_likes WHERE post_id={$post_id} AND user_liked_id={$user_liked_id}";

$result = mysqli_query($conn, $sql);

$num_results = mysqli_num_rows($result);


if($num_results == 0){

    $sql = "INSERT INTO post_likes (post_id, user_liked_id) VALUES ('{$post_id}', '{$user_liked_id}')";

    mysqli_query($conn, $sql);

    header("Location: ../profile.php?id={$user_liked_id}");

}

mysqli_close($conn);

header("Location: ../profile.php?id={$user_liked_id}");

?>