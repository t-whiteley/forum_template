<?php

session_start();
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bd = htmlspecialchars($_POST['comment']);
    $us = $_SESSION['un'];
    $po_id = $_GET['post_id'];

    $sql_comment = "INSERT INTO comments (post_id, user, body) VALUES ('$po_id', '$us', '$bd')";
    $conn->query($sql_comment);

    $sql_posts = "UPDATE posts SET comment_count = comment_count + 1 WHERE post_id = '$po_id'";
    $conn->query($sql_posts);

    header('Location: ../postview.php?post_id=' . $_GET['post_id']);


}