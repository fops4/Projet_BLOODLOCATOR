<?php
// Démarrez la session
session_start();

// Vérifiez si l'utilisateur est connecté
if (isset($_SESSION['unique_id'])) {
    include '../connexion.php';

    // Mise à jour du statut à "Offline now"
    $status = "Offline now";
    $sql = mysqli_query($connexion, "UPDATE hopital SET status = '{$status}' WHERE unique_id = {$_SESSION['unique_id']}");

    // Vérifiez si la mise à jour a réussi
    if ($sql) {
        // Détruire toutes les variables de session
        $_SESSION = array();

        // Détruire la session
        session_destroy();

        // Rediriger vers la page d'accueil (ou une autre page appropriée)
        header("Location: ../../index.php");
        exit();
    } else {
        // En cas d'échec de la mise à jour, afficher un message d'erreur ou prendre une autre action appropriée
        echo "Erreur lors de la mise à jour du statut.";
    }
} else {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page d'accueil (ou une autre page appropriée)
    header("Location: ../../index.php");
    exit();
}
