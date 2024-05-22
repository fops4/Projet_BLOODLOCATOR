<?php
// Démarrage de la session
session_start();

// Vérification si l'utilisateur est connecté (la variable de session unique_id est définie)
if (isset($_SESSION['unique_id'])) {

    // Inclusion du fichier de configuration

    include "../../hopital/connexion.php";

    // Récupération de l'ID de l'utilisateur émetteur (celui qui est connecté)
    $outgoing_id = $_SESSION['unique_id'];

    // Récupération de l'ID de l'utilisateur destinataire à partir des données POST
    $incoming_id = mysqli_real_escape_string($connexion, $_POST['incoming_id']);

    // Récupération du message à partir des données POST
    $message = mysqli_real_escape_string($connexion, $_POST['message']);

    // Vérification si le message n'est pas vide
    if (!empty($message)) {
        // Récupération de l'heure actuelle
        $current_time = date("Y-m-d H:i:s");

        // Requête SQL pour insérer le nouveau message dans la table messages avec l'heure
        $sql = mysqli_query($connexion, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, time)
                                VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', '{$current_time}')") or die();
    }
} else {
    // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    header("location:  ../../index.php");
}
