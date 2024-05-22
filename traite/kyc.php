<?php
session_start();

include '../hopital/connexion.php';


// Récupérer l'ID de l'utilisateur depuis la session
$userID = $_SESSION['user_idd'];

// Récupérer les données du formulaire KYC
$kycName = isset($_POST['kycName']) ? $_POST['kycName'] : '';
$kycID = isset($_POST[' kycID']) ? $_POST[' kycID'] : '';

// Gérer les photos recto et verso
$kycFrontPhoto = ''; // Nom du fichier pour le recto
$kycBackPhoto = '';  // Nom du fichier pour le verso


if (!empty($_FILES['kycFrontPhoto']['name'])) {
    $uploadDirectory = '../hopital/gestion_hopital/dossier_kyc/';
    $kycFrontPhoto = $uploadDirectory . basename($_FILES['kycFrontPhoto']['name']);
    move_uploaded_file($_FILES['kycFrontPhoto']['tmp_name'], $kycFrontPhoto);
}

if (!empty($_FILES['kycBackPhoto']['name'])) {
    $uploadDirectory = '../hopital/gestion_hopital/dossier_kyc/';
    $kycBackPhoto = $uploadDirectory . basename($_FILES['kycBackPhoto']['name']);
    move_uploaded_file($_FILES['kycBackPhoto']['tmp_name'], $kycBackPhoto);
}

// Préparer et exécuter la requête d'insertion KYC
$requeteInsertKYC = "INSERT INTO kyc (user_id, kycName,  kycID, kycFrontPhoto, kycBackPhoto) VALUES (?, ?, ?, ?, ?)";
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
