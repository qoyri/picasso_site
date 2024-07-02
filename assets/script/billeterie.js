function calculateTotal() {
    var total = 0;
    document.querySelectorAll("input[type='number']").forEach(function(input) {
        var price = parseFloat(input.getAttribute("data-price"));
        var quantity = parseInt(input.value);
        total += price * quantity;
    });
    document.getElementById("totalPrice").textContent = total.toFixed(2);
}

function showPaymentForm() {
    $('#paymentModal').modal('show');
}

function showQRCode() {
    $('#paymentModal').modal('hide');
    $('#qrModal').modal('show');
}