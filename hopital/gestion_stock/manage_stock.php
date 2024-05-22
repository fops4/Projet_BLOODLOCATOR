<?php
session_start();

include '../connexion.php';


// Récupérez les données du formulaire
$action = isset($_POST['action']) ? $_POST['action'] : '';
$bloodType = isset($_POST['bloodType']) ? $_POST['bloodType'] : '';
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;

// Initialisez la réponse
$response = array('success' => false, 'message' => '');

// Sélectionnez le stock actuel depuis la base de données
$query = "SELECT quantity FROM blood_stock WHERE blood_type = ? AND user_id = ?";
$checkStmt = $connexion->prepare($query);

if ($checkStmt) {
    $checkStmt->bind_param("si", $bloodType, $_SESSION['user_id']);
    $checkStmt->execute();
    $checkStmt->bind_result($currentQuantity);
    $checkStmt->fetch();
    $checkStmt->close();  // Fermez la première requête après avoir récupéré la quantité actuelle

    // Initialisez $stmt à null
    $stmt = null;

    switch ($action) {
        case 'add':
            // Ajoutez la quantité au stock
            $query = "INSERT INTO blood_stock (user_id, blood_type, quantity) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE quantity = quantity + ?";
            $stmt = $connexion->prepare($query);
            $stmt->bind_param("issi", $_SESSION['user_id'], $bloodType, $quantity, $quantity);
            break;

        case 'subtract':
            // Vérifiez d'abord si la quantité est disponible (déjà effectué avant le switch)
            if ($currentQuantity < $quantity) {
                $response['message'] = "Quantité insuffisante en stock. Il y a seulement " . $currentQuantity . " en stock.";
                break;
            }

            // Soustrayez la quantité du stock
            $query = "UPDATE blood_stock SET quantity = GREATEST(quantity - ?, 0) WHERE blood_type = ? AND user_id = ?";
            $stmt = $connexion->prepare($query);
            $stmt->bind_param("isi", $quantity, $bloodType, $_SESSION['user_id']);
            break;

        default:
            $response['message'] = 'Action non reconnue.';
            break;
    }

    // Vérifiez si $stmt est défini avant d'appeler execute()
    if ($stmt !== null && $stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Opération réussie.';
    } elseif ($stmt !== null) {
        $response['message'] = 'Erreur lors de l\'opération : ' . $stmt->error;
    }

    // Fermez $stmt s'il est défini
    if ($stmt !== null) {
        $stmt->close();
    }
} else {
    $response['message'] = 'Erreur lors de la préparation de la requête : ' . $connexion->error;
}

// Fermez la connexion à la base de données
$connexion->close();

// Retournez la réponse au format JSON
echo json_encode($response);
