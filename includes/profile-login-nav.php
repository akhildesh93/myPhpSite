<nav class="login-nav">
    <img src="img/zbook-logo.png" alt="" class="nav__zbook-logo">

    <form action="search.php" method="post">
        <input type="text" name="search_query">

        <button name="search_submit">
            <i class="fa fa-search" aria-hidden="true"></i>
        </button>

    </form>

    <div class="profile-nav__options">
        <a class="profile-nav__photo-link">
            <img src="img/profile-photo.jpg" alt="" class="profile-nav__photo">
        </a>

        <?php
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM users where id={$user_id}";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>


        <a class="profile-nav__name-link"><span class="profile-nav__name"><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></span></a>
        <a><span class="profile-nav__home">Home</span></a>


        <?php
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM friend_requests WHERE requested_id={$user_id}";
        $result = mysqli_query($conn, $sql);
        ?>

        <a href="friends-accept.php" class="profile-nav__friends">
            <i class="fa fa-users" aria-hidden="true"></i>
            <span <?php if(mysqli_num_rows($result) > 0) : ?> style="background-color:red" <?php endif;?> class="profile-nav__friends-num">
                        <?php echo mysqli_num_rows($result); ?>
                    </span>
        </a>



    </div>
</nav>