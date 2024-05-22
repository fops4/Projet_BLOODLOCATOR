<?php
// Définir la constante BASE_URL avec le chemin relatif vers la racine du site
define('BASE_URL', '/BloodLocator/');
?>


<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-flex align-items-center fixed-top">
  <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
    <div class="align-items-center d-none d-md-flex">
      <i class="bi bi-clock"></i> Lundi - Dimanche, 24h/24h
    </div>
    <div class="d-flex align-items-center">
      <i class="bi bi-phone"></i> Appeler nous au +237 676 40 58 24
    </div>
  </div>
</div>
<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
  <div class="container d-flex align-items-center">
    <a href="<?php echo BASE_URL; ?>admin-gh-pages/form.php" class="logo me-auto"><img src="<?php echo BASE_URL; ?>assets/img/blll.png" alt=""></a>
    <nav id="navbar" class="navbar order-last order-lg-0">
      <form method="post" action="<?php echo BASE_URL; ?>resultat.php">
        <div class="search-container">
          <select id="bloodGroups" name="bloodGroups">
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
          </select>
          <button class="searc" type="submit">Rechercher</button>
        </div>
      </form>
      <ul>
        <li><a class="nav-link scrollto " href="<?php echo BASE_URL; ?>index.php">Home</a></li>
        <li><a class="nav-link scrollto" href="<?php echo BASE_URL; ?>index.php#hospital">Hopitaux</a></li>
        <li><a class="nav-link scrollto" href="<?php echo BASE_URL; ?>index.php#temoignages">Temoignages</a></li>
        <li><a class="nav-link scrollto" href="<?php echo BASE_URL; ?>index.php#contact">Contacts</a></li>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
        if (session_status() == PHP_SESSION_NONE) {
          session_start();
        }
        if (isset($_SESSION["utilisateur_connectee"]) && $_SESSION["utilisateur_connectee"] === true) {
          // Si l'utilisateur est connecté, afficher le menu déroulant avec Profil et Déconnexion
        ?>

          <li><a class="nav-link scrollto" href="<?php echo BASE_URL; ?>chat/users.php">Notifications</a></li>
          <li class="dropdown"><a href="#"><span class="profil"><i class="fas fa-user"></i>&#9660;</span></a>
            <ul>
              <li><a href="<?php echo BASE_URL; ?>form/profil.php">Modifier le profil</a></li>
              <li><a href="<?php echo BASE_URL; ?>form/logout.php">Deconnexion</a></li>
            </ul>
          </li>

        <?php
        } else if (isset($_SESSION["utilisateur_connecte"]) && $_SESSION["utilisateur_connecte"] === true) {
          // Si l'utilisateur est connecté, afficher le menu déroulant avec Profil et Déconnexion
        ?>

          <li><a class="nav-link scrollto" href="<?php echo BASE_URL; ?>chat/users.php">Notifications</a></li>
          <li><a class="nav-link scrollto" href="<?php echo BASE_URL; ?>/../hopital_list.php">All</a></li>
          <li><a class="nav-link scrollto" href="<?php echo BASE_URL; ?>hopital/gestion_stock/stock.php">Stock</a></li>
          <li class="dropdown"><a href="#"><span class="profil"><i class="fas fa-user"></i>&#9660;</span></a>
            <ul>
              <div class="sb-sidenav-footer">
                <li><a href="<?php echo BASE_URL; ?>">User :
                    <?php
                    // Assurez-vous que la session est démarrée
                    if (session_status() == PHP_SESSION_NONE) {
                      session_start();
                    }

                    // Vérifiez si la clé "hopitalname" existe dans la session avant de l'utiliser
                    if (isset($_SESSION['hopitalname'])) {
                      $hopitalname = $_SESSION['hopitalname'];
                      echo $hopitalname;
                    } else {
                      // Gérez le cas où la clé "hopitalname" n'est pas définie
                      echo "Guest"; // ou une valeur par défaut appropriée
                    }
                    ?></a>
                </li>
                <li><a href="<?php echo BASE_URL; ?>hopital/gestion_hopital/profil.php">Modifier le profil</a></li>
                <li><a href="<?php echo BASE_URL; ?>hopital/user/logout.php">Deconnexion</a></li>
            </ul>
          </li>
        <?php
        } else {
          // Si l'utilisateur n'est pas connecté, afficher les options de connexion et d'inscription
        ?>
          <a href="<?php echo BASE_URL; ?>inter.php" class="appointment-btn scrollto"><span class="d-none d-md-inline">Get-Started</span></a>
        <?php
        }

        ?>
      </ul>


      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->
  </div>
</header><!-- End Header -->