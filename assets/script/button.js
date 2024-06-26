window.addEventListener('scroll', function() {
    var footer = document.getElementById('footer');
    var btnFloat = document.querySelector('.btn-float');
    var footerRect = footer.getBoundingClientRect();
    var btnRect = btnFloat.getBoundingClientRect();

    // Vérifiez si le bouton chevauche le pied de page
    if (footerRect.top <= window.innerHeight) {
    btnFloat.style.bottom = (window.innerHeight - footerRect.top + 20) + 'px';
} else {
    btnFloat.style.position = 'fixed';
    btnFloat.style.bottom = '20px';
}
});
