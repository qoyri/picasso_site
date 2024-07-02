<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Picasso</title>
    <meta name="google" content="notranslate">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Votre CSS personnalisé -->
    <link href="assets/css/styles.css" rel="stylesheet">
    <link rel="icon" href="https://www.freeiconspng.com/thumbs/museum-icon/art-history-museum-icon--4.png">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Fantastic+Antiqua&display=swap" rel="stylesheet">
    <meta name="format-detection" content="telephone=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
<!-- Barre de navigation ici, si nécessaire -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><img class="inverted-logo" src="assets/image/logo.png" alt="logo" /></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/oeuvres">Les Oeuvres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/picasso">À propos de Picasso</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/tarifs">Tarifs</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<canvas id="backgroundCanvas"></canvas>
<div class="embed-responsive embed-responsive-16by9">
    <div class="video-container">
        <video autoplay muted loop id="home-video" class="embed-responsive-item">
            <source src="assets/video/museum.mp4" type="video/mp4">
        </video>
        <div class="logo-container">
            <img src="assets/image/logo-page.png" alt="Logo" class="logo img-fluid">
        </div>
    </div>
</div>

<!-- Section Nouveautés -->
<div class="container my-5 section">
    <h2 class="text-center mb-4">Nouveautés</h2>
</div>
<div class="container-fluid mt-5">
    <div class="row-index">
        <div class="col-md-6 text-right">
            <h2>L'Exposition Picasso Arrive Bientôt !</h2>
            <p>Marquez vos calendriers. Du <strong>10 au 22 mai 2024</strong>, nous sommes extrêmement fiers<br>
                d'annoncer que notre musée accueillera une collection exclusive de <strong>neuf</strong> tableaux<br>
                de l'emblématique <strong>Picasso</strong>.</p>
            <p>Cette exposition offre une opportunité inégalée d'admirer de près les chefs-d'œuvre<br>
                de l'un des plus grands artistes du XXe siècle.</p>
            <p>Picasso était non seulement un peintre majeur, mais aussi un dessinateur, un<br>
                sculpteur et un graveur de renom.</p>
            <p>Né le 25 octobre 1881 à Malaga et mort le 8 avril 1973 à Mougins, Picasso a laissé une<br>
                grande influence sur le monde artistique, dont l'impact se fait encore sentir de nos<br>
                jours.</p>
            <p>Sa vie en France, son amour pour l'art et sa passion sans limite pour l'expression<br>
                artistique sont autant de sources d'inspiration pour les artistes d'aujourd'hui.</p>
            <p>Ne manquez pas cette occasion unique de plonger dans l'imaginaire infini de<br>
                Picasso. Venez, découvrez, aimez et laissez-vous inspirer. Nous sommes impatients<br>
                de vous accueillir à notre musée !</p>
        </div>
        <div class="col-md-6" id="threejs-or-carousel">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
            <script src="https://unpkg.com/three@0.128.0/examples/js/loaders/GLTFLoader.js"></script>
            <script src="https://unpkg.com/three@0.128.0/examples/js/controls/OrbitControls.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var container = document.getElementById('threejs-or-carousel');

                    if (window.innerWidth <= 768) {
                        // Si la largeur de la fenêtre est inférieure ou égale à 768px, chargez le carrousel Bootstrap
                        container.innerHTML = `
            <div class="carousel-container">
    <div id="carouselExposition" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/image/Jeune-fille-devant-un-miroir.jpg" class="d-block w-100" alt="Tableau 1">
            </div>
            <div class="carousel-item">
                <img src="assets/image/Le-reve.jpg" class="d-block w-100" alt="Tableau 2">
            </div>
            <div class="carousel-item">
                <img src="assets/image/Le-Baiser.jpg" class="d-block w-100" alt="Tableau 3">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExposition" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Précédent</span>
        </a>
        <a class="carousel-control-next" href="#carouselExposition" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Suivant</span>
        </a>
    </div>
</div>

        `;
                    } else {
                        // Sinon, chargez le modèle 3D
                        container.innerHTML = '<div id="threejs"></div>';
                        initThreeJS();
                    }
                });

                function initThreeJS() {
                    var container = document.getElementById('threejs');
                    var scene = new THREE.Scene();
                    var renderer = new THREE.WebGLRenderer({antialias: true, alpha: true}); // Ajout du paramètre alpha pour la transparence
                    var loader = new THREE.GLTFLoader();
                    var camera = new THREE.PerspectiveCamera(75, container.offsetWidth / container.offsetHeight, 0.1, 1000);

                    renderer.setClearColor(0x000000, 0); // Définir la couleur de fond sur transparente
                    renderer.setSize(container.offsetWidth, container.offsetHeight);
                    container.appendChild(renderer.domElement);

                    var textureLoader = new THREE.TextureLoader();
                    var textMesh;
                    const initialRotationX = (Math.PI / 180);
                    const initialRotationY = (Math.PI);
                    const initialRotationZ = (Math.PI / 180);
                    let targetRotationX = initialRotationX;
                    let targetRotationY = initialRotationY;
                    let targetRotationZ = initialRotationZ;
                    const rotationSpeed = 0.1;

                    var textures = [
                        textureLoader.load('assets/image/Jeune-fille-devant-un-miroir.jpg'),
                        textureLoader.load('assets/image/Le-reve.jpg'),
                        textureLoader.load('assets/image/Le-Baiser.jpg')
                    ];

                    var currentTextureIndex = 0;

                    function changeTexture() {
                        if (textMesh) {
                            textMesh.traverse(function (node) {
                                if (node instanceof THREE.Mesh && node.material.map) {
                                    node.material.map = textures[currentTextureIndex];
                                    node.material.needsUpdate = true;
                                }
                            });
                        }
                        currentTextureIndex = (currentTextureIndex + 1) % textures.length;
                    }

                    loader.load('assets/gltf/tableau.gltf', function (gltf) {
                        gltf.scene.rotation.y = Math.PI;
                        var count = 0;
                        gltf.scene.traverse(function (node) {
                            if (node instanceof THREE.Mesh) {
                                if (count === 0) {
                                    node.material = new THREE.MeshStandardMaterial({
                                        color: 0xD4AF37,
                                        metalness: 1,
                                        roughness: 0.5,
                                        emissive: 0xD4AF55,
                                        emissiveIntensity: 0.1
                                    });
                                } else if (count === 1) {
                                    node.material = new THREE.MeshBasicMaterial({map: textures[0]});
                                    // Faites pivoter l'image de la texture à 180 degrés
                                    node.geometry.attributes.uv.array.forEach((val, idx, array) => {
                                        if (idx % 2 === 0) {
                                            array[idx] = 1 - val; // Inverser l'axe U
                                        } else {
                                            array[idx] = 1 - val; // Inverser l'axe V
                                        }
                                    });
                                    node.geometry.attributes.uv.needsUpdate = true;
                                }
                                count++;
                            }
                        });

                        // Ajustez l'échelle et la position du modèle
                        gltf.scene.scale.set(3, 3, 3); // Ajustez ces valeurs pour changer l'échelle
                        gltf.scene.position.set(0, -1.7, 0.5); // Ajustez ces valeurs pour changer la position
                        textMesh = gltf.scene;

                        scene.add(gltf.scene);

                        // Change la texture toutes les 5 secondes
                        setInterval(changeTexture, 3000);
                    }, undefined, function (error) {
                        console.error(error);
                    });

                    renderer.setSize(container.offsetWidth, container.offsetHeight);
                    container.appendChild(renderer.domElement);

                    var directionalLight = new THREE.DirectionalLight(0xffffff, 0.5);
                    scene.add(directionalLight);

                    var light = new THREE.AmbientLight(0x404040);
                    scene.add(light);

                    camera.position.z = 2; // Ajustez la position de la caméra

                    var animate = function () {
                        requestAnimationFrame(animate);

                        // Interpolez doucement vers les rotations cibles
                        if (textMesh) {
                            textMesh.rotation.x += (targetRotationX - textMesh.rotation.x) * 0.1;
                            textMesh.rotation.y += (targetRotationY - textMesh.rotation.y) * 0.1;
                            // Ajoutez ceci si vous utilisez la rotation Z
                            // textMesh.rotation.z += (targetRotationZ - textMesh.rotation.z) * 0.1;
                        }

                        renderer.render(scene, camera);
                    };

                    animate();

                    document.addEventListener('mousemove', onDocumentMouseMove, false);

                    function onDocumentMouseMove(event) {
                        if (textMesh) {
                            const mouseX = (event.clientX / window.innerWidth) * 2 - 1;
                            const mouseY = -(event.clientY / window.innerHeight) * 2 + 1;

                            // Calculez la rotation autour de l'axe Z en fonction du mouvement horizontal de la souris
                            // Vous pouvez ajuster la valeur 0.1 pour changer la sensibilité de la rotation sur l'axe Z
                            const rotationZ = mouseX * 0.1;

                            // Calculez les rotations cibles basées sur la position de la souris
                            targetRotationX = initialRotationX - mouseY * rotationSpeed; // mettre + pour inverser la rotation
                            targetRotationY = initialRotationY - mouseX * rotationSpeed; // mettre + pour inverser la rotation
                            // Vous pouvez ajouter la rotation Z si nécessaire
                            // targetRotationZ = initialRotationZ + mouseX * rotationSpeed;
                            textMesh.rotation.z = initialRotationZ + rotationZ;
                        }
                    }

                    window.addEventListener('resize', onWindowResize, false);

                    function onWindowResize() {
                        camera.aspect = container.offsetWidth / container.offsetHeight;
                        camera.updateProjectionMatrix();
                        renderer.setSize(container.offsetWidth, container.offsetHeight);
                    }
                }
            </script>
        </div>
    </div>
