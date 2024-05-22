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

    // Initialisation de la variable $output
    $output = "";

    // Requête SQL pour récupérer les messages entre les deux utilisateurs
    $sql = "SELECT * FROM messages LEFT JOIN hopital ON hopital.unique_id = messages.outgoing_msg_id
            WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
            OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";

    // Exécution de la requête SQL
    $query = mysqli_query($connexion, $sql);

    // Vérification si des messages sont présents
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {

            if ($row['outgoing_msg_id'] == $outgoing_id) {
                // Message sortant (émanant de l'utilisateur connecté)

                $output .= '<div class="chat outgoing">
                            <div class="details">
                                <p class="message-text">' . $row['msg'] . '
                                <span class="time small-text">' . date('H:i', strtotime($row['time'])) . '
                                </span></p>
                            </div>
                            <img src="../../BloodLocator/hopital/gestion_hopital/' . $row['image'] . '" alt="">
                        </div>';
            } else {
                // Message entrant (provenant de l'autre utilisateur)
                $output .= '<div class="chat incoming">
                    <img src="../../BloodLocator/hopital/gestion_hopital/' . $row['image'] . '" alt="">
                    <div class="details">
                                <p class="message-textt">' . $row['msg'] . '
                                <span class="time-t small-textt">' . date('H:i', strtotime($row['time'])) . '
                                </span></p>
                            </div>
                </div>';
            }
        }
    } else {
        // Aucun message disponible
        $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
    }

    // Affichage du contenu généré
    echo $output;
} else {
    // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    header("location: ../../index.php");
}
