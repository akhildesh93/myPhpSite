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

                <?php include "includes/profile-menu-bar.php";?>

                <img src="img/profile-photo.jpg" alt="" class="profile-photo" style="width: 200px;">            </header>


            <div id="profile-photos">
                <div class="about__title">
                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                    <h3>Photos</h3>

                    <form action="process/photo-create.php" method="POST" enctype="multipart/form-data">
                        <input type="file" name="photo">
                        <button>+Add</button>
                    </form>
                </div>

                <div class="profile-photos">

                    <div class="row">

                        <?php
                            $user_id = $_SESSION['user_id'];
                            $sql = "SELECT * FROM photos WHERE user_id={$user_id}";
                            $result = mysqli_query($conn, $sql);
                        ?>

                        <?php while ($row = mysqli_fetch_assoc($result)): ?>

                        <div class="one-of-four">
                            <a><img src="img/<?php echo $row['file_name']; ?>" alt="" style="width: 100%; border: 10px solid white"></a>
                        </div>

                        <?php endwhile; ?>

                    </div> <!--END ROW-->


                </div>

            </div>

        </div>

    </body>
</html>