</div>
<!-- <script src="assets/script/BackGround.js"></script> -->

<!-- Section Événements -->
<div class="container my-5 section">
    <h2 class="text-center mb-4">Événements à venir</h2>
    <div class="row">
        <div class="col-md-4">
            <img src="assets/image/grecque.jpg" alt="Grèce antique" class="img-fluid rounded mb-3">
            <h3>Grèce antique</h3>
            <p>Plongez dans le monde fascinant de la Grèce Antique. Explorez une collection de sculptures, de poteries et de bijoux qui racontent une histoire d'art et de culture qui a eu une influence significative sur le monde occidental.</p>
        </div>
        <div class="col-md-4">
            <img src="assets/image/egypte.jpg" alt="Égypte" class="img-fluid rounded mb-3">
            <h3>Égypte</h3>
            <p>Découvrez les secrets de l’Égypte Antique. Traversez les sépultures des pharaons, contemplez d'authentiques sarcophages et découvrez une civilisation qui a conquis le désert et laissé un héritage culturel inégalé.</p>
        </div>
        <div class="col-md-4">
            <img src="assets/image/lumiere.jpg" alt="Jeux de lumière" class="img-fluid rounded mb-3">
            <h3>Jeux de lumière</h3>
            <p>Visitez notre exposition immersif de lumière. Découvrez comment les artistes utilisent la lumière pour créer de l'art captivant. Une expérience sensorielle qui provoque l'émerveillement par l'exploration des contraste de l'ombre et de la lumière.</p>
        </div>
    </div>
