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

            <!-------------------------------->
            <!--START - SEARCH QUERY RESULTS-->
            <!-------------------------------->

            <?php if(isset($_POST['search_submit'])): ?>

                <?php
                    $search_query = $_POST['search_query'];
                    $user_id = $_SESSION['user_id'];
                    $sql = "SELECT * FROM users WHERE (first_name LIKE '%{$search_query}%' OR last_name LIKE '%{$search_query}%') AND id <> {$user_id}";
                    $result = mysqli_query($conn, $sql);
                ?>

                <?php while($row = mysqli_fetch_assoc($result)) : ?>

                    <div class="container">

                        <div class="search-results__single">
                            <img src="img/profile-photo.jpg" alt="">
                            <a><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></a>

                            <form action="process/friend-request.php" method="POST">
                                <input type="hidden" name="requested_id" value="<?php echo $row['id']; ?>">
                                <button>
                                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                                    <span>Add Friend</span>
                                </button>
                            </form>
                        </div> <!--END SINGLE SEARCH RESULTS-->

                    </div> <!--END CONTAINER-->

                <?php endwhile; ?>




            <!-------------------------------->
            <!--END - SEARCH QUERY RESULTS-->
            <!-------------------------------->


            <?php else : ?>





            <!---------------------------->
            <!--START - SHOW ALL RESULTS-->
            <!---------------------------->

            <?php
                $user_id = $_SESSION['user_id'];
                $sql = "SELECT * FROM users WHERE id <> {$user_id}";
                $result = mysqli_query($conn, $sql);
            ?>


            <?php while($row = mysqli_fetch_assoc($result)) : ?>

                <div class="container">

                    <div class="search-results__single">
                        <img src="img/profile-photo.jpg" alt="">
                        <a><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></a>

                        <form action="process/friend-request.php" method="POST">
                            <input type="hidden" name="requested_id" value="<?php echo $row['id']; ?>">
                            <button>
                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                                <span>Add Friend</span>
                            </button>
                        </form>
                    </div> <!--END SINGLE SEARCH RESULTS-->

                </div> <!--END CONTAINER-->

            <?php endwhile; ?>

            <!-------------------------->
            <!--END - SHOW ALL RESULTS-->
            <!-------------------------->


            <?php endif; ?>


        </div>

    </body>
</html>