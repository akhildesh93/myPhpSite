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
    <body id="profile-about">

        <?php include 'includes/profile-login-nav.php'?>




        <div class="container">

            <header>
                <img src="img/beach.jpg" alt="" class="cover-photo">

                <?php include "includes/profile-menu-bar.php"; ?>

                <img src="img/profile-photo.jpg" alt="" class="profile-photo" style="width: 200px;">
            </header>


            <div class="about">
                <div class="about__title">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <h3>About</h3>
                </div>

                <div class="about__details">
                    <div class="about__details-left">
                        <ul>
                            <li>Contact and Basic Info</li>
                        </ul>
                    </div>
                    
                    <div class="about__details-right">

                        <?php
                            $user_id = $_SESSION['user_id'];
                            $sql = "SELECT * FROM users WHERE id={$user_id} LIMIT 1";
                            $result = mysqli_query($conn, $sql);
                        ?>

                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>

                        <div class="row">
                            <div class="one-of-four">
                                Mobile Phone
                            </div>
                            <div class="three-of-four">
                                <?php echo $row['phone_number']; ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="one-of-four">
                                Email
                            </div>
                            <div class="three-of-four">
                                <?php echo $row['email']; ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="one-of-four">
                                Birth Date
                            </div>
                            <div class="three-of-four">
                                <?php echo date('F d Y', strtotime($row['bday'])); ?>
                            </div>
                        </div>


                        <div class="row">
                            <div class="one-of-four">
                                Gender
                            </div>
                            <div class="three-of-four">
                                <?php echo $row['gender'];?>
                            </div>
                        </div>

                        <?php endwhile; ?>

                        <div class="row about__edit-btn">
                            <div class="one-of-four">
                                &zwnj;
                            </div>
                            <div class="three-of-four">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                <a href="about-edit.php">Edit</a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>





    </body>
</html>