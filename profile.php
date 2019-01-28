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
    <body id="profile">

        <?php include 'includes/profile-login-nav.php'?>

        <div class="container">

            <header>
                <img src="img/beach.jpg" alt="" class="cover-photo">

                <?php include "includes/profile-menu-bar.php"; ?>


                <?php
                    $user_id = $_SESSION['user_id'];
                    $sql = "SELECT * FROM profile_photos where user_id={$user_id} LIMIT 1";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                ?>

                <img src="img/<?php echo $row['file_name'] ?>" alt="" class="profile-photo" style="width: 200px;">

            </header>


            <div id="left-panel">
                <div class="intro white-background">
                    <i class="fa fa-globe" aria-hidden="true"></i>
                    <h2>Intro</h2>

                    <a>+ Describe who you are</a>

                    <a>+ Add info about you</a>
                </div>

                <div class="friends white-background">
                    <div class="friends__heading">
                        <i class="fa fa-users" aria-hidden="true"></i>

                        <?php
                            $current_user_id = $_GET['id'];
                            $sql = "SELECT * FROM friends WHERE user_id_one={$current_user_id} OR user_id_two={$current_user_id}";
                            $result = mysqli_query($conn, $sql);
                            $num_friends = mysqli_num_rows($result);
                        ?>


                        <h2>Friends</h2> <span><?php echo $num_friends; ?></span>
                    </div>


                    <div class="container">
                        <div class="row">

                            <?php
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

                            ?>


                            <?php for($i = 0; $i < $num_friends; $i++): ?>

                                <div class="one-of-three">
                                    <?php
                                        $sql = "SELECT * FROM profile_photos WHERE user_id={$friend_list[$i]} LIMIT 1";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_assoc($result);
                                    ?>

                                    <a>
                                        <img src="img/<?php echo $row['file_name']; ?>" alt="">
                                    </a>

                                    <?php
                                        $sql = "SELECT * FROM users WHERE id='{$friend_list[$i]}'";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_assoc($result);
                                    ?>
                                    <a style="color: black" class="friends__name"><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></a>

                                </div>

                            <?php endfor; ?>



                        </div> <!--END ROW-->


                    </div>




                </div>



            </div>


            <?php
                $user_id_one = $_SESSION['user_id'];
                $user_id_two = $_GET['id'];

                $sql = "SELECT * FROM friends WHERE (user_id_one={$user_id_one} AND user_id_two={$user_id_two}) OR (user_id_one={$user_id_two} AND user_id_two={$user_id_one})";

                $result = mysqli_query($conn, $sql);

                $num_result = mysqli_num_rows($result);
            ?>


            <?php if($num_result > 0 || $user_id_one == $user_id_two) : ?>

                <div id="right-panel">

                <div class="status-update white-background">
                    <form action="process/post-create.php" method="POST">
                        <input type="text" name="text" placeholder="What's on your mind?">
                        <input type="hidden" name="receiver_id" value="<?php echo $_GET['id']; ?>">
                        <input type="submit">
                    </form>
                </div>


                <?php
                    $profile_id = $_GET['id'];
                    $sql = "SELECT * FROM POSTS WHERE receiver_id={$profile_id} ORDER BY id DESC";
                    $result = mysqli_query($conn, $sql);
                ?>

                <?php while ($row = mysqli_fetch_assoc($result)) : ?>

                    <div class="profile-wall">

                    <div class="text-wall-post white-background">
                        <div class="text-wall-post__details">
                            <?php
                            $photo_user_id = $row['poster_id'];
                            $photo_sql = "SELECT * FROM profile_photos WHERE user_id={$photo_user_id} LIMIT 1";
                            $photo_result = mysqli_query($conn, $photo_sql);
                            $photo_row = mysqli_fetch_assoc($photo_result);
                            ?>


                            <img src="img/<?php echo $photo_row['file_name']; ?>" alt="">
                            <?php
                                $name_sql = "SELECT * FROM users WHERE id={$row['poster_id']} LIMIT 1";
                                $name_result = mysqli_query($conn, $name_sql);
                                $name_row = mysqli_fetch_assoc($name_result);
                            ?>


                            <p class="text-wall-post__name"><?php echo $name_row['first_name'] . ' ' . $name_row['last_name']; ?></p>
                        </div>

                        <div class="text-wall-post__content">
                            <p><?php echo $row['text']; ?></p>


                            <form action="process/like-create.php" method="post" class="text-wall-post__actions">

                                <input type="hidden" name="post_id" value="<?php echo $row['id']; ?>">

                                <button><i class="fa fa-thumbs-up" aria-hidden="true"></i><h3>Like</h3></button>

                            </form>



                            <?php if($row['poster_id'] == $_SESSION['user_id']):?>

                            <a href="post-edit.php?post_id=<?php echo $row['id']; ?>&receiver_id=<?php echo $row['receiver_id'];?>" class="text-wall-post__actions">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                Edit
                            </a>

                            <?php endif; ?>


                            <?php if($row['poster_id'] == $_SESSION['user_id'] || $row['receiver_id']  == $_SESSION['user_id']): ?>
                            <form action="process/post-delete.php" method="post" class="text-wall-post__actions">
                                <button>
                                    <i class="fa fa-minus-circle" aria-hidden="true"></i>
                                    Delete
                                </button>
                                <input type="hidden" value="<?php echo $row['id']; ?>" name="post_id">
                                <input type="hidden" value="<?php echo $row['receiver_id']; ?>" name="receiver_id">
                            </form>
                            <?php endif; ?>




                        </div>

                    </div> <!--END TEXT WALL POST-->

                </div>

                <?php endwhile; ?>

            </div>

            <?php endif; ?>



        </div>

    </body>
</html>


















