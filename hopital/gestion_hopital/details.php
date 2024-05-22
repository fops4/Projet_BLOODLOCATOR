<?php
// get_details.php


include '../connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hopitalId'])) {
    $hopitalId = $_POST['hopitalId'];

    // Utilisez une requête préparée pour éviter les attaques par injection SQL
    $queryDetails = "SELECT * FROM hopital WHERE id = ?";
    $stmt = $connexion->prepare($queryDetails);
    $stmt->bind_param("i", $hopitalId);
    $stmt->execute();
    $resultDetails = $stmt->get_result();

    if ($resultDetails) {
        $hopitalDetails = $resultDetails->fetch_assoc();
        // Fermez la connexion à la base de données ici
        $stmt->close();

        // Retournez les détails au format JSON
        echo json_encode($hopitalDetails);
    } else {
        // Gérez l'erreur si la requête échoue
        die("Erreur dans la requête SQL: " . $connexion->error);
    }
} else {
    // Gérez le cas où l'ID n'est pas spécifié dans l'URL
    echo json_encode(['error' => 'ID de l\'hôpital non spécifié.']);
}
