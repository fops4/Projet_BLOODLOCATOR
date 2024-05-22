<?php
// Boucle while pour parcourir chaque ligne de résultats de la requête SQL
while ($row = mysqli_fetch_assoc($query)) {

    // Requête SQL pour récupérer le dernier message de la conversation avec le contact actuel
    $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";

    // Exécution de la requête SQL2
    $query2 = mysqli_query($connexion, $sql2);

    // Récupération de la première ligne de résultat de la requête SQL2
    $row2 = mysqli_fetch_assoc($query2);

    // Si des messages sont présents dans la conversation, les récupérer, sinon indiquer "No message available"
    (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result = "No message available";

    // Limiter la longueur du message à 28 caractères avec des points de suspension s'il est plus long
    (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;

    // Vérifier si l'utilisateur actuel est l'émetteur du dernier message
    if (isset($row2['outgoing_msg_id'])) {
        ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
    } else {
        $you = "";
    }

    // Vérifier le statut en ligne ou hors ligne de l'utilisateur
    ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";

    // Cacher le point en ligne pour l'utilisateur actuel dans la liste
    ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";

    // Construction du HTML pour chaque contact avec des liens vers la page de chat
    $output .= '<a href="chat.php?id=' . $row['unique_id'] . '">
                    <div class="content">
                    <img src="../../BloodLocator/hopital/gestion_hopital/' . $row['image'] . '" alt="">
                    <div class="details">
                        <span>' . $row['hopitalname'] . " " . $row['hopitaladress'] . '</span>
                        <p>' . $you . $msg . '</p>
                    </div>
                    </div>
                    <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                </a>';
}
