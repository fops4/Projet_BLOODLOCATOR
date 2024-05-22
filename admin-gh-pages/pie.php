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

// Exécuter une requête SQL pour récupérer les données triées par quantité de sang décroissante
$sql = 'SELECT bs.quantity, h.hopitalname FROM blood_stock bs
        INNER JOIN hopital h ON bs.user_id = h.id
        ORDER BY bs.quantity DESC';
$result = $conn->query($sql);

// Stocker les données récupérées dans un tableau
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = array(
        'hopitalname' => $row['hopitalname'],
        'quantity' => $row['quantity']
    );
}

// Fermer la connexion à la base de données
$conn->close();
?>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <canvas id="myChart"></canvas>

    <script>
    // Convertir les données PHP en format JavaScript
    var chartData = <?php echo json_encode($data); ?>;

    // Extraire les noms d'hôpitaux et les quantités de sang
    var hopitalnames = chartData.map(function(item) {
        return item.hopitalname;
    });

    var quantities = chartData.map(function(item) {
        return item.quantity;
    });

    // Palette de couleurs prédéfinie
    var colors = [
        'rgba(0, 123, 255, 0.5)',
        'rgba(255, 0, 0, 0.5)',
        'rgba(0, 255, 0, 0.5)',
        'rgba(255, 255, 0, 0.5)',
        'rgba(255, 0, 255, 0.5)',
        'rgba(0, 255, 255, 0.5)'
        // Ajoutez d'autres couleurs si nécessaire
    ];

    // Limiter les couleurs aux hôpitaux disponibles
    colors = colors.slice(0, hopitalnames.length);

    // Créer le graphe avec Chart.js
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: hopitalnames,
            datasets: [{
                label: 'Quantité de sang',
                data: quantities,
                backgroundColor: colors,
                borderColor: 'rgba(0, 0, 0, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>