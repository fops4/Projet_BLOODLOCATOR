<?php
session_start();

include '../connexion.php';

// Initialisez la réponse
$response = array('success' => false, 'stock' => array());

// Sélectionnez le stock actuel depuis la base de données
$query = "SELECT blood_type, quantity FROM blood_stock WHERE user_id = ?";
$stmt = $connexion->prepare($query);

if ($stmt) {
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $response['stock'][] = array(
            'blood_type' => $row['blood_type'],
            'quantity' => $row['quantity']
        );
    }

    $response['success'] = true;

    // Fermez $stmt
    $stmt->close();
} else {
    $response['message'] = 'Erreur lors de la préparation de la requête : ' . $connexion->error;
}

// Fermez la connexion à la base de données
$connexion->close();

// Retournez la réponse au format JSON
echo json_encode($response);
