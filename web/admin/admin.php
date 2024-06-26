<?php
session_start();
include '../../config/db_config.php';

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("UPDATE ticket_prices SET price = ? WHERE id = ?");
    $stmt->bind_param("di", $price, $id);
    $stmt->execute();
}

$prices = $conn->query("SELECT * FROM ticket_prices");
?>

<?php include '../../includes/header.php'; ?>

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
        <button type="submit" class="btn btn-primary">Mettre à jour le tarif</button>
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
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </td>
                </form>
            </tr>
        <?php endwhile; ?>
    </table>
</div>
