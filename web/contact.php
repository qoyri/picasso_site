<?php include '../includes/header.php'; ?>

    <main class="container mt-5">
        <!-- Contact Information -->
        <div class="row mb-5">
            <div class="col-lg-6">
                <h3>Information de contact</h3>
                <p><strong>Adresse :</strong> <br>1 Rue du Musée, 74000 Annecy, France</p>
                <p><strong>Téléphone :</strong> <br>+33 4 50 33 87 30</p>
                <p><strong>Email :</strong> <br>contact@museedannecy.fr</p>
                <h3>Horaires d'ouverture</h3>
                <p>
                    <strong>Mardi à Vendredi :</strong> <br>10h00 - 12h00, 14h00 - 18h30<br>
                    <strong>Samedi et Dimanche :</strong> <br>10h00 - 19h00
                </p>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-6">
                <h3>Envoyez-nous un message</h3>
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Votre nom" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Votre email" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="message" name="message" rows="3" placeholder="Votre message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div>
        </div>

        <!-- Map -->
        <div class="row">
            <div class="col">
                <h3>Localisez-nous</h3>
                <!-- Note: You need to embed Google Maps iframe code here -->
                <div id="iframe-container">
                    <iframe id="map-iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2776.6148895757483!2d6.125654654563053!3d45.899014843476934!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478b8fefd42e8b53%3A0xd4da98f8096cf6de!2sConservatoire%20d'Art%20et%20d'Histoire!5e0!3m2!1sfr!2sfr!4v1719356341583!5m2!1sfr!2sfr" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </main>

<?php include '../includes/footer.php'; ?>