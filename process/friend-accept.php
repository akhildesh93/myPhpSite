<?php
session_start();
include "../includes/db.php";

$user_id_one = $_SESSION['user_id'];
$user_id_two = $_POST['user_id_two'];

/*CREATE FRIENDSHIP LINK IN FRIENDS TABLE*/
$sql = "INSERT INTO friends (user_id_one, user_id_two) VALUES ('{$user_id_one}', '{$user_id_two}')";
mysqli_query($conn, $sql);


/*DELETE OUTSTANDING FRIEND REQUEST*/

$sql = "DELETE FROM friend_requests WHERE (requested_id={$user_id_one} AND requester_id={$user_id_two}) OR (requested_id={$user_id_two} AND requester_id={$user_id_one})";

mysqli_query($conn, $sql);

mysqli_close($conn);

header("Location: ../profile.php?id={$user_id_one}");



?>
