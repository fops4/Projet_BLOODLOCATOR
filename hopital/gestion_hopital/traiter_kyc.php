<?php
session_start();

include '../connexion.php';


// Récupérer l'ID de l'utilisateur depuis la session
$userID = $_SESSION['user_id'];

// Récupérer les données du formulaire KYC
$kycName = isset($_POST['kyc_Name']) ? $_POST['kyc_Name'] : '';
$kycID = isset($_POST['kyc_id']) ? $_POST['kyc_id'] : '';

// Gérer les photos recto et verso
$kycFrontPhoto = ''; // Nom du fichier pour le recto
$kycBackPhoto = '';  // Nom du fichier pour le verso

if (!empty($_FILES['kyc_front_photo']['name'])) {
    $uploadDirectory = 'dossier_kyc/';
    $kycFrontPhoto = $uploadDirectory . basename($_FILES['kyc_front_photo']['name']);
    move_uploaded_file($_FILES['kyc_front_photo']['tmp_name'], $kycFrontPhoto);
}

if (!empty($_FILES['kyc_back_photo']['name'])) {
    $uploadDirectory = 'dossier_kyc/';
    $kycBackPhoto = $uploadDirectory . basename($_FILES['kyc_back_photo']['name']);
    move_uploaded_file($_FILES['kyc_back_photo']['tmp_name'], $kycBackPhoto);
}

// Préparer et exécuter la requête d'insertion KYC
$requeteInsertKYC = "INSERT INTO kyc_data (user_id, kyc_Name, kyc_id, kyc_front_photo, kyc_back_photo) VALUES (?, ?, ?, ?, ?)";
$stmtInsertKYC = $connexion->prepare($requeteInsertKYC);
$stmtInsertKYC->bind_param("issss", $userID, $kycName, $kycID, $kycFrontPhoto, $kycBackPhoto);
$stmtInsertKYC->execute();

// Vérifier si l'insertion a réussi
if ($stmtInsertKYC->affected_rows > 0) {
    // Insertion réussie
    $response = array('success' => true, 'message' => 'KYC soumis avec succès !');
} else {
    // Échec de l'insertion
    $response = array('success' => false, 'message' => 'Échec de la soumission du KYC.');
}

// Retournez la réponse en format JSON
echo json_encode($response);

// Fermer la connexion à la base de données
$stmtInsertKYC->close();
$connexion->close();
