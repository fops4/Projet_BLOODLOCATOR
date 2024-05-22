<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>BloodLocator</title>
    <meta content="" name="description">
    <meta content="" name="keywords">


    <!-- Favicons -->
    <link href="../../assets/img/favicon.png" rel="icon">
    <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <link href="../../css/styles.css" rel="stylesheet" />
    <!--  -->
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
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Template Main CSS File -->

    <link href="../../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/modif.css">


    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Ajoutez jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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








    <main style="margin-top: 100px;">


        <!-- ======= Doctors Section ======= -->
        <section id="doctors" class="doctors section-bg">
            <div id="layoutSidenav_content">
                <main>
                    <div class="gestion">
                        <div class="title">
                            <h2>Gestion de Stock de Sang</h2>
                        </div>
                        <div id="result-message"></div>
                        <form id="stockForm">
                            <label class="titre" for="bloodType">Groupe sanguin :</label>
                            <select id="bloodType" name="bloodType" required>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                            <label class="titre" for="quantity">Quantité :</label>
                            <input class="inp" type="number" id="quantity" name="quantity" required min="0" max="999" oninput="checkInputLength(this)">
                            <div id="quantity-error-message"></div>
                            <div id="currentStock">
                                <div class="title">
                                    <h3>Stock actuel </h3>
                                </div>
                                <ul id="stockList"></ul>
                            </div>
                            <div class="gbut">
                                <button class="but" type="button" onclick="updateStock('add')">Ajouter au stock</button>
                                <button class="butt" type="button" onclick="updateStock('subtract')">Soustraire du stock</button>
                            </div>
                        </form>
                    </div>
                    <footer class="py-4 bg-light mt-auto">
                    </footer>
                </main>
            </div>
        </section><!-- End Doctors Section -->


    </main>






    <!--
    

                -->



    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
        <div class="container" data-aos="zoom-in">

            <div class="text-center">
                <h3>En cas d'urgence? Besoin d'aide maintenant?</h3>
                <p>En tant que gardien de la santé et du bien-être, il est déchirant de voir des vies précieuses s'éteindre en raison de cette pénurie. C'est pourquoi je suis extrêmement reconnaissant et prêt à saisir cette opportunité offerte par 'BloodLocator'. En utilisant cette plateforme innovante, je suis déterminé à trouver les donneurs de sang compatibles et à établir des connexions vitales pour mes patients. Ensemble, nous pouvons inverser cette tendance tragique et offrir une lueur d'espoir à ceux qui en ont désespérément besoin. Le pouvoir de sauver des vies est entre nos mains, et je suis prêt à tout mettre en œuvre pour y parvenir.</p>
                <a class="cta-btn scrollto" href="form/connexion.html">Commencer des maintenant</a>
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
            include '../../hf/map.php';
            ?>
        </div>
    </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <?php
    include '../../hf/footer.php';
    ?>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // Chargez le stock actuel lors du chargement de la page
            getStock();
        });

        function checkInputLength(input) {
            // Limitez la longueur de la saisie à 3 chiffres
            if (input.value.length > 3) {
                input.value = input.value.slice(0, 3);
            }
        }

        function updateStock(action) {
            var bloodType = $("#bloodType").val();
            var quantity = $("#quantity").val();

            // Vérifiez si la quantité est valide
            if (!isValidQuantity(quantity)) {
                $("#result-message").html('<div class="error-message">Veuillez entrer un nombre entier positif (maximum 3 chiffres).</div>');
                return;
            }

            $.ajax({
                type: "POST",
                url: "manage_stock.php",
                data: {
                    action: action,
                    bloodType: bloodType,
                    quantity: quantity
                },
                dataType: "json",
                success: function(response) {
                    // Affichez le message de résultat
                    var messageDiv = $("#result-message");
                    messageDiv.html(response.message);

                    // Ajoutez une classe CSS en fonction du succès ou de l'échec
                    if (response.success) {
                        messageDiv.removeClass("error-message").addClass("success-message");
                        // Videz la zone de saisie après une opération réussie
                        $("#quantity").val('');
                        // Affichez le message pendant 5 secondes, puis videz-le
                        setTimeout(function() {
                            messageDiv.empty().removeClass("success-message");
                        }, 5000);
                    } else {
                        messageDiv.removeClass("success-message").addClass("error-message");
                    }

                    // Mettez à jour l'affichage du stock
                    getStock();
                },
                error: function(error) {
                    // Affichez les erreurs dans la console
                    console.error("Erreur AJAX:", error);
                }
            });
        }

        function isValidQuantity(quantity) {
            // Vérifiez si la quantité est un nombre entier positif avec un maximum de 3 chiffres
            return /^[1-9]\d{0,2}$/.test(quantity);
        }

        function getStock() {
            $.ajax({
                type: "GET",
                url: "get_stock.php",
                dataType: "json",
                success: function(response) {
                    // Mettez à jour l'affichage du stock
                    displayStock(response.stock);
                },
                error: function(error) {
                    // Affichez les erreurs dans la console
                    console.error("Erreur AJAX:", error);
                }
            });
        }

        function displayStock(stock) {
            // Assurez-vous que stock est défini et est un tableau
            if (Array.isArray(stock)) {
                // Videz la liste actuelle
                $("#stockList").empty();

                // Parcourez le stock et ajoutez chaque élément à la liste
                stock.forEach(function(item) {
                    $("#stockList").append("<li>" + item.blood_type + ": " + item.quantity + "</li>");
                });
            } else {
                console.error("Le stock n'est pas défini ou n'est pas un tableau :", stock);
            }
        }
    </script>
</body>

</html>