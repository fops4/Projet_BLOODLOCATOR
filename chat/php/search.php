<?php
session_start();

include "../../hopital/connexion.php";

$outgoing_id = $_SESSION['unique_id'];
$searchTerm = mysqli_real_escape_string($connexion, $_POST['searchTerm']);

$sql = "SELECT * FROM hopital WHERE NOT unique_id = {$outgoing_id} AND (hopitalname LIKE '%{$searchTerm}%' OR hopitaladress LIKE '%{$searchTerm}%') ";
$output = "";
$query = mysqli_query($connexion, $sql);
if (mysqli_num_rows($query) > 0) {
    include_once "data.php";
} else {
    $output .= 'No user found related to your search term';
}
echo $output;
