<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <style>
        #detailsContainer {
            margin-top: 20px;
            display: none;
            /* Masquez les détails initialement */
        }

        #detailTitle {
            margin-bottom: 20px;
        }

        #detailContent img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }
    </style>

    <title>Hopital</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php include __DIR__ . '/../navigation/header.php'; ?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php include __DIR__ . '/../navigation/nav.php'; ?>
        </div>
        <div id="layoutSidenav_content">
            <?php
            include '../connexion.php';

            $queryHopitaux = "SELECT id, hopitalname, image FROM hopital";
            $resultHopitaux = mysqli_query($connexion, $queryHopitaux);

            if (!$resultHopitaux) {
                die("Erreur dans la requête SQL: " . mysqli_error($connexion));
            }

            ?>
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="row" id="rowHopitaux">
                        <?php
                        while ($row = mysqli_fetch_assoc($resultHopitaux)) {
                            $hopitalId = $row['id'];
                            $hopitalName = $row['hopitalname'];
                            $hopitalImage = $row['image'];
                        ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <!-- Ajoutez la balise img pour afficher l'image -->
                                    <img class="card-img-top" src="<?php echo $hopitalImage; ?>" alt="Image de l'hôpital">
                                    <div class="card-body"><?php echo $hopitalName; ?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <!-- Modifiez le lien pour appeler la fonction showDetails avec l'ID de l'hôpital en tant que paramètre -->
                                        <a class="small text-white stretched-link" href="#" onclick="showDetails(<?php echo $hopitalId; ?>)">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>

                    <!-- Balise div pour afficher les détails de l'hôpital -->
                    <div id="detailsContainer">
                        <div id="detailTitle"></div>
                        <div id="detailContent"></div>
                    </div>
                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <?php include __DIR__ . '/../navigation/footer.php'; ?>
            </footer>
        </div>
    </div>
    <script>
        function showDetails(hopitalId) {
            // Masquez les informations existantes
            document.getElementById('rowHopitaux').style.display = 'none';
            document.getElementById('detailsContainer').style.display = 'block';

            // Utilisez JavaScript pour récupérer les détails de l'hôpital via une requête AJAX
            $.ajax({
                type: 'GET',
                url: 'details.php',
                data: {
                    id: hopitalId
                },
                success: function(response) {
                    document.getElementById('detailTitle').innerHTML = 'Détails de l\'Hôpital';
                    document.getElementById('detailContent').innerHTML = response;
                },
                error: function() {
                    alert('Erreur lors de la récupération des détails de l\'hôpital.');
                }
            });
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>

</body>

</html>