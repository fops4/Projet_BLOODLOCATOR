<?php
// Démarrage de la session
session_start();

// Inclusion du fichier de configuration

include "../../hopital/connexion.php";

// Récupération de l'ID de l'utilisateur émetteur (celui qui est connecté)
$outgoing_id = $_SESSION['unique_id'];

// Requête SQL pour récupérer la liste des utilisateurs (à l'exception de l'utilisateur connecté)
$sql = "SELECT * FROM hopital WHERE NOT unique_id = {$outgoing_id} ORDER BY id DESC";



// Exécution de la requête SQL
$query = mysqli_query($connexion, $sql);

// Initialisation de la variable $output
$output = "";

// Vérification du nombre de lignes résultantes de la requête
if (mysqli_num_rows($query) == 0) {
    // Aucun utilisateur disponible
    $output .= "No users are available to chat";
} elseif (mysqli_num_rows($query) > 0) {
    // Inclusion du script data.php (non fourni dans le code donné)
    include_once "data.php";
}

// Affichage du contenu généré
echo $output;
