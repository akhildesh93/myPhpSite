<?php
    include 'includes/permission.php';
    include 'includes/db.php'
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

        <img src="img/profile-photo.jpg" alt="" class="profile-photo">
    </header>


    <div class="about">
        <div class="about__title">
            <h3>Edit Post</h3>
        </div>

        <div class="about__details">

            <form class="about__form" action="process/post-edit.php" method="POST">

                <textarea id="" cols="30" rows="10" class="post-edit__textarea" name="text"></textarea>

                <input type="hidden" name="post_id" value="<?php echo $_GET['post_id']; ?>">
                <input type="hidden" name="receiver_id" value="<?php echo $_GET['receiver_id']; ?>">

                <input type="submit" class="about__submit">

            </form>

        </div>

    </div>

</div>

</body>
</html>