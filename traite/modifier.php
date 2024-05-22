<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION["utilisateur_connectee"]) || $_SESSION["utilisateur_connectee"] !== true) {
    // Si l'utilisateur n'est pas connecté, redirige vers la page de connexion
    header("Location: ../index.php ");
    exit();
}

include '../hopital/connexion.php';


// Récupérer l'ID de l'utilisateur depuis la session
$userID = $_SESSION['user_idd'];

// Récupérer les données du formulaire
$telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';
$newEmail = isset($_POST['email']) ? $_POST['email'] : '';
$newPassword = isset($_POST['newPassword']) ? $_POST['newPassword'] : '';
$currentPassword = isset($_POST['currentPassword']) ? $_POST['currentPassword'] : '';

// Construction de la requête de mise à jour
$requeteUpdate = "UPDATE donneur SET ";

// Initialisation des variables pour les types de paramètres et les valeurs
$types = '';
$values = array();

// Gestion du téléphone
if (!empty($telephone)) {
    $requeteUpdate .= "telephone=?, ";
    $types .= "s";
    $values[] = $telephone;
}

// Gestion de l'e-mail
if (!empty($newEmail)) {
    $requeteUpdate .= "email=?, ";
    $types .= "s";
    $values[] = $newEmail;
}

// Gestion du mot de passe
if (!empty($newPassword)) {
    // Vérifier l'ancien mot de passe
    $requetePassword = "SELECT password FROM donneur WHERE id = ?";
    $stmtPassword = $connexion->prepare($requetePassword);
    $stmtPassword->bind_param("i", $userID);
    $stmtPassword->execute();
    $resultPassword = $stmtPassword->get_result();

    if ($resultPassword->num_rows > 0) {
        $rowPassword = $resultPassword->fetch_assoc();
        $hashedPassword = $rowPassword['password'];

        // Vérifier si l'ancien mot de passe correspond
        if (password_verify($currentPassword, $hashedPassword)) {
            // Mot de passe correct, procéder à la mise à jour
            $requeteUpdate .= "password=?, ";
            $types .= "s";
            $values[] = password_hash($newPassword, PASSWORD_DEFAULT);
        } else {
            // Ancien mot de passe incorrect
            echo json_encode(array('success' => false, 'message' => 'Ancien mot de passe incorrect.'));
            exit();
        }
    } else {
        // Gérer le cas où l'utilisateur n'est pas trouvé dans la base de données
        echo json_encode(array('success' => false, 'message' => 'Utilisateur non trouvé.'));
        exit();
    }


    $stmtPassword->close();
}


// Supprimer la virgule et l'espace à la fin de la requête
$requeteUpdate = rtrim($requeteUpdate, ", ");

// Ajouter la clause WHERE à la requête
$requeteUpdate .= " WHERE id=?";
$types .= "i";
$values[] = $userID;

// Préparer et exécuter la requête de mise à jour
$stmtUpdate = $connexion->prepare($requeteUpdate);
$stmtUpdate->bind_param($types, ...$values);
$stmtUpdate->execute();

// Vérifier si la mise à jour a réussi
if ($stmtUpdate->affected_rows > 0) {
    // Mise à jour réussie
    $response = array('success' => true, 'message' => 'Mise à jour réussie !');
} else {
    // Aucune modification effectuée
    if ($stmtUpdate->affected_rows === 0) {
        $response = array('success' => true, 'message' => 'Aucune modification effectuée.');
    } else {
        // Échec de la mise à jour
        $response = array('success' => false, 'message' => 'Échec de la mise à jour.');
    }
}

// Retournez la réponse en format JSON
echo json_encode($response);


// Fermer la connexion à la base de données
$stmtUpdate->close();
$connexion->close();
