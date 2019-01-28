<?php
session_start();
include '../includes/db.php';

$user_id_one = $_SESSION['user_id'];
$user_id_two = $_POST['user_id_two'];


$sql = "DELETE FROM friends WHERE (user_id_one={$user_id_one} AND user_id_two={$user_id_two}) OR (user_id_one={$user_id_two} AND user_id_two={$user_id_one})";

mysqli_query($conn, $sql);

mysqli_close($conn);

header("Location: ../profile.php?id={$user_id_one}");



?>