
<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">forum_template</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Register</a>
                    </li>
                </ul>

                <?php

                if (isset($_SESSION['un'])) {
                    echo'<form class="d-flex" action="../php_functionality/logout.php" method="post">';
                    echo    '<button class="btn btn-outline-seocndary me-2" disabled>' . $_SESSION['un'] . '</button>';
                    echo    '<button class="btn btn-primary" type="submit">Log out</button>';
                    echo'</form>';
                }
                else {
                    echo'<form class="d-flex" action="../php_functionality/login.php" method="post">';
                    echo'    <input type="text" class="me-2" id="user" name="user" placeholder="username">';
                    echo'    <input type="password" class="me-2" id="pass" name="pass" placeholder="password">';
                    echo'    <button class="btn btn-primary" type="submit">Log in</button>';
                    echo'</form>';
                }

                ?>

            </div>
        </div>
    </nav>