</div>
<!-- Footer -->
<div class="btn-float" onclick="window.location.href='/billeterie'">
    <span>Billetterie</span>
    <img src="https://cdn-icons-png.flaticon.com/512/4811/4811580.png" alt="Billetterie">
</div>
<footer class="footer-dark navbar-dark" id="footer">
    <div class="container py-5">
        <div class="row-footer">

            <!-- À propos de la section -->
            <div class="col-md-6-footer col-sm-12">
                <h5 class="text-uppercase mb-4">À propos</h5>
                <p class="mb-0">Le musée d'Annecy est un pilier du patrimoine culturel dans la région d'Annecy depuis plus de 50 ans. Nous sommes dédiés à présenter des expositions de qualité supérieure, à inspirer un amour pour l'art et la culture, et à éduquer les visiteurs de tous âges. Notre mission est d'explorer et de célébrer le riche tapestry d'histoire artistique et culturelle d'Annecy.</p>
            </div>
            <!-- Nous contacter la section -->
            <div class="col-md-6-footer col-sm-12">
                <h5 class="text-uppercase mb-4">Nous contacter</h5>
                <p><a href="/contact" class="text-reset">Informations de contact</a></p>
            </div>

            <!-- Liens utiles -->
            <div class="col-md-6-footer col-sm-12">
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
</footer>
<script src="assets/script/button.js"></script>
</body>
</html>
