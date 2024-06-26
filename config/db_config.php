<?php
// Lire le fichier JSON et obtenir les paramètres de connexion
$configFile = 'config.json'; // Chemin vers votre fichier JSON
$config = json_decode(file_get_contents($configFile), true);

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

// Afficher les résultats
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Category: " . $row["category"]. " - Price: " . $row["price"]. "<br>";
    }
} else {
    echo "0 results";
}

// Fermer la connexion
$conn->close();
?>
