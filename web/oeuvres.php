<?php include '../includes/header.php'; ?>

<main class="container mt-5">
    <h2>Les Œuvres</h2>

    <div id="selected-oeuvre" class="d-none"> <!-- Hidden by default -->
        <div class="row">
            <div class="col-lg-8" id="selected-image">
                <!-- The clicked image will be displayed here -->
            </div>
            <div class="col-lg-4">
                <h3 id="selected-title"></h3> <!-- The title will be displayed here -->
                <div id="wiki-text"><!-- The Wikipedia text will be displayed here --></div>
                <button id="back-button">
                    <img src="https://cdn-icons-png.flaticon.com/512/9283/9283458.png" alt="Back">
                </button>
            </div>
        </div>
    </div>
    <!-- The original grid of images remain here -->
    <div class="row" id="oeuvres-container">
        <!-- The artworks will be inserted here by JavaScript -->
    </div>
</main>
    <script src="../assets/script/oeuvre.js"></script>
<?php include '../includes/footer.php'; ?>