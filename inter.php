<? session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>BloodLocator</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->

  <link href="assets/css/style.css" rel="stylesheet">
  <link href="css/modif.css" rel="stylesheet">
</head>

<body>

<?php
  include "hf/header.php";
  ?>



    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts" style= "margin: 200px 0 0 100px;">
      <div class="container" data-aos="fade-up">

        <div class="row no-gutters">





                                <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" style= "margin: 0 200px 0 200px;">



                        <?php
                        include 'hopital/connexion.php'; // Inclure le fichier de connexion à la base de données

                        // Exécuter la requête SQL
                        $sql = "SELECT COUNT(*) AS total_donors FROM donneur";
                        $result = $connexion->query($sql);

                        // Vérifier si la requête a réussi
                        if ($result) {
                        // Récupérer le résultat de la requête
                        $row = $result->fetch_assoc();
                        $totalDonors = $row['total_donors'];

                        // Afficher le nombre de donneurs
                        echo '<div class="count-box">';
                        echo '<i class="fas fa-user-md"></i>';
                        echo '<span data-purecounter-start="0" data-purecounter-end="'. $totalDonors .'" data-purecounter-duration="1" class="purecounter"></span>';
                        echo '';
                        echo '<p><strong>Donneur</strong>';

                        echo '<div class="commencer">';
                        echo '<a href="hopital/user/login.php" style="
font-weight: 500px;
font-size: 14px;
letter-spacing: 1px;
display: inline-block;
padding: 14px 32px;
border-radius: 4px;
transition: 0.5s;
line-height: 1;
color: #fff;
background: #3fbbc0;">Commencer</a>
</div>';


                        echo '</div>';
                        echo '</div>';
                        } else {
                        // Gérer les erreurs de requête
                        echo "Erreur lors de l'exécution de la requête : " . $connexion->error;
                        }

                        // Fermer la connexion à la base de données
                        $connexion->close();
                        ?>



                        <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">


                        <?php
                        include 'hopital/connexion.php'; // Inclure le fichier de connexion à la base de données

                        // Exécuter la requête SQL
                        $sql = "SELECT COUNT(*) AS total_donors FROM hopital";
                        $result = $connexion->query($sql);

                        // Vérifier si la requête a réussi
                        if ($result) {
                        // Récupérer le résultat de la requête
                        $row = $result->fetch_assoc();
                        $totalDonors = $row['total_donors'];

                        // Afficher le nombre de donneurs
                        echo '<div class="count-box">';
                        echo '<i class="far fa-hospital"></i>';
                        echo '<span data-purecounter-start="0" data-purecounter-end="'. $totalDonors .'" data-purecounter-duration="1" class="purecounter"></span>';
                        echo '';
                        echo '<p><strong>Hopitaux</strong>';


                        echo '<div class="commencer">';
                        echo '<a href="hopital/user/login.php" style="
font-weight: 200px;
font-size: 14px;
letter-spacing: 1px;
display: inline-block;
padding: 14px 32px;
border-radius: 4px;
transition: 0.5s;
line-height: 1;
color: #fff;
background: #3fbbc0;">Commencer</a>
</div>';

                        echo '</div>';
                        echo '</div>';
                        } else {
                        // Gérer les erreurs de requête
                        echo "Erreur lors de l'exécution de la requête : " . $connexion->error;
                        }

                        // Fermer la connexion à la base de données
                        $connexion->close();
                        ?>

        </div>

      </div>
    </section><!-- End Counts Section -->



    <div style = "margin-top:150px;">
      <?php
      include 'hf/map.php';
      ?>
    </div>
<?php
  include 'hf/footer.php';
  ?>

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>