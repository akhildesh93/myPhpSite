<?php
    session_start();
    include '../includes/db.php';

    $requester_id = $_SESSION['user_id'];
    $requested_id = $_POST['requested_id'];


    /*STEP 1: CHECK TO SEE IF A REQUEST EXISTS*/
        $sql = "SELECT * FROM friend_requests WHERE requester_id={$requester_id} AND requested_id={$requested_id}";
        $result = mysqli_query($conn, $sql);
        $num_results = mysqli_num_rows($result);

        if($num_results >= 1){
            header("Location: ../search.php");
        } else {
            /*STEP 2: ADD FRIEND REQUEST (IF NON EXISTS)*/

            $sql = "INSERT INTO friend_requests (requester_id, requested_id) VALUES ('{$requester_id}', '{$requested_id}')";
            mysqli_query($conn, $sql);
            mysqli_close($conn);

            header("location: ../search.php");

        }



?>