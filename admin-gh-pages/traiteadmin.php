<?php
// Assurez-vous de configurer ces informations en fonction de votre serveur MySQL
include 'form.php';

// Se connecter à la base de données
$connexion = new mysqli($host, $utilisateur, $mot_de_passe, $base_de_donnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

$login = isset($_POST['login']) ? $_POST['login'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Utiliser une requête préparée pour éviter les injections SQL
$selectQuery = "SELECT * FROM administrateur WHERE login = ?";
$stmt = $connexion->prepare($selectQuery);
$stmt->bind_param("s", $login); // "s" signifie chaîne, vous pouvez ajuster si nécessaire
$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    // Vérifier s'il y a des résultats
    if ($result->num_rows > 0) {
        // Récupérer les données de la ligne correspondante
        $row = $result->fetch_assoc();

        // Charger les variables
        $tlogin = $row['login'];
        $tpassword = $row['password'];
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['user_idd'] = $row['id'];
            $_SESSION['unique_id'] = $row['unique_id'];
            $_SESSION['utilisateur_connectee'] = true;

            // Mettre à jour le statut de connexion du donneur
            $newStatus = "Active now";
            $updateStatusQuery = "UPDATE donneur SET status = ? WHERE id = ?";
            $updateStatusStmt = $connexion->prepare($updateStatusQuery);
            $updateStatusStmt->bind_param("si", $newStatus, $row['id']);
            $updateStatusStmt->execute();
            $updateStatusStmt->close();

            echo "Connexion réussie!";
            // Vous pouvez rediriger l'utilisateur vers une autre page ici
            exit();
        } else {
            echo "Erreur : Mot de passe incorrect. Veuillez vérifier et réessayer.";
        }
    } else {
        echo "Erreur : Utilisateur non trouvé. Veuillez créer un compte en ";
    }

    // Libérer le résultat de la requête
    $result->free();
} else {
    echo "Erreur lors de la récupération des données : " . $connexion->error;
}

// Fermer la connexion à la base de données
$stmt->close();
$connexion->close();
