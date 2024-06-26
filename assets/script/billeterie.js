function calculateTotal() {
    const adultPrice = 12.50;
    const childPrice = 8.00;
    const seniorPrice = 10.00;
    const studentPrice = 9.00;

    const adultTickets = document.getElementById('adultTickets').value;
    const childTickets = document.getElementById('childTickets').value;
    const seniorTickets = document.getElementById('seniorTickets').value;
    const studentTickets = document.getElementById('studentTickets').value;

    const totalPrice = (adultTickets * adultPrice) + (childTickets * childPrice) + (seniorTickets * seniorPrice) + (studentTickets * studentPrice);

    document.getElementById('totalPrice').innerText = totalPrice.toFixed(2);
}

function showPaymentForm() {
    $('#paymentModal').modal('show');
}

function showQRCode() {
    $('#paymentModal').modal('hide');
    $('#qrModal').modal('show');
}