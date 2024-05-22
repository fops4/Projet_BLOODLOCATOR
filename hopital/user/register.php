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
    <link href="../../assets/img/favicon.png" rel="icon">
    <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">



    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../../css/styles.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Vendor CSS Files -->
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->

    <link href="../../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/modif.css">
</head>

<body>

    <?php
    include("../../hf/header.php");
    ?>

    <!-- Créer le formulaire avec les éléments HTML appropriés -->
    <form id="formEtapeUnique" class="form-container" action="traitement_inscription.php" method="post">
        <h1 class="form-title">Donneur</h1>
        <label for="hopitalname" class="form-label">Nom de l'Hôpital :</label>
        <input id="hopitalname" class="form-input" type="text" name="hopitalname" required>

        <label for="hopitaladress" class="form-label">Adresse de l'hopital</label>
        <input id="hopitaladress" class="form-input" type="text" name="hopitaladress" required>

        <label for="email" class="form-label">Adresse e-mail :</label>
        <input id="email" class="form-input" type="email" name="email" required>

        <label for="phone" class="form-label">Numéro de téléphone :</label>
        <input id="phone" class="form-input" type="tel" name="phone" required>

        <label for="creationDate" class="form-label">Date de création :</label>
        <input id="creationDate" class="form-input" type="date" name="creationDate" required>

        <label for="password" class="form-label">Mot de passe :</label>
        <input id="password" class="form-input" type="password" name="password" placeholder="Password" required>
        <button type="button" class="btn btn-outline-secondary" id="togglePassword1">
            <i class="fas fa-eye"></i>
        </button>
        <div id="password-strength" class="form-text"></div>

        <label for="confirmPassword" class="form-label">Confirmation du mot de passe :</label>
        <input id="confirmPassword" class="form-input" type="password" name="confirmPassword" placeholder="Confirm Password" required>
        <button type="button" class="btn btn-outline-secondary" id="togglePassword">
            <i class="fas fa-eye"></i>
        </button>
        <div id="confirm-password-error" class="form-text"></div>

        <div id="error-message" class="alert alert-danger" style="display:none;"></div>
        <div id="passwordError" class="text-danger"></div>
        <div class="form-checkbox">
            <input type="checkbox" name="terms" required>
            <label for="terms"><a href="#">Accepter les termes du contract </a></label>
        </div>
        <button type="submit" class="form-button">S'inscrire</button>
        <p class="form-credit">designed by TeAm</p>
    </form>

    </main><!-- End #main -->

    <?php
    include '../../hf/footer.php';
    ?>

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../../js/register.js"></script>
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