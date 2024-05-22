<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>BloodLocator</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="../css/styles.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">


  <!-- Template Main CSS File -->

  <link href="../assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/modif.css">
</head>

<body>

  <?php
  include("../hf/header.php");
  ?>

  <!-- Créer le formulaire avec les éléments HTML appropriés -->
  <form id="formEtapeUnique" class="form-container" action="../traite/traitementDonneur.php" method="post">
    <div class="etape" id="etape1">
      <h1 class="form-title">Donneur</h1>
      <label for="nom" class="form-label">Nom</label>
      <input id="nom" class="form-input" type="text" name="nom" required>
      <label for="prenom" class="form-label">Prenom</label>
      <input id="prenom" class="form-input" type="text" name="prenom" required>
      <div class="info">
        <div>
          <label for="date" class="form-label">Date de naissance</label>
          <input id="date" class="form-input" type="date" name="date" required>
        </div>
        <div>
          <label for="lieu" class="form-label">Lieu de naissance</label>
          <input id="lieu" class="form-input" type="text" name="lieu" required>
        </div>
      </div>
      <label for="sexe" class="form-label">Sexe</label>
      <select id="sexe" class="form-input" name="sexe" required>
        <option value="Masculin">Masculin</option>
        <option value="Feminin">Feminin</option>
      </select>
      <div class="mb-3">
        <label for="groupe_sanguin" class="form-label">Groupe sanguin :</label>
        <select class="form-select" name="groupe_sanguin" id="groupe_sanguin" required>
          <option value="A+">A+</option>
          <option value="A-">A-</option>
          <option value="B+">B+</option>
          <option value="B-">B-</option>
          <option value="AB+">AB+</option>
          <option value="AB-">AB-</option>
          <option value="O+">O+</option>
          <option value="O-">O-</option>
        </select>
      </div>
      <div id="error-message" class="alert alert-danger" style="display:none;"></div>
      <div id="passwordError" class="text-danger"></div>

      <button class="form-button" type="button" onclick="afficherEtape(2)">Suivant</button>
      <p class="form-footer">J'ai deja un compte? <a href="connexion.php">Se connecter</a>.</p>
      <p class="form-credit">designed by TeAm</p>
    </div>
    <div class="etape" id="etape2" style="display: none;">
      <label for="telephone" class="form-label">Telephone</label>
      <input id="telephone" class="form-input" type="text" name="telephone" required>
      <label for="email" class="form-label">Adresse Email</label>
      <input id="email" class="form-input" type="email" name="email" placeholder="exemple@gmail.com" required>
      <label for="password" class="form-label">Mot de passe :</label>
      <input id="password" class="form-input" type="password" name="password" placeholder="Password" required>
      <label for="confirmpassword" class="form-label">Confirmation du mot de passe :</label>
      <input id="confirmpassword" class="form-input" type="password" name="confirmpassword" placeholder="Confirm Password" required>

      <div id="password-strength"></div>
      <div id="confirm-password-error" class="text-danger"></div>

      <div class="form-checkbox">
        <input type="checkbox" name="terms" required>
        <label for="terms"><a href="#">Accepter les termes du contract </a></label>
      </div>
      <button class="form-button" type="submit">Envoyer</button>
      <p class="form-credit">designed by TeAm</p>
    </div>
  </form>

  </main><!-- End #main -->

  <?php
  include '../hf/footer.php';
  ?>

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script>
    $(document).ready(function() {
      // Ajoutez ceci pour afficher le message d'erreur
      function displayErrorMessage(message) {
        $('#error-message').text(message).show();
      }

      // Ajoutez ceci pour masquer le message d'erreur
      function hideErrorMessage() {
        $('#error-message').hide();
      }

      // Ajoutez ceci pour valider les mots de passe
      $('form').submit(function(event) {
        var password = $('#password').val();
        var confirmpassword = $('#confirmpassword').val();

        if (password !== confirmpassword) {
          displayErrorMessage("Les mots de passe ne correspondent pas.");
          event.preventDefault(); // Empêcher la soumission du formulaire
        } else {
          hideErrorMessage();
        }

      });

      // Gestion de la robustesse du mot de passe et vérification de la correspondance avec la confirmation
      $('#password, #confirmpassword').on('input', function() {
        var password = $('#password').val();
        var confirmpassword = $('#confirmpassword').val();
        var passwordStrength = $('#password-strength');
        var confirmpasswordError = $('#confirm-password-error');

        // Vérifiez la robustesse du mot de passe
        var strength = checkPasswordStrength(password);

        // Affichez le message en fonction de la force du mot de passe
        if (password.length === 0) {
          passwordStrength.text(''); // Cache le message lorsque le champ est vide
        } else if (strength <= 2) {
          passwordStrength.removeClass('text-success').addClass('text-danger').text('Mot de passe faible');
        } else if (strength <= 4) {
          passwordStrength.removeClass('text-danger').addClass('text-warning').text('Mot de passe moyen');
        } else {
          passwordStrength.removeClass('text-warning').addClass('text-success').text('Mot de passe fort');
        }

        // Vérifiez la correspondance du mot de passe avec la confirmation
        if (confirmpassword.length > 0 && password !== confirmpassword) {
          confirmpasswordError.text('Les mots de passe ne correspondent pas').addClass('text-danger');
        } else {
          confirmpasswordError.text('').removeClass('text-danger');
        }
      });

      $('#date').on('input', function() {
        var date = new Date($(this).val());
        var currentDate = new Date();
        var minDate = new Date('1980-01-01');

        if (date > currentDate) {
          displayErrorMessage("La date de création ne peut pas être dans le futur.");
        } else if (date < minDate) {
          displayErrorMessage("La date de création doit être au moins en 2003.");
        } else {
          hideErrorMessage();
        }
      });


      // Ajoutez ceci pour valider le numéro de téléphone
      $('#telephone').on('input', function() {
        var phoneNumber = $(this).val();

        // Remplacez le contenu non numérique par une chaîne vide
        phoneNumber = phoneNumber.replace(/\D/g, '');

        // Limitez la longueur à 9 caractères
        phoneNumber = phoneNumber.substring(0, 9);

        // Mettez à jour la valeur dans la zone de texte
        $(this).val(phoneNumber);
      });

      $('#togglePassword1, #togglePassword').on('click', function() {
        var passwordInput = $('#password, #confirmpassword');
        var type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
        passwordInput.attr('type', type);
      });
    });

    function checkPasswordStrength(password) {
      // Logique de vérification de la robustesse du mot de passe
      var minLength = 8;
      var hasUpperCase = /[A-Z]/.test(password);
      var hasLowerCase = /[a-z]/.test(password);
      var hasDigit = /\d/.test(password);
      var hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);

      var strength = 0;

      // Vérifiez chaque critère et incrémentez la force si le critère est rempli
      if (password.length >= minLength) {
        strength++;
      }

      if (hasUpperCase) {
        strength++;
      }

      if (hasLowerCase) {
        strength++;
      }

      if (hasDigit) {
        strength++;
      }

      if (hasSpecialChar) {
        strength++;
      }

      return strength;
    }




    function afficherEtape(numeroEtape) {
      // Masquer toutes les étapes
      var toutesLesEtapes = document.querySelectorAll('.etape');
      toutesLesEtapes.forEach(function(etape) {
        etape.style.display = 'none';
      });

      // Afficher l'étape spécifiée
      var etapeActuelle = document.getElementById('etape' + numeroEtape);
      if (etapeActuelle) {
        etapeActuelle.style.display = 'block';
      }
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>