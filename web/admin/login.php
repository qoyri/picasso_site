<?php
session_start();
$config = json_decode(file_get_contents('../../config/config.json'), true);
include '../../config/db_config.php'; // Fichier contenant la connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Utiliser md5 pour le hashage du mot de passe

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: admin.php");
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Picasso</title>
    <meta name="google" content="notranslate">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Votre CSS personnalisé -->
    <link href="../../assets/css/styles.css" rel="stylesheet">
    <link rel="icon" href="https://www.freeiconspng.com/thumbs/museum-icon/art-history-museum-icon--4.png">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Fantastic+Antiqua&display=swap" rel="stylesheet">
    <meta name="format-detection" content="telephone=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
<!-- Barre de navigation ici, si nécessaire -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><img class="inverted-logo" src="../../assets/image/logo.png" alt="logo" /></a>
</nav>

<div class="container">
    <h2>Connexion Admin</h2>
    <form method="post" action="login.php">
        <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
        <?php if (isset($error)) { echo "<p class='text-danger'>$error</p>"; } ?>
    </form>
</div>
</body>
</html>
