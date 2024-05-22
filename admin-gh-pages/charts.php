<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Charts</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">BloodLocator</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="../index.php">Deconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                        
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Home
                            </a>
                           
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Utilisateur
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="stables.php">Statistique des hopitaux</a>
                                    <a class="nav-link" href="donneurst.php">Statistique des Donneurs</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="charts.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="table.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>
                            <a class="nav-link" href="hopital.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Hopital
                            </a>
                            <a class="nav-link" href="donneur.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                donneur
                            </a>
                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Messagerie
                            </a>
                            <a class="nav-link" href="verifie.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                KYC Tcheque
                            </a>
                        </div>
                    </div>
                    
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Charts</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Charts</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                
                            </div>
                        </div>
                        <div class="card mb-4">
                            
                            <?php
                            // Établir une connexion à la base de données MySQL
                            $servername = 'localhost';
                            $username = 'root';
                            $password = '';
                            $dbname = 'bloodlocator';

                            $conn = new mysqli($servername, $username, $password, $dbname);

                            // Vérifier la connexion
                            if ($conn->connect_error) {
                                die('Connexion échouée : ' . $conn->connect_error);
                            }

                            // Exécuter une requête SQL pour récupérer les données
                            $sql = 'SELECT blood_type, SUM(quantity) AS total_quantity FROM blood_stock GROUP BY blood_type';
                            $result = $conn->query($sql);

                            // Stocker les données récupérées dans un tableau
                            $data = array();
                            while ($row = $result->fetch_assoc()) {
                                $data[] = array(
                                    'blood_type' => $row['blood_type'],
                                    'quantity' => $row['total_quantity']
                                );
                            }

                            // Fermer la connexion à la base de données
                            $conn->close();
                            ?>
                              <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <body>
                                <canvas id="myChart"></canvas>

                                <script>
                                // Convertir les données PHP en format JavaScript
                                var chartData = <?php echo json_encode($data); ?>;

                                // Extraire les valeurs du blood_type et du quantity
                                var labels = chartData.map(function(item) {
                                    return item.blood_type;
                                });
                                var values = chartData.map(function(item) {
                                    return item.quantity;
                                });

                                // Créer le graphe avec Chart.js
                                var ctx = document.getElementById('myChart').getContext('2d');
                                var myChart = new Chart(ctx, {
                                    type: 'bar', // Type de graphe, par exemple 'bar', 'line', 'pie', etc.
                                    data: {
                                        labels: labels, // Étiquettes des axes X
                                        datasets: [{
                                            label: 'Quantité de sang par type', // Légende du graphe
                                            data: values, // Données du graphe
                                            backgroundColor: 'rgba(0, 123, 255, 0.5)', // Couleur de fond
                                            borderColor: 'rgba(0, 123, 255, 1)', // Couleur des bordures
                                            borderWidth: 1 // Épaisseur des bordures
                                        }]
                                    },
                                    options: {
                                        // Personnalisation supplémentaire du graphe, telle que la configuration de l'échelle des axes, les légendes, etc.
                                    }
                                });
                                </script>

                                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <i class="fas fa-chart-bar me-1"></i>
                                            Bar Chart Example
                                        </div>
                                        <div class="card-body"><canvas id="myBarChart" width="100%" height="50"></canvas></div>
                                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <i class="fas fa-chart-pie me-1"></i>
                                            Pie Chart Example
                                        </div>
                                        <div class="card-body"><canvas id="myPieChart" width="100%" height="50"></canvas></div>
                                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                    <footer class="py-4 bg-light mt-auto">
                        <div class="container-fluid px-4">
                            <div class="d-flex align-items-center justify-content-between small">
                                <div class="text-muted">Copyright &copy; Your Website 2023</div>
                                <div>
                                    <a href="#">Privacy Policy</a>
                                    &middot;
                                    <a href="#">Terms &amp; Conditions</a>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            <script src="js/scripts.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
            <script src="assets/demo/chart-area-demo.js"></script>
            <script src="assets/demo/chart-bar-demo.js"></script>
            <script src="assets/demo/chart-pie-demo.js"></script>
        </body>
    </html>
