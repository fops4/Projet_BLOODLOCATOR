<?php
$host = 'localhost';
$utilisateur = 'root';
$mot_de_passe = '';
$base_de_donnees = 'bloodlocator';

$connexion = new mysqli($host, $utilisateur, $mot_de_passe, $base_de_donnees);

if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}
