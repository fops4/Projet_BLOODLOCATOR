<?php
// Assurez-vous de configurer ces informations en fonction de votre serveur MySQL

include 'hopital/connexion.php';
// Se connecter à la base de données
$connexion = new mysqli($host, $utilisateur, $mot_de_passe, $base_de_donnees);

// Vérifier la connexion
if ($connexion->connect_error) {
  die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

// Récupérer le groupe sanguin à partir de la requête ou d'une autre source
$bloodGroups = isset($_POST['bloodGroups']) ? $_POST['bloodGroups'] : '';

// Préparer la requête SQL pour la recherche par groupe sanguin (correspondance exacte) pour les hôpitaux
$selectQueryHospital = "SELECT h.*, bs.quantity FROM hopital h
                        INNER JOIN blood_stock bs ON h.id = bs.user_id
                        WHERE bs.blood_type = ? AND bs.quantity > 0";

// Préparer la requête SQL pour la recherche par groupe sanguin (correspondance exacte) pour les donneurs
$selectQueryDonor = "SELECT * FROM donneur WHERE groupe_sanguin = ?";

?>
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
  <link rel="stylesheet" href="css/modif.css">
</head>


<body>

  <?php
  include("hf/header.php");
  ?>
  <main style="margin-top: 100px;">

    <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors section-bg">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Hopitaux</h2>
        </div>
        <div class="row">
          <?php
          // Utiliser une requête préparée avec bind_param pour les hôpitaux
          if ($stmt = $connexion->prepare($selectQueryHospital)) {
            $stmt->bind_param("s", $bloodGroups);

            // Exécution de la requête pour les hôpitaux
            $stmt->execute();

            // Récupération des résultats pour les hôpitaux
            $resultHospital = $stmt->get_result();

            // Vérifier s'il y a des résultats pour les hôpitaux
            if ($resultHospital->num_rows > 0) {
              $i = 1;
              while ($row = $resultHospital->fetch_assoc()) {
                $i++;

                // Afficher ou utiliser les données pour les hôpitaux 
                echo "<div class='col-lg-3 col-md-6 d-flex align-items-stretch'>";
                echo "  <div class='member' data-aos='fade-up' data-aos-delay='100'>";
                echo "    <div class='member-img'>";
                echo "      <img src='hopital/gestion_hopital/" . $row['image'] . "' class='img-fluid' alt='Image de l'hôpital'>";
                echo "      <div class='social'>";
                echo '              <a href="https://wwww.twitter.com"><i class="bi bi-twitter"></i></a>   ';
                echo '              <a href="https://www.facebook.com"><i class="bi bi-facebook"></i></a>';
                echo '              <a href="https://www.instagram.com"><i class="bi bi-instagram"></i></a>';
                echo '              <a href="https://www.linkedin.com"><i class="bi bi-linkedin"></i></a>';
                echo "      </div>";
                echo "    </div>";
                echo "    <div class='member-info'>";
                echo "      <h4>" . $row['hopitalname'] . "</h4>";
                echo "      <span>" . $row['hopitaladress'] . "</span>";
                echo "    </div>";
                echo "  </div>";
                echo "</div>";

                if ($i % 4 == 0) {
                  echo '<br>';
                }
              }
            } else {
              echo "<div class='section-title'>";
              echo "  <h5>Aucun hôpital trouvé pour le groupe sanguin : $bloodGroups</h5>";
              echo "</div>";
            }

            // Libérer le résultat pour les hôpitaux
            $resultHospital->free();
            $stmt->close();
          } else {
            echo "Erreur lors de la préparation de la requête pour les hôpitaux : " . $connexion->error;
          }

          echo '<div class="section-title">';
          echo '<h2>Donneurs</h2>';
          echo '</div>';

          // Utiliser une nouvelle requête préparée pour les donneurs
          if ($stmtDonor = $connexion->prepare($selectQueryDonor)) {
            $stmtDonor->bind_param("s", $bloodGroups);

            // Exécution de la requête pour les donneurs
            $stmtDonor->execute();

            // Récupération des résultats pour les donneurs
            $resultDonor = $stmtDonor->get_result();
            $i = 0;
            // Vérifier s'il y a des résultats pour les donneurs
            if ($resultDonor->num_rows > 0) {
              echo "<div style = 'display:flex'>";
              while ($rowDonor = $resultDonor->fetch_assoc()) {
                // Afficher ou utiliser les données pour les donneurs 
                echo '<div class="card" style="width: 10rem; margin: 0 20px 20px; text-align:center; justify-content: center">';
                echo   '<div class="card-body">';
                echo     '<h5 class="card-title">' . $rowDonor['nom'] . '</h5>';
                echo     '<h6 class="card-subtitle mb-2 text-muted">' . $rowDonor['prenom'] . '</h6>';
                echo     '<h6 class="card-subtitle mb-2 text-muted">' . $rowDonor['telephone'] . '</h6>';
                echo   '</div>';
                echo '</div>';
              }
              echo '</div>';
            } else {
              echo "<div class='section-title'>";
              echo "  <h5>Aucun donneur trouvé pour le groupe sanguin : $bloodGroups</h5>";
              echo "</div>";
            }


            // Libérer le résultat pour les donneurs
            $resultDonor->free();
            $stmtDonor->close();
          } else {
            echo "Erreur lors de la préparation de la requête pour les donneurs : " . $connexion->error;
          }


          // Fermer la connexion à la base de données
          $connexion->close();
          ?>
        </div>
      </div>
    </section><!-- End Doctors Section -->




  </main>

  <!-- ======= Cta Section ======= -->
  <section id="cta" class="cta">
    <div class="container" data-aos="zoom-in">

      <div class="text-center">
        <h3>En cas d'urgence? Besoin d'aide maintenant?</h3>
        <p>En tant que gardien de la santé et du bien-être, il est déchirant de voir des vies précieuses s'éteindre en raison de cette pénurie. C'est pourquoi je suis extrêmement reconnaissant et prêt à saisir cette opportunité offerte par 'BloodLocator'. En utilisant cette plateforme innovante, je suis déterminé à trouver les donneurs de sang compatibles et à établir des connexions vitales pour mes patients. Ensemble, nous pouvons inverser cette tendance tragique et offrir une lueur d'espoir à ceux qui en ont désespérément besoin. Le pouvoir de sauver des vies est entre nos mains, et je suis prêt à tout mettre en œuvre pour y parvenir.</p>
        <a class="cta-btn scrollto" href="form/connexion.php">Commencer des maintenant</a>
      </div>

    </div>
  </section><!-- End Cta Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container">

      <div class="section-title">
        <h2>Contact</h2>
      </div>

    </div>

    <div>
      <?php
      include 'hf/map.php';
      ?>
    </div>

  </section><!-- End Contact Section -->

  </main><!-- End #main -->

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