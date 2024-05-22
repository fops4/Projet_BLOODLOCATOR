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
$sql = 'SELECT groupe_sanguin, GROUP_CONCAT(CAST(id AS CHAR(50)) SEPARATOR ", ") AS id_donneurs FROM donneur GROUP BY groupe_sanguin';
$result = $conn->query($sql);

// Stocker les données récupérées dans un tableau
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = array(
        'groupe_sanguin' => $row['groupe_sanguin'],
        'id_donneurs' => $row['id_donneurs']
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

    // Extraire les valeurs du groupe_sanguin et des id_donneurs
    var labels = chartData.map(function(item) {
        return item.groupe_sanguin;
    });
    var values = chartData.map(function(item) {
        return item.id_donneurs;
    });

    // Créer le graphe avec Chart.js
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar', // Type de graphe, par exemple 'bar', 'line', 'pie', etc.
        data: {
            labels: labels, // Étiquettes des axes X
            datasets: [{
                label: 'ID des donneurs par groupe sanguin', // Légende du graphe
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
</body> 