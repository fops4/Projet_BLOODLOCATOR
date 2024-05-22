










<?php
// Assurez-vous de configurer ces informations en fonction de votre serveur MySQL
$host = 'localhost';
$utilisateur = 'root';
$mot_de_passe = '';
$base_de_donnees = 'bloodlocator';

// Se connecter à la base de données
$connexion = new mysqli($host, $utilisateur, $mot_de_passe, $base_de_donnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

// Récupérer tous les hôpitaux de la base de données
$selectQuery = "SELECT * FROM donneur";
$result = $connexion->query($selectQuery);

// Vérifier si un formulaire de modification a été soumis
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $adresse = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $updateQuery = "UPDATE donneur SET nom = ?, prenom = ?, telephone = ? WHERE id = ?";
        
        // Utiliser une instruction préparée pour éviter les attaques par injection SQL
        $stmt = $connexion->prepare($updateQuery);
        $stmt->bind_param("sssi", $nom, $adresse, $telephone, $id);

    // Exécuter la requête de mise à jour
    if ($stmt->execute()) {
        echo "Mise à jour réussie.";
        // Rediriger vers index.php
        header("Location: donneur.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour : " . $stmt->error;
    }
    
    // Fermer la requête préparée
    $stmt->close();
}

// Vérifier si un formulaire de suppression a été soumis
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    
    // Préparer la requête SQL de suppression avec un paramètre
    $deleteQuery = "DELETE FROM donneur WHERE id = ?";
    
    // Utiliser une instruction préparée pour éviter les attaques par injection SQL
    $stmt = $connexion->prepare($deleteQuery);
    $stmt->bind_param("i", $id);
    
    // Exécuter la requête de suppression
    if ($stmt->execute()) {
        echo "Suppression réussie.";
        // Rediriger vers index.php
        header("Location: donneur.php");
        exit();
    } else {
        echo "Erreur lors de la suppression : " . $stmt->error;
    }
    
    // Fermer la requête préparée
    $stmt->close();
}

// Fermer la connexion à la base de données
$connexion->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des Donneurs</title>
    <style>
    
    table {
  width: 100%;
  border-collapse: collapse;
  background-color: #f8f8f8;
  font-family: Arial, sans-serif;
}

th, td {
  padding: 12px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #333;
  color: white;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

tr:hover {
  background-color: #e6e6e6;
}

img {
  max-width: 80px;
  height: auto;
  border-radius: 50%;
}

input[type="text"], input[type="file"] {
  padding: 6px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

button {
  padding: 8px 16px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button:hover {
  background-color: #45a049;
}
  </style>
</head>
<body>
    
    <h1>Liste des hôpitaux</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Téléphone</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nom']; ?></td>
                <td><?php echo $row['prenom']; ?></td>
                <td><?php echo $row['telephone']; ?></td>
                <td>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="text" name="nom" value="<?php echo $row['nom']; ?>">
                        <input type="text" name="prenom" value="<?php echo $row['prenom']; ?>">
                        <input type="text" name="telephone" value="<?php echo $row['telephone']; ?>">
                        <button type="submit" name="update">Modifier</button>
                        <button type="submit" name="delete">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>