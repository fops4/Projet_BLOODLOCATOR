<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>BloodLocator</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href=" assets/img/favicon.png" rel="icon">
    <link href=" assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href=" assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href=" assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href=" assets/vendor/aos/aos.css" rel="stylesheet">
    <link href=" assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href=" assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Gardez cette ligne qui inclut jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <!-- Template Main CSS File -->

    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href=" css/modif.css">
</head>

<body>
    <?php
    include 'hf/header.php';
    ?>

    <?php
    // Assurez-vous de configurer ces informations en fonction de votre serveur MySQL

    include 'hopital/connexion.php';
    // Se connecter à la base de données
    $connexion = new mysqli($host, $utilisateur, $mot_de_passe, $base_de_donnees);

    // Vérifier la connexion
    if ($connexion->connect_error) {
        die("Échec de la connexion à la base de données : " . $connexion->connect_error);
    }

    $queryHopitaux = "SELECT id, hopitalname, hopitaladress, image FROM hopital";
    $resultHopitaux = mysqli_query($connexion, $queryHopitaux);

    if (!$resultHopitaux) {
        die("Erreur dans la requête SQL: " . mysqli_error($connexion));
    }

    ?>
    <?php

    include 'hopital/connexion.php' ?>
    <div id="layoutSidenav_content">
        <main style="margin-top: 100px;">

            <!--liste des hopitaux à recuprérer et a afficheer-->
            <section id="doctors" class="doctors section-bg">
                <div class="container" data-aos="fade-up">
                    <div class="section-title">
                        <h2>Hopitaux</h2>
                    </div>
                    <div class="row">
                        <?php
                        while ($row = mysqli_fetch_assoc($resultHopitaux)) {
                            $hopitalId = $row['id'];
                            $hopitalName = $row['hopitalname'];
                            $hopitalImage = $row['image'];
                            $hopitalAdress = $row['hopitaladress']
                        ?>
                            <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                                <div class="member" data-aos="fade-up" data-aos-delay="100">
                                    <div class="member-img">
                                        <img src="hopital/gestion_hopital/<?php echo $hopitalImage; ?>" alt="Image de l'hôpital" class="img-fluid">
                                        <div class="social">
                                            <a href="https://wwww.twitter.com"><i class="bi bi-twitter"></i></a>
                                            <a href="https://www.facebook.com"><i class="bi bi-facebook"></i></a>
                                            <a href="https://www.instagram.com"><i class="bi bi-instagram"></i></a>
                                            <a href="https://www.linkedin.com"><i class="bi bi-linkedin"></i></a>
                                        </div>
                                    </div>
                                    <div class="member-info">
                                        <h4><?php echo $hopitalName; ?></h4>
                                        <h4><?php echo $hopitalAdress; ?></h4>
                                        <!--<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#hopitalDetailsModal" data-id="--><!--">Voir les détails</button>-->
                                    </div>
                                </div>
                            </div>
                        <?php
                        } ?>
                    </div>
                </div>
            </section>
            <!-- Modal -->
            <div class="modal fade" id="hopitalDetailsModal" tabindex="-1" aria-labelledby="hopitalDetailsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="hopitalDetailsModalLabel">Détails de l'hôpital</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="detailContent">
                            <!-- Contenu des détails de l'hôpital à afficher ici -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>

    </div>
    </main>

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

    <script>
        $(document).ready(function() {
            $('[data-bs-target="#hopitalDetailsModal"]').on('click', function() {
                var hopitalId = $(this).data('id');

                // Faites une requête AJAX pour récupérer les détails de l'hôpital
                $.ajax({
                    url: 'hopital/gestion_hopital/details.php',
                    method: 'POST',
                    data: {
                        hopitalId: hopitalId
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Mettez à jour le contenu du modal avec les détails récupérés
                        $('#detailContent').html(
                            '<div class="col-lg-12 d-flex align-items-stretch">' +
                            '   <div class="member" data-aos="fade-up" data-aos-delay="100">' +
                            '       <div class="member-img">' +
                            '           <img src="hopital/gestion_hopital/' + response.image + '" alt="Image de l\'hôpital" class="img-fluid img-thumbnail">' +

                            '       </div>' +
                            '       <div class="member-info">' +
                            '           <h4>' + response.hopitalname + '</h4>' +
                            '           <h4>' + response.hopitaladress + '</h4>' +
                            '           <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#hopitalDetailsModal" data-id="' + response.id + '">Voir les détails</button>' +
                            '       </div>' +
                            '   </div>' +
                            '</div>'
                        );
                    },
                    error: function() {
                        alert('Une erreur s\'est produite lors de la récupération des détails.');
                    }
                });
            });
        });
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Les autres scripts restent inchangés -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>