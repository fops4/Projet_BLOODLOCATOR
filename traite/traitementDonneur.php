<?php
// Assurez-vous de configurer ces informations en fonction de votre serveur MySQL
include '../hopital/connexion.php';

// Se connecter à la base de données
$connexion = new mysqli($host, $utilisateur, $mot_de_passe, $base_de_donnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

// Récupérer les données du formulaire
$nom = isset($_POST['nom']) ? $_POST['nom'] : '';
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
$date = isset($_POST['date']) ? $_POST['date'] : '';
$lieu = isset($_POST['lieu']) ? $_POST['lieu'] : '';
$sexe = isset($_POST['sexe']) ? $_POST['sexe'] : '';
$groupe_sanguin = isset($_POST['groupe_sanguin']) ? $_POST['groupe_sanguin'] : '';
$telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$confirm_password = isset($_POST['confirm-password']) ? $_POST['confirm-password'] : '';

// Valider les données du formulaire (ajoutez vos propres règles de validation si nécessaire)

// Vérifier si l'email n'est pas déjà utilisé
$email_check_query = "SELECT * FROM donneur WHERE email = ?";
$email_check_stmt = $connexion->prepare($email_check_query);
$email_check_stmt->bind_param("s", $email);
$email_check_stmt->execute();
$email_check_result = $email_check_stmt->get_result();

if ($email_check_result->num_rows > 0) {
    // L'email est déjà utilisé, vous pouvez prendre une action appropriée ici
    echo "L'email est déjà utilisé.";
    header("Location: ../form/login.php");
} else {
    // L'email n'est pas encore utilisé, vous pouvez insérer les données dans la base de données
    $insert_query = "INSERT INTO donneur (nom, prenom, date, lieu, sexe, telephone, email, password, groupe_sanguin, unique_id, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $insert_stmt = $connexion->prepare($insert_query);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Générer un unique_id aléatoire
    $unique_id = rand(time(), 100000000);

    // Définir le statut comme "Non connecté"
    $status = "Active now";

    $insert_stmt->bind_param("sssssssssss", $nom, $prenom, $date, $lieu, $sexe, $telephone, $email, $hashed_password, $groupe_sanguin, $unique_id, $status);

    if ($insert_stmt->execute()) {
        // Inséré avec succès
        session_start();
        $_SESSION['user_idd'] = $connexion->insert_id;  // Utilisez la fonction insert_id pour obtenir l'identifiant inséré
        $_SESSION['utilisateur_connectee'] = true;
        $_SESSION['unique_id'] = $unique_id;
        $_SESSION['status'] = $status;
        header("Location: ../index.php");
    } else {
        // Erreur lors de l'insertion
        echo "Erreur lors de l'inscription : " . $connexion->error;
    }
}

// Fermer la connexion à la base de données
$email_check_stmt->close();
$insert_stmt->close();
$connexion->close();
