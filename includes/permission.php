<?php
    session_start();
    if($_SESSION['permission'] !== 1){
        header("Location: index.php");
    }
?>