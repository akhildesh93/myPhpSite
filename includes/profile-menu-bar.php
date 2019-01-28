<?php
    $user_id = $_SESSION['user_id'];
?>

<div class="menu-bar">
    <ul>

        <li><a href="profile.php?id=<?php echo $user_id; ?>">Timeline</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="friends.php">Friends</a></li>
        <li><a href="photos.php">Photos</a></li>
    </ul>
</div>