<?php
// Assurez-vous de configurer ces informations en fonction de votre serveur MySQL
$host = 'localhost';
$utilisateur = 'root';
$mot_de_passe = '';
$base_de_donnees = 'bloodlocator';

// Se connecter à la base de données
$connexion = new mysqli($host, $utilisateur, $mot_de_passe, $base_de_donnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

// Récupérer le nom de l'hôpital et le groupe sanguin pour les hôpitaux de groupe sanguin O+
$selectQuery = "SELECT h.hopitalname, b.blood_type FROM hopital h INNER JOIN blood_stock b ON h.id = b.user_id WHERE b.blood_type = 'B+'";
$result = $connexion->query($selectQuery);

// Vérifier si des résultats ont été trouvés
if ($result->num_rows > 0) {
    echo "<style>
            table {
                border-collapse: collapse;
                width: 100%;
            }
            
            th, td {
                text-align: left;
                padding: 8px;
            }
            
            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            
            th {
                background-color: #4CAF50;
                color: white;
            }
        </style>";
    echo "<table>";
    echo "<tr><th>Nom de l'hôpital</th><th>Groupe sanguin</th></tr>";

    // Afficher chaque ligne de résultats
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['hopitalname'] . "</td>";
        echo "<td>" . $row['blood_type'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Aucun hôpital avec le groupe sanguin B+ trouvé.";
}

// Fermer la connexion à la base de données
$connexion->close();
?>