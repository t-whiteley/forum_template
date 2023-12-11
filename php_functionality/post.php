<?php

session_start();
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tt = htmlspecialchars($_POST['title']);
    $bd = htmlspecialchars($_POST['body']);
    $tg = htmlspecialchars($_POST['tags']);
    $us = $_SESSION['un'];

    $sql = "INSERT INTO posts (user, title, body, tags, like_count, comment_count) VALUES ('$us', '$tt', '$bd', '$tg', '0', '0')";
    $conn->query($sql);
    header('Location: ../index.php');
}