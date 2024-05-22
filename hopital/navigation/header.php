<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="../index.php">Hopital</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <?php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION["utilisateur_connecte"]) && $_SESSION["utilisateur_connecte"] === true) {
            // Si l'utilisateur est connecté, afficher le menu déroulant avec Profil et Déconnexion
        ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="../gestion_hopital/profil.php">Profil</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <form action="user/logout.php" method="post" class="dropdown-item">
                            <button type="submit" class="btn btn-link">Déconnexion</button>
                        </form>
                    </li>

                </ul>
            </li>
        <?php
        } else {
            // Si l'utilisateur n'est pas connecté, afficher les options de connexion et d'inscription
        ?>
            <li class="nav-item">
                <a class="nav-link" href="/user/login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/user/register.php">Inscription</a>
            </li>
        <?php
        }
        ?>
    </ul>
</nav>