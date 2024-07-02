<?php
session_start();

// Charger la configuration depuis le fichier JSON
$config = json_decode(file_get_contents('../../config/config.json'), true);

include '../../config/db_config.php';

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function setLoginCookie($username) {
    $expireTime = time() + (15 * 60); // 15 minutes
    setcookie('loggedin', $username, $expireTime, "/");
    setcookie('login_time', time(), $expireTime, "/");
}

function isLoginCookieValid() {
    if (isset($_COOKIE['loggedin']) && isset($_COOKIE['login_time'])) {
        if ((time() - $_COOKIE['login_time']) <= (15 * 60)) {
            setLoginCookie($_COOKIE['loggedin']); // Refresh the cookie
            return true;
        } else {
            clearLoginCookies();
        }
    }
    return false;
}

function clearLoginCookies() {
    setcookie('loggedin', '', time() - 3600, "/");
    setcookie('login_time', '', time() - 3600, "/");
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
        setLoginCookie($username);
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: /admin");
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}

// Gérer la soumission du formulaire de mise à jour des tarifs
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_price'])) {
    if (isLoginCookieValid()) {
        $id = $_POST['id'];
        $price = $_POST['price'];

        $stmt = $conn->prepare("UPDATE tarifs SET price = ? WHERE id = ?");
        $stmt->bind_param("di", $price, $id);
        $stmt->execute();

        // Rafraîchir la page pour afficher les mises à jour
        header("Refresh:0");
        exit;
    } else {
        clearLoginCookies();
        $_SESSION['loggedin'] = false;
    }
}

// Gérer la déconnexion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
    clearLoginCookies();
    session_unset();
    session_destroy();
    header("Location: /admin");
    exit;
}

// Récupérer les tarifs actuels
$prices = $conn->query("SELECT * FROM tarifs");
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
<div class="wrapper">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/"><img class="inverted-logo" src="../../assets/image/logo.png" alt="logo" /></a>
            <?php if (isLoginCookieValid()): ?>
                <form method="post" action="" class="ml-auto">
                    <button type="submit" name="logout" class="logout-btn">Déconnexion</button>
                </form>
            <?php endif; ?>
        </div>
    </nav>

    <div class="content">
        <div class="container">
            <?php if (!isLoginCookieValid()): ?>
                <h2>Connexion Admin</h2>
                <form method="post" action="">
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
                                <form method="post" action="">
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
    </div>
    <?php include '../../includes/footer.php'; ?>
</div>
</body>
</html>

