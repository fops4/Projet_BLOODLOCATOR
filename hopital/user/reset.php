<?php
// Assurez-vous de configurer ces informations en fonction de votre serveur MySQL

include '../connexion.php';

// Se connecter à la base de données
$connexion = new mysqli($host, $utilisateur, $mot_de_passe, $base_de_donnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

$adressemail = isset($_POST['adressemail']) ? $_POST['adressemail'] : '';
$newpassword = isset($_POST['newpassword']) ? password_hash($_POST['newpassword'], PASSWORD_DEFAULT) : '';

// Vérifier l'identité de l'utilisateur
$selectQuery = "SELECT * FROM hopital WHERE email = '$adressemail'";
$result = $connexion->query($selectQuery);

if ($result) {
    // Vérifier s'il y a des résultats
    if ($result->num_rows > 0) {
        // L'utilisateur est identifié, permettre la réinitialisation du mot de passe
        $row = $result->fetch_assoc();

        // Préparer la requête SQL d'update
        $updateQuery = "UPDATE hopital SET password = '$newpassword' WHERE email = '$adressemail'";

        // Exécuter la requête d'update
        if ($connexion->query($updateQuery) === TRUE) {
            header("Location: login.php");
        } else {
            echo "Erreur lors de la réinitialisation du mot de passe : " . $connexion->error;
        }
    } else {
        echo "Les informations fournies ne correspondent pas.";
    }

    // Libérer le résultat de la requête
    $result->free();
} else {
    echo "Erreur lors de la récupération des données : " . $connexion->error;
}

// Fermer la connexion à la base de données
$connexion->close();
