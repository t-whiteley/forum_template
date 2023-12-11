<?php

    session_start();
    include('php_functionality/conn.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="html/styles.css">

</head>
<body>

    <?php
    include('html/navbar.php');
    ?>


    <div class="container-fluid mt-5 mb-5">

    

        <!-- user post -->

        <?php
        if (isset($_SESSION['un'])) {
            echo'<div class="card">';
            echo'    <div class="card-body">';
            echo'        make a post:';
            echo'        <form action="php_functionality/post.php" method="post">';
            echo'            <input type="text" name="title" id="title" placeholder="title">';
            echo'            <input type="text" name="body" id="body" placeholder="body">';
            echo'            <input type="text" name="tags" id="tags" placeholder="tags">';
            echo'            <input type="submit" name="submit" value="post">';
            echo'        </form>';
            echo'    </div>';
            echo'</div>';
        }

        ?>


        






        <!-- feed -->


        <h3 class="mt-5">feed</h3>
        <table class="table table-hover mt-4">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">user</th>
                    <th scope="col">title</th>
                    <th scope="col">tags</th>
                    <th scope="col">likes</th>
                    <th scope="col">comments</th>
                    <th scope="col">published</th>
                </tr>
            </thead>
            <tbody>

                <?php
                include('php_functionality/conn.php');
        
                
                $sql = "SELECT * FROM posts ORDER BY published desc";
                $result = $conn->query($sql);
                $all_tags = [];
        
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {




                        echo'<tr>';
                        echo'    <td>' . $row['post_id'] . '</td>';
                        echo'    <td>' . $row['user'] . '</td>';
                        echo'    <td><a href="postview.php?post_id=' . $row['post_id'] . '">' . $row['title'] . '</a></td>';
                        echo'    <td>';

                        // tags

                        $tags = $row['tags'];
                        $curr = '';
                        for ($i = 0; $i<strlen($tags); $i++) {
                            if ($tags[$i] == ',') {
                                echo'<span class="badge rounded-pill text-bg-primary me-1">' . $curr . '</span>';
                                if (!(in_array($curr, $all_tags))) {
                                    array_push($all_tags, $curr);
                                }
                                $curr = '';
                            }
                            else {
                                $curr .= $tags[$i];
                            }
                        }
                        echo'<span class="badge rounded-pill text-bg-primary">' . $curr . '</span>';


                        echo'    </td>';
                        echo'    <td>' . $row['like_count'] . '</td>';
                        echo'    <td>' . $row['comment_count'] . '</td>';
                        echo'    <td>' . $row['published'] . '</td>';
                        echo'</tr>';
                        
                    }
                }
                else {
                    echo 'no records';
                }
                
                ?>

            </tbody>


        </table>









        <!-- users -->


        <h3 class="mt-5">users</h3>
        <table class="table table-hover mt-4">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">user</th>

                </tr>
            </thead>
            <tbody>

                <?php

                $sql_accounts = "SELECT * FROM accounts";
                $res_accounts = $conn->query($sql_accounts);
                while ($row = $res_accounts->fetch_assoc()) {
                    echo'<tr>';
                    echo'    <td>' . $row['account_id'] . '</td>';
                    echo'    <td>' . $row['username'] . '</td>';
                    echo'</tr>';
                }
            
                ?>

            </tbody>
        </table>





        <!-- tags -->
        <h3 class="mt-5 mb-3">tags</h3>
        <?php
        for ($i = 0; $i < count($all_tags); $i++) {
            echo'<span class="badge rounded-pill text-bg-primary me-2">' . $all_tags[$i] . '</span>';
        }
        ?>


    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>