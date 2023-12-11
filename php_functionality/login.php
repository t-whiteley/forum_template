<?php

session_start();
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $un = htmlspecialchars($_POST['user']);
    $pw = htmlspecialchars($_POST['pass']);

    // $pw = password_hash($pw, PASSWORD_DEFAULT);

    // $sql = "INSERT INTO accounts (username, password) VALUES ('$un', '$pw')";
    // $result = $conn->query($sql);

    $sql = "SELECT * FROM accounts WHERE username = '$un'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        if (password_verify($pw, $data['password'])) {
            $_SESSION['un'] = $un;
            header('Location: ../index.php');
        }
        else {
            header('Location: ../index.php');            
        }
    }
    else {
        header('Location: ../index.php');
    }
    
}
else {
    header('Location: ../index.php');
}