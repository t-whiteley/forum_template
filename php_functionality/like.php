<?php

session_start();
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $po_id = $_GET['post_id'];
    $sign = $_GET['sign'];

    if ($sign == 'plus') {
        $sql = "UPDATE posts SET like_count=like_count+1 WHERE post_id='$po_id'";
    }
    else {
        $sql = "UPDATE posts SET like_count=like_count-1 WHERE post_id='$po_id'";
    }
    $conn->query($sql);
    
    header('Location: ../postview.php?post_id=' . $_GET['post_id']);
}

?>