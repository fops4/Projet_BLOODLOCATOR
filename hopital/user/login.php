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
    <link href="../../assets/img/favicon.png" rel="icon">
    <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../../css/styles.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>


    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="../../css/modif.css">
    <link href="../../assets/css/style.css" rel="stylesheet">

</head>

<body>

    <?php
    include "../../hf/header.php";
    ?>

    <!-- Créer le formulaire avec les éléments HTML appropriés -->
    <form class="form-container" form action="traitement_login.php" method="post">
        <h1 class="form-title">Connexion</h1>
        <label for="emailOrPhone" class="form-label">Email ou Numéro de téléphone :</label>
        <input type="text" class="form-input" id="emailOrPhone" name="emailOrPhone" required>
        <label for="password" class="form-label">Mot de passe :</label>
        <input type="password" class="form-input" id="password" name="password" required>
        <a href="resetPassword.php">
            <p class="lien">Mot de passe oublier?
        </a></p>
        <div class="form-checkbox">
        </div>
        <div id="login-message"></div>
        <button type="submit" class="form-button">Se connecter</button>
        <p class="lien">Je n'ai pas de compte? <a href="register.php">S'inscrire</a>.</p>
        <p class="form-credit">designed by TeAm</p>
    </form>


    </main><!-- End #main -->

    <?php
    include '../../hf/footer.php';
    ?>

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <script>
        $(document).ready(function() {
            $('input').on('input', function() {
                $('#login-message').html(''); // Masquer le message
            });
            $('form').submit(function(event) {
                event.preventDefault(); // Empêcher la soumission du formulaire

                var formData = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: 'traitement_login.php',
                    data: formData,
                    success: function(response) {
                        // Afficher le message de réponse
                        $('#login-message').html(response);

                        // Rediriger vers index.php si la connexion réussit
                        if (response.includes("Connexion réussie!")) {
                            window.location.href = "../../index.php";
                        }
                    },
                    error: function(error) {
                        // Gérer les erreurs si nécessaire
                        console.log(error);
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>

    <!-- Vendor JS Files -->
    <script src="../../assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="../../assets/vendor/aos/aos.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../../assets/js/main.js"></script>

</body>

</html>