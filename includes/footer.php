<!-- Footer -->
<!-- Bouton Flottant -->
<div class="btn-float" onclick="window.location.href='/billeterie'">
    <span>Billetterie</span>
    <img src="https://cdn-icons-png.flaticon.com/512/4811/4811580.png" alt="Billetterie">
</div>

<footer class="footer-dark navbar-dark" id="footer">
    <div class="container py-5">
        <div class="row-footer">

            <!-- À propos de la section -->
            <div class="col-md-6 col-sm-12">
                <h5 class="text-uppercase mb-4">À propos</h5>
                <p class="mb-0">Le musée d'Annecy est un pilier du patrimoine culturel dans la région d'Annecy depuis plus de 50 ans. Nous sommes dédiés à présenter des expositions de qualité supérieure, à inspirer un amour pour l'art et la culture, et à éduquer les visiteurs de tous âges. Notre mission est d'explorer et de célébrer le riche tapestry d'histoire artistique et culturelle d'Annecy.</p>
            </div>
            <!-- Nous contacter la section -->
            <div class="col-md-6 col-sm-12">
                <h5 class="text-uppercase mb-4">Nous contacter</h5>
                <p><a href="/contact" class="text-reset">Informations de contact</a></p>
            </div>

            <!-- Liens utiles -->
            <div class="col-md-6 col-sm-12">
                <h5 class="text-uppercase mb-4">Liens utiles</h5>
                <ul class="list-unstyled">
                    <li><a href="/contact" class="text-reset">Contact</a></li>
                    <li><a href="https://fr.wikipedia.org/wiki/Pablo_Picasso" class="text-reset">A propos de Picasso Wiki</a></li>
                </ul>
            </div>

        </div>

        <!-- Droits d'auteur et année -->
        <div class="row mt-5">
            <div class="col text-center">
                <p class="text-muted mb-0 small">&copy; <?= date('Y') ?> Musée d'Annecy. Tous droits réservés.</p>
            </div>
        </div>
    </div>
<script src="../assets/script/button.js"></script>
</footer>
</body>
</html>