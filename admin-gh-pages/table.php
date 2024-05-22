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

// Récupérer tous les donneurs de la base de données
$selectQuery = "SELECT * FROM donneur";
$result = $connexion->query($selectQuery);

// Vérifier si un formulaire de modification a été soumis
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $groupeSanguin = $_POST['groupe_sanguin'];
    $telephone = $_POST['telephone'];

    // Préparer la requête SQL de mise à jour
    $updateQuery = "UPDATE donneur SET nom = ?, groupe_sanguin = ?, telephone = ? WHERE id = ?";

    // Utiliser une instruction préparée pour éviter les attaques par injection SQL
    $stmt = $connexion->prepare($updateQuery);
    $stmt->bind_param("sssi", $nom, $groupeSanguin, $telephone, $id);

    // Exécuter la requête de mise à jour
    if ($stmt->execute()) {
        echo "Mise à jour réussie.";
        // Rediriger vers index.php
        header("Location: index.php");
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
        header("Location: index.php");
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
    <title>Liste des donneurs</title>
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

        input[type="text"] {
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
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
<a class="navbar-brand ps-3" href="index.php">BloodLocator</a>
<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Groupe sanguin</th>
        <th>Téléphone</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nom']; ?></td>
            <td><?php echo $row['groupe_sanguin']; ?></td>
            <td><?php echo $row['telephone']; ?></td>
        </tr>
    <?php } ?>
</table>



</body>
</html>