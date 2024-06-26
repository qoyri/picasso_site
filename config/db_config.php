<?php
// Vérifier si les informations ont été correctement lues
if (json_last_error() !== JSON_ERROR_NONE) {
    die("Error reading database configuration: " . json_last_error_msg());
}

// Récupérer les informations de connexion
$servername = $config['servername'];
$username = $config['username'];
$password = $config['password'];
$dbname = $config['dbname'];

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Requête SQL pour récupérer les tarifs
$sql = "SELECT category, price FROM tarifs";
$result = $conn->query($sql);
?>
