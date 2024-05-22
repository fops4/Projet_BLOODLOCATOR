<?php
session_start();

include '../connexion.php';

// Récupérer les données du formulaire
$emailOrPhone = $_POST['emailOrPhone'];
$password = $_POST['password'];

// Vérifier si l'emailOrPhone est un email ou un numéro de téléphone
$column = filter_var($emailOrPhone, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

// Préparer la requête SQL pour vérifier l'existence de l'utilisateur
$checkUserQuery = "SELECT * FROM hopital WHERE $column = ?";

// Utilisation d'une requête préparée pour éviter les attaques par injection SQL
$stmt = $connexion->prepare($checkUserQuery);
$stmt->bind_param("s", $emailOrPhone);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Utilisateur trouvé, vérifier le mot de passe
    $row = $result->fetch_assoc();

    if (password_verify($password, $row['password'])) {
        // Mot de passe correct, connectez l'utilisateur

        // Mise à jour du statut de l'utilisateur
        $newStatus = "Active now";
        $updateStatusQuery = "UPDATE hopital SET status = ? WHERE id = ?";
        $updateStatusStmt = $connexion->prepare($updateStatusQuery);
        $updateStatusStmt->bind_param("si", $newStatus, $row['id']);
        $updateStatusStmt->execute();
        $updateStatusStmt->close();

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['unique_id'] = $row['unique_id'];
        $_SESSION['hopitalname'] = $row['hopitalname'];
        $_SESSION['hospital_id'] = $row['id'];
        $_SESSION['utilisateur_connecte'] = true;
        echo "Connexion réussie!";
        // Vous pouvez rediriger l'utilisateur vers une autre page ici
    } else {
        // Mot de passe incorrect
        echo "Erreur : Mot de passe incorrect. Veuillez vérifier et réessayer.";
    }
} else {
    // Utilisateur non trouvé
    echo "Erreur : Utilisateur non trouvé. Veuillez créer un compte en ";
}

// Fermer la connexion à la base de données
$stmt->close();
$connexion->close();
