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
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">


    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Template Main CSS File -->

    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/modif.css">
</head>

<body>
    <?php
    include '../../hf/header.php';
    ?>


    <?php
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION["utilisateur_connecte"]) || $_SESSION["utilisateur_connecte"] !== true) {
        // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
        header("Location: ../login.php");
        exit();
    }
    include '../connexion.php';

    // Récupérer l'ID de l'utilisateur depuis la session
    $userID = $_SESSION['user_id'];

    // Charger les informations de l'utilisateur depuis la base de données
    $requeteProfil = "SELECT * FROM hopital WHERE id = ?";
    $stmtProfil = $connexion->prepare($requeteProfil);
    $stmtProfil->bind_param("i", $userID);
    $stmtProfil->execute();
    $resultProfil = $stmtProfil->get_result();

    if ($resultProfil->num_rows > 0) {
        $rowProfil = $resultProfil->fetch_assoc();
    } else {
        // Gérer le cas où l'utilisateur n'est pas trouvé dans la base de données
    }

    // Fermer la connexion à la base de données
    $stmtProfil->close();
    $connexion->close();
    ?>
    <div id="modif" style="display:block;">
        <!-- Créer le formulaire avec les éléments HTML appropriés -->
        <form class="form-container" method="post" id="updateProfileForm" action="update_profile" enctype="multipart/form-data">
            <h1 class="form-title">Modification Du Profil</h1>
            <div class="card-body">
                <h2 class="card-title">Information sur <?php echo $rowProfil['hopitalname']; ?></h2>
            </div>
            <div class="embed-responsive embed-responsive-1by1">
                <img src="<?php echo $rowProfil['image']; ?>" class="card-img-top img-fluid rounded embed-responsive-item" alt="Image de l'hôpital">
            </div>
            <input id="id" class="form-input" type="text" name="id" value="<?php echo $_SESSION['user_id']; ?>" readonly>
            <label for="hopitalname" class="form-label">Nom de l'hôpital:</label>
            <input id="hopitalname" class="form-input" type="text" name="hopitalname" value="<?php echo $rowProfil['hopitalname']; ?>" required>

            <label for="hopitaladress" class="form-label">Adresse de l'hôpital:</label>
            <input type="text" id="hopitaladress" name="hopitaladress" class="form-input" value="<?php echo $rowProfil['hopitaladress']; ?>" readonly>

            <label for="phone" class="form-label">Numéro de téléphone:</label>
            <input type="text" id="phone" class="form-input" name="phone" value="<?php echo isset($rowProfil['phone']) ? $rowProfil['phone'] : ''; ?>">

            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" class="form-input" name="email" value="<?php echo isset($rowProfil['email']) ? $rowProfil['email'] : ''; ?>">

            <label for="creationDate" class="form-label">Date de création:</label>
            <input type="date" id="creationDate" class="form-input" value="<?php echo $rowProfil['creationDate']; ?>" readonly>

            <label for="currentPassword" class="form-label"><strong>Mot de passe actuel :</strong></label>
            <div class="input-group">
                <input type="password" id="currentPassword" name="currentPassword" class="form-control">
                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="currentPassword">
                    <i class="fas fa-eye" id="eyeIconCurrent"></i>
                </button>
            </div>
            <label for="newPassword" class="form-label"><strong>Nouveau mot de passe :</strong></label>
            <div class="input-group">
                <input type="password" id="newPassword" name="newPassword" class="form-control">
                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="newPassword">
                    <i class="fas fa-eye" id="eyeIconCurrent"></i>
                </button>
            </div>
            <label for="confirmPassword" class="form-label"><strong>Confirmer le nouveau mot de passe :</strong></label>
            <div class="input-group">
                <input type="password" id="confirmPassword" name="confirmPassword" class="form-control">
                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="confirmPassword">
                    <i class="fas fa-eye" id="eyeIconCurrent"></i>
                </button>
            </div>
            <div id="password-error" class="error-message" style="display:none;">Le mot de passe doit contenir au moins 8 caractères, une majuscule, et un chiffre.</div>
            <div id="password-strength" class="progress">
                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="mb-3">
                <label for="newImage" class="form-label"><strong>Nouvelle image :</strong></label>
                <input type="file" id="newImage" name="newImage" class="form-control">
            </div>
            <div id="error-message" class="alert alert-danger" style="display:none;"></div>
            <div id="updateMessage" class="alert" style="display: none;"></div>
            <div class="mb-3">
                <button type="button" class="btn btn-primary" id="openKycModal">
                    Vérification KYC
                </button>
                <span id="verificationStatus" class="text-muted">Non vérifié</span>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success" id="saveChanges">Sauvegarder les modifications</button>
            </div>
        </form>
    </div>
    <!-- Modal pour la vérification KYC -->
    <div class="modal fade" id="kycModal" tabindex="-1" role="dialog" aria-labelledby="kycModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kycModalLabel">Vérification KYC</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeKycModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Pour procéder à la vérification KYC, veuillez fournir les informations requises ci-dessous :</p>
                    <!-- Ajoutez l'ID au formulaire KYC -->
                    <form id="kycForm" action="traiter_kyc.php" method="POST">
                        <div class="mb-3">
                            <label for="kyc_Name" class="form-label">Nom complet :</label>
                            <input type="text" class="form-control" id="kyc_Name" name="kyc_Name" placeholder="Votre nom complet" required>
                        </div>
                        <div class="mb-3">
                            <label for="kyc_id" class="form-label">Numéro d'identification :</label>
                            <input type="text" class="form-control" id="kyc_id" name="kyc_id" placeholder="Votre numéro d'identification" required>
                        </div>
                        <div class="mb-3">
                            <label for="kyc_front_photo" class="form-label">Photo recto de la carte (tenu en main) :</label>
                            <input type="file" class="form-control" id="kyc_front_photo" name="kyc_front_photo" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label for="kyc_back_photo" class="form-label">Photo verso de la carte (tenu en main) :</label>
                            <input type="file" class="form-control" id="kyc_back_photo" name="kyc_back_photo" accept="image/*" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeKycModal2">Fermer</button>
                            <!-- Changez le bouton de type "submit" -->
                            <button type="submit" class="btn btn-primary">Soumettre</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">

            <div class="section-title">
                <h2>Contact</h2>
            </div>

        </div>

        <div>
            <?php
            include '../hf/map.php';
            ?>
        </div>
    </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <?php
    include '../hf/footer.php';
    ?>

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->

    <script>
        $(document).ready(function() {
            // Ajoutez ceci pour afficher le message d'erreur
            function displayErrorMessage(message) {
                $('#password-error').text(message).show();
            }

            // Ajoutez ceci pour masquer le message d'erreur
            function hideErrorMessage() {
                $('#password-error').hide();
            }

            // Ajoutez ceci pour valider les mots de passe
            $('form').submit(function(event) {
                var newPassword = $('#newPassword').val();
                var confirmPassword = $('#confirmPassword').val();

                // Ajoutez une validation supplémentaire si nécessaire
                if (newPassword !== confirmPassword) {
                    displayErrorMessage("Les nouveaux mots de passe ne correspondent pas.");
                    event.preventDefault(); // Empêcher la soumission du formulaire
                } else {
                    hideErrorMessage();
                }
            });

            // Gestion de la robustesse du nouveau mot de passe et vérification de la correspondance avec la confirmation
            var strength = 0; // Déclarer strength en dehors de la fonction

            $('#newPassword, #confirmPassword').on('input', function() {
                var newPassword = $('#newPassword').val();
                var confirmPassword = $('#confirmPassword').val();
                var passwordStrength = $('#password-strength');

                // Vérifiez la robustesse du nouveau mot de passe
                strength = checkPasswordStrength(newPassword);

                // Cachez le message lorsque le champ est vide
                if (newPassword.length === 0) {
                    passwordStrength.text('');
                } else {
                    // Affichez le message en fonction de la force du mot de passe
                    if (strength <= 2) {
                        passwordStrength.removeClass('bg-success').addClass('bg-danger').text('Faible');
                    } else if (strength <= 4) {
                        passwordStrength.removeClass('bg-danger').addClass('bg-warning').text('Moyen');
                    } else {
                        passwordStrength.removeClass('bg-warning').addClass('bg-success').text('Fort');
                    }
                }

                // Mise à jour de la barre de progression en fonction de la force du mot de passe
                var progressWidth = (strength / 5) * 100;
                $('#password-strength .progress-bar').width(progressWidth + '%');

                // Ajoutez des classes Bootstrap pour différents niveaux de force
                var progressBar = $('#password-strength .progress-bar');
                progressBar.width(progressWidth + '%');

                if (strength <= 2) {
                    progressBar.addClass('bg-danger');
                } else if (strength <= 4) {
                    progressBar.addClass('bg-warning');
                } else {
                    progressBar.addClass('bg-success');
                }

                // Réactivez la transition pour la prochaine mise à jour
                setTimeout(function() {
                    progressBar.css('transition', 'width 0.3s ease');
                }, 0);
            });

            $('.toggle-password').on('mousedown', function() {
                var targetId = $(this).data('target');
                var passwordInput = $('#' + targetId);
                var eyeIcon = $('#eyeIcon' + targetId);

                // Change l'icône en fonction de l'état du mot de passe
                eyeIcon.removeClass('fa-eye-slash').addClass('fa-eye');

                // Affiche le mot de passe
                passwordInput.attr('type', 'text');
            });

            $('.toggle-password').on('mouseup', function() {
                var targetId = $(this).data('target');
                var passwordInput = $('#' + targetId);
                var eyeIcon = $('#eyeIcon' + targetId);

                // Change l'icône en fonction de l'état du mot de passe
                eyeIcon.removeClass('fa-eye').addClass('fa-eye-slash');

                // Cache le mot de passe après trois secondes
                setTimeout(function() {
                    passwordInput.attr('type', 'password');
                }, 3000);
            });
        });

        // Fonction pour vérifier la robustesse du mot de passe
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
        // Ajoutez ceci pour valider le numéro de téléphone
        $('#phone').on('input', function() {
            var phoneNumber = $(this).val();

            // Remplacez le contenu non numérique par une chaîne vide
            phoneNumber = phoneNumber.replace(/\D/g, '');

            // Limitez la longueur à 10 chiffres (vous pouvez ajuster cela en fonction de vos besoins)
            phoneNumber = phoneNumber.substring(0, 10);

            // Mettez à jour la valeur dans la zone de texte
            $(this).val(phoneNumber);
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#openKycModal').click(function() {
                $('#kycModal').modal('show');
            });

            // Script pour fermer la modal
            $('#closeKycModal').click(function() {
                $('#kycModal').modal('hide');
            });

            // Script pour fermer la modal
            $('#closeKycModal2').click(function() {
                $('#kycModal').modal('hide');
            });
        });

        // Attendez que le document soit prêt
        $(document).ready(function() {
            // Soumettez le formulaire KYC lorsqu'il est envoyé
            $('#kycForm').submit(function(e) {
                e.preventDefault(); // Empêchez le formulaire de s'envoyer normalement

                // Obtenez les données du formulaire
                var kycData = new FormData(this);

                // Effectuez une requête AJAX
                $.ajax({
                    type: 'POST',
                    url: 'traiter_kyc.php', // Assurez-vous d'ajuster le chemin du fichier PHP
                    data: kycData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Analysez la réponse JSON
                        var result = JSON.parse(response);

                        // Affichez le message de succès ou d'échec dans la console (ajustez selon vos besoins)
                        if (result.success) {
                            console.log('KYC soumis avec succès !');
                        } else {
                            console.error('Échec de la soumission du KYC.');
                        }

                        // Fermez le modal KYC
                        $('#kycModal').modal('hide');
                    },
                    error: function() {
                        console.error('Erreur lors de la soumission du formulaire KYC.');
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#updateProfileForm').submit(function(event) {
                // Empêcher la soumission normale du formulaire
                event.preventDefault();

                // Effectuer la mise à jour via AJAX
                $.ajax({
                    type: 'POST',
                    url: 'update_profile.php',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Analyser la réponse JSON
                        var result = JSON.parse(response);

                        // Afficher le message
                        showUpdateMessage(result.success, result.message);
                    },
                    error: function() {
                        // En cas d'erreur AJAX
                        showUpdateMessage(false, 'Erreur lors de la mise à jour.');
                    }
                });
            });
        });

        // Fonction pour afficher le message
        function showUpdateMessage(success, message) {
            var updateMessage = $('#updateMessage');
            updateMessage.html(message);

            if (success) {
                updateMessage.removeClass('alert-danger').addClass('alert-success');
            } else {
                updateMessage.removeClass('alert-success').addClass('alert-danger');
            }

            updateMessage.show();

            // Vous pouvez ajouter un délai pour masquer le message après un certain temps
            setTimeout(function() {
                updateMessage.hide();
            }, 5000); // Masquer après 5 secondes (ajustez selon vos besoins)
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
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