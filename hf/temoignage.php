<?php
include '../hopital/connexion.php'; // Inclure le fichier de connexion à la base de données

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $name = $_POST['name'];
    $profession = $_POST['profession'];
    $temoignage = $_POST['temoignage'];

    // Récupérer les données de l'image
    $image = $_FILES['image']['name'];
    $temp_image = $_FILES['image']['tmp_name'];
    
    // Vérification de l'existence de l'image et de son format
    if (isset($image) && !empty($image) && in_array(pathinfo($image, PATHINFO_EXTENSION), array('jpg', 'jpeg', 'png', 'gif'))) {
        // Déplacement de l'image dans le dossier d'images du site
        move_uploaded_file($temp_image, 'image/' . $image);
        
        // Insérer les données dans la table temoignage
        $sql = "INSERT INTO temoignage (name, profession, temoignage, image) VALUES (?, ?, ?, ?)";
        $stmt = $connexion->prepare($sql);
        
        // Vérifier si la préparation de la requête a réussi
        if ($stmt) {
            $stmt->bind_param("ssss", $name, $profession, $temoignage, $image);
            $stmt->execute();
            
            // Vérifier si l'insertion a réussi
            if ($stmt->affected_rows > 0) {
                header("location: ../index.php");
                exit();
            } else {
                echo "Erreur lors de l'enregistrement du témoignage : " . $connexion->error;
            }
        } else {
            echo "Erreur lors de la préparation de la requête : " . $connexion->error;
        }

        // Fermeture de la requête préparée
        $stmt->close();
    } else {
        echo 'Veuillez sélectionner une photo valide.';
    }
}

// Fermer la connexion à la base de données
$connexion->close();
?>