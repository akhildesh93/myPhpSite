<?php
include 'includes/permission.php';
include 'includes/db.php';
?>
<!doctype html>
<html lang="en">
<head>

    <title>ZBOOK</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

</head>
<body id="search">

    <?php include 'includes/profile-login-nav.php'?>

    <div class="search-results">
    <div class="container">

        <?php
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT * FROM friend_requests WHERE requested_id={$user_id}";
            $result = mysqli_query($conn, $sql);
        ?>

        <?php while ($row = mysqli_fetch_assoc($result)): ?>

            <?php
                $requester_id = $row['requester_id'];
                $sql = "SELECT * FROM users WHERE id={$requester_id}";
                $profile_result = mysqli_query($conn, $sql);
            ?>


            <?php while ($requester = mysqli_fetch_assoc($profile_result)) : ?>
            <div class="search-results__single">
                <img src="img/profile-photo.jpg" alt="">
                <a><?php echo $requester['first_name'] . ' ' . $requester['last_name']; ?></a>

                <form action="process/friend-accept.php" method="post">
                    <input type="hidden" name="user_id_two" value="<?php echo $requester['id']; ?>">
                    <button>
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                        <span>Accept Request</span>
                    </button>
                </form>
            </div>
            <?php endwhile; ?>


        <?php endwhile; ?>

    </div>


</div>







</body>
</html>