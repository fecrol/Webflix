<nav class="navbar navbar-expand-lg navbar-dark dark-bg">
    <div class="container-fluid">
        <a class="navbar-brand nav-logo-link-lg nav-logo-link-md nav-logo-link-sm" href="./home.php"><img
                src="./img/logo.png" alt="" class="nav-logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="./home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./movies.php">Movies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./tv-shows.php">TV Shows</a>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION['firstName'] . " " . $_SESSION["lastName"] ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="./user-account.php">Account</a></li>
                        <li><a class="dropdown-item" href="#">Transaction History</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="login.php" class="nav-link">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>