<?php include '../config/db_config.php'; ?>
<?php include '../includes/header.php'; ?>
<div class="container my-5">
    <div class="header">
        <h1>Tarifs de l'exposition</h1>
        <p>Découvrez nos tarifs pour les différentes catégories de billets.</p>
    </div>
    <table class="table table-bordered text-center">
        <thead>
        <tr>
            <th>Catégorie</th>
            <th>Prix (€)</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            // Afficher les données de chaque ligne
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["category"]. "</td><td>" . $row["price"]. "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='2' class='text-center'>Aucun tarif trouvé</td></tr>";
        }
        $conn->close();
        ?>
        </tbody>
    </table>
</div>
<?php include '../includes/footer.php'; ?>
