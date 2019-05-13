<?php

include_once 'db_connect.php';

if (isset($_POST['title'])){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

    $stmt=$mysqli->prepare("INSERT INTO posts title=?, content=?, uid=?, postDate=?");
    $stmt->bind_param('ssii', $title, $content, $_SESSION['uid'],strtotime(date('Y m d')));
    if ($stmt->execute()){
        echo "Your post has been added successfully.";
    }
    $mysqli->close();
}

if ($_SESSION['level'] > 1){
    $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
    $stmt=$mysqli->prepare("SELECT title, content, uid, postDate FROM posts ORDER BY postDate DESC");
    $stmt=$mysqli->bind_result($title, $content, $uid, $postDate);
    $posts = [];
    while ($stmt->fetch()){
        $posts[] = array("title"=>$title, "content"=>$content, "uid"=>$uid);
    }

} else {
    $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
    $stmt=$mysqli->prepare("SELECT title, content, uid, postDate FROM posts WHERE uid=? ORDER BY postDate DESC");
    $stmt->bind_param("i", $_SESSION['uid']);
    $stmt->bind_result($title, $content, $uid, $postDate);
    $posts = [];
    while ($stmt->fetch()){
        $posts[] = array("title"=>$title, "content"=>$content, "uid"=>$uid);
    }
}



?>

