<?php
session_start();

// Charger la configuration depuis le fichier JSON
$config = json_decode(file_get_contents('../../config/config.json'), true);

// Créer une connexion à la base de données
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Gérer la soumission du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Utiliser md5 pour le hashage du mot de passe

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}

// Gérer la soumission du formulaire de mise à jour des tarifs
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_price'])) {
    $id = $_POST['id'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("UPDATE ticket_prices SET price = ? WHERE id = ?");
    $stmt->bind_param("di", $price, $id);
    $stmt->execute();
}

// Récupérer les tarifs actuels
$prices = $conn->query("SELECT * FROM ticket_prices");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><img class="inverted-logo" src="../../assets/image/logo.png" alt="logo" /></a>
    </div>
</nav>

<div class="container">
    <?php if (!isset($_SESSION['loggedin'])): ?>
        <h2>Connexion Admin</h2>
        <form method="post" action="admin.php">
            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Se connecter</button>
            <?php if (isset($error)) { echo "<p class='text-danger'>$error</p>"; } ?>
        </form>
    <?php else: ?>
        <div class="admin-container">
            <h2>Admin - Modifier les Tarifs</h2>
            <?php if (isset($message)) { echo "<p class='text-success'>$message</p>"; } ?>
            <form method="post" action="admin.php">
                <div class="form-group">
                    <label for="category">Catégorie</label>
                    <select class="form-control" id="category" name="category" required>
                        <option value="Adulte">Adulte</option>
                        <option value="Enfant">Enfant</option>
                        <option value="Senior">Senior</option>
                        <option value="Étudiant">Étudiant</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="price">Prix (€)</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                </div>
                <button type="submit" name="update_price" class="btn btn-primary">Mettre à jour le tarif</button>
            </form>
            <h2>Tarifs actuels</h2>
            <table class="table-admin">
                <thead>
                <tr>
                    <th>Catégorie</th>
                    <th>Prix (€)</th>
                </tr>
                </thead>
                <?php while ($row = $prices->fetch_assoc()): ?>
                    <tr>
                        <form method="post" action="admin.php">
                            <td><?php echo $row['category']; ?></td>
                            <td><input type="number" name="price" class="form-control" value="<?php echo $row['price']; ?>" step="0.01" min="0"></td>
                            <td>
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="update_price" class="btn btn-primary">Mettre à jour</button>
                            </td>
                        </form>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php include '../../includes/footer.php'; ?>
</body>
</html>
