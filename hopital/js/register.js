/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});
        // inscription hopital
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
                var confirmPassword = $('#confirmPassword').val();

                if (password !== confirmPassword) {
                    displayErrorMessage("Les mots de passe ne correspondent pas.");
                    event.preventDefault(); // Empêcher la soumission du formulaire
                } else {
                    hideErrorMessage();
                }
            });

            // Gestion de la robustesse du mot de passe et vérification de la correspondance avec la confirmation
            $('#password, #confirmPassword').on('input', function() {
                var password = $('#password').val();
                var confirmPassword = $('#confirmPassword').val();
                var passwordStrength = $('#password-strength');
                var confirmPasswordError = $('#confirm-password-error');

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
                if (confirmPassword.length > 0 && password !== confirmPassword) {
                    confirmPasswordError.text('Les mots de passe ne correspondent pas').addClass('text-danger');
                } else {
                    confirmPasswordError.text('').removeClass('text-danger');
                }
            });

            $('#creationDate').on('input', function() {
                var creationDate = new Date($(this).val());
                var currentDate = new Date();
                var minDate = new Date('1980-01-01'); 

                if (creationDate > currentDate) {
                    displayErrorMessage("La date de création ne peut pas être dans le futur.");
                } else if (creationDate < minDate) {
                    displayErrorMessage("La date de création doit être au moins en 1990.");
                } else {
                    hideErrorMessage();
                }
            });


            // Ajoutez ceci pour valider le numéro de téléphone
            $('#phone').on('input', function() {
                var phoneNumber = $(this).val();

                // Remplacez le contenu non numérique par une chaîne vide
                phoneNumber = phoneNumber.replace(/\D/g, '');

                // Limitez la longueur à 9 caractères
                phoneNumber = phoneNumber.substring(0, 9);

                // Mettez à jour la valeur dans la zone de texte
                $(this).val(phoneNumber);
            });

            $('#togglePassword1, #togglePassword').on('click', function() {
                var passwordInput = $('#password, #confirmPassword');
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

        
         