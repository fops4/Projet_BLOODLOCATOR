<?php
include '../connexion.php';

// Récupérer les données du formulaire
$hopitalname = $_POST['hopitalname'];
$hopitaladress = $_POST['hopitaladress'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$creationDate = $_POST['creationDate'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hasher le mot de passe
$confirmPassword = password_hash($_POST['confirmPassword'], PASSWORD_DEFAULT);

// Générer un unique_id aléatoire
$unique_id = rand(time(), 100000000);

// Définir le status comme "Active now"
$status = "Active now";

// Vérifier si l'email existe déjà
$emailCheckQuery = "SELECT * FROM hopital WHERE email = ?";
$emailCheckStmt = $connexion->prepare($emailCheckQuery);
$emailCheckStmt->bind_param("s", $email);
$emailCheckStmt->execute();
$emailCheckResult = $emailCheckStmt->get_result();

if ($emailCheckResult->num_rows > 0) {
    // L'email existe déjà, afficher un message d'erreur
    echo "Erreur lors de l'inscription : Cet email est déjà utilisé.";
    exit();
}

$emailCheckStmt->close();

// Vérifier si le numéro de téléphone existe déjà
$phoneCheckQuery = "SELECT * FROM hopital WHERE phone = ?";
$phoneCheckStmt = $connexion->prepare($phoneCheckQuery);
$phoneCheckStmt->bind_param("s", $phone);
$phoneCheckStmt->execute();
$phoneCheckResult = $phoneCheckStmt->get_result();

if ($phoneCheckResult->num_rows > 0) {
    // Le numéro de téléphone existe déjà, afficher un message d'erreur
    echo "Erreur lors de l'inscription : Ce numéro de téléphone est déjà utilisé.";
    exit();
}

$phoneCheckStmt->close();

// Si l'email et le numéro de téléphone n'existent pas, procédez à l'insertion
$insertQuery = "INSERT INTO hopital (hopitalname, hopitaladress, phone, email, creationDate, password, unique_id, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $connexion->prepare($insertQuery);

$stmt->bind_param("ssssssss", $hopitalname, $hopitaladress, $phone, $email, $creationDate, $password, $unique_id, $status);

if ($stmt->execute()) {
    // L'inscription a réussi
    session_start();
    $_SESSION['user_id'] = $stmt->insert_id;
    $_SESSION['hopitalname'] = $hopitalname;
    $_SESSION['unique_id'] = $unique_id; // Ajout de l'unique_id dans la session
    $_SESSION['utilisateur_connecte'] = true;
    header("Location: ../../index.php");
    exit();
} else {
    echo "Erreur lors de l'inscription : " . $stmt->error;
}

$stmt->close();
$connexion->close();
