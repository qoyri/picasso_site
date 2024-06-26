<?php
$config = json_decode(file_get_contents('../config/config.json'), true);
include '../config/db_config.php'; ?>
<?php include '../includes/header.php'; ?>
<div class="container my-5">
    <h2 class="text-center mb-4">Billetterie</h2>
    <div class="table-container">
        <form id="ticketForm" onsubmit="showPaymentForm(); return false;">
            <table class="table table-striped text-center">
                <thead>
                <tr>
                    <th>Catégorie</th>
                    <th>Prix (€)</th>
                    <th>Nombre de Tickets</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Afficher les données de chaque ligne
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["category"] . "</td>";
                        echo "<td>" . $row["price"] . "</td>";
                        echo "<td><input type='number' class='form-control' value='0' min='0' onchange='calculateTotal()' data-price='" . $row["price"] . "'></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>Aucun tarif trouvé</td></tr>";
                }
                $conn->close();
                ?>
                </tbody>
            </table>
            <div class="text-right">
                <h3>Total : <span id="totalPrice">0.00</span> €</h3>
                <button type="submit" class="btn btn-primary">Acheter</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal pour le paiement -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Paiement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="paymentForm" onsubmit="showQRCode(); return false;">
                    <div class="form-group">
                        <label for="cardNumber">Numéro de carte</label>
                        <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 9012 3456" required>
                    </div>
                    <div class="form-group">
                        <label for="cardExpiry">Date d'expiration</label>
                        <input type="text" class="form-control" id="cardExpiry" placeholder="MM/AA" required>
                    </div>
                    <div class="form-group">
                        <label for="cardCVC">CVC</label>
                        <input type="text" class="form-control" id="cardCVC" placeholder="123" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Payer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour le QR code -->
<div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="qrModalLabel">Votre Billet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>Scannez ce QR code pour obtenir votre billet :</p>
                <img src="../assets/image/code.png" alt="QR Code" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<script src="../assets/script/billeterie.js"></script>
<?php include '../includes/footer.php'; ?>