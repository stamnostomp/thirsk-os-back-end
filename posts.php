<?php
include 'include/class.user.php';
$user = new User();
$posts = $user->all_posts();
print $posts
?>
