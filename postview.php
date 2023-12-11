<?php
session_start();
include('php_functionality/conn.php');
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header('Location: index.php');
    exit;
}
else {
    $sql = 'SELECT * FROM posts WHERE post_id=' . $_GET['post_id'];
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    echo'<title>' . $row['title'] . '</title>';
    ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="html/styles.css">

</head>
<body>
    <?php
    include('html/navbar.php')
    ?>


    <div class="container-fluid mt-5">
        <div class="card">
            <div class="card-header">
                <?php
                    echo $row['user'] . '<br>';
                    echo 'likes: ' . $row['like_count'] . '<br>';
                    echo 'comments: ' . $row['comment_count'] . '<br>';
                    echo '<em>' . $row['published'] . '</em>';
                ?>
            </div>

            <div class="card-body">
                <?php
                echo '<em>' . $row['title'] . '</em>' . '<br>';
                echo $row['body'];
                ?>
            </div>

            <?php
            if (isset($_SESSION['un'])) {
                echo'<div class="list-group list-group-flush">';
                echo'    <form class="p-3" action="php_functionality/comment.php?post_id=' . $_GET['post_id'] . '" method="post">';
                echo'        <div class="input-group">';
                echo'            <input class="form-control" type="text" name="comment" id="comment" placeholder="Your comment">';
                echo'            <div class="input-group-append ms-2">';
                echo'                <button type="submit" class="btn btn-outline-primary">comment</button>';
                echo '                <a class="btn btn-outline-success" href="php_functionality/like.php?post_id=' . $_GET['post_id'] . '&sign=plus">Like</a>';
                echo '                <a class="btn btn-outline-danger" href="php_functionality/like.php?post_id=' . $_GET['post_id'] . '&sign=neg">Dislike</a><br>';
                echo'            </div>';
                echo'        </div>';
                echo'    </form>';
                echo'</div>';
            }
            ?>



            <?php
            $sql_comments = 'SELECT * FROM comments WHERE post_id=' . $_GET['post_id'];
            $result_comments = $conn->query($sql_comments);
            if ($result_comments->num_rows > 0) {

                echo'<div class="card-footer p-3">';
                echo'<table class="table table-light table-hover">';

                while ($row_comments = $result_comments->fetch_assoc()) {
                    echo'<tr>';
                    echo'    <td>' . $row_comments['comment_id'] . '</td>';
                    echo'    <td>' . $row_comments['user'] . '</td>';
                    echo'    <td>' . $row_comments['body'] . '</td>';
                    echo'    <td>' . $row_comments['published'] . '</td>';
                    echo'</tr>';

                }
                echo'</table>';
                echo'</div>';
            }
            ?>


        </div>
    </div>









    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>