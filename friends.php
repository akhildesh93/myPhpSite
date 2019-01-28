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


            <div id="profile-friends">
                <div class="about__title">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <h3>Friends</h3>
                </div>

                <div class="profile-friends__list">

                    <div class="row">


                        <?php

                            $friend_list = null;

                            $current_user_id = $_SESSION['user_id'];
                            $sql = "SELECT * FROM friends WHERE user_id_one={$current_user_id} OR user_id_two={$current_user_id}";
                            $result = mysqli_query($conn, $sql);

                            while($row = mysqli_fetch_assoc($result)){
                                foreach($row as $key => $value){
                                    if($key == 'user_id_one' && $value !== $current_user_id){
                                        $friend_list[] = $value;
                                    }
                                    if($key == 'user_id_two' && $value !== $current_user_id){
                                        $friend_list[] = $value;
                                    }
                                }
                            }

                            $num_friends_list = count($friend_list);

                        ?>




                        <?php for($i = 0; $i < $num_friends_list; $i++):?>

                            <?php
                                $sql = "SELECT * FROM users WHERE id={$friend_list[$i]}";
                                $result = mysqli_query($conn, $sql);
                                $friend_info = mysqli_fetch_assoc($result);
                            ?>


                        <div class="one-of-two">
                            <div class="profile-friend__single">
                                <img src="img/profile-photo.jpg" alt="">

                                <a href="profile.php?id=<?php echo $friend_info['id']; ?>"><h2><?php echo $friend_info['first_name'] . ' ' . $friend_info['last_name']; ?></h2></a>

                                <form action="process/friend-delete.php" method="POST">
                                    <input type="hidden" name="user_id_two" value="<?php echo $friend_info['id']; ?>">
                                    <button class="profile-friend__unfriend-btn">Unfriend</button>
                                </form>
                            </div>
                        </div>
                        <?php endfor; ?>


                    </div> <!--END ROW-->



                </div>

            </div>

        </div>

    </body>
</html>